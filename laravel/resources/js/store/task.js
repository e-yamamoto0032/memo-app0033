function getDefaultState() {
    return {
        lists: [],
    }
}

const state = getDefaultState()

const mutations = {
    addlist(state, payload) {
        state.lists.push({
            title: payload.title,
            cards: [],
            order: payload.order,
            id: payload.id,
        })
    },
    removelist(state, payload) {
        state.lists.splice(payload.listIndex, 1)
    },
    addCardToList(state, payload) {
        state.lists[payload.listIndex].cards.push({body: payload.body})
    },
    removeCardFromList(state, payload) {
        state.lists[payload.listIndex].cards.splice(payload.cardIndex, 1)
    },
    updateList(state, payload) {
        state.lists = payload.lists
    },
    clearData(state) {
        Object.assign(state, getDefaultState())
    },

}

const actions = {
    async addlist(context, payload) {
        context.commit('addlist', payload)
        await axios.post('/api/tasks', payload)
    },
    async dblist(context, payload) {
        context.commit('addlist', payload)
    },
    removelist(context, payload) {
        context.commit('removelist', payload)
    },
    addCardToList(context, payload) {
        context.commit('addCardToList', payload)
    },
    removeCardFromList(context, payload) {
        context.commit('removeCardFromList', payload)
    },
    updateList(context, payload) {
        console.log(payload)
        context.commit('updateList', payload)
    },
    resetTask(context) {
        context.commit('clearData')
    },
}

const getters = {}
export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
}
