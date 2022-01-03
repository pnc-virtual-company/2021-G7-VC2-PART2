<template>
  <v-container>
    <template>
      <v-simple-table> </v-simple-table>
      <div class="permission">
        <v-card 
        color="grey lighten-4" 
        class="mx-auto card"
         max-width="900"
         v-for="(discipline, index) in datadiscipline"
         :key="index"
         >
          <v-row>
            <v-col cols="12" sm="2" class="logo">
              <v-icon color="orange" size="60px"> mdi-alert </v-icon>
            </v-col>
            <v-divider vertical class="ma-3" color="white"></v-divider>
            <v-col cols="12" sm="2">
              <v-avatar class="ma-3" size="120" tile>
               <v-img :src=" url + discipline.students.picture "></v-img>
              </v-avatar>
            </v-col>
            <v-col cols="12" sm="3" class="text-center data">
              <h3> {{discipline.students.first_name}}  {{discipline.students.last_name}} </h3>
              <span>WEB-A 2021</span><br />
             
            </v-col>
            <v-col cols="12" sm="3" class="date">
              <v-chip class="ma-2" color="yellow darken-4">2021-01-12</v-chip
              >
             
            </v-col>
            <v-col cols="12" sm="2">
              <div class="i_con">
                <v-icon color="blue darken-1" text size="30px">
                  mdi-lead-pencil</v-icon
                >
                <v-icon
                  color="red darken-1"
                  text
                  size="30px"
                  @click="getPermissionId(permission.id)"
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
  props: ["datadiscipline"],
  emits: ["search-permission"],
  data() {
    return {
       url: "http://127.0.0.1:8000/storage/images/",
    };
    
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
.v-chip {
  font-weight: bold;
}
@import url("https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap");
h3 {
  font-family: "Times New Roman", cursive;
}
</style>
