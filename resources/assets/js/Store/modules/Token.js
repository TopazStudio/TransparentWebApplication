import TokenService from './../../services/TokenService';

let tokenService = new TokenService();

const state = {
    Token: ''
};

const mutations = {
    SET_TOKEN(state,payload){
        state.Token = payload.token;
    }
};

const actions = {
    async attemptLogin({commit},form){
        commit({
            type: 'SET_TOKEN',
            token: await tokenService.login(form)
        });
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
