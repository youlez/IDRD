<template>
  <v-card flat>
    <v-data-table
      :headers="headers"
      :items="materiales"
      :sort-by="[{ key: 'codigo', order: 'asc' }]"
      v-model:search="search"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Materiales</v-toolbar-title>
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
                          v-model="form.codigo"
                          :rules="rules_codigo"
                          label="Código"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" class="pa-2 pb-0">
                        <v-text-field
                          v-model="form.nombre"
                          :rules="rules_nombre"
                          label="Nombre"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" class="pa-2 pb-0">
                        <v-textarea
                          v-model="form.descripcion"
                          :rules="rules"
                          label="Descripción"
                        ></v-textarea>
                      </v-col>
                      <v-col cols="12" class="pa-2 pb-0">
                        <v-select
                          v-model="form.unidad_id"
                          :items="select_unidad"
                          item-title="nombre"
                          item-value="value"
                          :rules="rules"
                          label="Unidad"
                          required
                        ></v-select>
                      </v-col>
                      <v-col cols="12" class="pa-2 pb-0">
                        <v-number-input
                          prepend-icon="mdi-currency-usd"
                          :min="1"
                          label="Precio (Pesos)"
                          :rules="rules"
                          :reverse="false"
                          controlVariant="stacked"
                          :hideInput="false"
                          :inset="false"
                          v-model="form.precio"
                        ></v-number-input>
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
                >¿Está seguro de eliminar el material?</v-card-title
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
        <v-icon class="me-2" size="small" @click="editarMaterial(item)">
          mdi-pencil
        </v-icon>
        <v-icon size="small" @click="deleteItem(item)"> mdi-delete </v-icon>
      </template>
      <template v-slot:no-data>
        <p>No hay información</p>
      </template>
    </v-data-table>
  </v-card>
</template>
<script>
import axios from "axios";
import { VNumberInput } from "vuetify/labs/VNumberInput";
export default {
  name: "Materiales",
  data: (vm) => ({
    search: "",
    dialog: false,
    dialogDelete: false,
    dialogCorrect: false,
    headers: [
      {
        title: "Código",
        align: "start",
        key: "codigo",
      },
      { title: "Nombre", key: "nombre" },
      { title: "Descripción", key: "descripcion" },
      { title: "Unidad", key: "nombre_unidad.nombre" },
      { title: "Precio", key: "precio" },
      { title: "Acciones", key: "actions", sortable: false },
    ],
    materiales: [],
    index: -1,
    form: {
      id: null,
      codigo: null,
      nombre: null,
      descripcion: null,
      unidad_id: null,
      precio: null,
    },
    defaultForm: {
      id: null,
      codigo: null,
      nombre: null,
      descripcion: null,
      unidad_id: null,
      precio: null,
    },
    select_unidad: [],
    rules: [(value) => vm.checkApi(value)],
    rules_nombre: [(value) => vm.checkNombre(value)],
    rules_codigo: [(value) => vm.checkCodigo(value)],
    url: "http://localhost/IDRD/backend/public/api/",
  }),

  components: {
    VNumberInput,
  },

  computed: {
    formTitle() {
      return this.index === -1 ? "Crear Material" : "Editar Material";
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
    this.select_unidad = this.getSelectParametro(1);
  },

  methods: {
    initialize() {
      axios.get(this.url + "materiales").then((response) => {
        this.materiales = response.data;
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

    async checkApi(value) {
      return new Promise((resolve) => {
        if (!value) return resolve("Campo Requerido");
        return resolve(true);
      });
    },

    async checkNombre(value) {
      return new Promise((resolve) => {
        if (!value) return resolve("Campo Requerido");
        let campo = this.materiales.filter(
          (val) => val.nombre.trim() === value.trim()
        );
        if (
          (this.index == -1 && campo.length > 0) ||
          (this.index != -1 && campo.length > 0 && campo[0].id != this.form.id)
        )
          return resolve("Este nombre ya existe");
        return resolve(true);
      });
    },

    async checkCodigo(value) {
      return new Promise((resolve) => {
        if (!value) return resolve("Campo Requerido");
        let campo = this.materiales.filter((val) => val.codigo === value);
        if (
          (this.index == -1 && campo.length > 0) ||
          (this.index != -1 && campo.length > 0 && campo[0].id != this.form.id)
        )
          return resolve("Este código ya existe");
        return resolve(true);
      });
    },

    editarMaterial(item) {
      this.index = this.materiales.indexOf(item);
      this.form = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.index = this.materiales.indexOf(item);
      this.form = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm(id) {
      axios.delete(this.url + "materiales/" + id).then(() => {
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
          axios.post(this.url + "materiales", this.form).then(() => {
            this.initialize();
            this.close();
            this.dialogCorrect = true;
          });
        } else {
          axios
            .put(this.url + "materiales/" + this.form.id, this.form)
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
