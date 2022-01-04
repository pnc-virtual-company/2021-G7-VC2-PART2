<template>
  <section>
     <student-form @addStudent="addStudent" class="student_btn"></student-form>
    <student-card v-if="userAccount.role != 'Student'"
      :dataStudent="students"
      @deleteItem="deleteStudent"
      @search-user="searchStudent"
      @update-student="studentdata"
    ></student-card>
    <student-detail v-if="userAccount.role ==='Student'"></student-detail>

  </section>
</template>

<script>
import StudentForm from "../ui/studentdata/StudentForm.vue";
import StudentCard from "../ui/studentdata/StudentCard.vue";
import StudentDetail from "../ui/studentdata/StudentDetail.vue";
import axios from "../../api/api.js";
export default {
  name: "App",
  components: {
    "student-card": StudentCard,
    "student-form": StudentForm,
    "student-detail":StudentDetail

  },
  data() {
    return {
      students: [],
      userAccount:JSON.parse(localStorage.getItem('user')),
    };
  },
  methods: {
    //_____________ get students list________________
    studentdata() {
      axios.get("/students").then((response) => {
        this.students = response.data;
      });
    },
    // ___________Add new student into list______________
    addStudent(newStudent) {
      axios.post("/students", newStudent).then(() => {
        this.studentdata();
      
      });
    },
    //______________ delete student in student list______________
    deleteStudent(studentId) {
      axios.delete("/students/" + studentId).then(() => {
        this.studentdata();
      });
    },
    //______________ search student __________________
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