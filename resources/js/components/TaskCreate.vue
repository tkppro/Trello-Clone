<template>
    <v-dialog width="500" v-model="dialog">
        <template v-slot:activator="{ on }">
            <div style="height: 100px; position: absolute; top: 70%; right: 10%;">
                <v-fab-transition>
                    <v-btn v-on="on" color="pink" dark absolute top right fab>
                        <v-icon>mdi-plus</v-icon>
                    </v-btn>
                </v-fab-transition>
            </div>
        </template>
        <v-card>
            <v-card-title class="headline grey lighten-2" primary-title>
                Add a New Task
            </v-card-title>
            <v-card-text>
                <v-form class="px-3" ref="form">
                    <v-text-field @keydown.enter.prevent="submit" label="Name" v-model="name" prepend-icon="mdi-folder" :rules="inputRules"></v-text-field>
                    <v-btn :loading="isLoading" class="success mx-0 mt-3" @click="submit">Add task</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
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
        submit(e) {
            if (this.$refs.form.validate()) {
                this.isLoading = true;
                const task = {
                    name: this.name,
                    boardId: this.$route.params.id,
                    order: 1
                }

                this.$store.dispatch('addTask', task)
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
}
</script>
