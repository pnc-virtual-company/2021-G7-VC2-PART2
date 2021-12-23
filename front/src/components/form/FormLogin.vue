<template>
  <div class="container">
    <div class="title">
      <h2>STUDENTS LIFE</h2>
    </div>
    <form class="mx-auto">
      <div class="user-icon">
        <v-icon class="mt-5 shaped" style="font-size: 100px; color: white"
          >mdi-account-circle</v-icon
        >
      </div>

      <v-row class="form ">
          <v-col class="c_email">
              <v-text-field
                background-color="green lighten-5"
                class="email rounded "
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
          <v-col class="c_password">
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
      </v-row>

      <div class="login">
        <v-btn 
        style="width: 60%" 
        @click="login"
        > LOG IN </v-btn>
      </div>

      <div class="para">
        <p>The easy way to manage all students</p>
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
          localStorage.setItem("authToken", res.data.token);
          this.$router.push("/user").catch(() => {});
        });
      }
    },
  },
};
</script>
    
<style scoped>
.container {
  margin-top: 10px;
}

form {
  background-color: rgb(131, 207, 236);
  width: 40%;
  height: 70vh;
  margin-top: 10px;
  margin-right: auto;
  margin-left: auto;
}

.login {
  text-align: center;
  margin-top: 10px;
}

.user-icon {
  text-align: center;
  margin-top: 60px;
}

.title {
  justify-content: center;
  display: flex;
  margin-top: 30px;
}

.para {
  justify-content: center;
  display: flex;
  margin-top: 30px;
  color: white;
}
.form {
  display: grid;
  padding: 10px;
  margin-top:50px;
}

</style>
