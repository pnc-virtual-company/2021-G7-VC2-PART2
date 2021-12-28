<template>
<v-container>
    <template>
        <v-card>
            <v-card-title>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details @keyup="searchUsername"></v-text-field>
            </v-card-title>
            <v-simple-table>
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

                                <div class="i-con">
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
        };
    },
    methods: {
        // ____________get student id_____________
        getstudentId(id) {
            this.deleteId = id;
            this.$emit("deleteItem", this.deleteId);
        },
        searchUsername() {
            this.$emit("search-user", this.search);
        },

        getStudentInfo(student) {
            this.showForm = true;
            this.studentData = student;
            console.log(this.studentData);
        },
        Cencel(hidden) {
            this.showForm = hidden;
        },
        Updatestudent(id, student, hidden) {

            axios.put("/students/" + id, student).then((res) => {
                console.log(res.data);
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
