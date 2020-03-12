<template>
    <v-expansion-panel>
        <v-expansion-panel-header>
            <span v-if="!editing" @dblclick="editCard" class="title">{{ title }}</span>
            <v-text-field v-else v-model="title"
             @keyup.enter="doneEdit" @keyup.esc="cancelEdit" v-focus label="Title" :placeholder="title" ></v-text-field>
            <v-menu bottom left>
                <template v-slot:activator="{ on }">
                    <v-btn dark icon v-on="on" class="justify-end">
                        <v-icon color="black">mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item @click="editing = !editing">
                        <v-list-item-title>Edit</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="deleteCard(card.id)">
                        <v-list-item-title>Delete</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="archiveCard">
                        <v-list-item-title>Archive</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-expansion-panel-header>
        <v-expansion-panel-content class="grey--text">
            <div class="font-weight-bold">due by {{ createdAt }}</div>
            <div v-if="!editing" @dblclick="editCard">{{ description }}</div>
            <v-text-field v-else v-model="description" 
             @keyup.enter="doneEdit" @keyup.esc="cancelEdit" v-focus label="Description" :placeholder="description" ></v-text-field>
            
        </v-expansion-panel-content>
        
    </v-expansion-panel>
</template>

<script>

export default {
    props: {
        card: {
            type: Object,
            required: true,
        },
        taskId: {
            type: Number,
            required: true,
        }
    },
    components: {
        
    },
    directives: {
        focus: {
            inserted: function (el) {
                el.focus()
            }
        }
    },
    data() {
        return {
            'id': this.card.id,
            'title': this.card.title,
            'createdAt': this.card.created_at,
            'description': this.card.description,
            'editing': false,
            'titleBeforeEdit': '',
            'descriptionBeforeEdit': '',
        }
    },
    methods: {
        editCard() {
            this.titleBeforeEdit = this.title
            this.descriptionBeforeEdit = this.description
            this.editing = true
        },
        doneEdit() {
            if (this.title.trim() == '') {
                this.title = this.titleBeforeEdit
            }
            this.editing = false
            this.$store.dispatch('updateCard', {
                'id': this.id,
                'title': this.title,
                'description': this.description,
                'order': 0,
                'task_id': this.taskId
            })
        },
        cancelEdit() {
            this.title = this.titleBeforeEdit
            this.description = this.descriptionBeforeEdit
            this.editing = false
        },
        deleteCard(id) {
            this.$store.dispatch('deleteCard', {
                'id': id,
                'taskId': this.taskId
            })
        },
        archiveCard() {

        }
    }
}
</script>

<style>

</style>
