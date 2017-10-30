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
                /**
                 * The current company being viewed
                 * */
                companyId: ''
            }
        },
        computed:{
            ...mapState('Company',[
                'company'
            ]),
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
            async getCompany(id){
                if(id) this.companyId = id;
                else {
                    try{
                        this.companyId = this.$route.params.companyId;
                    }catch (e){
                        this.$router.push('/');
                    }
                }

                try{
                    if(this.company.id !== this.companyId)
                        this.fetchCompany(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/');
                }

            },
            /**
             * Get documents of the current company.
             * */
            async getDocuments(id){
                try{
                    this.fetchDocuments(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/');
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