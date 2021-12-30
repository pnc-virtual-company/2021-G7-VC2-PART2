<template>
  <section>
    <permission-form @addPermission="addPermission" class="create"></permission-form>
    <permission-card
      :datapermission="permissions"
      @search-permission="searchPermission"
    ></permission-card>
  </section>
</template>

<script>
import PermissionCard from "../ui/permissiondata/PermissionCard.vue";
import PermissionForm from "../ui/permissiondata/PermissionForm.vue";
import axios from "../../api/api.js";
export default {
  name: "App",
  components: {
    "permission-card": PermissionCard,
    "permission-form": PermissionForm,
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
        console.log(this.permissions);
      });
    },
    addPermission(newPermission) {
      axios.post("/permission/" + newPermission).then((response) => {
        this.permissiondata();
        console.log(response.data)
      });
    },
    searchPermission(search) {
      if (search !== "") {
        axios.get("/permission" + "/search/" + search).then((response) => {
          this.permissions = response.data;
        });
      } else {
        this.permissiondata();
      }
    },
  },
  mounted() {
    this.permissiondata();
  },
};
</script>

<style>
.create {
  margin-left: 82%;
  margin-top: 5%;
}
</style>