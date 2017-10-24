import {apolloClient} from "@/Apollo/index";
import {REGISTER_COMPANY} from '@/Apollo/mutations';

const state = {
    company: '',
};

const mutations = {
    SET_COMPANY(state,{company}){
        state.company= company;
    },
    UNSET_COMPANY(state){
        state.company = null;
    }
};

const actions = {
    async attemptRegistry({commit},form){
        let response = await apolloClient.mutate({
            mutation: REGISTER_COMPANY,
            variables: {
                raw: JSON.stringify(form)
            },
        });

        commit({
            type: 'SET_COMPANY',
            company: response.data.company
        });
    },
};

export default {
    namespaced: true,
    actions
}
