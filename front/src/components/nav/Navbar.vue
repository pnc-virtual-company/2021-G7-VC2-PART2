<template>
  <nav>
    <v-navigation-drawer v-model="sidebar" app absolute left temporary>
      <v-list>
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
          <v-list-item
            v-for="item in menuItems"
            :key="item.title"
            :to="item.path"
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>{{ item.title }}</v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar dark>
      <span class="hidden-sm-and-up">
        <v-app-bar-nav-icon @click="sidebar = !sidebar"> </v-app-bar-nav-icon>
      </span>
      <v-toolbar-title>
        <router-link to="/appTitle" tag="span" style="cursor: pointer">
          {{ appTitle }}
        </router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-xs-only">
        <v-btn
          active-class="grey-5 white--text"
          text
          v-for="item in menuItems"
          :key="item.title"
          :to="item.path" 
        >
          <v-icon left color="blue --text">{{ item.icon }}</v-icon>
          {{ item.title }}
          <v-btn v-if="item.path == '/logout'" @click="logOut">Log Out</v-btn>
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
      menuItems: [
        {
          title: "User",
          path: "/user",
          icon: "mdi-account-convert",
        },
        {
          title: "Students",
          path: "/studentlist",
          icon: "mdi-account-multiple",
        },
        {
          title: "Permissions",
          path: "/permission",
          icon: "mdi-clipboard-check",
        },
        {
          title: "Disciples",
          path: "/disciples",
          icon: "mdi-file-document",
        },
        {
          title: "",
          path: "/logout",
          icon: "mdi-login",
        },
      ],
    };
  },
  methods: {
    logOut() {
      localStorage.clear();
      this.$emit("log_out");
      this.$router.push("/login");
    },
  },
};
</script>
