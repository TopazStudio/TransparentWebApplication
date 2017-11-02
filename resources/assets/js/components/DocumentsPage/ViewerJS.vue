<template>
    <iframe
            v-if="onReady"
            class="fly-viewer-js"
            :src="'/Util/ViewerJS/#../../storage/' + docLoc"
            allowfullscreen
            webkitallowfullscreen>
    </iframe>
</template>
<script>
    export default {
        props:['docLoc'],
        data(){
            return{
                onReady: true
            }
        },
        watch:{
            docLoc(val,oldVal){
                this.onReady = false;
                this.$nextTick(() => {
                    this.onReady = true;
                });
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
    .fly-viewer-js{
        height: 100%;
        width: 100%;
    }
</style>