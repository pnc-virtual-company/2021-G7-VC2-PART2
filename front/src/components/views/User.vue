<template>
  <section>
    <user-form @addUserAccount="addUserAccount" class="create"></user-form>
    <user-card
      :dataUser="users"
      @deleteUser="deleteUser"
      @search-user="searchUser"
    ></user-card>
  </section>
</template>

<script>
import UsertForm from "../ui/userdata/UserForm.vue";
import UserCard from "../ui/userdata/UserCard.vue";
import axios from "../../api/api.js";

export default {
  name: "App",
  components: {
    "user-card": UserCard,
    "user-form": UsertForm,
  },
  data() {
    return {
      users: [],
    };
  },
  methods: {
    //____________ get students list_______________
    userList() {
      axios.get("/users").then((response) => {
        this.users = response.data;
      });
    },

    // __________Add new student into list_____________
    addUserAccount(newUserAccount) {
      axios.post("/createUser", newUserAccount).then((response) => {
        this.userList();
        console.log(response.data);
      });
    },
  
    //_____________ search student _________________
    searchUser(search) {
      if (search !== "") {
        axios.get("/users" + "/search/" + search).then((response) => {
          this.users = response.data;
        });
      } else {
        this.userList();
      }
    },
  },
   mounted() {
    this.userList();
  },
};
</script>

<style>
.create {
  margin-left: 86%;
  margin-top: 5%;
}
</style>