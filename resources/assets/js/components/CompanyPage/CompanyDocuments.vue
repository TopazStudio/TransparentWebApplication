<template>
    <el-card class="fly-card fly-info-Card" ref="companyDocsCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">Documents</span>
        </div>
        <div class="fly-card-Content">
            <document-table></document-table>
        </div>
    </el-card>
</template>
<script>
    import {mapActions} from 'vuex';
    import DocumentTable from '@/components/DocumentsPage/DocumentTable.vue';

    export default {
        props: ['companyId'],
        created(){
            this.getDocuments();
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
            DocumentTable
        }
    }
</script>