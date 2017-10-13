const state = {
    Token: '',
    User: '',
    Authenticated: ''
};

const mutations = {
    SET_AUTH(state,{info}){
        state.Token = info.token;
        state.User = info.user;

    },
    SET_AUTHENTICATED(state,{status}){
        state.Authenticated = status;
    },
    LOGOUT(state){
        state.Authenticated = false;
        state.User = null;
        state.Token = null;
    }
};

const actions = {
    async attemptLogin({commit},form){
        let response = await axios.post('http://laravel.dev/api/auth/login',form);
        commit({
            type: 'SET_AUTH',
            info: response.data.info
        });
        commit({
            type: 'SET_AUTHENTICATED',
            status: true
        });
    },
    async attemptRegistry({state,dispatch},form){
        await axios.post('http://laravel.dev/api/auth/register',form);
        await dispatch('attemptLogin',form)
    },
    logout({commit}){
        commit('LOGOUT');
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
