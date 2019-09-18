import { getMe } from "@/api/me";

const state = {
    me: {}
  };
  
  const mutations = {
    SET_ME: (state, me) => {
      state.me = me;
    },
  };
  
  const actions = {
    // async getInfo({ commit }) { 
    //     const userInfo = await getMe().data;
  
    //     commit('SET_ME', userInfo);
    //     return userInfo;
    // },
    getInfo({ commit }) {
      return new Promise((resolve, reject) => {
        getMe()
          .then(response => {
            const { data } = response;
  
            if (!data) {
              reject('Verification failed, please Login again.');
            }
  
            const { 
              // address,
              avatar,
              // created_at,
              // email,
              // email_verified_at,
              id,
              name,
              // phone,
              // status,
              // uid,
              // updated_at,
             } = data;
            // roles must be a non-empty array
            // if (!roles || roles.length <= 0) {
            //   reject('getInfo: roles must be a non-null array!');
            // }
  
            // commit('SET_ROLES', roles);
            // commit('SET_PERMISSIONS', permissions);
            commit('SET_NAME', name);
            commit('SET_AVATAR', avatar);
            // commit('SET_INTRODUCTION', introduction);
            commit('SET_ID', id);

            commit('SET_ME', data);
            resolve(data);
          })
          .catch(error => {
            reject(error);
          });
      });
    }
  };
  
  export default {
    namespaced: true,
    state,
    mutations,
    actions,
  };
  