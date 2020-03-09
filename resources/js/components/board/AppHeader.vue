<template>
<nav class="navbar navbar-light bg-faded">
    <router-link to="/" class="navbar-brand">
        <label>Board</label>
    </router-link>
    <div class="d-flex justify-content-end" v-if="!isLoading">
        <TaskListRestore />
        <TaskListEdit />
        <TaskBoardEdit />
        <TaskListArchive />
    </div>
</nav>
</template>

<script>
import TaskListRestore from './TaskListRestore'
import TaskListEdit from './TaskListEdit'
import TaskBoardEdit from './TaskBoardEdit'
import TaskListArchive from './TaskListArchive'

export default {
    components: {
        TaskListRestore,
        TaskListEdit,
        TaskBoardEdit,
        TaskListArchive,
    },
    data() {
        return {
            isLoading: true
        }
    }
}
</script>

<style>

</style>
