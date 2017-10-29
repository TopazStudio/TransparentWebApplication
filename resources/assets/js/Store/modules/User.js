import {apolloClient} from "@/Apollo/index";
import {GET_USER_REVIEWS} from '@/Apollo/queries';
import {REVIEW} from '@/Apollo/mutations';

const state = {
    User: '',
};

const mutations = {
    SET_USER(state,{payload}){
        state.User = payload.user;
    },
    UNSET_USER(state){
        state.User = null;
    },

    ADD_REVIEWS(state,{reviews}){
        state.User = { ...state.User, reviews }
    },
    ADD_REVIEW(state,{review}){
        let holder = JSON.parse(JSON.stringify(state.User));

        holder.reviews = [...holder.reviews,review];

        state.User = holder;
    },
    DELETE_REVIEW(state,{review}){
        let holder = JSON.parse(JSON.stringify(state.User));

        holder.reviews.splice(holder.reviews.findIndex((el)=>{
            if(el)
                return el.id === review.id;
        }),1);

        state.User = holder;
    },
    UPDATE_REVIEW(state,{review}){
        let holder = JSON.parse(JSON.stringify(state.User));

        holder.reviews = holder.reviews.map((el)=>{
            if(el)
                if(el.id === review.id){
                    return review;
                }
        });

        state.User = holder;
    }
};

const actions = {
    async fetchReviews({commit}){
        let response = await apolloClient.query({
            query: GET_USER_REVIEWS,
        });

        //TODO: allow multiple user reviews
        commit({
            type: 'ADD_REVIEWS',
            reviews: [response.data.viewer.review]
        });
    },

    async deleteReview({state,commit},review){
        let response = await apolloClient.mutate({
            mutation: REVIEW,
            variables:{
                raw: JSON.stringify({...review,userId:state.User.id,companyId:review.company.id}),
                type: 'Delete'
            }
        });

        commit({
            type: 'DELETE_REVIEW',
            review
        });

        commit({
            type: 'Company/DELETE_REVIEW',
            review
        },{root: true});
    },

    async updateReview({commit,state},review){
        let response = await apolloClient.mutate({
            mutation: REVIEW,
            variables:{
                raw: JSON.stringify({...review,userId:state.User.id,companyId:review.company.id}),
                type: 'Update'
            }
        });

        commit({
            type: 'UPDATE_REVIEW',
            review: response.data.review
        });

        commit({
            type: 'Company/UPDATE_REVIEW',
            review: response.data.review
        },{root: true});
    },

    async addReview({commit,rootState,state},content){
        let response = await apolloClient.mutate({
            mutation: REVIEW,
            variables:{
                raw: JSON.stringify({
                    content:content,
                    userId: state.User.id,
                    companyId: rootState.Company.company.id
                }),
                type: 'Add'
            }
        });

        commit({
            type: 'ADD_REVIEW',
            review: response.data.review
        });

        commit({
            type: 'Company/ADD_REVIEW',
            review: response.data.review
        },{root: true});
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
