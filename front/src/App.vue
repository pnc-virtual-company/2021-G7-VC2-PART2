<template>
  <v-app>
    <Navbar v-if="isLogin" @log_out="isLogout"></Navbar>
    <v-main>
      <router-view @log-in="showMeu" />
    </v-main>
  </v-app>
</template>

<script>
import Navbar from "./components/nav/Navbar.vue";
export default {
  components: {
    Navbar,
  },
  name: "App",

  data: () => ({
    isLogin: false,
  }),
  methods: {
    showMeu(loginn) {
      this.isLogin = loginn;
      this.$router.push("/user").catch(() => {});
    },
    isLogout() {
      this.isLogin = false;
    },
  },
  mounted() {
    let user = JSON.parse(localStorage.getItem("user"));
    if (user.id !== null) {
      this.isLogin = true;
      if (this.$router.history.current.path == "/user") {
        this.$router.push("/user").catch(() => {});
      }
    }else if (user.id == null) {
      this.isLogin = false
    }
  },
};
</script>
<style >
  
</style>