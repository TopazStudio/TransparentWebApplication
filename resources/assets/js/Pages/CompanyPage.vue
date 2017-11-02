<template>
    <main id="companyPage" class="page" style="background-color: rgba(218, 218, 218, 0.84);">
        <company-header></company-header>
        <div class="fly-twoPane-view">
            <el-col :xs="24" :sm="24" :md="12" :lg="12">
                <company-details></company-details>
                <company-related-topics></company-related-topics>
            </el-col>
            <el-col :xs="24" :sm="24" :md="12" :lg="12" >
                <company-documents :companyId="companyId"></company-documents>
                <company-related-blogs></company-related-blogs>
            </el-col>
        </div>
    </main>
</template>
<script>
    import { mapActions,mapState } from 'vuex';

    import CompanyDocuments from '@/components/CompanyPage/CompanyDocuments.vue';
    import CompanyRelatedBlogs from '@/components/CompanyPage/CompanyRelatedBlogs.vue';
    import CompanyRelatedTopics from '@/components/CompanyPage/CompanyRelatedTopics.vue';
    import CompanyDetails from '@/components/CompanyPage/CompanyDetails.vue';
    import CompanyHeader from '@/components/CompanyPage/CompanyHeader.vue';

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
            getCompany(){
                try{
                    if(this.company.id !== this.companyId)
                        this.fetchCompany(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
                }
            },
            getCoverImage(){
                let src = 'companyPics/coverImages/placeholder.svg';

                //TODO: fetching cover image from company.
                /*if (this.company === undefined || this.company.pictures === undefined){
                    src = 'userPics/placeholder.png';
                }else if(this.company.pictures[0]){
                    src = this.company.pictures[0].location;
                }*/

//                return 'http://laravel.dev/storage/' + src;
                return 'https://loremflickr.com/1350/200';
            }
        },
        components:{
            CompanyDocuments,
            CompanyRelatedBlogs,
            CompanyRelatedTopics,
            CompanyDetails,
            CompanyHeader
        },
    }
</script>
