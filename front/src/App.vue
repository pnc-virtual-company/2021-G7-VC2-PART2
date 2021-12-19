<template>
  <v-app>
    <FormLogin></FormLogin>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import FormLogin from "./components/form/FormLogin.vue";
export default {
  components: { FormLogin },
  name: "App",

  data: () => ({
    //
  }),
};
</script>
