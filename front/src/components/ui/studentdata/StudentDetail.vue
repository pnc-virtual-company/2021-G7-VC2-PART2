<template>
<v-container>
    <div v-for="student of studentData" :key="student.id" class="mb-5">
        <v-row v-if="userStudent.student_id == student.id">
            <v-col cols="12" sm="3">
                <v-avatar class="" size="100" tile>
                    <!-- <v-img :src=" url + student.picture "></v-img> -->
                    <v-img src="https://i.pinimg.com/736x/2d/06/d0/2d06d0861bcfb437c8d072b0fc06a648.jpg"></v-img>
                </v-avatar>
            </v-col>
            <v-col cols="12" sm="3">
                <v-text class="text-lg-h6">Name: {{student.first_name}} {{student.last_name}}</v-text><br>
                <v-text class="text-lg-h6">Gender:</v-text>
                <v-text> {{student.gender}}</v-text><br>
                <v-icon black size="25px"> mdi-phone</v-icon>
                <v-text class="text-md-body-1">: 0{{student.phone}}</v-text>
            </v-col>
            <v-col cols="12" sm="3" class="text-center">
                <v-icon black size="30px" color=""> mdi-school</v-icon>
                <v-text class="text-lg-h6"> {{student.class}}</v-text>
            </v-col>
            <v-col cols="12" sm="3" class="text-lg-right">
                <v-icon black size="30px" color=""> mdi-school </v-icon>
                <v-text class="text-lg-h6 green--text"> At school</v-text>
            </v-col>
        </v-row>
    </div>
    <!-- permission -->
    <template>
        <v-tabs vertical>
            <v-tab>
                <v-badge  :content="countPermission" :value="countPermission" color="red" overlap>
                    <v-icon left> mdi-account </v-icon>Permissions
                </v-badge>
            </v-tab>
            <v-tab>
                <v-badge  :content="messages" :value="messages" color="red" overlap>
                    <v-icon left> mdi-lock</v-icon>Disciplines
                </v-badge>
            </v-tab>
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <v-expansion-panels>
                            <v-expansion-panel class="mb-2" v-for="permiss of permissionData" :key="permiss.id">
                                <v-expansion-panel-header>
                                    <v-row>
                                        <v-col cols="12" sm="1" class="logo">
                                            <v-icon black size="60px" color="orange darken-2"> mdi-link-variant </v-icon>
                                        </v-col>
                                        <v-divider vertical class="ma-3" color="white"></v-divider>

                                        <v-col cols="12" sm="3" class="date">
                                            <v-icon black> mdi-calendar-text</v-icon>
                                            <v-chip class="ma-2 "> {{permiss.start_date}}</v-chip>
                                        </v-col>
                                        <v-col cols="12" sm="3" class="date">
                                            <v-icon black> mdi-calendar-text</v-icon>
                                            <v-chip class="ma-2 ">{{permiss.end_date}}</v-chip>
                                        </v-col>
                                        <v-col cols="12" sm="1" class="text-center data">
                                            <span class="num orange--text">5 days</span>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>

                                <v-expansion-panel-content>{{permiss.description}}</v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <p>
                            Morbi nec metus. Suspendisse faucibus, nunc et pellentesque egestas, 
                        </p>

                    </v-card-text>
                </v-card>
            </v-tab-item>
        </v-tabs>
    </template>
</v-container>
</template>

<script>
import axios from "../../../api/api.js";
export default {
    data() {
        return {
            studentData: [],
            permissionData: [],
            userStudent: JSON.parse(localStorage.getItem("user")),
            url: "http://127.0.0.1:8000/storage/images/",
            countPermission:0,

        }
    },
    mounted() {
        axios.get("/students").then((res) => {
            for (let stu of res.data) {
                this.studentData.push(stu)
            }
        });
        axios.get("/permission").then((res) => {
            for (let per of res.data) {
                if (this.userStudent.student_id === per.student_id) {
                    this.permissionData.push(per);
                    this.countPermission++
                }
            }
        });
    },
}
</script>

<style scoped>
.permisson {
    width: 100%;
}
</style>
