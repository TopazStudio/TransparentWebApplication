import {apolloClient} from "@/Apollo/index";
import {GET_COMPANY_RELATED_BLOGS} from '@/Apollo/queries';

const state = {
    companyRelatedBlogs: []
};

const mutations = {
    SET_COMPANY_RELATED_BLOGS(state,{payload}){
        state.companyRelatedBlogs = payload;
    },
};

const actions = {
    async fetchCompanyRelatedBlogs({commit},id){
        let response = await apolloClient.query({
            query: GET_COMPANY_RELATED_BLOGS,
            variables: {
                id
            },
        });
        commit({
            type: 'SET_COMPANY_RELATED_BLOGS',
            payload: response.data.company.relatedBlogs
        });
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
