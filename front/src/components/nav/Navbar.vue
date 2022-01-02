<template>
  <nav>
    <v-navigation-drawer v-model="sidebar" app absolute left temporary>
      <!-- 1 -->
      <div class="navResponsiv">
        <v-btn active-class="grey-5 white--text" text v-if="appTitle.role === 'admin'">
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
      </div>
    </v-navigation-drawer>
    <!-- Navbar -->
    <v-toolbar class="orange lighten-1">
      <span class="hidden-sm-and-up">
        <v-app-bar-nav-icon @click="sidebar = !sidebar"> </v-app-bar-nav-icon>
      </span>
      <v-toolbar-title class="d-flex">
          <v-list-item-avatar color="grey darken-3">
              <v-img class="elevation-6" alt="" src="https://zenprospect-production.s3.amazonaws.com/uploads/pictures/60b386ff84a3630001b3bb0d/picture"></v-img>
          </v-list-item-avatar>
          <v-toolbar-title class="text-uppercase mt-4"> {{appTitle.userName}}</v-toolbar-title>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-xs-only">
        <v-btn active-class="grey-5 white--text" text v-if="appTitle.role === 'admin'">
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
            Discipline
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
      appTitle: JSON.parse(localStorage.getItem("user")),
      sidebar: false,
      group: false,
      menuItems: [
          { title: 'User', path: '/user', icon: 'mdi-home' },
          { title: 'Studentlist', path: '/studentlist', icon: 'mdi-account-multiple' },
          { title: 'Permission', path: '/permission', icon: 'mdi-clipboard-check' },
          { title: 'Disciples', path: '/disciples', icon: 'mdi-file-document' },
          { title: 'Logout', path: '/logout', icon: 'mdi-login' },
     ]
    };
  },
  methods: {
    logOut() {
      
      localStorage.clear("userId");
      this.$emit("log_out");
      this.$router.push("/login");
     
    },
  },
  
  

};
</script>
<style>
@import url('https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap');
nav {
font-family: 'Pushster', cursive;}
.navResponsiv {
  display: grid;
}
</style>
