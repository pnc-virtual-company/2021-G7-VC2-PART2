<template>
  <section>
    <discipline-form class="discipline_btn" @addDiscipline="addDiscipline"></discipline-form>
        <div class="search">
        <v-text-field outlined dense v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details placeholder="Search"></v-text-field>
    </div>
    <discipline-card 
    :datadiscipline="disciplinesToDisplay"
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
            disciplinesKeep: [],
            disciplinesToDisplay: [],
            search: "",
        };
    },
    methods: {
        disciplinedata() {
            axios.get("/discipline").then((response) => {
                this.disciplinesKeep = response.data;
                this.disciplinesToDisplay = this.disciplinesKeep;
            });
        },
        addDiscipline(newDiscipline) {
            axios.post("/discipline", newDiscipline).then(() => {
                this.disciplinedata();
            });
        },
        deleteDiscipline(disciplineId){
        axios.delete("/discipline/" + disciplineId).then((response)=>{
        console.log(response.data);
        this.disciplinedata();
      }) 
    },
    },
    
    watch: {
        search: function (newValue) {
            if(newValue === '') {
                this.disciplinesToDisplay = this.disciplinesKeep;
            } else {
                this.disciplinesToDisplay = this.disciplinesKeep.filter(discipline => 
                    discipline.students.first_name.toLowerCase().includes(newValue.toLowerCase()) ||
                    discipline.students.last_name.toLowerCase().includes(newValue.toLowerCase()) ||
                    discipline.students.class.toLowerCase().includes(newValue.toLowerCase())
                )
            }
        }
    },

    mounted() {
        this.disciplinedata();
    },
};
</script>

<style>
.discipline_btn {
    margin-left: 72.5%;
    margin-top: 5%;
    padding: 5px;
}
.search{
    width: 40%;
    margin-top: -46px;
    margin-left: 15vh;
}
</style>
