<template>
<div class="col-3 list-column list-width">
    <div class="heading" :style="{backgroundColor: list.headerColor }">
        <h4 class="heading-text text-center">{{ list.name }}</h4>
        <TaskListActions :board="board" :list="list" />
    </div>
    <div class="cards cards-list">
        <draggable v-model="items" v-bind="dragOptions">
            <TaskListItem v-for="item in items" :item="item" 
            :list="list" :board="board" 
            :key="item.id" 
            @item-editted="itemEdited" 
            @item-cancelled="itemCancelled" 
            @item-editing="itemEditing"></TaskListItem>
        </draggable>
        <TaskListItem class="fixed-card" :item="defaultItem" 
        :list="list" :board="board" 
        @item-editted="itemEdited" 
        @item-cancelled="itemCancelled"
         @item-editing="itemEditing"></TaskListItem> </div> </div>
</template>

<script>
import TaskListItem from './TaskListItem'
import TaskListActions from './TaskListActions'

export default {
    components: {
        TaskListItem,
        TaskListActions
    },
    computed: {
        dragOptions() {
            return {
                animation: "200",
                ghostClass: "ghost",
                group: "task-list-items"
            }
        },
        items: {
            get() {
                return this.list.items
            },
            set(value){
                this.list.items=value
            }
        }
    },
}
</script>

<style>

</style>
