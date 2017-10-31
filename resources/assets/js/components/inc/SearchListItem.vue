<template>
    <div class="fly-search-list-item" @click="onclick">
        <el-col v-if="hasPicture" :xs="6" :sm="6" :md="6" :lg="6">
            <img :src="getImage()" alt="Item pic">
        </el-col>
        <el-col :xs="18" :sm="18" :md="18" :lg="18" class="content">
            <b>{{item.name}}</b>
            <br>
            {{item.description}}
        </el-col>
    </div>
</template>
<script>
    export default {
        props: {
            item: { type: Object, required: true }
        },
        data(){
            return{
                hasPicture: ''
            }
        },
        mounted(){
            //CHECK PICTURE
            if (this.item.pictures !== undefined){
                this.hasPicture = true;
            }
        },
        methods:{
            onclick(){
                this.$router.push(`/company/${this.item.id}`);
                console.log('COMING SOON')
            },
            getImage(){
                let src = 'userPics/placeholder.png';

                if (this.item.pictures === undefined){
                    src = 'userPics/placeholder.png';
                }else if(this.item.pictures[0]){
                    src = this.item.pictures[0].location;
                }
                return 'http://laravel.dev/storage/' + src;
            }
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-search-list-item{
        @include size(100% 100px);
        position: relative;
        cursor: pointer;
        border-bottom: 1px solid darkgrey;
        .content{
            padding: 10px;
        }
        &:hover{
            background-color: darken(#fff,10%);
        }
    }
</style>