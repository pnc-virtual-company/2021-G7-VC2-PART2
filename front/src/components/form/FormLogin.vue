<template>
  <div class="container ">
    <div class="text-center">
      <form class="mx-auto">
        <div class="user_icon">
          <!-- <v-icon style="font-size: 100px" color="blue"
            >mdi-account-circle</v-icon
          > -->
          <v-list-item-avatar color="grey darken-3">
          <v-img
            class="elevation-6"
            alt=""
            src="https://zenprospect-production.s3.amazonaws.com/uploads/pictures/60b386ff84a3630001b3bb0d/picture"
          ></v-img>
        </v-list-item-avatar>
          <h2>STUDENTS LIFE</h2>
        </div>
        <v-row class="input">
          <v-col class="c_email" cols="12" sm="7">
            <v-text-field
              background-color="green lighten-5"
              class="email rounded"
              v-model="email"
              :error-messages="emailErrors"
              label="E-mail"
              placeholder="example@gmail.com"
              required
              outlined
              @input="$v.email.$touch()"
              @blur="$v.email.$touch()"
            ></v-text-field>
          </v-col>
          <br />
          <v-col class="c_password" cols="12" sm="7">
            <v-text-field
              v-model="password"
              class="password rounded"
              background-color="green lighten-5"
              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required, rules.min]"
              :type="show1 ? 'text' : 'password'"
              name="input-10-1"
              label="Password"
              outlined
              hint="At least 6 characters"
              @click:append="show1 = !show1"
            ></v-text-field>
          </v-col>
          <v-col class="c_password" cols="12" sm="7">
            <v-btn color="blue" dark block @click="login"> LOG IN </v-btn>
            <span color="red">The easy way to manage all students</span>
          </v-col>
        </v-row>
      </form>
    </div>
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
  },
  data: () => ({
    email: "",
    password: "",
    show1: false,
    rules: {
      required: (value) => !!value || "Password is required.",
      min: (v) => v.length >= 6 || "Min 6 characters",
      emailMatch: () => `The email and password you entered don't match`,
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
  },

  methods: {
    login() {
      this.$v.$touch();
      let data = {
        email: this.email,
        password: this.password,
      };
      if (this.email !== "" && this.password !== "") {
        axios.post("/login", data).then((res) => {
          this.$emit("log-in", true);
          localStorage.setItem('user', JSON.stringify(res.data.user));
          localStorage.setItem("userRole", res.data.user.role);
          localStorage.setItem("authToken", res.data.token);
          this.$router.push("/user").catch(() => {});
        });
      }
    },
  },
};
</script>
    
<style scoped>
.input {
  display: flex;
  justify-content: center;
  margin-top: 3%;
}
</style>
