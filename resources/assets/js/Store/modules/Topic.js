import {apolloClient} from "@/Apollo/index";
import {GET_COMPANY_RELATED_TOPICS} from '@/Apollo/queries';

const state = {
    companyRelatedTopics: []
};

const mutations = {
    SET_COMPANY_RELATED_TOPICS(state,{payload}){
        state.companyRelatedTopics = payload;
    },
};

const actions = {
    async fetchCompanyRelatedTopics({commit},id){
        let response = await apolloClient.query({
            query: GET_COMPANY_RELATED_TOPICS,
            variables: {
                id
            },
        });
        commit({
            type: 'SET_COMPANY_RELATED_TOPICS',
            payload: response.data.company.relatedTopics
        });
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
