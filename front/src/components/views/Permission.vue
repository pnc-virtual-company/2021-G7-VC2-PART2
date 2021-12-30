<template>
  <section>
    <permission-form @addPermission="addPermission" class="create"></permission-form>
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
    permissiondata(){
      axios.get(url + '/permission').then(res=>{
        this.permissions = res.data;
      })
    },
    addPermission(newPermission) {
      axios.post("/permission/" + newPermission).then((response) => {
        this.permissiondata();
        console.log(response.data)
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
.create {
  margin-left: 82%;
  margin-top: 5%;
}
</style>