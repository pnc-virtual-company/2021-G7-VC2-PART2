<template>
  <v-container>
    <template>
      <v-simple-table> </v-simple-table>
      <div class="discipline">
        <v-card
          color="grey lighten-4"
          class="mx-auto card"
          max-width="2000"
          max-height="130"
          v-for="(discipline, index) in datadiscipline"
          :key="index"
        >
          <v-row>
            <v-col cols="12" sm="3" class="logo mt-4">
              <v-icon color="orange" size="50px"> mdi-alert </v-icon><br />
              <strong class="title"> {{ discipline.discipline_type }} </strong>
            </v-col>
            <!-- image -->
            <v-col cols="12" sm="2">
              <v-avatar size="100" tile>
                <v-img :src="url + discipline.students.picture"></v-img>
              </v-avatar>
            </v-col>
            <v-col cols="12" sm="3" class="text-center data mt-4">
              <h3>
                {{ discipline.students.first_name }}
                {{ discipline.students.last_name }}
              </h3>
              <span> {{ discipline.students.class }}</span
              ><br />
            </v-col>
            <v-col cols="12" sm="2" class="date mt-4">
              <v-chip class="ma-2" color="orange darken-2">
                {{ discipline.date_time }}</v-chip
              >
            </v-col>

            <v-col cols="12" sm="2">
              <div class="i_con mt-4">
                <v-icon
                  color="blue darken-1"
                  text
                  size="30px"
                  v-if="userAccount.role === 'admin'"
                  @click="getdisciplineInfo(discipline)"
                  >mdi-lead-pencil</v-icon
                >
                <v-icon
                  color="red darken-1"
                  text
                  size="30px"
                  @click="getDisciplineId(discipline.id)"
                  v-if="userAccount.role === 'admin'"
                  >mdi-delete</v-icon
                ><br /><br /><br />
                <v-col cols="auto">
                  <v-dialog transition="dialog-top-transition" max-width="550">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="white"
                        class="blue--text detailButton"
                        v-bind="attrs"
                        v-on="on"
                      >
                        More<v-icon>mdi-chevron-down</v-icon>
                      </v-btn>
                    </template>
                    <template v-slot:default="dialog">
                      <v-card>
                        <v-toolbar
                          color="blue lighten-4"
                          darkclass="text-h4 pa-7"
                        >
                          <v-list-item-avatar color="grey darken-3">
                            <v-img class="elevation-6" alt="">
                              <v-icon color="orange" size="60px">
                                mdi-alert
                              </v-icon>
                            </v-img>
                          </v-list-item-avatar>
                          <div class="text-h4 title">
                            {{ discipline.discipline_type }}
                          </div> </v-toolbar
                        ><br />
                        <v-card-text>
                          <div class="font-weight-bold ml-8 mb-2 text-h5">
                            {{ discipline.date_time }}
                          </div>
                          <v-timeline align-top dense>
                            <v-timeline-item small color="orange">
                              <div>
                                <div class="font-weight-normal text-h6">
                                  Student name:
                                  <strong
                                    >{{ discipline.students.first_name }}
                                    {{ discipline.students.last_name }}</strong
                                  >
                                </div>
                              </div>
                            </v-timeline-item>
                            <v-timeline-item small>
                              <div>
                                <div class="font-weight-normal text-h6">
                                  Gender:
                                  <strong>
                                    {{ discipline.students.gender }}
                                  </strong>
                                </div>
                              </div>
                            </v-timeline-item>
                            <v-timeline-item small color="orange">
                              <div>
                                <div class="font-weight-normal text-h6">
                                  Batch:
                                  <strong>
                                    {{ discipline.students.class }}
                                  </strong>
                                </div>
                              </div>
                            </v-timeline-item>
                            <v-timeline-item small>
                              <div>
                                <div class="font-weight-normal text-h6">
                                  Reason: {{ discipline.explaination }}
                                </div>
                              </div>
                            </v-timeline-item>
                          </v-timeline>
                        </v-card-text>

                        <v-card-actions class="justify-end">
                          <v-btn color="blue" text @click="dialog.value = false"
                            >Close</v-btn
                          >
                        </v-card-actions>
                      </v-card>
                    </template>
                  </v-dialog>
                </v-col>
              </div>
            </v-col>
          </v-row>
        </v-card>
        <update-discipline
          v-if="showForm"
          :disciplineInfo="disciplineData"
          @cancel="Cencel"
          @update="UpdateDiscipline"
        >
        </update-discipline>
      </div>
    </template>
    <div class="text-center">
      <v-dialog
        v-model="dialog"
        transition="dialog-top-transition"
        max-width="500"
      >
        <v-card>
          <v-card-text>
            <div class="text-h5 pa-5">Do you want to delete this discipline?</div>
          </v-card-text>
          <hr />
          <v-card-actions class="justify-end">
            <v-spacer></v-spacer>
            <v-btn @click="dialog = false" class="blue white--text" text>
              Cancel
            </v-btn>
            <v-btn class="red white--text" text  @click="deleteDiscipline">
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
import UpdateDiscipline from "./UpdateDiscipline.vue";
export default {
  props: ["datadiscipline"],
  emits: ["update-discipline", "deleteDiscipline"],
  components: {
    "update-discipline": UpdateDiscipline,
  },

  data() {
    return {
      url: "http://127.0.0.1:8000/storage/images/",
      userAccount: JSON.parse(localStorage.getItem("user")),
      search: "",
      disciplineId: 0,
      disciplineData: [],
      showForm: false,
      isHiddin: false,
      dialog: false,
      deleteId: 0,
    };
  },
  methods: {
    getDisciplineId(id) {
      this.dialog = true;
      this.deleteId = id;
    },

    getdisciplineInfo(discipline) {
      this.showForm = true;
      this.disciplineData = discipline;
    },

    Cencel(hidden) {
      this.showForm = hidden;
    },

    UpdateDiscipline(id, discipline, hidden) {
      axios.put("/discipline/" + id, discipline).then((res) => {
        this.$emit("update-discipline", res.data);
        this.showForm = hidden;
      });
    },
    deleteDiscipline() {
      this.$emit("deleteDiscipline", this.deleteId);
      this.dialog = false;
    },
  },
};
</script>

<style scoped>
.detailButton {
  margin-top: -60px;
}
.date {
  margin-top: 3%;
}

.data {
  margin-top: 3%;
  margin-left: -3%;
}

.i_con {
  margin-top: 30%;
}

.logo {
  margin-top: 4%;
}

.card {
  margin-top: 2%;
  text-align: center;
}

.num {
  color: grey;
}

.v-chip {
  font-weight: bold;
}

.title {
  text-transform: uppercase;
}

/* strong {
  text-transform: uppercase;
} */
@import url("https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap");

h3 {
  font-family: "Times New Roman", cursive;
}
</style>
