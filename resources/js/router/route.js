import Vue from 'vue'
import VueRouter from 'vue-router'
import Dashboard from '../views/Dashboard.vue'
import { store } from '../store/store'
import Team from '../views/Team.vue'
import Table from '../views/Table.vue'
import Login from '../components/auth/Login'
import Logout from '../components/auth/Logout'
import Register from '../components/auth/Register'
import Board from '../views/Board'
Vue.use(VueRouter)

const routes = [{
        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/projects',
        name: 'projects',
        meta: {
            requiresAuth: true,
        },
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import ( /* webpackChunkName: "about" */ '../views/Project.vue')
    },
    {
        path: '/team',
        name: 'team',
        component: Team,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/table',
        name: 'table',
        component: Table,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/board/:id',
        name: 'board',
        component: Board,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        props: true,
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: '/logout',
        name: 'logout',
        component: Logout
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            requiresVisitor: true
        }
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters.loggedIn) {
            next({
                name: 'dashboard',
            }, { name: 'project' }, { name: 'team' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router