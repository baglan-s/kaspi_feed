import { createStore } from 'vuex'

export default createStore({
    state () {
      return {
        user: null,
        isLoaded: true,
      }
    },
    getters: {
        getCurrentUser(state) {
            return state.user
        },
        isLoaded(state) {
          return state.isLoaded
        }
    },
    mutations: {
      SET_CURRENT_USER (state, user) {
        state.user = user
      },
      DELETE_CURRENT_USER (state, user) {
        state.user = null
      },
      SET_LOADING(state) {
        state.isLoaded = !state.isLoaded
      }
    },
    actions: {
        setCurrentUser({commit}, user) {
            commit('SET_CURRENT_USER', user)
        },
        deleteCurrentUser({commit}) {
          commit('DELETE_CURRENT_USER')
        },
        setLoading({commit}) {
          commit('SET_LOADING')
        }
    }
})