<template>
  <div class="text">
    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="dark blue-2" dark v-bind="attrs" v-on="on">
          +Add User
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="text-h5 blue lighten-1">
          Create User Account
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6">
                <v-text-field
                  :rules="nameRules"
                  label="User Account"
                  type="text"
                  prepend-icon="mdi-account"
                  v-model="user_account"
                >
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="6">
                <v-text-field
                  :rules="passwordRules"
                   label="Password"
                  prepend-icon="mdi-key-variant"
                  v-model="password"
                  :type="show1 ? 'text' : 'password'"
                  :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                  @click:append="show1 = !show1"
                >
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="12">
                <v-text-field
                  :rules="emailRules"
                  label="E-mail"
                  type="email"
                  prepend-icon="mdi-email"
                  v-model="email"
                >
                </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="12">
                <v-select
                  :items="roles"
                  v-model="role"
                  label="Choose Role"
                  prepend-icon="mdi-account-switch"
                ></v-select>
              </v-col>
              <v-col class="d-flex" cols="12" sm="12">
                <v-select
                  v-if="role === 'Student'"
                  :items="students"
                  v-model="student"
                  label="Choose Student"
                  prepend-icon="mdi-account-star"
                >
                </v-select>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions class="black lighten-1">
          <v-spacer></v-spacer>
          <v-btn color="red darken-1" text @click="dialog = false">
            Cancel
          </v-btn>
          <v-btn color="blue darken-1" text @click="createUserAccount">
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import axios from "../../../api/api.js";
export default {
  emits: ["addUserAccount"],
  data() {
    return {
      dialog: false,
      show1: false,
      roles: ["Socail Affair Officer", "Student"],
      students: [],
      student: "",
      user_account: "",
      role: "",
      email: "",
      password: null,
      nameRules: [
        (v) => !!v || "Name is required",
        (v) => (v && v.length <= 15) || "Name must be less than 15 characters",
      ],
      passwordRules: [
        (v) => !!v || "Password is required",
        (v) => (v && v.length > 5) || "Password must be more than 6 characters",
      ],
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
    };
  },
  methods: {
    getstudents() {
      axios.get("/students").then((response) => {
        for (let data of response.data) {
          this.students.push(data.first_name);
        }
      });
    },
    createUserAccount() {
      if (this.user_account !== "") {
        this.dialog = false;
        let newUserAccount = new FormData();
        newUserAccount.append("userName", this.user_account);
        newUserAccount.append("email", this.email);
        newUserAccount.append("password", this.password);
        newUserAccount.append("role", this.role);
        this.$emit("addUserAccount", newUserAccount);
      }
    },
  },
  mounted() {
    this.getstudents();
  },
};
</script>