<template>
<v-app>
    <Navbar v-if="isLogin"></Navbar>
    <FormLogin @login='loginForm'></FormLogin>
    <v-main>
        <router-view />
    </v-main>
</v-app>
</template>

<script>
import FormLogin from "./components/form/FormLogin.vue";
import Navbar from "./components/nav/Navbar.vue";
export default {
    components: {
        FormLogin,
        Navbar
    },
    name: "App",

    data: () => ({
        isLogin: false,
    }),
    methods: {
        loginForm() {
            this.isLogin = true
        }
    },
};
</script>