<template>
  <v-container>
    <template>
      <v-card>
        <v-card-title>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
            @keyup="searchUsername"
          ></v-text-field>
         
        </v-card-title>
        <v-simple-table>
          <template v-slot:default>
            <thead class="blue lighten-3">
              <tr>
                
                <th>User Account</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="lighten-4">
              <tr
                class=""
                v-for="(user, index) in dataUser"
                :key="index"
              >
                <td>{{ user.userName }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
                <td>
                  <div class="i-con">
                    <v-icon color="blue darken-1" text>mdi-lead-pencil</v-icon>
                    <v-icon
                      color="red darken-1"
                      @click="getUserId(user.id)"
                      >mdi-delete</v-icon
                    >
                  </div>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-card>
    </template>
  </v-container>
</template>
<script>

export default {
  props: ["dataUser"],
  emits: ["deleteUser", "search-user"],
  
  data() {
    return {
      search: "",
      userId: 0,
      deleteId: 0,
    };
  },
  methods: {
    // ____________get student id_____________
    getUserId(id) {
      this.deleteId = id;
      this.$emit("deleteUser", this.deleteId);
    },

    searchUsername() {
      this.$emit("search-user", this.search);
    },
  },
};
</script>
<style scoped>
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