<template>
    <v-container>
        <template>
           <v-card>
        <v-card-title  class="orange lighten-1 text-h5">
          Create User Account
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="12">
                <v-text-field
                  :rules="nameRules"
                  label="User Account"
                  type="text"
                  prepend-icon="mdi-account"
                  v-model="user_account"
                >
                </v-text-field>
              </v-col>
              <!-- <v-col cols="12" sm="6">
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
              </v-col> -->
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
              <v-col class="d-flex" cols="12" sm="12"  v-if="role==='Student'">
                <label for="student" class="mb-0">Choose student</label>
                <select
                  name="student"
                  id="student"
                  class="select_student"
                  v-model="id"
                >
                  <option
                    v-for="categorys of students"
                    :key="categorys.id"
                    :value="categorys.id"
                  >
                    {{ categorys.first_name }}
                    {{ categorys.last_name }}
                  </option>
                </select>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions class="black lighten-1">
          <v-spacer></v-spacer>
          <v-btn @click="cancel"  color="red darken-1" text >
            Cancel
          </v-btn>
          <v-btn @click="Update"  color="blue darken-1" text >
            Update
          </v-btn>
        </v-card-actions>
      </v-card>
        </template>
    </v-container>
</template>

<script>
import axios from "../../../api/api.js";
export default {
  props: ["userInfo"],
  emits: ["update", "cancel"],
  data() {
    return {
      dialog: false,
      show1: false,
      roles: ["Socail Affair Officer", "Student"],
      students: [],
      id: null,
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
    studentdata() {
      axios.get("/students").then((response) => {
        this.students = response.data;
      });
    },

    Update() {
      let user = {
        userName: this.user_account,
        student_id: this.id,
        password: this.password,
        email: this.email,
        role: this.role,

      };
     
      this.$emit("update", this.userInfo.id, user, false);
      console.log(user);
      
    },
    cancel(){
        this.$emit('cancel', false);
      }
  },
  mounted() {
    
    this.user_account= this.userInfo.userName;
    this.password = this.userInfo.password;
    this.email = this.userInfo.email;
    this.role = this.userInfo.role;
  
    this.studentdata();
    
  },
};
</script>