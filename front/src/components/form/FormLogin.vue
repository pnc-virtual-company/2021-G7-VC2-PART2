<template>
<div class="container" v-if="isLogin">
    <div class="title">
        <h2>STUDENTS LIFE</h2>
    </div>
    <form>
        <div class="user-icon">
            <v-icon style="font-size:100px;color:white">mdi-account-circle</v-icon>
        </div>

        <v-text-field background-color="green lighten-5" class="email rounded " v-model="email" :error-messages="emailErrors" label="E-mail" placeholder="example@gmail.com" required @input="$v.email.$touch()" @blur="$v.email.$touch()"></v-text-field>

        <v-text-field v-model="password" class="password rounded" background-color="green lighten-5" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :rules="[rules.required, rules.min]" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Password" hint="At least 6 characters" counter @click:append="show1 = !show1"></v-text-field>

        <div class="login">
            <v-btn style="width:60%" @click="login"> LOG IN </v-btn>
        </div>

        <div class="para">
            <p>The easy way to manage all students</p>
        </div>

    </form>

</div>
</template>

<script>
import {
    validationMixin
} from "vuelidate";
import {
    required,
    email
} from "vuelidate/lib/validators";
import axios from '../../api/api.js';

export default {
    mixins: [validationMixin],

    validations: {
        email: {
            required,
            email
        },
    },

    data: () => ({
        email: "",
        password: "",
        show1: false,
        isLogin: true,
        rules: {
            required: value => !!value || 'Password is required.',
            min: v => v.length >= 6 || 'Min 6 characters',
            emailMatch: () => (`The email and password you entered don't match`),
        }
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
                password: this.password
            };

            axios.post("/login", data).then(res => {
                if (this.email !== '' && this.password !== '') {
                    this.$emit('login');
                }
                localStorage.setItem('authToken', res.data.token);
                this.$router.push('/user')
                this.isLogin = false
                this.userInfo = true
            }).catch(error => {
                console.log(error)
            })
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
    margin-top: 50px;
}

.email,
.password {
    width: 60%;
    margin-right: auto;
    margin-left: auto;
}

.email {
    margin-top: 60px;
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
</style>
