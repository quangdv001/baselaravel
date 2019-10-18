import { fetchList, create, edit, remove } from '@/api/motel'

function updateList(motel, list) {
  let isUpdate = false
  const _list = list.map(item => {
    if (item.id === motel.id) {
      isUpdate = true
      return motel
    } else {
      return item
    }
  })
  return isUpdate ? _list : false
}

const state = {
  list: []
}
  
const mutations = {
  SET_LIST: (state, items) => {
    if (items && items.length > 0) {
      state.list = items
    }
  },
  SET_ITEM: (state, item) => {
    let isExit = false
    if (state.list.length > 0) isExit = updateList(item, state.list)
    if (isExit) {
      state.list = isExit
    } else {
      state.list.unshift(item)
      state.list.pop()
    } 
  },
  REMOVE_ITEM: (state, item_id) => {
    if (item_id) {
      state.list = state.list.filter(item => item.id !== item_id)
    }
  },
}

const actions = {
  FetchList({ commit }, { current_page, limit }) {
    return new Promise((resolve, reject) => {
    fetchList(current_page, limit)
      .then(res => {
        if (res && res.success) {
          const data = (res.data && res.data.data) || []
          commit('SET_LIST', data)
          resolve(res)
        } else {
          throw res
        }
      })
      .catch(error => {
        reject(error)
      })
    })
  },
  Create({ commit }, { name, address, description }) {
    return new Promise((resolve, reject) => {
    create({ name, address, description })
      .then(res => {
        if (res && res.success) {
          const data = (res && res.data) || false
          if (data) commit('SET_ITEM', data)
          resolve(res)
        } else {
          throw res
        }
      })
      .catch(error => {
        reject(error)
      })
    })
  },
  Edit({ commit }, { name, address, description }) {
    return new Promise((resolve, reject) => {
    edit({ name, address, description })
      .then(res => {
        if (res && res.success) {
          const data = (res && res.data) || false
          if (data) commit('SET_ITEM', data)
          resolve(res)
        } else {
          throw res
        }
      })
      .catch(error => {
        reject(error)
      })
    })
  },
  Remove({ commit }, id) {
    return new Promise((resolve, reject) => {
    remove(id)
      .then(res => {
        if (res && res.success) {
          const data = (res && res.data) || false
          if (data) commit('REMOVE_ITEM', data.id)
          resolve(res)
        } else {
          throw res
        }
      })
      .catch(error => {
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
