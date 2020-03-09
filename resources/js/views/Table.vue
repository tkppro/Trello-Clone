<template>
    <v-container class="my-5">
        <v-row wrap>
            <div v-if="!isExist">Nothing here!</div>
            <v-col cols="12" sm="6" md="4" lg="3" v-for="board in getBoards" :key="board.id">
                <v-card text class="text-center ma-3">
                    <v-card-text>
                        <div class="title">{{ board.name }} </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn text color="grey" router :to="{ name: 'board', params: {id: board.id} }">
                            <v-icon small left>mdi-login-variant</v-icon>
                            <span>Access this board</span>
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import AppHeader from '../components/board/AppHeader'
import draggable from 'vuedraggable'
export default {
    data() {
        return {
            isExist: true,
        }
    },
    components: {
        AppHeader,
        draggable
    },
    created() {
        this.$store.dispatch('retrieveBoards')
    },
    computed: {
        getBoards() {
            return this.$store.getters.getBoards
        },
        isExists() {
            if (this.getBoards.length > 0) {
                this.isExist = true
            } else {
                this.isExist = false
            }
        }
    }
}
</script>

<style>

</style>
