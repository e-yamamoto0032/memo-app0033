import {OK, UNPROCESSABLE_ENTITY} from '../util'

function getDefaultState() {
    return {
        lists: [],
        apiStatus: null,
        taskErrorMessages: null,
        cardErrorMessages: null,
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
    setCardErrorMessages(state, messages) {
        state.cardErrorMessages = messages
    },
    addCardToList(state, payload) {
        const result = state.lists.find((v) => v.id === payload.task_id )
        result.cards.push({
            id: payload.id,
            body: payload.body,
            order: payload.order,
            sheet_id: payload.sheet_id,
            task_id: payload.task_id
        })
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
    async addCardToList(context, payload) {
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/cards', payload)
            .catch(err => err.response || err)

        if(response.status === OK) {
            context.commit('setApiStatus', true)
            return false
        }
        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setCardErrorMessages', response.data.errors)
        } else {
            context.commit('error/setCode', response.status, {root: true})
        }
    },
    dbCard(context, payload) {
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
