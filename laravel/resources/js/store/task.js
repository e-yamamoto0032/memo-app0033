import {OK, UNPROCESSABLE_ENTITY} from '../util'

function getDefaultState() {
    return {
        lists: [],
        apiStatus: null,
        taskErrorMessages: null,
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
            sheet_id: payload.sheet_id
        })
    },
    clearData(state) {
        Object.assign(state, getDefaultState())
    },
    setApiStatus(state, status) {
        state.apiStatus = status
    },
    setTaskErrorMessages(state, messages) {
        state.taskErrorMessages = messages
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

}

const actions = {
    async addlist(context, payload) {
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/tasks', payload)
            .catch(err => err.response || err)

        if(response.status === OK) {
            context.commit('setApiStatus', true)
            return false
        }
        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setTaskErrorMessages', response.data.errors)
        } else {
            context.commit('error/setCode', response.status, {root: true})
        }
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
