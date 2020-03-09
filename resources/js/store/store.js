import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
        name: localStorage.getItem('name') || '',
        boards: [],
        tasks: [],
        isTaskAdded: false,
    },
    getters: {
        loggedIn(state) {
            return state.token != null
        },
        name(state) {
            return state.name
        },
        getBoards(state) {
            return state.boards
        },
        getTasks(state) {
            return state.tasks
        },
        getIsTaskAdded(state) {
            return state.isTaskAdded
        }
    },
    mutations: {
        retrieveToken(state, token) {
            state.token = token
        },
        destroyToken(state) {
            state.token = null
        },
        retrieveName(state, name) {
            state.name = name
        },
        destroyName(state) {
            state.name = ''
        },
        retrieveBoards(state, boards) {
            state.boards = boards
        },
        addBoard(state, board) {
            state.boards.push({
                'id': board.id,
                'name': board.name,
                'background': board.background,
                'user_id': board.user_id,
                'created_at': board.created_at,
                'updated_at': board.updated_at,
            })
        },
        retrieveTasks(state, tasks) {
            state.tasks = tasks
        },
        updateTask(state, task) {
            const index = state.tasks.findIndex(item => item.id == task.id)
            state.tasks[index].name = task.name
                // state.tasks.splice(index, 1, {
                //     'id': task.id,
                //     'name': task.name,
                //     'order': task.order,
                //     'board_id': task.board_id,
                //     'archived': task.archived,
                //     'created_at': task.created_at,
                //     'updated_at': task.updated_at,
                //     'cards': task.cards,
                // })

        },
        addTask(state, task) {
            state.tasks.push({
                'id': task.id,
                'name': task.name,
                'order': task.order,
                'board_id': task.board_id,
                'archived': task.archived,
                'created_at': task.created_at,
                'updated_at': task.updated_at,
                'cards': [],
            })
        },
        taskAdded(state, taskAdded) {
            state.isTaskAdded = taskAdded
        },
        deleteTask(state, id) {
            const index = state.tasks.findIndex(item => item.id == id)
            if (index >= 0)
                state.tasks.splice(index, 1)
        },
        // card mutations
        addCard(state, data) {
            const index = state.tasks.findIndex(item => item.id == data.taskId)

            state.tasks[index].cards.push({
                'id': data.card.id,
                'title': data.card.title,
                'description': data.card.description,
                'order': data.card.order,
                'task_id': data.card.task_id,
                'archived': data.card.archived,
                'created_at': data.card.created_at,
                'updated_at': data.card.updated_at,
            })
        },

    },
    actions: {
        register(context, data) {
            return new Promise((resolve, reject) => {
                axios.post('/register', {
                        name: data.name,
                        email: data.email,
                        password: data.password,
                        password_confirmation: data.password_confirmation
                    })
                    .then(response => {
                        resolve(response)
                    })
                    .catch(error => {
                        reject(error)
                    })
            })
        },
        destroyToken(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

            if (context.getters.loggedIn) {
                return new Promise((resolve, reject) => {
                    axios.post('/logout')
                        .then(response => {
                            const token = response.data.access_token
                            localStorage.removeItem('access_token')
                            localStorage.removeItem('name')
                            context.commit('destroyToken')
                            context.commit('destroyName')
                            resolve(response)
                        })
                        .catch(error => {
                            localStorage.removeItem('access_token')
                            localStorage.removeItem('name')
                            context.commit('destroyToken')
                            context.commit('destroyName')
                            reject(error)
                        })
                })
            }
        },
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('/login', {
                        email: credentials.email,
                        password: credentials.password,
                    })
                    .then(response => {
                        const token = response.data.access_token
                        localStorage.setItem('access_token', token)
                        context.commit('retrieveToken', token)
                            // retrieve user name
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
                        axios.get('/user')
                            .then(response => {
                                const name = response.data.name
                                context.commit('retrieveName', name)
                                localStorage.setItem('name', name)
                            })
                            .catch(error => {

                            })

                        resolve(response)
                    })
                    .catch(error => {

                        reject(error)
                    })
            })
        },
        retrieveBoards(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
                // context.commit('updateLoading', true)

            axios.get('/boards')
                .then(response => {
                    context.commit('retrieveBoards', response.data)
                        //context.commit('updateLoading', false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        addBoard(context, board) {
            axios.post('/boards', {
                    name: board.name,
                })
                .then(response => {
                    context.commit('addBoard', response.data.data)
                        //context.commit('updateLoading', false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        retrieveTasks(context, id) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
                // context.commit('updateLoading', true)

            axios.get('/boards/' + id)
                .then(response => {
                    console.log(response.data)
                    context.commit('retrieveTasks', response.data.tasks)
                        //context.commit('updateLoading', false)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        addTask(context, task) {
            axios.post('/tasks', {
                    name: task.name,
                    order: task.order,
                    board_id: task.boardId,
                })
                .then(response => {
                    context.commit('addTask', response.data.data)
                    context.commit('taskAdded', true)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        updateTask(context, task) {
            axios.patch('/tasks/' + task.id, {
                    name: task.name,
                })
                .then(response => {
                    context.commit('updateTask', response.data.data)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        deleteTask(context, id) {
            axios.delete('/tasks/' + id)
                .then(response => {
                    context.commit('deleteTask', id)
                })
                .catch(error => {
                    console.log(error)
                })
        },
        // card actions
        addCard(context, card) {
            axios.post('/cards', {
                    title: card.title,
                    description: card.description,
                    task_id: card.taskId,
                    order: card.order,
                })
                .then(response => {
                    context.commit('addCard', {
                        card: response.data.data,
                        taskId: card.taskId
                    })
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },

})