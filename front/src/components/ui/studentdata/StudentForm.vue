<template>
  <div class="text">
    <v-dialog v-model="dialog" max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn class="orange lighten-1" dark v-bind="attrs" v-on="on">
          +Add Student
        </v-btn>
      </template>
      <v-card>
        <v-card-title  class="text-h5 blue lighten-1">
          Create Student
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  label="Firstname"
                  type="text"
                  prepend-icon="mdi-account"
                  v-model="first_name"
                >
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="6">
                <v-text-field
                  label="Lastname"
                  type="text"
                  prepend-icon="mdi-account"
                  v-model="last_name"
                >
                </v-text-field>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6">
                
                <v-select :items="genders" v-model="gender" label="Gender" prepend-icon="mdi-gender-transgender"></v-select>
              </v-col>
              <v-col class="d-flex" cols="12" sm="6">
                <v-select :items="class_name" v-model="classes" label="Class" prepend-icon="mdi-school"></v-select>
              </v-col>

              <v-col cols="12" sm="12" >
                <v-text-field
                  label="Phone"
                  type="number"
                  prepend-icon="mdi-cellphone"
                  v-model="phone"
                >
                </v-text-field>
              </v-col>
              <v-col cols="12" sm="12">
                <input type="file" label="Profile" @change="onFileSelected" />
              </v-col>
              
            </v-row>
          </v-container>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions class="black lighten-1">
          <v-spacer></v-spacer>
          <v-btn color="red darken-1" text @click="dialog= false"> Cancel </v-btn>
          <v-btn color="blue darken-1" text @click="createStudent"> Save </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  emits: ["addStudent"],
  data() {
    return {
      dialog: false,
      class_name: ["SNA", "WEB-A", "WEB-B"],
      genders: ["Male", "Female"],
      first_name: "",
      last_name: "",
      phone: "",
      classes: "",
      picture: "",
      gender: "",
    };
  },
  methods: {
    onFileSelected(event) {
      this.picture = event.target.files[0];
    },
    createStudent() {
      if (this.first_name !== "") {
        this.dialog = false;
        let newStudent = new FormData();
        newStudent.append("first_name", this.first_name);
        newStudent.append("last_name", this.last_name);
        newStudent.append("gender", this.gender);
        newStudent.append("class", this.classes);
        newStudent.append("phone", this.phone);
        newStudent.append("picture", this.picture);
        this.$emit("addStudent", newStudent);
      }
    },
  },
};
</script>