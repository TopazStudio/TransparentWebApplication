<template>
    <el-card class="fly-card documents-card" ref="companyRegCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">COMPANY DOCUMENTS</span>
        </div>
        <div class="fly-card-content">
            <document-table></document-table>
        </div>
    </el-card>
</template>
<script>
    import { mapState,mapActions } from 'vuex';
    import DocumentTable from '@/components/DocumentsPage/DocumentTable.vue';
    export default {
        /**
         * Initialize the page by getting the company and
         * documents.
         * */
        created(){
            this.getCompany();
            this.getDocuments();
        },
        data(){
            return{

            }
        },
        computed:{
            ...mapState('Company',[
                'company'
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
                'fetchCompany'
            ]),
            ...mapActions('Document',[
                'fetchDocuments'
            ]),

            /**
             * Get current company.
             * */
            async getCompany(){
                try{
                    if(this.company.id !== this.companyId)
                        this.fetchCompany(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
                }
            },
            /**
             * Get documents of the current company.
             * */
            async getDocuments(){
                try{
                    this.fetchDocuments(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
                }
            }
        },
        components:{
            DocumentTable
        },
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .documents-card{
        @include size(900px null);
        margin: 80px auto;
    }
</style>