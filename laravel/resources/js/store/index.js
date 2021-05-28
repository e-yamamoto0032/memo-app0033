import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import sheet from './sheet'
import error from './error'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        sheet,
        error
    }
})



export default store
