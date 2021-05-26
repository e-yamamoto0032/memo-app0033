import moment from "moment";

function getDefaultState() {
    return {
        sheets: []

    }
}

const state = getDefaultState()

const mutations = {
    setSheet(state, payload) {
        state.sheets.push({
            id: payload.id,
            title: payload.title,
            body: payload.body,
            deadline: moment(payload.deadline).format("YYYY年MM月DD日"),
            end_date: moment(payload.end_date).format("YYYY年MM月DD日"),
            status: payload.status,
            user_id: payload.user_id
        })
    },
    clearAuthData(state) {
        Object.assign(state, getDefaultState())
    }

}

const actions = {
    dbSheet(context, payload) {
        context.commit('setSheet', payload)
    },
    resetSheet(context) {
        context.commit('clearAuthData')
    }
}

const getters = {
    getSheet: state => state.sheets
}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}



