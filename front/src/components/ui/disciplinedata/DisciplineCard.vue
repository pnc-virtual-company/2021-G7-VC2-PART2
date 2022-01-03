<template>
  <v-container>
    <template>
      <v-simple-table> </v-simple-table>
      <div class="permission">
        <v-card
          color="grey lighten-4"
          class="mx-auto card"
          max-width="900"
          v-for="(discipline, index) in datadiscipline"
          :key="index"
        >
          <v-row>
            <v-col cols="12" sm="3" class="logo">
              <v-icon color="orange" size="60px"> mdi-alert </v-icon><br />
              <strong> {{ discipline.discipline_type }} </strong>
            </v-col>

            <v-col cols="12" sm="2">
              <v-avatar class="ma-3" size="120" tile>
                <v-img :src="url + discipline.students.picture"></v-img>
              </v-avatar>
            </v-col>
            <v-col cols="12" sm="3" class="text-center data">
              <h3>
                {{ discipline.students.first_name }}

                {{ discipline.students.last_name }}
              </h3>
              <span>  {{ discipline.students.class }}</span><br />
            </v-col>
            <v-col cols="12" sm="2" class="date">
              <v-chip class="ma-2" color="orange darken-2"> January 3, 2022</v-chip>
            </v-col>

            <v-col cols="12" sm="2">
              <div class="i_con">
                <v-icon color="blue darken-1" text size="30px">
                  mdi-lead-pencil</v-icon
                >
                <v-icon
                  color="red darken-1"
                  text
                  size="30px"
                  @click="getPermissionId(permission.id)"
                  >mdi-delete</v-icon
                ><br /><br /><br />
                <v-col cols="auto">
                  <v-dialog transition="dialog-top-transition" max-width="550">
                    <template v-slot:activator="{ on, attrs }">
                      <v-btn
                        color="white"
                        class="blue--text"
                        v-bind="attrs"
                        v-on="on"
                      >
                         More<v-icon>mdi-chevron-down</v-icon>
                      </v-btn>
                    </template>
                    <template v-slot:default="dialog">
                      <v-card>
                        <v-toolbar color="blue lighten-4"  darkclass="text-h4 pa-7">
                          <v-list-item-avatar color="grey darken-3">
                            <v-img
                              class="elevation-6"
                              alt=""
                            > <v-icon color="orange" size="60px"> mdi-alert </v-icon> </v-img>
                          </v-list-item-avatar>
                          <div class="text-h4 title">{{ discipline.discipline_type }} </div>
                        </v-toolbar><br>
                        <v-card-text>
                          <div class="font-weight-bold ml-8 mb-2 text-h5">January 03, 2022</div>
                          <v-timeline align-top dense>
                            <v-timeline-item small color="orange">
                              <div>
                                <div class="font-weight-normal text-h6">
                                   Student name: <strong>{{ discipline.students.first_name }} {{ discipline.students.last_name }}</strong> 
                                </div>
                              </div>
                            </v-timeline-item>
                            <v-timeline-item small >
                              <div>
                                <div class="font-weight-normal text-h6">
                                  Gender: <strong> {{ discipline.students.gender }} </strong> 
                                </div>
                                
                              </div>
                            </v-timeline-item>
                            <v-timeline-item small color="orange">
                              <div>
                                <div class="font-weight-normal text-h6">
                                  Batch: <strong> {{ discipline.students.class }} </strong> 
                                </div>
                                
                              </div>
                            </v-timeline-item>
                            <v-timeline-item small >
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
      </div>
    </template>
  </v-container>
</template>
<script>
export default {
  props: ["datadiscipline"],

  data() {
    return {
      url: "http://127.0.0.1:8000/storage/images/",
    };

  },
  
};
</script>
<style scoped>
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

strong {
  text-transform: uppercase;
}
@import url("https://fonts.googleapis.com/css2?family=Pushster&family=Raleway:wght@300&display=swap");
h3 {
  font-family: "Times New Roman", cursive;
}
</style>
