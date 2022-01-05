<template>
  <div class="text-center login">
    <form class="mx-auto form" style="width: 30%">
      <div class="user_icon">
        <v-avatar color="grey darken-3" size="100" class="logo">
          <v-img
            class="elevation-6"
            alt=""
            src="https://zenprospect-production.s3.amazonaws.com/uploads/pictures/60b386ff84a3630001b3bb0d/picture"
          ></v-img>
        </v-avatar>
        <h2 >STUDENTS LIFE</h2>
      </div>
      <div class="log">
        <div></div>
        <v-row class="input pa-0 ma-0">
          <v-col class="c_email mb-0" cols="12" sm="12">
            <v-text-field
              outlined
              dense
              background-color="green lighten-5"
              label="E-mail"
              v-model="email"
              :error-messages="emailErrors"
              @input="$v.email.$touch()"
              @blur="$v.email.$touch()"

            ></v-text-field>
          </v-col>
          <br />
          <v-col class="c_password pt-0 mt-0" cols="12" sm="12">
            <v-text-field
              outlined
              dense
              v-model="password"
              class="password pa-0 ma-0"
              label="Password"
              hint="At least 6 characters"
              background-color="green lighten-5"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required, rules.min]"
              :type="show1 ? 'text' : 'password'"
              :error-messages="passwordErrors"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>
          <v-col class="c_password pt-0 mt-0" cols="12" sm="12">
            <v-btn class="orange lighten-1" dark block @click="login"> LOG IN </v-btn>
            <span>The easy way to manage all students</span>
          </v-col>
        </v-row>
      </div>
    </form>
  </div>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, email } from "vuelidate/lib/validators";
import axios from "../../api/api.js";

export default {
  mixins: [validationMixin],

  validations: {
    email: {
      required,
      email,
    },
    password: {
      required,
    },
  },
  data: () => ({
    email: "",
    password: "",
    show1: false,
    rules: {
      required: (value) => !!value || "Password is required.",
      min: (v) => v.length >= 6 || "Min 6 characters",
    },
  }),

  computed: {
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return errors;
      !this.$v.email.email && errors.push("Must be valid e-mail");
      !this.$v.email.required && errors.push("E-mail is required");
      return errors;
    },
    passwordErrors() {
      const errors = [];
      if (!this.$v.password.$dirty) return errors;
      !this.$v.password.required && errors.push("Password is required");
      return errors;
    },
  },

  methods: {
    login() {
      this.$v.$touch();
      let data = {
        email: this.email,
        password: this.password,
      };
      if (this.email !== "" && this.password.length !== "") {
        axios.post("/login", data).then((res) => {
          this.$emit("log-in", true);
          localStorage.setItem('user',JSON.stringify(res.data.user));
          //if role is admin go to user page, otherwise student page
          let roles = JSON.parse(localStorage.getItem("user"))
          if(roles.role === "admin"){
            this.$router.push("/userNav")
          }else{
            this.$router.push("/studentList")
          }
          
        });
      }
    },
  },

  
};
</script>
    
<style scoped>
.log {
  display: flex;
  justify-content: space-around;
}
.login {
  background-image: url("../../assets/img/imgb.jpg");
  background-size: cover;
  height: 100%;
  width: 100%;
}
.logo{
  margin-top: 70px;
}
@import url("https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap");
h2 {
  font-family: "Pushster", cursive;
}
</style>