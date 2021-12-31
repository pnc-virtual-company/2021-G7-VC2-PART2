<template>
  <div class="text">
    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="orange lighten-1" dark v-bind="attrs" v-on="on">
          +Add Permissions
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
        <v-btn color="blue darken-1" text @click="createPermission">
          Create
        </v-btn>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import axios from "../../../api/api.js";
export default {
  emits: ["addPermission"],
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
    studentdata() {
      axios.get("/students").then((response) => {
        for (let data of response.data) {
          let fullName = data.first_name + "  " + data.last_name;
          this.students.push(fullName);
        }
      });
    },
    createPermission() {
      if (this.student !== "") {
        this.dialog = false;
        let newPermission = new FormData();
        newPermission.append("student_name", this.student);
        newPermission.append("start_date", this.startDate);
        newPermission.append("end_date", this.endDate);
        newPermission.append("leave_type", this.reason);
        newPermission.append("student_id", this.num);

        this.$emit("addPermission", newPermission);
      }
    },
  },
  mounted() {
    this.studentdata();
  },
};
</script>