import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import sheet from './sheet'

Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        auth,
        sheet
    }
})



export default store
