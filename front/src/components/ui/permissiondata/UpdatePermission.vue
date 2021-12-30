<template>
  <div class="text">
    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="orange lighten-1" dark v-bind="attrs" v-on="on">
          +Add Permission
        </v-btn>
      </template>
      <v-card>
        <div class="text-center">
          <v-card-title class="text-h5"> NEW PERMISSION </v-card-title>
        </div>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col class="d-flex" cols="12" sm="12" md="12">
                <v-select
                  :items="students"
                  v-model="student"
                  label="Choose Student"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                <v-text-field type="date" v-model="startDate"> </v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="12">
                <v-text-field type="date" v-model="endDate"> </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="12">
                <v-select
                  :items="permission_Type"
                  v-model="reason"
                  label="Choose leave type"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="12">
                <v-textarea
                  background-color="grey lighten-4"
                  color=""
                  label="Description"
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" > Cancel </v-btn>
          <v-btn color="primary"  class="mr-4" > Update </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
// import axios from '../../axios-request.js'
export default {
    props:['dataStudent'],
  data() {
    return {
      dialog: false,
      students: [],
      permission_Type: ["KK", "OO", "PP", "JJ"],
      student: null,
      startDate: null,
      endDate: null,
      reason: null,
      num: 1,
    };
  },
  methods: {

    //======================== update User ===========================================================
    //   UpdateUser(){
    //       let editUser = {
    //           'username': this.name,
    //           'email': this.email,
    //           'password': this.setPassword,
    //           'role': this.select,
              
    //       }
    //       axios.put('/updateUser/' + this.editID, editUser).then(res =>{
    //           console.log(res.data);
    //           this.dialog = false;
    //       })
    //   },

      //======================== update User ===========================================================

    //   getAllStudent(){
    //     axios.get('/students').then(res =>{
    //       let allStudents = res.data;
    //       for(let student of allStudents){
    //         this.studentsList.push(student.first_name);
    //       }
    //     })
    //   },
  },
    mounted() {
        // this.name = this.dataStudent.username;
        // this.email = this.dataStudent.email;
        // this.select = this.dataStudent.role;
        // this.setPassword = this.dataStudent.password;
        // this.editID = this.dataStudent.id;
        // this.getAllStudent();
    },
};
</script>
