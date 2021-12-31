<template>
  <section>
     <student-form @addStudent="addStudent" class="student_btn"></student-form>
    <student-card
      :dataStudent="students"
      @deleteItem="deleteStudent"
      @search-user="searchStudent"
      @update-student="studentdata"
    ></student-card>
  </section>
</template>

<script>
import StudentForm from "../ui/studentdata/StudentForm.vue";
import StudentCard from "../ui/studentdata/StudentCard.vue";
import axios from "../../api/api.js";
export default {
  name: "App",
  components: {
    "student-card": StudentCard,
    "student-form": StudentForm,
  },
  data() {
    return {
      students: [],
    };
  },
  methods: {
    //____________ get students list_______________
    studentdata() {
      axios.get("/students").then((response) => {
        this.students = response.data;
        console.log(this.students)
      });
    },
    // __________Add new student into list_____________
    addStudent(newStudent) {
      axios.post("/students", newStudent).then((response) => {
        this.studentdata();
        console.log(response.data);
      });
    },
    //_____________ delete student in student list_____________
    deleteStudent(studentId) {
      axios.delete("/students/" + studentId).then((response) => {
        console.log(response.data);
        this.studentdata();
      });
    },
    //_____________ search student _________________
    searchStudent(search) {
      if (search !== "") {
        axios.get("/students" + "/search/" + search).then((response) => {
          this.students = response.data;
        });
        
      } else {
        this.studentdata();
      }
    },
  },
  mounted() {
    this.studentdata();
  },
};
</script>

<style>
.student_btn {
  margin-left: 84%;
  margin-top: 5%;
}
</style>