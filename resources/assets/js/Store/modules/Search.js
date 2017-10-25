import SearchService from '@/Services/SearchService';

const actions = {
    async searchOnType({commit},{queryString,searchType,cb}){
        let results = await SearchService.search(queryString, searchType);
        //convert into array
        let array = [];

        Object.values(results).forEach((entity)=>{
            if (entity instanceof Array)
               entity.forEach((val)=>{
                  array.push(val);
               });
        });

        cb(array);
    }
};

export default {
    namespaced: true,
    actions
}
