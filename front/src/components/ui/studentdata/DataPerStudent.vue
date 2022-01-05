<template>
<v-container>
    <div v-for="student of studentData" :key="student.id" class=" stu-info mb-5 mr-4">
        <v-row>
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
                <v-icon black size="30px" color=""> mdi-google-classroom</v-icon>
                <v-text class="text-lg-h6"> {{student.class}}</v-text>
            </v-col>
            <v-col cols="12" sm="3" class="text-lg-right">
                <div v-if="countTerminate===0">
                    <v-icon black size="30px" color=""> mdi-school </v-icon>
                    <v-text class="text-lg-h6 green--text" > At school</v-text>
                </div>
                <div v-else>
                    <v-icon black size="30px" color=""> mdi-account-off </v-icon>
                    <v-text class="text-lg-h6 green--text"> Out school</v-text>
                </div>
              
            </v-col>
        </v-row>
    </div>
    <!-- 1 -->
    <template >
        <v-tabs vertical mt-10 >

            <v-tab class="d-flex justify-start">
                <v-badge :content="countPermission" :value="countPermission" color="red" overlap>
                    <v-icon left> mdi-checkbox-multiple-marked </v-icon>
                    <v-text>Permissions</v-text>

                </v-badge>
            </v-tab>
            <v-tab class="d-flex justify-start">
                <v-badge :content="countWarning" :value="countWarning" color="red" overlap>
                    <v-icon left> mdi-note</v-icon>
                    <v-text>Warning letter</v-text>
                </v-badge>
            </v-tab>
            <v-tab class="d-flex justify-start">
                <v-badge :content="countMisconduct" :value="countMisconduct" color="red" overlap>
                    <v-icon left> mdi-alert</v-icon>
                    <v-text>MISCONDUCT</v-text>
                </v-badge>
            </v-tab>
            <v-tab class="d-flex justify-start">
                <v-badge :content="countOralWarning" :value="countOralWarning" color="red" overlap>
                    <v-icon left> mdi-alert</v-icon>
                    <v-text>Oral warning</v-text>
                </v-badge>
            </v-tab>
            <v-tab class="d-flex justify-start">
                <v-badge :content="countTerminate" :value="countTerminate" color="red" overlap>
                    <v-icon left> mdi-account-remove</v-icon>
                    <v-text>Terminaton</v-text>
                </v-badge>
            </v-tab>
            <!-- permission -->
            <v-tab-item  >
                <v-card flat  >
                    <v-card-text >
                        <v-expansion-panels class="ml-5 permission-card">
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
                                            <span class="font-weight-black " v-html="Math.round(((new Date(permiss.end_date)).getTime() - (new Date(permiss.start_date)).getTime()) / (1000 *  3600 * 24))"></span><span> days</span>

                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>

                                <v-expansion-panel-content>{{permiss.description}}</v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <!-- warning letter -->
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <v-expansion-panels v-if="countWarning >0">
                            <v-expansion-panel class="mb-2" v-for="warning of warningLetterData" :key="warning.id">
                                <v-expansion-panel-header>
                                    <v-row>
                                        <v-col cols="12" sm="3" class="logo">
                                            <v-icon black size="50px" color="orange darken-2"> mdi-alert </v-icon>
                                            <v-text class="text-uppercase">{{warning.discipline_type}}</v-text>
                                        </v-col>
                                        <v-divider vertical class="ma-3" color="white"></v-divider>

                                        <v-col cols="12" sm="3" class="date">
                                            <v-icon black> mdi-calendar-text</v-icon>
                                            <v-chip class="ma-2 "> {{warning.date_time}}</v-chip>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>{{warning.explaination}}</v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <v-expansion-panels v-else>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-row class="d-flex justify-center">
                                        <v-col cols="12" sm="3" class="logo">
                                            <v-icon black size="50px" color="orange darken-2"> mdi-alert </v-icon>
                                            <v-text class="text-uppercase">No Data</v-text>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <!-- Misconduct -->
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <v-expansion-panels v-if="countMisconduct >0">
                            <v-expansion-panel class="mb-2" v-for="misconduct of misconductData" :key="misconduct.id">
                                <v-expansion-panel-header v-if="misconduct.discipline_type==='Misconduct'">
                                    <v-row>
                                        <v-col cols="12" sm="3" class="logo">
                                            <v-icon black size="50px" color="orange darken-2"> mdi-alert </v-icon>
                                            <v-text class="text-uppercase">{{misconduct.discipline_type}}</v-text>
                                        </v-col>
                                        <v-divider vertical class="ma-3" color="white"></v-divider>

                                        <v-col cols="12" sm="3" class="date">
                                            <v-icon black> mdi-calendar-text</v-icon>
                                            <v-chip class="ma-2 "> {{misconduct.date_time}}</v-chip>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>{{misconduct.explaination}}</v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <v-expansion-panels v-else>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-row class="d-flex justify-center">
                                        <v-col cols="12" sm="3" class="logo">
                                            <v-icon black size="50px" color="orange darken-2"> mdi-alert </v-icon>
                                            <v-text class="text-uppercase">No Data</v-text>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <!-- oral warning -->
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <v-expansion-panels v-if="countOralWarning >0">
                            <v-expansion-panel class="mb-2" v-for="oral of oralWarningData" :key="oral.id">
                                <v-expansion-panel-header>
                                    <v-row>
                                        <v-col cols="12" sm="3" class="logo">
                                            <v-icon black size="50px" color="orange darken-2"> mdi-alert </v-icon>
                                            <v-text class="text-uppercase">{{oral.discipline_type}}</v-text>
                                        </v-col>
                                        <v-divider vertical class="ma-3" color="white"></v-divider>

                                        <v-col cols="12" sm="3" class="date">
                                            <v-icon black> mdi-calendar-text</v-icon>
                                            <v-chip class="ma-2 "> {{oral.date_time}}</v-chip>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>{{oral.explaination}}</v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <v-expansion-panels v-else>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-row class="d-flex justify-center">
                                        <v-col cols="12" sm="3" class="logo">
                                            <v-icon black size="50px" color="orange darken-2"> mdi-alert </v-icon>
                                            <v-text class="text-uppercase">No Data</v-text>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-card-text>
                </v-card>
            </v-tab-item>
            <!-- termination -->
            <v-tab-item>
                <v-card flat>
                    <v-card-text>
                        <v-expansion-panels v-if="countTerminate >0">
                            <v-expansion-panel class="mb-2" v-for="terminate of terminationData" :key="terminate.id">
                                <v-expansion-panel-header>
                                    <v-row>
                                        <v-col cols="12" sm="3" class="logo">
                                            <v-icon black size="50px" color="orange darken-2"> mdi-alert </v-icon>
                                            <v-text class="text-uppercase">{{terminate.discipline_type}}</v-text>
                                        </v-col>
                                        <v-divider vertical class="ma-3" color="white"></v-divider>

                                        <v-col cols="12" sm="3" class="date">
                                            <v-icon black> mdi-calendar-text</v-icon>
                                            <v-chip class="ma-2 "> {{terminate.date_time}}</v-chip>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>{{terminate.explaination}}</v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <v-expansion-panels v-else>
                            <v-expansion-panel>
                                <v-expansion-panel-header>
                                    <v-row class="d-flex justify-center">
                                        <v-col cols="12" sm="3" class="logo">
                                            <v-icon black size="50px" color="orange darken-2"> mdi-alert </v-icon>
                                            <v-text class="text-uppercase">No Data</v-text>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-header>
                            </v-expansion-panel>
                        </v-expansion-panels>
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
            disciplineData: [],
            misconductData: [],
            warningLetterData: [],
            oralWarningData: [],
            terminationData: [],
            userStudent: JSON.parse(localStorage.getItem("user")),
            url: "http://127.0.0.1:8000/storage/images/",
            countPermission: 0,
            countDiscipline: 0,
            countMisconduct: 0,
            countWarning: 0,
            countOralWarning: 0,
            countTerminate: 0

        }
    },
    mounted() {
        axios.get("/students").then((res) => {
            for (let stu of res.data) {
                if(this.userStudent.student_id === stu.id){
                    this.studentData.push(stu)
                }
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
        axios.get("/discipline").then((res) => {
            for (let dis of res.data) {
                if (this.userStudent.student_id === dis.student_id) {
                    this.disciplineData.push(dis);
                }
            }
            for (let n of this.disciplineData) {
                if (n.discipline_type === "Misconduct") {
                    this.countMisconduct++
                    this.misconductData.push(n);
                }
                if (n.discipline_type === "Warning letter") {
                    this.countWarning++
                    this.warningLetterData.push(n);
                }
                if (n.discipline_type === "Oral warning") {
                    this.countOralWarning++
                    this.oralWarningData.push(n)
                }
                if (n.discipline_type === "Terminaton") {
                    this.countTerminate++
                    this.terminationData.push(n)
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

.stu-info{
    border: 2px solid rgb(0,0,0,0.2);
    padding: 15px;
    outline: none;
    border-radius: 5px;

}
</style>
