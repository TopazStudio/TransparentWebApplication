const state = {
    Token: ''
};

const mutations = {
    SET_TOKEN(state,payload){
        state.Token = payload.token;
    }
};

const actions = {
    attemptLogin({commit},form){
        axios.post('http://laradev.dev/api/user/signin',form)
            .then((response)=>{
                commit({
                    type: 'SET_TOKEN',
                    token: response.data.token
                });
            });
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
