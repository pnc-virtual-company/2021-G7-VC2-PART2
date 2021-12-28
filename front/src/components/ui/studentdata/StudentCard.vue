<template>
  <v-container>
    <template>
      <v-card>
        <v-card-title>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
            @keyup="searchStudentName"
          ></v-text-field>
          <v-spacer></v-spacer>
          
        </v-card-title>
        <v-simple-table>
          <template v-slot:default>
            <thead class="blue lighten-3">
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="lighten-4">
              <tr
                class=""
                v-for="student in dataStudent"
                :key="student.first_name"
              >
                <td>{{ student.first_name }}</td>
                <td>{{ student.last_name }}</td>
                <td>0{{ student.phone }}</td>
                <td>{{ student.gender }}</td>
                <td>
                  <div class="i-con">
                    <v-icon color="blue darken-1" text>mdi-lead-pencil</v-icon>
                    <v-icon
                      color="red darken-1"
                      @click="getstudentId(student.id)"
                      >mdi-delete</v-icon
                    >
                  </div>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card>
    </template>
  </v-container>
</template>
<script>
import axios from "../../../api/api.js";
export default {
  props: ["dataStudent"],
  emits: ["deleteItem", "search-user", "updateStudent"],
  data() {
    return {
      search: "",
      students: [],
      deleteId: 0,
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
      axios.post("/students", newStudent).then((response) => {
        this.studentdata();
        console.log(response.data);
      });
    },
    // ____________get student id_____________
    getstudentId(id) {
      this.deleteId = id;
      this.$emit("deleteItem", this.deleteId);
    },

    searchStudentName() {
      this.$emit("search-user", this.search);
    },
  },
  mounted() {
    this.studentdata();
  },
};
</script>
<style scoped>
v-card-title {
  background: rgb(85, 237, 248);
}
.t-head {
  display: flex;
  justify-content: space-between;
}
th {
  color: black;
}
td {
  color: black;
}
</style>