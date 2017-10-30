<template>
    <el-card class="fly-card viewerjs-card" ref="companyRegCard">
        <div class="fly-card-content">
            <iframe
                    class="fly-viewer-js"
                    :src="getSrc()"
                    :width="width"
                    :height="height"
                    allowfullscreen
                    webkitallowfullscreen>
            </iframe>
        </div>
    </el-card>
</template>
<script>
    export default {
        props:['docLoc'],
        data(){
            return{
                width: 300,
                height: 400
            }
        },
        methods:{
            getSrc(){
                return this.getViewerLoc() + this.docLoc;
            },
            getViewerLoc(){
                return '/Util/ViewerJS/#../../storage/';
            }
        }
        //DOC SIZES
        /*
            (A4 sized documents - portrait) (1.414 : 1)
            width='724' height='1024'
            width='566' height='800'
            width='389' height='550'
            width='297' height='210'

            (A4 sized documents - landscape) (1 : 1.414 )
            width='1024' height='724'
            width='800' height='566'
            width='550' height='389'
            width='210' height='297'

            (screen sized documents) (4 : 3)
            width='1024' height='768'
            width='800' height='600'
            width='600' height='450'
        */
    }
</script>
<style lang="scss">

    .viewerjs-card{
        .fly-viewer-js{

        }
    }

</style>