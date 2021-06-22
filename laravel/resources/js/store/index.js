import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import sheet from './sheet'
import error from './error'
import task from './task'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        sheet,
        error,
        task,
    }
})



export default store
