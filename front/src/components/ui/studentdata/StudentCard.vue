<template>
<v-container>
    <template>
        <v-card>
            <v-card-title>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details @keyup="searchUsername"></v-text-field>
            </v-card-title>
            <v-simple-table >
                <template v-slot:default>
                    <thead class="blue lighten-3">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="lighten-4">
                        <tr class="" v-for="(student, index) in dataStudent" :key="index">
                            <td>{{ student.first_name }}</td>
                            <td>{{ student.last_name }}</td>
                            <td>{{ student.gender }}</td>
                            <td>{{ student.class }}</td>
                            <td>0{{ student.phone }}</td>
                            <td>
                                <div v-if="userAccount.role === 'Student'">
                                    <div class="i-con">
                                        <v-icon  color="blue darken-1" text>mdi-lead-pencil</v-icon>
                                        <v-icon color="red darken-1">mdi-delete</v-icon>
                                    </div>
                                </div>
                                <div class="i-con" v-else>
                                        <v-icon @click="getStudentInfo(student)" color="blue darken-1" text>mdi-lead-pencil</v-icon>
                                        <v-icon color="red darken-1" @click="getstudentId(student.id)">mdi-delete</v-icon>
                                </div>
                            </td>
                        </tr>
                        <update-student v-if="showForm" :studentInfo="studentData" @cancel="Cencel" @update="Updatestudent">
                        </update-student>
                    </tbody>
                </template>
            </v-simple-table>
        </v-card>
    </template>
    <div class="text-center">
      <v-dialog
        v-model="dialog"
        transition="dialog-top-transition"
        max-width="500"
      >
        <v-card>
          <v-card-text>
            <div class="text-h5 pa-5">Do you want to delete this student?</div>
          </v-card-text>
          <hr />
          <v-card-actions class="justify-end">
            <v-spacer></v-spacer>
            <v-btn @click="dialog = false" class="blue white--text" text>
              Cancel
            </v-btn>
            <v-btn class="red white--text" text @click="deleteStudent">
              Ok
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
</v-container>
</template>

<script>
import axios from "../../../api/api.js";
import Updatestudent from "./UpdateStudent.vue";
export default {
    props: ["dataStudent"],
    emits: ["deleteItem", "search-user", "update-student"],
    components: {
        "update-student": Updatestudent,
    },
    data() {
        return {
            search: "",
            studentId: 0,
            studentData: [],
            showForm: false,
            dialog: false,
            deleteId: 0,
            userAccount:JSON.parse(localStorage.getItem("user")),
      
        };
    },
    methods: {
        // ____________get student id_____________

        getstudentId(id) {
            this.dialog = true;
            this.deleteId = id;
        },
        deleteStudent() {
            this.$emit('deleteItem', this.deleteId);
            this.dialog = false;
        },
        searchUsername() {
            this.$emit("search-user", this.search);
        },
        getStudentInfo(student) {
            this.showForm = true;
            this.studentData = student;
            
        },
        Cencel(hidden) {
            this.showForm = hidden;
        },
        Updatestudent(id, student, hidden) {
            axios.put("/students/" + id, student).then((res) => {
                this.$emit("update-student", res.data);
                this.showForm = hidden;

            });
        },
    },
    
};
</script>

<style>
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
