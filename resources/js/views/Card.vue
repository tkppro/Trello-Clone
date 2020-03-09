<template>
    <v-expansion-panel>
        <v-expansion-panel-header>
            {{ title }}
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
            <div>{{ description }}</div>
        </v-expansion-panel-content>
        
    </v-expansion-panel>
</template>

<script>

export default {
    props: {
        card: {
            type: Object,
            required: true,
        }
    },
    components: {
        
    },
    data() {
        return {
            'id': this.card.id,
            'title': this.card.title,
            'createdAt': this.card.created_at,
            'description': this.card.description,
            'editing': false,
        }
    },
    methods: {
        deleteCard() {

        },
        archiveCard() {

        }
    }
}
</script>

<style>

</style>
