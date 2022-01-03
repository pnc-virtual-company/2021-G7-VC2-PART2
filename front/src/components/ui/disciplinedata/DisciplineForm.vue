<template>
  <div class="text">
    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="orange lighten-1 " class="black--text" dark v-bind="attrs" v-on="on">
          +Discipline
        </v-btn>
      </template>
      <v-card>
        <div class="text-center">
          <v-card-title class="text-h5 orange lighten-1">
            NEW PERMISSION
          </v-card-title>
        </div>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col class="d-flex" cols="12" sm="12" md="12">
                <label for="student" class="country mb-0">Choose student</label><br>
                <select
                  name="student"
                  id="student"
                  class="select_student"
                  v-model="id"
                >
                  <option
                    v-for="categorys of students"
                    :key="categorys.id"
                    :value="categorys.id"
                  >
                    {{ categorys.first_name }}
                    {{ categorys.last_name }}
                  </option>
                </select>
              </v-col>
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
        <v-card-actions class="black lighten-1">
          <v-btn color="blue darken-1 " text block @click="createDiscipline">
            CREATE NOW
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from "../../../api/api.js";
export default {
  emits: ["addDiscipline"],
  data() {
    return {
      dialog: false,
      students: [],
      disciplineType: ["Misconduct", "Oral warning", "Warning letter", "Terminaton"],
      id: null,
      type:null,
      date: null,
      reason: null,
      explaination: null,
    };
  },
  methods: {
    studentdata() {
      axios.get("/students").then((response) => {
        this.students = response.data;
      });
    },
    createDiscipline() {
      if (this.student_id !== "") {
        this.dialog = false;
        let newDiscipline = new FormData();
        newDiscipline.append("student_id", this.id);
        newDiscipline.append("discipline_type", this.type);
        newDiscipline.append("date_time", this.date);
        newDiscipline.append("explaination", this.explaination);
        
        this.$emit("addDiscipline", newDiscipline);
        console.log(this.id);
      }
      this.type = null;
      this.student_id = null;
      this.date = null;
      this.explaination = null;
  
    },
  },
  mounted() {
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

@import url("https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap");

</style>
