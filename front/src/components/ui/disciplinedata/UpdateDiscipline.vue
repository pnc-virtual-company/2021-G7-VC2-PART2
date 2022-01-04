<template>
  <div class="container">
    <v-card>
      <div class="text-center">
        <v-card-title class="text-h5 orange lighten-1">
          Update Discipline
        </v-card-title>
      </div>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col class="d-flex" cols="12" sm="12" md="12">
              <label for="student" class="country mb-0">Choose student</label
              ><br />
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
            <!-- edit discipline dialog -->
            <v-col cols="12" sm="12" md="12">
              <v-text-field type="date" v-model="date"> </v-text-field>
            </v-col>
            <v-col class="d-flex" cols="12" sm="12">
              <v-select
                v-model="type"
                :items="disciplineType"
                label="Choose leave type"
                required
              ></v-select>
            </v-col>
          
              <v-textarea
                v-model="explaination"
                auto-grow
                 solo
                filled
                color="deep-purple"
                label="Description"
                rows="1"
              ></v-textarea>
          
          </v-row>
        </v-container>
      </v-card-text>
      <v-divider></v-divider>
      <v-card-actions class="black lighten-1">
        <v-spacer></v-spacer>
        <v-btn @click="cancel" color="red darken-1" text> Cancel </v-btn>
        <v-btn @click="Update" color="blue darken-1" text> Update </v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
import axios from "../../../api/api.js";
export default {
  props: ["disciplineInfo"],
  emits: ["update", "cancel"],
  data() {
    return {
      dialog: false,
      students: [],
      disciplineType: [
        "Misconduct",
        "Oral warning",
        "Warning letter",
        "Terminaton",
      ],
      student_id: null,
      discipline_type: null,
      date_time: null,
      explaination: null,
      student: "",
    };
  },
  methods: {
    studentdata() {
      axios.get("/students").then((response) => {
        this.students = response.data;
      });
    },
    Update() {
      let discipline = {
        student_id: this.id,
        discipline_type: this.type,
        date_time: this.date,
        explaination: this.explaination,
      };
      this.$emit("update", this.disciplineInfo.id, discipline, false);
      console.log(discipline);
    },
    cancel() {
      this.$emit("cancel", false);
    },
  },
  mounted() {
    this.id = this.disciplineInfo.student_id;
    this.type = this.disciplineInfo.discipline_type;
    this.date = this.disciplineInfo.date_time;
    this.explaination = this.disciplineInfo.explaination;
    this.studentdata();
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
