<template>
<div>
     <v-dialog v-model="dialog" max-width="500px">
    <v-card>
        <v-card-title  class="orange lighten-1 text-h5">
            Update Student
        </v-card-title>
        <v-card-text >
            <v-container>
                <v-row>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field label="Firstname" type="text" prepend-icon="mdi-account" v-model="first_name">
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                        <v-text-field label="Lastname" type="text" prepend-icon="mdi-account" v-model="last_name">
                        </v-text-field>
                    </v-col>
                    <v-col class="d-flex" cols="12" sm="6">
                        <v-select :items="genders" v-model="gender" label="Gender" prepend-icon="mdi-gender-transgender"></v-select>
                    </v-col>
                    <v-col class="d-flex" cols="12" sm="6">
                        <v-select :items="class_name" v-model="classes" label="Class" prepend-icon="mdi-school"></v-select>
                    </v-col>

                    <v-col cols="12" sm="12">
                        <v-text-field label="Phone" type="number" prepend-icon="mdi-cellphone" v-model="phone">
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions class="black lighten-1">
            <v-spacer></v-spacer>
            <v-btn @click="cancel" color="red darken-1" text> Cancel </v-btn>
            <v-btn @click="Update" color="blue darken-1" text> Update </v-btn>
        </v-card-actions>
    </v-card>
    </v-dialog>
</div>
</template>

<script>
export default {
    props: ["studentInfo"],
    emits: ["update", "cancel"],
    data() {
        return {
            dialog: true,
            first_name: "",
            last_name: "",
            phone: "",
            classes: "",
            gender: "",
            genders: ["Male", "Female"],
            class_name: ["SNA-2019", "WEB-A-2019", "WEB-B-2019","SNA-2020", "WEB-A-2020", "WEB-B-2020",
                        "SNA-2021", "WEB-A-2021", "WEB-B-2021","SNA-2022", "WEB-A-2022", "WEB-B-2022",
                        "SNA-2023", "WEB-A-2023", "WEB-B-2023","SNA-2024", "WEB-A-2024", "WEB-B-2024",
                        "SNA-2025", "WEB-A-2025", "WEB-B-2025","SNA-2026", "WEB-A-2026", "WEB-B-2026"],
        };
    },
    methods: {
        Update() {
            let student = {
                first_name: this.first_name,
                last_name: this.last_name,
                gender: this.gender,
                class: this.classes,
                phone: this.phone,

            };

            this.$emit("update", this.studentInfo.id, student, false);
        },
        cancel() {
            this.$emit('cancel', false);
        }
    },
    mounted() {
        this.first_name = this.studentInfo.first_name;
        this.last_name = this.studentInfo.last_name;
        this.gender = this.studentInfo.gender;
        this.classes = this.studentInfo.class;
        this.phone = this.studentInfo.phone;
    },
};
</script>

<style>
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
