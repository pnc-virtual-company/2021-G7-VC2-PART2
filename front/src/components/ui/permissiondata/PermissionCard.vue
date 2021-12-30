<template>
  <v-container>
    <template>
      <v-simple-table> </v-simple-table>
      <div class="permission">
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
                <v-img :src="url + permission.students.picture"></v-img>
              </v-avatar>
            </v-col>
            <v-col cols="12" sm="3" class="text-center data">
              <h3>
                {{ permission.students.first_name }}
                {{ permission.students.last_name }}
              </h3>
              <span>WEB-A</span><br />
              <span class="num">5 days</span>
            </v-col>
            <v-col cols="12" sm="3" class="date">
              <v-chip class="ma-2" color="yellow darken-4">
                Start date: {{ permission.start_date }} </v-chip
              ><br />
              <v-chip class="ma-2" color="yellow darken-4">
                End date: {{ permission.end_date }}
              </v-chip>
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
                >
              </div>
            </v-col>
          </v-row>
        </v-card>
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
            <div class="text-h5 pa-5">Do you want to delete this permission?</div>
          </v-card-text>
          <hr />
          <v-card-actions class="justify-end">
            <v-spacer></v-spacer>
            <v-btn @click="dialog = false" class="blue white--text" text>
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
  emits: ["search-permission"],
  data() {
    return {
      search: "",
      permissionId: 0,
      dialog: false,
      url: "http://127.0.0.1:8000/storage/images/",
    };
  },
  methods: {
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
</style>
