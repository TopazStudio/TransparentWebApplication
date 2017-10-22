<template>
    <div class="fly-search">
        <el-autocomplete
                class="search-input"
                v-model="searchTerm"
                placeholder="Search Documents,Companies,Topics and more"
                custom-item="search-list-item"
                :fetch-suggestions="querySearchAsync"
                :trigger-on-focus="false"
                size="large"
                @select="handleSelect">
            <el-select v-model="searchType" slot="prepend" placeholder="Select" style=" width: 110px;" filterable clearable>
                <el-option
                        v-for="item in searchOptions"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                </el-option>
            </el-select>
            <el-button slot="append" icon="search"></el-button>
        </el-autocomplete>
    </div>
</template>
<script>
    import { mapState,mapActions } from 'vuex';
    import SearchListItem from './SearchListItem.vue';

    export default {
        data(){
            return{
                searchTerm: '',
                searchType: '',
                searchOptions: [
                    {
                        value: 'company',
                        label: 'Companies'
                    },
                    {
                        value: 'document',
                        label: 'Documents'
                    },
                    {
                        value: 'topic',
                        label: 'Topics'
                    },
                ],
            }
        },
        methods:{
            ...mapActions('Search',[
                'searchOnType',
            ]),
            async querySearchAsync(queryString, cb) {
                try{
                    this.searchOnType({queryString,searchType:this.searchType,cb});
                }catch (error){
                    this.notifyError(error);
                }
            },
            handleSelect(item) {
                console.log(item);
            }
        }
    }
</script>
<style lang="scss">
    .fly-search{
        .search-input{
            width: 100%;
        }
    }
</style>