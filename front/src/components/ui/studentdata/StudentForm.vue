<template>
<div class="text">
    <v-dialog v-model="dialog" max-width="500px">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="orange lighten-1" class="black--text" dark v-bind="attrs" v-on="on">
                +Student
            </v-btn>
        </template>
        <v-card>
            <v-card-title class="text-h5 orange lighten-1 ">
                Create Student
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field :error-messages="firstNameErrors" label="Firstname" type="text" prepend-icon="mdi-account" v-model="first_name" required @input="$v.first_name.$touch()" @blur="$v.first_name.$touch()">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field :error-messages="lastNameErrors" label="Lastname" type="text" prepend-icon="mdi-account" v-model="last_name" required @input="$v.last_name.$touch()" @blur="$v.last_name.$touch()">
                            </v-text-field>
                        </v-col>
                        <v-col class="d-flex" cols="12" sm="6">
                            <v-select :error-messages="genderErrors" :items="genders" v-model="gender" label="Gender" prepend-icon="mdi-gender-transgender" required @input="$v.gender.$touch()" @blur="$v.gender.$touch()"></v-select>
                        </v-col>
                        <v-col class="d-flex" cols="12" sm="6">
                            <v-select :error-messages="classErrors" :items="class_name" v-model="classes" label="Class" prepend-icon="mdi-school" required @input="$v.classes.$touch()" @blur="$v.classes.$touch()"></v-select>
                        </v-col>

                        <v-col cols="12" sm="12">
                            <v-text-field :error-messages="phoneErrors" label="Phone" type="number" prepend-icon="mdi-cellphone" v-model="phone" required @input="$v.phone.$touch()" @blur="$v.phone.$touch()">
                            </v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12">
                            <input type="file" label="Profile" @change="onFileSelected" />
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions class="black lighten-1">
                <v-spacer></v-spacer>
                <v-btn color="red darken-1" text @click="dialog = false">
                    Cancel
                </v-btn>
                <v-btn color="blue darken-1" text @click="createStudent">
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</div>
</template>

<script>
import {
    validationMixin
} from "vuelidate";
import {
    required,
    maxLength
} from "vuelidate/lib/validators";
export default {
    emits: ["addStudent"],
    mixins: [validationMixin],
    validations: {
        first_name: {
            required,
            maxLength: maxLength(10)
        },
        last_name: {
            required,
            maxLength: maxLength(10)
        },
        phone: {
            required,
            maxLength: maxLength(10)
        },
        gender: {
            required
        },
        classes: {
            required
        },
        image: {
            required
        },

        checkbox: {
            checked(val) {
                return val;
            },
        },
    },
    data() {
        return {
            checkbox: false,
            dialog: false,
            class_name: ["SNA", "WEB-A", "WEB-B"],
            genders: ["Male", "Female"],
            first_name: "",
            last_name: "",
            phone: "",
            classes: "",
            picture: "",
            gender: "",
        };
    },
    computed: {
        checkboxErrors() {
            const errors = [];
            if (!this.$v.checkbox.$dirty) return errors;
            !this.$v.checkbox.checked && errors.push("You must agree to continue!");
            return errors;
        },
        firstNameErrors() {
            const errors = [];
            if (!this.$v.first_name.$dirty) return errors;
            !this.$v.first_name.maxLength &&
                errors.push("First must be at most 10 characters long");
            !this.$v.first_name.required && errors.push("First Name is required.");
            return errors;
        },
        lastNameErrors() {
            const errors = [];
            if (!this.$v.last_name.$dirty) return errors;
            !this.$v.last_name.maxLength &&
                errors.push("Last must be at most 10 characters long");
            !this.$v.last_name.required && errors.push("Last  Name is required.");
            return errors;
        },
        genderErrors() {
            const errors = [];
            if (!this.$v.gender.$dirty) return errors;
            !this.$v.gender.required && errors.push("Gender is required");
            return errors;
        },
        classErrors() {
            const errors = [];
            if (!this.$v.classes.$dirty) return errors;
            !this.$v.classes.required && errors.push("Class is required");
            return errors;
        },
        phoneErrors() {
            const errors = [];
            if (!this.$v.phone.$dirty) return errors;
            !this.$v.phone.maxLength &&
                errors.push("Phone must be at most 10 characters long");
            !this.$v.phone.required && errors.push("Phone is required.");
            return errors;
        },
        imageErrors() {
            const errors = [];
            if (!this.$v.picture.$dirty) return errors;
            !this.$v.picture.required && errors.push("Image is required");
            return errors;
        },
    },
    methods: {
        onFileSelected(event) {
            this.picture = event.target.files[0];
        },
        createStudent() {
            if (this.first_name !== "") {
                this.dialog = false;
                let newStudent = new FormData();
                newStudent.append("first_name", this.first_name);
                newStudent.append("last_name", this.last_name);
                newStudent.append("gender", this.gender);
                newStudent.append("class", this.classes);
                newStudent.append("phone", this.phone);
                newStudent.append("picture", this.picture);
                this.$emit("addStudent", newStudent);
            }
        },
        submit() {
            this.$v.$touch()
        },
        clear() {
            this.$v.$reset()
            this.first_name = ''
            this.last_name = ''
            this.classes = null
            this.gender = null
            this.phone = null
            this.picture = null
            this.checkbox = false
        },
    },

};
</script>
