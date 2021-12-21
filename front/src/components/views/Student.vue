<template>
  <v-data-table
    :headers="headers"
    :items="students"
    :search="search"
    sort-by="first_name"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              +ADD Student
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.first_name"
                      label="First Name"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.last_name"
                      label="Last Name"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.gender"
                      label="Gender"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="6">
                    <v-text-field
                      v-model="editedItem.class"
                      label="Class"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="12">
                    <v-text-field
                      v-model="editedItem.phone"
                      label="Phone Number"
                    ></v-text-field>
                  </v-col>
                  <v-row no-gutters justify="center" align="center">
                    <v-col cols="12">
                      <v-file-input show-size label="Image input" @change="selectFile"></v-file-input>
                    </v-col>
                  </v-row>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
              <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete"
                >Cancel</v-btn
              >
              <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                >OK</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small color= "blue" class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small color= "red" @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
   
  </v-data-table>
</template>
<script>
import axios from "axios";
export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    deleteById: null,
    search: "",
   
    currentFile: undefined,
    progress: 0,
    headers: [
      { text: "First Name", value: "first_name" },
      { text: "Last Name", value: "last_name" },
      { text: "Gender", value: "gender" },
      { text: "Class", value: "class" },
      { text: "Phone Number", value: "phone" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    students: [],
    editedIndex: -1,
    editedItem: {
      id: null,
      first_name: "",
      last_name: "",
      gender: "",
      class: "",
      picture: "",
      phone: null,
    },
    defaultItem: {
      id: '',
      first_name: "",
      last_name: "",
      gender: "",
      class: "",
      picture: "",
      phone: null,
    },
    
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Create Student" : "Edit Student";
    },
  },
  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      axios.get("http://localhost:8000/api/students").then((response) => {
        this.students = response.data;
      });
    },
    editItem(item) {
      this.editedIndex = item.id
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
      console.log(item.id)
    },

    deleteItem(item) {
      this.editedIndex = item.id;
      this.dialogDelete = true;
      console.log(item.id)
    },
    deleteItemConfirm() {  
      axios.delete("http://localhost:8000/api/students/" +this.editedIndex )
           .then(()=> {
              this.initialize();
           })
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    selectFile(file) {
      this.progress = 0;
      this.picture = file;
      console.log(this.picture)
    },
    save() {
      if (this.editedIndex > -1) {
        // Object.assign(this.desserts[this.editedIndex], this.editedItem);
        console.log("edit data")
        
        axios.put("http://localhost:8000/api/students/" + this.editedItem.id,{first_name: this.editedItem.first_name,last_name: this.editedItem.last_name,gender: this.editedItem.gender, class: this.editedItem.class, phone: this.editedItem.phone})
        .then(response =>{
          console.log(response)
        })
      } else {
        // this.students.push(this.editedItem);
        console.log(this.students);
        axios.post("/http://localhost:8000/api/students", this.editedItem).then((response) => {
          this.students.push(response.data);
          console.log(this.editedItem)
          
        });
      }
      this.close();
    },
  },
};
</script>