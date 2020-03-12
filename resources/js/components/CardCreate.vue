<template>
    <v-dialog width="500" v-model="dialog">
        <template v-slot:activator="{ on }">
            <div class="d-flex d-flex-centered">
                <v-fab-transition>
                    <v-btn v-on="on" color="blue" dark fab>
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </v-fab-transition>
            </div>
        </template>
        <v-card>
            <v-card-title class="headline grey lighten-2" primary-title>
                Add a New Card
            </v-card-title>
            <v-card-text>
                <v-form class="px-3" ref="form">
                    <v-text-field @keydown.enter.prevent="submit" label="Title" v-model="title" prepend-icon="mdi-folder" :rules="inputRules"></v-text-field>
                    <v-textarea @keydown.enter.prevent="submit" :rules="inputRules" label="Description" v-model="description" prepend-icon="mdi-pen"></v-textarea>
                    <v-btn :loading="isLoading" class="success mx-0 mt-3" @click="submit">Add Card</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import format from 'date-fns/format'
import parseISO from 'date-fns/parseISO'
 
export default {
    props: {
        taskId: {
            type: Number,
            required: true,
        }
    },
    data() {
        return {
            title: '',
            description: '',
            inputRules: [
                v => v.length >= 5 || 'Minimum length is 5 characters'
            ],
            isLoading: false,
            dialog: false,
        }
    },
    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                this.isLoading = true;
                const card = {
                    title: this.title,
                    description: this.description,
                    taskId: this.taskId,
                    order: 0
                }

                this.$store.dispatch('addCard', card)
                .then(() => {
                    this.isLoading = false;
                    this.dialog = false;
                    this.title = '';
                    this.description = '';
                })
                .catch(error => {
                    this.isLoading = false;
                })
            }

        }
    },
    computed: {
        
    }
}
</script>

<style lang="scss">
.d-flex-centered {
    justify-content: center;
}
</style>