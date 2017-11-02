<template>
    <el-card class="fly-card fly-card-plain fly-doc-preview" ref="documentPreview">
        <span class="header" style="background-color: #301AA0;">Your Review</span>
        <div class="fly-card-Content" style="background: #e2e2e2;">
            <viewer-js :docLoc="document.location"></viewer-js>
        </div>
    </el-card>
</template>
<script>
    import ViewerJs from './ViewerJS.vue';
    export default {
        data(){
            return{
                document: ''
            }
        },
        methods:{
            setDocument(doc){
                this.document = doc;
            }
        },
        components:{
            ViewerJs
        }
    }
</script>
<style lang="scss">
    .fly-doc-preview{
        .fly-card-Content{
            height: 400px;
        }
    }
</style>