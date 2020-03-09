<template>
<div>
    <v-card text class="text-center ma-3">
        <v-card-title class="task-name">
            <span v-if="!editing" @dblclick="editTask" class="title">{{ name }}</span>
            <v-text-field v-else v-model="name" @blur="doneEdit"
             @keyup.enter="doneEdit" @keyup.esc="cancelEdit" v-focus label="Name" :placeholder="name" ></v-text-field>
            <v-spacer></v-spacer>

            <v-menu bottom left>
                <template v-slot:activator="{ on }">
                    <v-btn dark icon v-on="on">
                        <v-icon color="black">mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item @click="editing = !editing">
                        <v-list-item-title>Edit</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="deleteTask(task.id)">
                        <v-list-item-title>Delete</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="archiveTask">
                        <v-list-item-title>Archive</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>

        </v-card-title>
        <!-- Card display -->
        <draggable v-model="task.cards" group="task.cards" style="min-height: 15px" ghost-class="ghost">
            <v-expansion-panels accordion v-for="card in task.cards" :key="card.id">
                <Card :card="card" />
            </v-expansion-panels>
        </draggable>
        
    </v-card>
    <CardCreate :taskId="task.id"/>
    </div>
</template>

<script>
import Card from './Card'
import draggable from "vuedraggable";
import CardCreate from "../components/CardCreate";

export default {
    props: {
        task: {
            type: Object,
            required: true,
        }
    },
    components: {
        Card,
        draggable,
        CardCreate,
    },
    data() {
        return {
            'id': this.task.id,
            'name': this.task.name,
            'beforeEditCache': '',
            'editing': false
        }
    },
    directives: {
        focus: {
            inserted: function (el) {
                el.focus()
            }
        }
    },
    methods: {
        editTask() {
            this.beforeEditCache = this.name
            this.editing = true
        },
        doneEdit() {
            if (this.name.trim() == '') {
                this.name = this.beforeEditCache
            }
            this.editing = false
            this.$store.dispatch('updateTask', {
                'id': this.id,
                'name': this.name,
            })
        },
        cancelEdit() {
            this.name = this.beforeEditCache
            this.editing = false
        },
        deleteTask(id) {
            this.$store.dispatch('deleteTask', id)
        },
        archiveTask() {

        }
    }
}
</script>

<style>

</style>
