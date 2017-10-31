<template>
    <main id="companyPage" class="page fly-twoPane-view" style="background-color: rgba(245, 245, 245, 0.84);">
        <el-col :xs="24" :sm="24" :md="12" :lg="12">
            <company-control></company-control>
            <company-stats></company-stats>
            <company-reviews></company-reviews>
        </el-col>
        <el-col :xs="24" :sm="24" :md="12" :lg="12" >
            <company-documents :companyId="companyId"></company-documents>
            <company-related-blogs></company-related-blogs>
        </el-col>
    </main>
</template>
<script>
    import { mapActions,mapState } from 'vuex';

    import CompanyDocuments from '@/components/CompanyPage/CompanyDocuments.vue';
    import CompanyRelatedBlogs from '@/components/CompanyPage/CompanyRelatedBlogs.vue';
    import CompanyReviews from '@/components/CompanyPage/CompanyReviews.vue';
    import CompanyStats from '@/components/CompanyPage/CompanyStats.vue';
    import CompanyControl from '@/components/CompanyPage/CompanyControl.vue';

    export default {
        created(){
            this.getCompany();
        },
        data(){
            return{

            }
        },
        computed:{
            ...mapState('Company',[
                'company',
            ]),
            /**
             * Get id of company supposed to be fetched. If none is
             * found then its a 404.
             *
             * */
            companyId(){
                try{
                    return this.$route.params.companyId;
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
                }
            }
        },
        methods:{
            ...mapActions('Company',[
                'fetchCompany',
            ]),
            /**
             * Fetch the company requested for viewing if
             * it wasn't already fetched.
             *
             * */
            async getCompany(id){
                try{
                    if(this.company.id !== id ? id : this.companyId)
                        this.fetchCompany(companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
                }
            }
        },
        components:{
            CompanyDocuments,
            CompanyRelatedBlogs,
            CompanyReviews,
            CompanyStats,
            CompanyControl,
        },
    }
</script>
<style lang="scss">

</style>