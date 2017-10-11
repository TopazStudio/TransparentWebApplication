const state = {
    Token: '',
    User: '',
    Authenticated: false
};

const mutations = {
    SET_AUTH(state,{info}){
        state.Token = info.token;
        state.User = info.user;

    },
    SET_AUTHENTICATED({Authenticated},{status}){
        Authenticated = status;
    }
};

const actions = {
    attemptLogin({commit},form){
        axios.post('http://laravel.dev/api/auth/login',form)
            .then((response)=>{
                commit({
                    type: 'SET_AUTH',
                    info: response.data.info
                });
                commit({
                    type: 'SET_AUTHENTICATED',
                    status: true
                });
            });
    },
    attemptRegistry(state,form){
        axios.post('http://laravel.dev/api/auth/register',form)
            .then((response)=>{
                this.attemptLogin(state,form);
            });
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
