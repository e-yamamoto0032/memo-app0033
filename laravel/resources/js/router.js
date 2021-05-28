import Vue from 'vue'
import VueRouter from 'vue-router'

import Main from './components/Main.vue'
import Board from './components/Board.vue'
import Login from './components/Login.vue'
import store from './store'
import SystemError from './components/errors/System.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Main
    },

    {
        path: '/board',
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

    {
        path: '/500',
        component: SystemError
    },


]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router
