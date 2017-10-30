import {apolloClient} from "@/Apollo/index";
import {GET_COMPANY_DOCUMENTS} from "@/Apollo/queries";

const state = {
    Documents: []
};

const mutations = {
    SET_DOCUMENTS(state,{documents}){
        state.Documents = documents;
    },
    UNSET_DOCUMENTS(state){
        state.Documents = null;
    },

    ADD_DOCUMENT(state,{document}){
        let holder = JSON.parse(JSON.stringify(state.Documents));

        holder = [...holder,document];

        state.Documents = holder;
    },
    DELETE_DOCUMENT(state,{document}){
        let holder = JSON.parse(JSON.stringify(state.Documents));

        holder.splice(holder.findIndex((el)=>{
            if(el)
                return el.id === document.id;
        }),1);

        state.Documents = holder;
    },
    UPDATE_DOCUMENT(state,{document}){
        let holder = JSON.parse(JSON.stringify(state.Documents));

        holder = holder.map((el)=>{
            if(el)
                if(el.id === document.id){
                    return document;
                }
        });

        state.Documents = holder;
    }

};

const actions = {
    async fetchDocuments({commit},id){
        let response = await apolloClient.query({
            query: GET_COMPANY_DOCUMENTS,
            variables: {
                id: id
            }
        });

        commit({
            type: 'SET_DOCUMENTS',
            documents: response.data.company.documents
        });
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
}
