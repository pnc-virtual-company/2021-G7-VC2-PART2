<template>
  <section>
    <user-form @addUserAccount="addUserAccount" class="user_btn"></user-form>
    <user-card
      :dataUser="users"
      @deleteUser="deleteUser"
      @search-user="searchUser"
      @update-user="userList"
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
    //___________ get students list______________
    userList() {
      axios.get("/users").then((response) => {
        this.users = response.data;
      });
    },

    // _________Add new student into list____________
    addUserAccount(newUserAccount) {
      axios.post("/createUser", newUserAccount).then(() => {
        this.userList();
      });
    },
  
    //____________ search student ________________
    searchUser(search) {
      if (search !== "") {
        axios.get("/users" + "/search/" + search).then((response) => {
          this.users = response.data;
        });
      } else {
        this.userList();
      }
    },
    deleteUser(userId){
      axios.delete("/users/" + userId).then(()=> {
        this.userList();
      })
    }
  },
  mounted() {
    this.userList();
  },
};
</script>

<style scoped>
.user_btn {
  margin-left: 89%;
  margin-top: 5%;
}
</style>