<template>
  <v-simple-table>
    <template>
      <v-row justify="center" class="blue">
        <v-dialog v-model="dialog" persistent max-width="450px">
          <template v-slot:activator="{ on, attrs }">
            <button class="kc_fab_main_btn" v-bind="attrs" v-on="on">+</button>
          </template>
          <v-card class="primary">
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field label="First Name*" required></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field label="Last Name"></v-text-field>
                  </v-col>
                   <v-col cols="12">
                   <v-radio-group v-model="row" row>
                    <v-radio label="Male" value="radio-1"></v-radio>
                    <v-radio label="Female" value="radio-2"></v-radio>
                  </v-radio-group>
                  </v-col>
                  
                  <v-col class="d-flex" cols="12" sm="6">
                    <v-select :items="items" label="Class Name*"></v-select>
                  </v-col>
                  <v-col class="d-flex" cols="12" sm="6">
                    <v-select :items="years" label="Generation*"></v-select>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Phone Number*" required></v-text-field>
                  </v-col>
                  <v-row justify="center" align="center">
                    <v-col cols="8">
                      <v-file-input
                        show-size
                        label="Select Image"
                        accept="image/*"
                        @change="selectImage"
                      ></v-file-input>
                    </v-col>
                    <v-col cols="4" class="pl-2">
                      <v-btn color="primary" dark small @click="upload">
                        Upload
                        <v-icon right dark>mdi-cloud-upload</v-icon>
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-row>
              </v-container>
              <small>*indicates required field</small>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red darken-1" text @click="dialog = false">
                Close
              </v-btn>
              <v-btn color="blue darken-1" text @click="addNewStudent">
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </template>
    <template>
      <thead>
        <tr class="light-blue header">
          <th>First Name</th>
          <th>Last Name</th>
          <th>Gender</th>
          <th>Class</th>
          <th>Phone Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="student in students" :key="student.id">
          <td>{{ student.first_name }}</td>
          <td>{{ student.last_name }}</td>
          <td>{{ student.gender }}</td>
          <td>{{ student.class }}</td>
          <td>0{{ student.phone }}</td>
          <td>
            <v-icon color="blue">mdi-lead-pencil</v-icon>
            <v-icon color="red">mdi-delete</v-icon>
          </td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
</template>
<script>
import axios from "../../api/api.js";
export default {
  data() {
    return {
      dialog: false,
      row: null,
      items: ["SNA", "WEB-A", "WEB-B", "WEB-C"],
      years: [2020, 2021, 2022, 2023, 2024, 2025, 2026],
      students: [],
    };
  },
  methods: {
    studentData() {
      axios.get("/students").then((response) => {
        this.students = response.data;
      });
    },
    addNewStudent(
      firstName,
      lastName,
      gender,
      class_Generation,
      phone_number,
      image
    ) {
      const newStudent = new FormData();
      newStudent.append("first_name", firstName);
      newStudent.append("last_name", lastName);
      newStudent.append("gender", gender);
      newStudent.append("class", class_Generation);
      newStudent.append("phone_number", phone_number);
      newStudent.append("image", image);
      axios.post("/students", newStudent).then(() => {
        this.studentData();
        console.log("created");
      });
    },
  },
  mounted() {
    this.studentData();
  },
};
</script>
<style>
.header {
  font-weight: bold;
  text-transform: uppercase;
  box-shadow: 0 3px 6px grey, 0 3px 6px rgba(0, 0, 0, 0.23);
}
.kc_fab_main_btn {
  background-color: rgb(59, 147, 230);
  width: 60px;
  height: 60px;
  margin-top: 25%;
  border-radius: 100%;
  background: rgb(59, 147, 230);
  border: none;
  outline: none;
  color: #fff;
  font-size: 36px;
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
  transition: 0.3s;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  position: fixed;
  left: 205vh;
}

.kc_fab_main_btn:focus {
  transform: scale(1.1);
  transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
}
.icon {
  margin-left: auto;
  margin-right: auto;
}
</style>
