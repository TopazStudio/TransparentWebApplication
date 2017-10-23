const state = {
    company: '',
};

const mutations = {
    SET_COMPANY(state,{payload}){
        state.company= payload.company;
    },
};

const actions = {
    async attemptRegistry({dispatch},form){
        await axios.post('http://laravel.dev/api/company/add',form);

    },
};

export default {
    namespaced: true,
    actions
}
