import { fetchList } from '@/api/motel'

function updateMotel(motel, list) {
  return list = list.map(item => {
    if (item.id === motel.id) {
      return motel
    } else {
      return item
    }
  })
}

const state = {
  list: []
}
  
const mutations = {
  SET_MOTEL: (state, motel) => {
    let isExit = false
    if (state.list.length > 0) isExit = updateMotel(motel, state.list)
    isExit ? (state.list = isExit) : state.list.push(motel)
  },
}

const actions = {
  FetchList({ commit }) {
    return new Promise((resolve, reject) => {
    fetchList()
      .then(res => {
        if (res && res.success) {
          const data = (res.data && res.data.data) || []
          commit('SET_MOTEL', data)
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
