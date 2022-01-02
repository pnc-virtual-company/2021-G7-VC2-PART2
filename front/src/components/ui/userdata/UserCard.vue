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

    <div class="text-center">
      <v-dialog
        v-model="dialog"
        transition="dialog-top-transition"
        max-width="500"
      >
        <v-card>
          <v-card-text>
            <div class="text-h5 pa-5">Do you want to delete this user?</div>
          </v-card-text>
          <hr />
          <v-card-actions class="justify-end">
            <v-spacer></v-spacer>
            <v-btn @click="dialog = false" class="blue white--text" text>
              Cancel
            </v-btn>
            <v-btn class="red white--text" text @click="deleteUser">
              Ok
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>

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
      isHiddin: false,
      dialog: false,
      deleteId: 0
    };
  },
  methods: {
    // __________get student id___________
    getUserId(id) {
        this.dialog = true;
        this.deleteId = id;
    },
    deleteUser() {
        this.$emit('deleteUser', this.deleteId);
        this.dialog = false;
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