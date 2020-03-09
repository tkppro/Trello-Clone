<template>
<v-container class="my-5">
    <v-row wrap>
        <div v-if="!isExist">Nothing here!</div>
        <!-- <draggable v-model="getTasks" group="getTasks" style="min-height: 15px" ghost-class="ghost"> -->
        <v-col cols="12" sm="6" md="4" lg="3" v-for="task in getTasks" :key="task.id">
            <Task :task="task" />
        </v-col>
        <TaskCreate/>
        <!-- </draggable> -->
    </v-row>
</v-container>
</template>

<script>
import Task from './Task'
import draggable from "vuedraggable";
import TaskCreate from '../components/TaskCreate'
export default {
    data() {
        return {
            id: this.$route.params.id,
            isExist: true,
        }
    },
    components: {
        Task,
        draggable,
        TaskCreate
    },
    created() {
        this.$store.dispatch('retrieveTasks', this.id)
    },
    computed: {
        getTasks() {
            return this.$store.getters.getTasks
        },
        isExists() {
            if (this.getTasks.length > 0) {
                this.isExist = true
            } else {
                this.isExist = false
            }
        }
    },
    methods: {
        addTask() {

        }
    }
}
</script>

<style>
.task-name {
    background-color: aquamarine;
}

.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
</style>
