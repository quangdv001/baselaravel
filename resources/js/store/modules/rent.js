import { fetchList } from '@/api/rent'

function updateRent(rent, list) {
  return list = list.map(item => {
    if (item.id === rent.id) {
      return rent
    } else {
      return item
    }
  })
}

const state = {
  list: []
}
  
const mutations = {
  SET_RENT: (state, rent) => {
    let isExit = false
    if (state.list.length > 0) isExit = updateRent(rent, state.list)
    isExit ? (state.list = isExit) : state.list.push(rent)
  },
}

const actions = {
  FetchList({ commit }) {
    return new Promise((resolve, reject) => {
    fetchList()
      .then(res => {
        if (res && res.success) {
          const data = (res.data && res.data.data) || []
          commit('SET_RENT', data)
          resolve(data)
        } else {
          throw res
        }
      })
      .catch(error => {
        console.warn(error)
        reject(error)
      })
    })
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
