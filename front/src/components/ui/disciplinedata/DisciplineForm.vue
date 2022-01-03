<template>
  <div class="text">
    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="orange lighten-1 "
          class="black--text"
          dark
          v-bind="attrs"
          v-on="on"
        >
          +Discipline
        </v-btn>
      </template>
      <v-card>
        <div class="text-center">
          <v-card-title class="text-h5 orange lighten-1">
            NEW DISCIPLINE
          </v-card-title>
        </div>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col class="d-flex" cols="12" sm="12" md="12">
                <label for="student" class="country mb-0">Choose student</label
                ><br />
                <select
                :error-messages="studentErrors"
                  required @input="$v.student_id.$touch()" 
                  @blur="$v.student_id.$touch()"
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
              <v-col cols="12" sm="12" md="12">
                <v-text-field 
                :error-messages="dateErrors"
                  required @input="$v.date.$touch()" 
                  @blur="$v.date.$touch()"
                type="date" 
                v-model="date"
                > </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="12">
                <v-select
                :error-messages="typeErrors"
                  required @input="$v.type.$touch()" 
                  @blur="$v.type.$touch()"
                  v-model="type"
                  :items="disciplineType"
                  label="Choose leave type"
                 
                ></v-select>
              </v-col>
              <v-col cols="12" md="12">
                <v-textarea
                :error-messages="explainationErrors"
                  required @input="$v.explaination.$touch()" 
                  @blur="$v.explaination.$touch()"
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
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
export default {
  emits: ["addDiscipline"],
  mixins: [validationMixin],
  validations: {
    student_id: {
      required,
    },
    type: {
      required,
    },
    date: {
      required,
    },
    explaination: {
      required,
    },
    checkbox: {
      checked(val) {
        return val;
      },
    },
  },
  data() {
    return {
      checkbox: false,
      dialog: false,
      students: [],
      disciplineType: [
        "Misconduct",
        "Oral warning",
        "Warning letter",
        "Terminaton",
      ],
      id: null,
      type: "",
      date: "",
      explaination: "",
    };
  },
  computed: {
    checkboxErrors() {
      const errors = [];
      if (!this.$v.checkbox.$dirty) return errors;
      !this.$v.checkbox.checked && errors.push("You must agree to continue!");
      return errors;
    },
    studentErrors() {
      const errors = [];
      if (!this.$v.student_id.$dirty) return errors;
      !this.$v.student_id.required && errors.push("Student is required");
      return errors;
    },
    typeErrors() {
      const errors = [];
      if (!this.$v.type.$dirty) return errors;
      !this.$v.type.required && errors.push("Discipline is required");
      return errors;
    },
    dateErrors() {
      const errors = [];
      if (!this.$v.date.$dirty) return errors;
      !this.$v.date.required && errors.push("Date is required");
      return errors;
    },
     explainationErrors() {
      const errors = [];
      if (!this.$v.explaination.$dirty) return errors;
      !this.$v.explaination.required && errors.push("Description is required");
      return errors;
    },
   
  },
  methods: {
    studentdata() {
      axios.get("/students").then((response) => {
        this.students = response.data;
      });
    },
    createDiscipline() {
      if (this.date !== "" && this.type !== "" && this.explaination !== "") {
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
    submit() {
      this.$v.$touch();
    },
    clear() {
      this.$v.$reset();
      this.type = null;
      this.student_id = null;
      this.date = null;
      this.explaination = null;
      this.checkbox = false;
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
