<template>
    <main id="documentPage" class="page " style="background-color: rgba(245, 245, 245, 0.84);">
        <company-header></company-header>
        <div class="fly-full-list-view">
            <el-col :xs="24" :sm="24" :md="12" :lg="12" class="full-list">
                <document-list @handleSelect="handleSelect"></document-list>
            </el-col>
            <el-col :xs="24" :sm="24" :md="12" :lg="12" class="side-controls">
                <document-preview ref="documentPreview" style="height: 100%;"></document-preview>
            </el-col>
        </div>
    </main>
</template>
<script>
    import { mapState,mapActions } from 'vuex';
    import DocumentList from '@/components/DocumentsPage/DocumentList.vue';
    import DocumentPreview from '@/components/DocumentsPage/DocumentPreview.vue';
    import CompanyHeader from '@/components/CompanyPage/CompanyHeader.vue';

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

            handleSelect(payload){
                this.$refs.documentPreview.setDocument(payload);
            },
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
            CompanyHeader,
            DocumentList,
            DocumentPreview
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