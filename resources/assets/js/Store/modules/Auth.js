import {networkInterface,apolloClient} from "@/Apollo/index";
import {LOGIN_VIEWER_QUERY} from '@/Apollo/queries';

const state = {
    Token: '',
    User: '',
    Authenticated: ''
};

const mutations = {
    SET_AUTH(state,{payload}){
        state.Token = payload.token;
        state.User = payload.user;
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
    async storeAuth({commit,state},payload){
        commit({
            type: 'SET_AUTH',
            payload
        });
        commit({
            type: 'SET_AUTHENTICATED',
            status: true
        });

        networkInterface.use([{
            applyMiddleware (req, next) {
                if (!req.options.headers) {
                    req.options.headers = {}
                }
                const token = state.Token;
                req.options.headers.authorization = token ? `Bearer ${token}` : null;
                next()
            }
        }]);
    },
    async attemptLogin({dispatch},form){
        let response = await apolloClient.query({
                                query: LOGIN_VIEWER_QUERY,
                                variables: form,
                            });
        await dispatch('storeAuth',response.data.login);
    },
    async attemptRegistry({dispatch},form){
        //TODO: allow registration to return a token instead of doing to steps when registering
        await axios.post('http://laravel.dev/api/auth/register',form);
        await dispatch('attemptLogin',form);
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
