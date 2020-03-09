<template>
<div class="scrolling-wrapper">
    <draggable v-model="lists" v-bind="dragOptions" class="row flex-nowrap my-3">
        <TaskList v-for="(listItem, index) in lists" :key="index" :list="listItem">
        </TaskList>
    </draggable>
</div>
</template>

<script>
import TaskList from './TaskList'
import draggable from 'vuedraggable'

export default {
    components: {
        TaskList,
        draggable,
    },
    data() {
        return {
            board: []
        }
    },
    computed: {
        dragOptions() {
            return {
                animation: "200",
                ghostClass: "ghost",
                handle: ".heading",
                group: "task-board-lists"
            }
        },
        lists: {
            get() {
                return this.board.lists
            },
            set(value) {
                this.board.lists = value
            }
        }
    },
    created() {
        
    }
}
</script>

<style>

</style>
