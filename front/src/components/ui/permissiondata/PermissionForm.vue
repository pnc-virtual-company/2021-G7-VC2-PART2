<template>
  <div class="text">
    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="orange lighten-1 "
          class="black--text btnAddPermission"
          dark
          v-bind="attrs"
          v-on="on"
        >
          +Permission
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
              <br />
              <v-col class="d-flex" cols="12" sm="12" md="12">
                <label for="student" class="country mb-0">Choose student</label>
                <select
                  name="student"
                  id="student"
                  class="select_student"
                  v-model="id"
                  :error-messages="studentErrors"
                  @input="$v.id.$touch()"
                  @blur="$v.id.$touch()"
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
              <v-col cols="12" sm="12" md="6">
                <v-text-field
                  type="date"
                  v-model="startDate"
                  :error-messages="startDateErrors"
                  @input="$v.startDate.$touch()"
                  @blur="$v.startDate.$touch()"
                >
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="12" md="6">
                <v-text-field
                  type="date"
                  v-model="endDate"
                  :error-messages="endDateErrors"
                  @input="$v.endDate.$touch()"
                  @blur="$v.endDate.$touch()"
                >
                </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="12">
                <v-select
                  v-model="reason"
                  :items="permissionType"
                  label="Choose leave type"
                  :error-messages="typeErrors"
                  @input="$v.reason.$touch()"
                  @blur="$v.reason.$touch()"
                ></v-select>
              </v-col>
              <v-col cols="12" md="12">
                <v-textarea
                  solo
                  name="input-7-4"
                  v-model="description"
                  label="Description..."
                  :error-messages="explainationErrors"
                  @input="$v.description.$touch()"
                  @blur="$v.description.$touch()"
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions class="black lighten-1">
          <v-btn color="blue darken-1 " text block @click="createPermission">
            Create now
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required } from "vuelidate/lib/validators";
import axios from "../../../api/api.js";
export default {
  emits: ["addPermission"],
  mixins: [validationMixin],
  validations: {
    student_id: {
      required,
    },
    reason: {
      required,
    },
    startDate: {
      required,
    },
    endDate: {
      required,
    },
    description: {
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
      dialog: false,
      students: [],
      permissionType: ["Sick", "Urgent Case", "Accendent"],
      id: null,
      startDate: null,
      endDate: null,
      reason: null,
      description: null,
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
      if (!this.$v.reason.$dirty) return errors;
      !this.$v.reason.required && errors.push("Discipline is required");
      return errors;
    },
    endDateErrors() {
      const errors = [];
      if (!this.$v.endDate.$dirty) return errors;
      !this.$v.endDate.required && errors.push("Date is required");
      return errors;
    },
    startDateErrors() {
      const errors = [];
      if (!this.$v.startDate.$dirty) return errors;
      !this.$v.startDate.required && errors.push("Date is required");
      return errors;
    },
    explainationErrors() {
      const errors = [];
      if (!this.$v.description.$dirty) return errors;
      !this.$v.description.required && errors.push("Description is required");
      return errors;
    },
  },
  methods: {
    studentdata() {
      axios.get("/students").then((response) => {
        this.students = response.data;
      });
    },
    createPermission() {
      if (this.student_id !== "") {
        this.dialog = false;
        let newPermission = new FormData();
        newPermission.append("student_id", this.id);
        newPermission.append("start_date", this.startDate);
        newPermission.append("end_date", this.endDate);
        newPermission.append("leave_type", this.reason);
        newPermission.append("description", this.description);
        this.$emit("addPermission", newPermission);
        console.log(this.id);
      }
      this.permission_Type = null;
      this.student_id = null;
      this.startDate = null;
      this.endDate = null;
      this.reason = null;
      this.description = null;
    },
    submit() {
      this.$v.$touch();
    },
    clear() {
      this.$v.$reset();
      this.permission_Type = null;
      this.student_id = null;
      this.startDate = null;
      this.endDate = null;
      this.reason = null;
      this.description = null;
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
.btnAddPermission {
  position: fixed;
  margin-top: 20px;
  margin-left: 23px;
}

@import url("https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap");
</style>
