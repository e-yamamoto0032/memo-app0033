import moment from "moment";
import { OK, UNPROCESSABLE_ENTITY } from '../util'

function getDefaultState() {
    return {
        sheets: [],
        apiStatus: null,
        sheetErrorMessages: null
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
    },
    setApiStatus (state, status) {
        state.apiStatus = status
    },
    setSheetErrorMessages (state, messages) {
        state.sheetErrorMessages = messages
    },
}

const actions = {
    dbSheet(context, payload) {
        context.commit('setSheet', payload)
    },
    resetSheet(context) {
        context.commit('clearAuthData')
    },
    async addSheet(context, payload) {
        context.commit('setApiStatus', null)
        const response = await axios.post('/api/sheets', payload)
            .catch(err => err.response || err)

        if(response.status === OK) {
            context.commit('setApiStatus', true)
            return false
        }
        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setSheetErrorMessages', response.data.errors)
        } else {
            context.commit('error/setCode', response.status, { root: true })
        }
    },
    async updateSheet(context, payload) {
        context.commit('setApiStatus', null)
        const response = await axios.patch('/api/sheets/' + payload.id, payload)
            .catch(err => err.response || err)

        if(response.status === OK) {
            context.commit('setApiStatus', true)
            return false
        }
        context.commit('setApiStatus', false)
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setSheetErrorMessages', response.data.errors)
        } else {
            context.commit('error/setCode', response.status, { root: true })
        }
    },
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



