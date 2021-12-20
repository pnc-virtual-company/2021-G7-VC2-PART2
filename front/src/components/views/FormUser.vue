<template>
  <v-data-table
    hide-default-footer
    class="elevation-1"
    :headers="headers"
    :items="desserts"
  >
    <template v-slot:top>
      <v-toolbar>
        <v-toolbar-title>User list</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              New Item
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedItem.name"
                      label="USERNAME"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedItem.email"
                      label="EMAIL"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      v-model="editedItem.role"
                      label="ROLE"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <!-- Edit -->
            <v-card-actions>
              <v-spacer></v-spacer>
              <!--  text @click="close" -->
              <v-btn color="blue darken-1"> Cancel </v-btn>
              <!--  text @click="save" -->
              <v-btn color="blue darken-1"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <!-- Delete -->
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
          <!--  text @click="closeDelete" -->
            <v-card-title class="text-h5"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1"
                >Cancel</v-btn
              >
              <!--  text @click="deleteItemConfirm" -->
              <v-btn color="blue darken-1"
                >OK</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
  </v-data-table>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "USERNAME",
        align: "start",
        sortable: false,
        value: "name",
      },
      { text: "EMAIL", value: "email" },
      { text: "ROLES", value: "role" },
      { text: "ACTIONS", value: "actions", sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      email: "",
      role: "",
    },
    defaultItem: {
      name: "",
      email: "",
      role: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.desserts = [
        {
          name: "Som Chhorn",
          email: "som@gmail.com",
          role: "Student",
        },
        {
          name: "Som Chhorn",
          email: "som@gmail.com",
          role: "Student",
        },
        {
          name: "Som Chhorn",
          email: "som@gmail.com",
          role: "Student",
        },
        {
          name: "Som Chhorn",
          email: "som@gmail.com",
          role: "Student",
        },
        {
          name: "Som Chhorn",
          email: "som@gmail.com",
          role: "Student",
        },
        {
          name: "Som Chhorn",
          email: "som@gmail.com",
          role: "Student",
        },
      ];
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.desserts.splice(this.editedIndex, 1);
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

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    },
  },
};
</script>
