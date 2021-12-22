<template>
  <section>
    <student-card
      :dataUser="students"
      @deleteItem="deleteStudent"
      @search-user="searchStudent"
    ></student-card>
  </section>
</template>

<script>
// import StudentForm from "../ui/StudentForm.vue";
import StudentCard from "../ui/studentdata/StudentCard.vue";
import axios from "../../api/api.js";

export default {
  name: "App",
  components: {
    "student-card": StudentCard,
    // "student-form": StudentForm,
  },
  data() {
    return {
      students: [],
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
      axios.post("/students", newStudent).then(response => {
        this.studentdata();
        console.log(response.data);
      });
    },
    //______________ delete student in student list______________
    deleteStudent(studentId) {
      axios.delete("/students/" + studentId).then((response) => {
        console.log(response.data);
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
</style>