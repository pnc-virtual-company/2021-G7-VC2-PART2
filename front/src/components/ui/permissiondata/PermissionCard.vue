<template>
  <div class="permission">
    <v-card 
    class="mx-auto card" 
    max-width="900" 
    v-for="(permission, index) in datapermission"
    :key="index">
      <v-row>
        <v-col cols="12" sm="2" class="logo">
          <v-icon black size="60px"> mdi-link-variant </v-icon>
        </v-col>
        <v-divider vertical class="ma-3" color="white"></v-divider>
        <v-col cols="12" sm="2">
          <v-avatar class="ma-3" size="120" tile>
            <v-img
              src="https://pm1.narvii.com/7068/371b63bb840d96f6ac4eeb4575ba7db59bb78c8fr1-736-749v2_hq.jpg"
            ></v-img>
          </v-avatar>
        </v-col>
        <v-col cols="12" sm="3" class="text-center data">
          <h3> {{permission.student_name}} </h3>
          <span>WEB-A</span>
        </v-col>
        <v-col cols="12" sm="3" class="date">
          <v-chip class="ma-2" color="orange lighten-1">
            start date: {{permission.start_date}} </v-chip
          ><br />
          <v-chip class="ma-2" color="orange lighten-1">
            end date: {{permission.end_date}}
          </v-chip>
        </v-col>
        <v-col cols="12" sm="2">
          <div class="i_con">
            <v-icon color="blue darken-1" text size="40px">
              mdi-lead-pencil</v-icon
            >
            <v-icon color="red darken-1" text size="40px">mdi-delete</v-icon>
          </div>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>
<script>
export default {
  props: ["datapermission"],
};
</script>
<style scoped>
.date {
  margin-top: 2%;
}
.data {
  margin-top: 5%;
  margin-left: -3%;
}
.i_con {
  margin-top: 35%;
}
.logo {
  margin-top: 4%;
}
.card {
  margin-top: 2%;
  text-align: center;
}
</style>