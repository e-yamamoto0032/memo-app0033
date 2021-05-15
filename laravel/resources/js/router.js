import Vue from 'vue'
import VueRouter from 'vue-router'

import Main from './components/Main.vue'
import Board from './components/Board.vue'
import Login from './components/Login.vue'
import store from './store'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Main
    },

    {
        path: '/board/:username',
        name: 'board',
        component: Board
    },

    {
        path: '/login',
        component: Login,
        beforeEnter (to, from, next) {
            if (store.getters['auth/check']) {
                next('/')
            } else {
                next()
            }
        }
    },


]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
