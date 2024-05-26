<template>
  <v-card flat>
    <v-data-table
      :headers="headers"
      :items="proyectos"
      :sort-by="[{ key: 'nombre', order: 'asc' }]"
      v-model:search="search"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Proyectos</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-text-field
            v-model="search"
            density="compact"
            label="Buscar"
            prepend-inner-icon="mdi-magnify"
            variant="solo-filled"
            class="mr-2"
            flat
            hide-details
            single-line
          ></v-text-field>

          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ props }">
              <v-btn class="mr-2 bg-blue" elevation="4" v-bind="props">
                Crear
              </v-btn>
            </template>

            <v-form @submit.prevent="save">
              <v-card>
                <v-card-title class="pa-4">
                  <span class="text-h5">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12" class="pa-2 pb-0">
                        <v-text-field
                          v-model="form.nombre"
                          :rules="rules"
                          label="Nombre"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" class="pa-2 pb-0">
                        <v-select
                          v-model="form.departamento_id"
                          :items="select_departamento"
                          item-title="nombre"
                          item-value="value"
                          :rules="rules"
                          label="Departamento"
                          @update:modelValue="
                            form.ciudad_id = null;
                            getSelectCiudad(`${form.departamento_id}`);
                          "
                          required
                        ></v-select>
                      </v-col>
                      <v-col cols="12" class="pa-2 pb-0">
                        <v-select
                          v-model="form.ciudad_id"
                          :items="select_ciudad"
                          item-title="nombre"
                          item-value="id"
                          :rules="rules"
                          label="Ciudad"
                          required
                        ></v-select>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions class="pa-4">
                  <v-spacer></v-spacer>
                  <v-btn
                    class="bg-green"
                    elevation="4"
                    variant="text"
                    type="submit"
                  >
                    Guardar
                  </v-btn>
                  <v-btn
                    class="bg-grey"
                    elevation="4"
                    variant="text"
                    @click="close"
                  >
                    Cancelar
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </v-dialog>

          <v-dialog v-model="dialogMateriales" max-width="1000px">
            <Asociar :proyecto_id="proyecto_id" />
          </v-dialog>

          <v-dialog v-model="dialogCorrect" max-width="320">
            <v-list class="py-2" color="primary" elevation="12" rounded="lg">
              <v-list-item
                append-icon="mdi-check-all"
                title="Registro guardado exitosamente"
              >
                <template v-slot:append>
                  <div class="pe-4">
                    <v-icon color="success" size="x-large"></v-icon>
                  </div>
                </template>
              </v-list-item>
            </v-list>
          </v-dialog>

          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5 text-center"
                >¿Está seguro de eliminar el proyecto?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue-darken-1"
                  variant="text"
                  @click="deleteItemConfirm(this.form.id)"
                  >Si</v-btn
                >
                <v-btn color="blue-darken-1" variant="text" @click="closeDelete"
                  >No</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:[`item.actions`]="{ item }">
        <v-icon class="me-2" size="small" @click="editarProyecto(item)">
          mdi-pencil
        </v-icon>
        <v-icon class="me-2" size="small" @click="deleteItem(item)">
          mdi-delete
        </v-icon>
        <v-btn
          class="bg-orange"
          variant="text"
          @click="asociarMateriales(item)"
        >
          Materiales
        </v-btn>
      </template>
      <template v-slot:no-data>
        <p>No hay información</p>
      </template>
    </v-data-table>
  </v-card>
</template>
<script>
import axios from "axios";
import Asociar from "./Asociar.vue";
export default {
  name: "Proyectos",
  data: (vm) => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    dialogCorrect: false,
    dialogMateriales: false,
    headers: [
      { title: "Nombre", key: "nombre" },
      { title: "Departamento", key: "nombre_departamento.nombre" },
      { title: "Ciudad", key: "nombre_ciudad.nombre" },
      { title: "Acciones", key: "actions", sortable: false },
    ],
    proyectos: [],
    index: -1,
    form: {
      id: null,
      nombre: null,
      departamento_id: null,
      ciudad_id: null,
    },
    defaultForm: {
      id: null,
      nombre: null,
      departamento_id: null,
      ciudad_id: null,
    },
    proyecto_id: null,
    select_departamento: [],
    select_ciudad: [],
    rules: [(value) => vm.checkApi(value)],
    url: "http://localhost/IDRD/backend/public/api/",
  }),

  components: {
    Asociar,
  },

  computed: {
    formTitle() {
      return this.index === -1 ? "Crear Proyecto" : "Editar Proyecto";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
    dialogCorrect(val) {
      if (!val) return;

      setTimeout(() => (this.dialogCorrect = false), 1000);
    },
  },

  created() {
    this.initialize();
    this.select_departamento = this.getSelectParametro(2);
  },

  methods: {
    initialize() {
      axios.get(this.url + "proyectos").then((response) => {
        this.proyectos = response.data;
      });
    },

    getSelectParametro(parametro_id) {
      let select = [];
      axios
        .get(this.url + "getSelectParametro/" + parametro_id)
        .then((response) => {
          for (let parametro of response.data) {
            select.push(parametro);
          }
        });
      return select;
    },

    getSelectCiudad(departamento_id) {
      this.select_ciudad = [];
      if (departamento_id != null) {
        axios
          .get(this.url + "getSelectCiudad/" + departamento_id)
          .then((response) => {
            for (let parametro of response.data) {
              this.select_ciudad.push(parametro);
            }
          });
      }
    },

    async checkApi(value) {
      return new Promise((resolve) => {
        if (!value) return resolve("Campo Requerido");
        return resolve(true);
      });
    },

    editarProyecto(item) {
      this.index = this.proyectos.indexOf(item);
      this.form = Object.assign({}, item);
      this.getSelectCiudad(this.form.departamento_id);
      this.dialog = true;
    },

    deleteItem(item) {
      this.index = this.proyectos.indexOf(item);
      this.form = Object.assign({}, item);
      this.dialogDelete = true;
    },

    asociarMateriales(item) {
      this.index = this.proyectos.indexOf(item);
      this.proyecto_id = item.id;
      this.dialogMateriales = true;
    },

    deleteItemConfirm(id) {
      axios.delete(this.url + "proyectos/" + id).then(() => {
        this.initialize();
      });
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.form = Object.assign({}, this.defaultForm);
        this.index = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.form = Object.assign({}, this.defaultForm);
        this.index = -1;
      });
    },

    async save(event) {
      let results = await event;
      if (results.valid) {
        if (this.form.id == null) {
          axios.post(this.url + "proyectos", this.form).then(() => {
            this.initialize();
            this.close();
            this.dialogCorrect = true;
          });
        } else {
          axios
            .put(this.url + "proyectos/" + this.form.id, this.form)
            .then(() => {
              this.initialize();
              this.close();
              this.dialogCorrect = true;
            });
        }
      }
    },
  },
};
</script>
