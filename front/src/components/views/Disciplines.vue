<template>
  <section>
    <discipline-form
      class="permission_btn"
      @addDiscipline="addDiscipline"
    ></discipline-form>
    <discipline-card 
    :datadiscipline="disciplines"
     @deleteDiscipline = "deleteDiscipline"
     @update-discipline="disciplinedata"
    ></discipline-card>
    
  </section>
</template>

<script>
import DisciplineCard from "../ui/disciplinedata/DisciplineCard.vue";
import DisciplineForm from "../ui/disciplinedata/DisciplineForm.vue";
import axios from "../../api/api";
export default {
  name: "App",
  components: {
    "discipline-card": DisciplineCard,
    "discipline-form": DisciplineForm,
  },
  data() {
    return {
      disciplines: [],
    };
  },
  methods: {
    disciplinedata() {
      axios.get("/discipline").then((response) => {
        this.disciplines = response.data;
        console.log(response.data);
      });
    },
    addDiscipline(newDiscipline) {
      axios.post("/discipline", newDiscipline).then((response) => {
        this.disciplinedata();
        console.log(response.data);
      });
    },

    deleteDiscipline(disciplineId){
      axios.delete("/discipline/" + disciplineId).then((response)=>{
        console.log(response.data);
        this.disciplinedata();
      })
    }
    
  },
  mounted() {
      this.disciplinedata();
    },
};
</script>

<style>
.permission_btn {
  margin-left: 75%;
  margin-top: 5%;
}
</style>
