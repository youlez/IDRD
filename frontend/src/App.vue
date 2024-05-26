<template>
  <v-container>
    <v-card>
      <v-toolbar color="primary" title="PRUEBA TÉCNICA IDRD"> </v-toolbar>

      <div class="d-flex flex-row">
        <v-tabs
          v-model="tab"
          color="primary"
          direction="vertical"
          class="v-col-2"
        >
          <v-tab
            prepend-icon="mdi-view-list"
            text="Materiales"
            value="option-1"
          ></v-tab>
          <v-tab
            prepend-icon="mdi-domain"
            text="Proyectos"
            value="option-2"
          ></v-tab>
        </v-tabs>

        <v-tabs-window v-model="tab" class="v-col-10">
          <v-tabs-window-item value="option-1">
            <Materiales />
          </v-tabs-window-item>

          <v-tabs-window-item value="option-2">
            <Proyectos />
          </v-tabs-window-item>
        </v-tabs-window>
      </div>
    </v-card>
  </v-container>
</template>
<script>
import Materiales from "./components/Materiales.vue";
import Proyectos from "./components/Proyectos.vue";
export default {
  data() {
    return {
      tab: "option-1",
    };
  },
  components: { Materiales, Proyectos },
};
</script>
