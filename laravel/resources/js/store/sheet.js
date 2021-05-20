import moment from "moment";

const state = {
    sheets: []
}

const mutations = {
    setSheet(state, payload) {
        state.sheets.push({
            title: payload.title,
            body: payload.body,
            deadline: moment(payload.deadline).format("YYYY年MM月DD日"),
            status: payload.status,
            user_id: payload.user_id
        })
    },

}

const actions = {
    addSheet(context, payload) {
        axios.post('/api/sheets', payload)
        context.commit('setSheet', payload)
        console.log(payload)
    },
    dbSheet(context,payload) {
        context.commit('setSheet', payload)
        console.log(payload)
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



