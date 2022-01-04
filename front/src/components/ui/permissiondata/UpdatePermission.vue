<template>
    <div class="container">
        <v-card>
        <div class="text-center">
          <v-card-title class="text-h5 orange lighten-1">
            Update Permission
          </v-card-title>
        </div>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col class="d-flex" cols="12" sm="12" md="12">
                <label for="student" class="country mb-0">Choose student</label>
                <select
                  name="student"
                  id="student"
                  class="select_student"
                  v-model="id"
                >
                  <option
                    v-for="(student, index) of students"
                    :key="index"
                    :value="student.id"
                  >
                    {{ student.first_name }}
                    {{ student.last_name }}
                  </option>
                </select>
              </v-col>
              <v-col cols="12" sm="12" md="6">
                <v-text-field type="date" v-model="startDate"> </v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="6">
                <v-text-field type="date" v-model="endDate"> </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="12">
                <v-select
                  v-model="reason"
                  :items="permissionType"
                  label="Choose leave type"
                  required
                ></v-select>
              </v-col>
              <v-col cols="12" md="12">
               <v-textarea
                  solo
                  name="input-7-4"
                  v-model="explaination"
                  label="Description..."
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions class="black lighten-1">
          <v-spacer></v-spacer>
          <v-btn @click="cancel"  color="red darken-1" text >
            Cancel
          </v-btn>
          <v-btn @click="Update"  color="blue darken-1" text >
            Update
          </v-btn>
        </v-card-actions>
      </v-card>
    </div>
</template>

<script>
import axios from "../../../api/api.js";
export default {
  props: ["permissionInfo"],
  emits: ["update", "cancel"],
  data() {
    return {
      dialog: false,
      students: [],
      permissionType: ["Sick", "Urgent Case", "Accendent"],
      student_id: null,
      start_date: null,
      end_date: null,
      leave_type: null,
      description: null,
    };
  },
  methods: {
       studentdata() {
      axios.get("/students").then((response) => {
        this.students = response.data;
    
      });
    },
    Update() {
      let permission = {
          student_id: this.id,
          start_date: this.startDate,
          end_date: this.endDate,
          leave_type: this.reason,
          description: this.description
      };
      this.$emit("update", this.permissionInfo.id, permission, false);
      console.log(permission);
    },
    cancel() {
      this.$emit("cancel", false);
    },
  },
  mounted() {
    this.id = this.permissionInfo.student_id;
    this.startDate = this.permissionInfo.start_date;
    this.endDate = this.permissionInfo.end_date;
    this.reason = this.permissionInfo.leave_type;
    this.description = this.permissionInfo.description;
    this.studentdata();
    console.log(this.studentdata())
  },
};
</script>

<style scoped>
.select_student {
  width: 300px;
  height: 40px;
  border-bottom: 1px solid grey;
  padding: 10px;
}
.container {
  padding: 30px;
  width: 83%;
  
}

@import url("https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap");

</style>