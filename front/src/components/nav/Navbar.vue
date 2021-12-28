<template>
  <nav>
    <v-toolbar class="orange lighten-1">
      <span class="hidden-sm-and-up">
        <v-app-bar-nav-icon @click="sidebar = !sidebar"> </v-app-bar-nav-icon>
      </span>
      <v-toolbar-title> {{role}} </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-xs-only">
        <v-btn active-class="grey-5 white--text" text>
          <v-icon left class="blue--text">mdi-home</v-icon>
          <router-link to="/user" tag="span" style="cursor: pointer">
            User
          </router-link>
        </v-btn>
        <v-btn active-class="grey-5 white--text" text>
          <v-icon left class="blue--text">mdi-account-multiple</v-icon>
          <router-link to="/studentlist" tag="span" style="cursor: pointer">
            Students
          </router-link>
        </v-btn>
        <v-btn active-class="grey-5 white--text" text>
          <v-icon left class="blue--text">mdi-clipboard-check</v-icon>
          <router-link to="/permission" tag="span" style="cursor: pointer">
            Permissions
          </router-link>
        </v-btn>
        <v-btn active-class="grey-5 white--text" text>
          <v-icon left class="blue--text">mdi-file-document</v-icon>
          <router-link to="/disciples" tag="span" style="cursor: pointer">
            Disciples
          </router-link>
        </v-btn>
        <v-btn active-class="grey-5 white--text" @click="logOut" text>
          <v-icon left class="blue--text">mdi-login</v-icon>
          <router-link to="/logout" tag="span" style="cursor: pointer">
            Log Out
          </router-link>
        </v-btn>
      </v-toolbar-items>
    </v-toolbar>
  </nav>
</template>

<script>

export default {
  data() {
    return {
      appTitle: "Administrator",
      sidebar: false,
      group: false,
      role: ""
    };
  },
  methods: {
    logOut() {
      
      localStorage.clear("userId");
      this.$emit("log_out");
      this.$router.push("/login");
     
    },
  },
  mounted() {
    this.role = localStorage.getItem("role")
  },
};
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap');
nav {
font-family: 'Pushster', cursive;}
</style>
