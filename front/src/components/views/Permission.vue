<template>
  <section>
    <permission-form @addPermission="addPermission" class="permission_btn"></permission-form>
    <permission-card
      :datapermission="permissions"
      @deletePermission="deletePermission"
      @search-permission="searchPermission"
    ></permission-card>
  </section>
</template>
<script>
import PermissionCard from "../ui/permissiondata/PermissionCard.vue";
import PermissionForm from "../ui/permissiondata/PermissionForm.vue";
import axios from "../../api/api.js";
let url = "http://localhost:8000/api"
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
      axios.post("/permission" , newPermission).then((response) => {
        this.permissiondata();
        console.log(response.data)
        console.log(newPermission)
      });
    },
    deletePermission(permissionId) {
      axios.delete(url + '/permission/' + permissionId ).then((response) => {
        console.log(response.data);
        this.permissiondata();
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
.permission_btn {
  margin-left: 75%;
  margin-top: 5%;
}
</style>