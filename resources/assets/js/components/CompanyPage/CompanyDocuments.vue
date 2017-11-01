<template>
    <el-card class="fly-card fly-card-plain company-doc-card" ref="companyDocsCard">
        <span class="header" style="background-color: #301AA0;">Documents</span>
        <div class="fly-card-Content" style="background: #e2e2e2;">
            <document-item v-for="(doc,index) in Documents"
                    :key="index"
                    :document="doc">
            </document-item>
            <span v-if="Documents.length === 0" class="no-docs">NO DOCUMENTS</span>
        </div>
    </el-card>
</template>
<script>
    import {mapActions,mapState} from 'vuex';
    import DocumentTable from '@/components/DocumentsPage/DocumentTable.vue';
    import DocumentItem from '@/components/DocumentsPage/inc/DocumentItem.vue';

    export default {
        props: ['companyId'],
        created(){
            this.getDocuments();
        },
        computed:{
            ...mapState('Document',[
                'Documents',
            ]),
        },
        methods:{
            ...mapActions('Document',[
                'fetchDocuments',
            ]),
            /**
             * Get documents of the current company.
             * */
            async getDocuments(){
                try{
                    this.fetchDocuments(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/');
                }
            }
        },
        components:{
            DocumentTable,
            DocumentItem
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";
    @import "~sass/variables";
    @import "~sass/mixins";

    .company-doc-card{
        .header{
            padding: 10px;
            display: block;
            position: relative;
            color: white;
            width: 200px;
            text-align: left;
            z-index: 0;
            @include slanted-left();
        }
        .no-docs{
            padding: 50px;
            text-align: center;
            margin: auto;
            display: block;
        }
    }
</style>