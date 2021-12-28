<template>
  <section>
    <permission-card :datapermission="permissions"></permission-card>
  </section>
</template>

<script>
import PermissionCard from "../ui/permissiondata/PermissionCard.vue";
import axios from "../../api/api.js";
export default {
  name: "App",
  components: {
    "permission-card": PermissionCard,
  },
  data() {
    return {
      permissions: [],
    };
  },
  methods: {
    //_____________ get permission list________________
    permissiondata() {
      axios.get("/permission").then((response) => {
        this.permissions = response.data;
         console.log(this.permissions)
      });
    },
  },
  mounted() {
      this.permissiondata();
    },
};
</script>

<style>
</style>