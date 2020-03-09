<template>
<div class="text-center">
    <v-dialog width="500" v-model="dialog">
        <template v-slot:activator="{ on }">
            <v-btn class="success" dark v-on="on">Add New Board</v-btn>
        </template>
        <v-card>
            <v-card-title class="headline grey lighten-2" primary-title>
                Add a New Board
            </v-card-title>
            <v-card-text>
                <v-form class="px-3" ref="form">
                    <v-text-field label="Name" v-model="name" prepend-icon="mdi-folder" :rules="inputRules"></v-text-field>
                    <!-- <v-menu max-width="290">
                        <template v-slot:activator="{ on }">
                            <v-text-field :rules="inputRules" :value="formattedDate" label="Due date" prepend-icon="mdi-calendar-range" v-on="on"></v-text-field>
                        </template>
                        <v-date-picker v-model="due"></v-date-picker>
                    </v-menu> -->
                    <v-btn :loading="isLoading" class="success mx-0 mt-3" @click="submit">Add project</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</div>
</template>

<script>
import format from 'date-fns/format'
import parseISO from 'date-fns/parseISO'

export default {
    data() {
        return {
            name: '',
            due: null,
            inputRules: [
                v => v.length >= 5 || 'Minimum length is 5 characters'
            ],
            isLoading: false,
            dialog: false,
        }
    },
    methods: {
        submit() {
            if(this.$refs.form.validate()) {
                this.isLoading = true;
                const board = {
                    name: this.name,
                }

                this.$store.dispatch('addBoard', board)
                .then(() => {
                    this.isLoading = false;
                    this.dialog = false;
                    this.name = '';
                })
                .catch(error => {
                    this.isLoading = false;
                })
            }
            
        }
    },
    computed: {
        formattedDate() {
            return this.due ? format(parseISO(this.due), 'do MMM yyyy') : ''
        }
    }
}
</script>
