<template>
  <v-container>
    <template>
     
        <v-simple-table> </v-simple-table>
        <div class="permission">
          <v-card-title>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
              @keyup="searchPermission"
            ></v-text-field>
          </v-card-title>
          <v-card
            color="grey lighten-4"
            class="mx-auto card"
            max-width="900"
            v-for="(permission, index) in datapermission"
            :key="index"
          >
            <v-row>
              <v-col cols="12" sm="2" class="logo">
                <v-icon black size="60px"> mdi-link-variant </v-icon>
              </v-col>
              <v-divider vertical class="ma-3" color="white"></v-divider>
              <v-col cols="12" sm="2">
                <v-avatar class="ma-3" size="120" tile>
                  <v-img
                  :src="url + permission.students.picture"
                  ></v-img>
                </v-avatar>
              </v-col>
              <v-col cols="12" sm="3" class="text-center data">
                <h3>{{ permission.students.first_name }} {{ permission.students.last_name }}</h3>
                <span>WEB-A</span><br>
                <span class="num">5 days</span>
              </v-col>
              <v-col cols="12" sm="3" class="date">
                <v-chip class="ma-2 "  color="orange lighten-3">
                  Start date: {{ permission.start_date }} </v-chip
                ><br />
                <v-chip class="ma-2" color="orange lighten-3">
                  End date: {{ permission.end_date }}
                </v-chip>
              </v-col>
              <v-col cols="12" sm="2">
                <div class="i_con">
                  <v-icon color="blue darken-1" text size="30px">
                    mdi-lead-pencil</v-icon
                  >
                  <v-icon color="red darken-1" text size="30px"
                    >mdi-delete</v-icon
                  >
                </div>
              </v-col>
            </v-row>
          </v-card>
        </div>
      
    </template>
  </v-container>
</template>
<script>
export default {
  props: ["datapermission"],
  emits: ["search-permission"],
  data() {
    return {
      search: "",
      url: "http://127.0.0.1:8000/storage/images/"
    };
  },
  methods: {
    searchPermission() {
      this.$emit("search-permission", this.search);
    },
  },
};
</script>
<style scoped>
.date {
  margin-top: 3%;
}
.data {
  margin-top: 3%;
  margin-left: -3%;
}
.i_con {
  margin-top: 30%;
}
.logo {
  margin-top: 4%;
}
.card {
  margin-top: 2%;
  text-align: center;
}
.num {
 color: grey; 
}
</style>