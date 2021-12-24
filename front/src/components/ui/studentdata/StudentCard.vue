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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody class="lighten-4">
              <tr
                class=""
                v-for="(student ,index) in dataUser"
                :key="index"
              >
                <td>{{ student.first_name }}</td>
                <td>{{ student.last_name }}</td>
                 <td>{{ student.gender }}</td>
                  <td>{{ student.class }}</td>
                <td>0{{ student.phone }}</td>
               
                <td>
                  <div class="i-con">
                    <v-icon color="blue darken-1" text>mdi-lead-pencil</v-icon>
                    <v-icon
                      color="red darken-1"
                      @click="getstudentId(student.id)"
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
  emits: ["deleteItem", "search-user", "updateStudent"],
 

  data() {
    return {
      search: "",
      studentId: 0,
    };
  },
  methods: {
    // ____________get student id_____________
    getstudentId(id) {
      this.deleteId = id;
      this.$emit("deleteItem", this.deleteId);
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