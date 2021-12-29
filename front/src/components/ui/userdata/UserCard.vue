<template>
  <v-container>
    <template>
      <v-card>
        <v-card-title>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
            @keyup="searchStudent"
          ></v-text-field>
         
        </v-card-title>
        <v-simple-table>
          <template v-slot:default>
            <thead class="blue lighten-3">
              <tr>
                
                <th>User Account</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="lighten-4">
              <tr
                class=""
                v-for="(user, index) in dataUser"
                :key="index"
              >
                <td>{{ user.userName}}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
                <!-- <td>{{ user.password}}</td> -->
                
                <td>
                  <div class="i-con">
                    <v-icon color="blue darken-1" text  @click="getUserInfo(user)">mdi-lead-pencil</v-icon>
                    <v-icon
                      color="red darken-1"
                      @click="getUserId(user.id)"
                      v-if="user.role != 'admin'"
                      >mdi-delete</v-icon
                    >
                  </div>
                </td>
              </tr>
              <update-user
                v-if="showForm"
                :userInfo="userData"
                @cancel="Cencel"
                @update="UpdateUser"
              >
              </update-user>
            </tbody>
          </template>
        </v-simple-table>
      </v-card>
    </template>
  </v-container>
</template>
<script>
import axios from "../../../api/api.js";
import UpdateUser from "./UpdateUser.vue";
export default {
  props: ["dataUser"],
  emits: ["deleteUser", "search-user", "update-user"],
  components: {
    "update-user": UpdateUser,
  },
  
  data() {
    return {
      search: "",
      userId: 0,
      userData: [],
      showForm: false,
    };
  },
  methods: {
    // ___________get student id____________
    getUserId(id) {
      this.deleteId = id;
      this.$emit("deleteUser", this.deleteId);
      console.log(id);
    },

    searchStudent() {
      this.$emit("search-user", this.search);
    },

    getUserInfo(user) {
      this.showForm = true;
      this.userData = user;
      console.log(this.userData);
    },

    Cencel(hidden) {
      this.showForm = hidden;
    },

    UpdateUser(id, user, hidden) {
     
      axios.put("/users/" + id, user).then((res) => {
        // console.log(res.data);
        this.$emit("update-user", res.data);
        this.showForm = hidden;
       
      });
    },
  },
};
</script>
<style scoped>
v-card-title {
  background: rgb(85, 237, 248);
}
.t-head {
  display: flex;
  justify-content: space-between;
}
th {
  color: black;
}
td {
  color: black;
}
</style>