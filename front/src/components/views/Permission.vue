<template>
  <section>
    <permission-form 
    @addPermission="addPermission" 
    class="permission_btn"
    ></permission-form>
      <v-text-field 
      class="search" 
      v-model="search" 
      append-icon="mdi-magnify" 
      label="Search" 
      single-line hide-details placeholder="Search first name, Lastname and Class" 
      outlined 
      dense
      ></v-text-field>
    <permission-card
      :datapermission="permissions"
      @deletePermission="deletePermission"
      @edit-permission="permissiondata"
     
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
      search:"",
    };
  },
  methods: {
    //____________ get permission list_______________
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
      axios.delete('/permission/' + permissionId ).then((response) => {
        console.log(response.data);
        this.permissiondata();
      });
    },
     // search first name, last name and class
    searchPermission(value) {
      if(value !== "") {
        this.permissions = this.permissions.filter(
          (permission) => (permission.students.first_name.toLowerCase().includes(value.toLowerCase()) ||
          (permission.students.last_name.toLowerCase().includes(value.toLowerCase()) || 
          (permission.students.class.toLowerCase().includes(value.toLowerCase())))))
          console.log(this.permissions);
      }else{
        this.permissiondata();
      }
    },
  },
  watch:{
    search:function(){
      this.searchPermission(this.search);
    }
  },
  mounted() {
    this.permissiondata();
  },
};
</script>

<style lang="scss" scoped>
.permission_btn {
  margin-left: 73%;
  margin-top: 5%;
}
.search {
  width: 30%;
  margin-top: 20px;
  margin-left: 14.4%;
  position: fixed;
}
</style>