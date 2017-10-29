import {apolloClient} from "@/Apollo/index";
import {REGISTER_COMPANY} from '@/Apollo/mutations';
import {GET_COMPANY,GET_REVIEWS} from '@/Apollo/queries';

const state = {
    company: '',
};

const mutations = {
    SET_COMPANY(state,{company}){
        state.company = company;
    },
    UNSET_COMPANY(state){
        state.company = null;
    },

    ADD_REVIEWS(state,{reviews}){
        state.company = { ...state.company, reviews }
    },
    ADD_REVIEW(state,{review}){
        let holder = JSON.parse(JSON.stringify(state.company));

        holder.reviews = [...holder.reviews,review];

        state.company = holder;
    },
    DELETE_REVIEW(state,{review}){
        let holder = JSON.parse(JSON.stringify(state.company));

        holder.reviews.splice(holder.reviews.findIndex((el)=>{
            if(el)
                return el.id === review.id;
        }),1);

        state.company = holder;
    },
    UPDATE_REVIEW(state,{review}){
        let holder = JSON.parse(JSON.stringify(state.company));

        holder.reviews = holder.reviews.map((el)=>{
            if(el)
                if(el.id === review.id){
                    return review;
                }
        });

        state.company = holder;
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

        return response.data.company;
    },

    async fetchCompany({commit},id){
        let response = await apolloClient.query({
            query: GET_COMPANY,
            variables: {id},
        });

        commit({
            type: 'SET_COMPANY',
            company: response.data.company
        });
    },

    async fetchReviews({commit},id){
        let response = await apolloClient.query({
            query: GET_REVIEWS,
            variables: {id},
        });

        commit({
            type: 'ADD_REVIEWS',
            reviews: response.data.company.reviews
        });
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
