const state = {
    sheets: []
}

const mutations = {
    setSheet(state, payload) {
        state.sheets.push({
            title: payload.title,
            body: payload.body,
            deadline: payload.deadline,
            status: payload.status,
            user_id: payload.user_id
        })
    },

}

const actions = {
    addSheet(context, payload) {
        axios.post('/api/sheets', payload)
        context.commit('setSheet', payload)
    },

}

const getters = {}


export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}



