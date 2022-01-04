<template>
<section>

    <permission-form @addPermission="addPermission" class="permission_btn"></permission-form>
    <v-text-field class="search" 
      v-model="search" append-icon="mdi-magnify" label="Search" 
      single-line hide-details placeholder="Search first name, Lastname and Class"
    ></v-text-field>
    <permission-card :datapermission="permissionsDisplay" @deletePermission="deletePermission"></permission-card>
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
            permissionsDisplay: [],
            userAccount: JSON.parse(localStorage.getItem("user")),
            search: ''

        };
    },
    methods: {
        //____________ get permission list_______________
        permissiondata() {
            axios.get("/permission").then((response) => {
                this.permissions = response.data;
                this.permissionsDisplay=this.permissions;
                if (this.userAccount.role === 'Student') {
                    this.permissionsDisplay = this.permissions.filter(
                    (permission) => permission.student_id == this.userAccount.student_id)
                }
            });
        },
        addPermission(newPermission) {
            axios.post("/permission", newPermission).then(() => {
                this.permissiondata();
            });
        },
        deletePermission(permissionId) {
            axios.delete('/permission/' + permissionId).then(() => {
                this.permissiondata();
            });
        },

    },
    mounted() {
        this.permissiondata();
    },
    watch: {
        // search first name, last name and class
        search: function (value) {
            if (value === '') {
                this.permissionsDisplay = this.permissions
            } else {
              this.permissionsDisplay = this.permissions.filter(permission => 
                  permission.students.first_name.toLowerCase().includes(value.toLowerCase()) ||
                  permission.students.last_name.toLowerCase().includes(value.toLowerCase()) ||
                  permission.students.class.toLowerCase().includes(value.toLowerCase())
                )
            }
        }
    },
};
</script>

<style>
.permission_btn {
    margin-left: 73%;
    margin-top: 5%;
}

.search {
    width: 40%;
    margin-top: -46px;
    margin-left: 7%;
}
</style>
