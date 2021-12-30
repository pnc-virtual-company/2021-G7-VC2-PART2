<template>
  <v-container>
    <template>
      <v-card>
        <v-simple-table> </v-simple-table>
        <div class="permission">
          <v-card-title>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
              @keyup="searchPermission"
            ></v-text-field>
          </v-card-title>
          <v-card
            color="grey lighten-4"
            class="mx-auto card"
            max-width="900"
            v-for="(permission, index) in datapermission"
            :key="index"
          >
            <v-row>
              <v-col cols="12" sm="2" class="logo">
                <v-icon black size="60px"> mdi-link-variant </v-icon>
              </v-col>
              <v-divider vertical class="ma-3" color="white"></v-divider>
              <v-col cols="12" sm="2">
                <v-avatar class="ma-3" size="120" tile>
                  <v-img
                    src="https://pm1.narvii.com/7068/371b63bb840d96f6ac4eeb4575ba7db59bb78c8fr1-736-749v2_hq.jpg"
                  ></v-img>
                </v-avatar>
              </v-col>
              <v-col cols="12" sm="3" class="text-center data">
                <h3>{{ permission.student_name }}</h3>
                <span>WEB-A</span>
              </v-col>
              <v-col cols="12" sm="3" class="date">
                <v-chip class="ma-2" color="orange lighten-1">
                  start date: {{ permission.start_date }} </v-chip
                ><br />
                <v-chip class="ma-2" color="orange lighten-1">
                  end date: {{ permission.end_date }}
                </v-chip>
              </v-col>
              <v-col cols="12" sm="2">
                <div class="i_con">
                  <v-icon color="blue darken-1" text size="40px">
                    mdi-lead-pencil</v-icon
                  >
                  <v-icon
                    color="red darken-1"
                    text
                    size="40px"
                    @click="getPermissionId(permission.id)"
                    >mdi-delete</v-icon
                  >
                </div>
              </v-col>
            </v-row>
          </v-card>
        </div>
      </v-card>
    </template>
    <div class="text-center">
      <v-dialog v-model="dialog" width="500" height="700">
        <v-card>
          <v-card-title class="text-h5 blue lighten-2">
            Delete student
          </v-card-title>
          <h3 class="ma">Do you want to delete this student</h3>
          <v-divider></v-divider>

          <v-card-actions class="blue lighten-2">
            <v-spacer></v-spacer>
            <v-btn
              @click="dialog = false"
              class="green darken-4 white--text"
              text
            >
              Cancel
            </v-btn>
            <v-btn class="red white--text" text @click="deletePermission">
              Ok
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </v-container>
</template>
<script>
export default {
  props: ["datapermission"],
  emits: ["deletePermission", "search-permission"],
  data() {
    return {
      search: "",
      permissionId: 0,
      // deleteId:0,
      dialog: false,
    };
  },
  methods: {
    // getPermissionId(id) {
    //   console.log(id)
    //   this.permissionId = id;
    //   this.$emit("deletePermission", this.permissionId);
    // },

    getPermissionId(id) {
      this.dialog = true;
      this.permissionId = id;
    },

    deletePermission() {
      this.$emit("deletePermission", this.permissionId);
      this.dialog = false;
    },

    searchPermission() {
      this.$emit("search-permission", this.search);
    },
  },
};
</script>
<style scoped>
.date {
  margin-top: 2%;
}
.data {
  margin-top: 5%;
  margin-left: -3%;
}
.i_con {
  margin-top: 35%;
}
.logo {
  margin-top: 4%;
}
.card {
  margin-top: 2%;
  text-align: center;
}
</style>