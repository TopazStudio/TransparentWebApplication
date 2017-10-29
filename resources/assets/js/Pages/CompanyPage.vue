<template>
    <main id="companyPage" class="page fly-twoPane-view" style="background-color: rgba(245, 245, 245, 0.84);">
        <el-col :xs="24" :sm="24" :md="12" :lg="12">
            <company-control></company-control>
            <company-stats></company-stats>
            <company-reviews></company-reviews>
        </el-col>
        <el-col :xs="24" :sm="24" :md="12" :lg="12" >
            <company-documents></company-documents>
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
        mounted(){
            this.getCompany();
        },
        data(){
            return{

            }
        },
        computed:{
            ...mapState('Company',[
                'company',
            ])
        },
        methods:{
            ...mapActions('Company',[
                'fetchCompany',
            ]),
            async getCompany(id){
                let companyId = null;

                if(id) companyId = id;
                else {
                    try{
                        companyId = this.$route.params.companyId;
                    }catch (e){
                        this.$router.push('/');
                    }
                }

                try{
                    if(this.company.id !== companyId)
                        this.fetchCompany(companyId);
                }catch (e){
                    this.$router.push('/');
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
        beforeRouteUpdate (to, from, next) {
            this.checkCompany(to.params.companyId);
            next();
        }
    }
</script>
<style lang="scss">

</style>