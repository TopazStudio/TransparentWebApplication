import {RESULTS_WANTED_OF} from '@/Apollo/queries';
import {apolloClient} from "@/Apollo/index";
import gql from 'graphql-tag';
let esBuilder = require('bodybuilder');

export default class SearchService{

    static async search(queryString,searchType){
        let query;

        if (searchType === undefined || searchType === ''){
            query = this.getQuery(['company','topic','document'])
        }else {
            query = this.getQuery([searchType])
        }

        let response = await apolloClient.query({
            query,
            variables: {
                raw: JSON.stringify(esBuilder().query('match','name',queryString).build())
            },
        });

        return response.data.search;
    }


    static getQuery(types){
        let searchEntities = '';

        types.forEach((type)=>{
            searchEntities += `${type}(raw: $raw){
                                 ${RESULTS_WANTED_OF(type)}
                              }`
        });

        return gql(`
                    query SEARCH($raw: String){
                        search{
                            ${searchEntities}
                        }
                    }
                `);
    }
}