<template>
  <v-container>
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
              <v-btn class="mr-2 bg-brown" elevation="4" v-bind="props">
                Asociar
              </v-btn>
            </template>

            <v-form @submit.prevent="save">
              <v-card>
                <v-card-title class="pa-4">
                  <span class="text-h5">Asociar Material</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12" class="pa-2 pb-0">
                        <v-select
                          v-model="form.material_id"
                          :items="select_material"
                          item-title="codigo"
                          item-value="id"
                          :rules="rules"
                          label="Material"
                          required
                        ></v-select>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions class="pa-4">
                  <v-spacer></v-spacer>
                  <v-btn
                    class="bg-brown"
                    elevation="4"
                    variant="text"
                    type="submit"
                  >
                    Asociar
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
                title="Registro asociado exitosamente"
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
                >¿Está seguro que desea desacoiar el material?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue-darken-1"
                  variant="text"
                  @click="ToogleItemConfirm(this.form.id)"
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
        <v-btn
          class="bg-red"
          elevation="4"
          variant="text"
          type="submit"
          @click="ToogleItem(item)"
        >
          Desasociar
        </v-btn>
      </template>
      <template v-slot:no-data>
        <p>No hay información</p>
      </template>
    </v-data-table>
  </v-container>
</template>
<script>
import axios from "axios";
export default {
  name: "Asociar",
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
      material_id: null,
    },
    defaultForm: {
      id: null,
      material_id: null,
    },
    select_material: [],
    rules: [(value) => vm.checkApi(value)],
    url: "http://localhost/IDRD/backend/public/api/",
  }),

  props: {
    proyecto_id: null,
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
  },

  methods: {
    initialize() {
      axios
        .get(this.url + "getMaterialesByProyecto/" + this.proyecto_id)
        .then((response) => {
          this.materiales = response.data;
        });
      this.select_material = [];
      axios.get(this.url + "getSelectMaterial").then((response) => {
        for (let parametro of response.data) {
          this.select_material.push(parametro);
        }
      });
    },

    async checkApi(value) {
      return new Promise((resolve) => {
        if (!value) return resolve("Campo Requerido");
        return resolve(true);
      });
    },

    ToogleItem(item) {
      this.index = this.materiales.indexOf(item);
      this.form = Object.assign({}, item);
      this.dialogDelete = true;
    },

    ToogleItemConfirm(id) {
      this.form.proyecto_id = null;
      this.form.material_id = id;
      axios
        .post(this.url + "toogleProyecto", {
          form: this.form,
        })
        .then(() => {
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
        this.form.proyecto_id = this.proyecto_id;
        axios
          .post(this.url + "toogleProyecto", {
            form: this.form,
          })
          .then(() => {
            this.initialize();
            this.close();
            this.dialogCorrect = true;
          });
      }
    },
  },
};
</script>
