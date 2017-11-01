<template>
    <section class="fly-search-pane">
        <el-col :xs="24" :sm="24" :md="12" :lg="12" style="margin: auto;">
            <span class="content">{{promoMessage}}</span>
        </el-col>
        <el-col :xs="24" :sm="24" :md="12" :lg="12" style="margin: auto;">
            <search-input></search-input>
        </el-col>
    </section>
</template>
<script>
    import SearchInput from '../inc/SearchInput.vue';

    export default {
        components:{
            SearchInput
        },
        data(){
            return{
                promoMessage: 'All the info you need to make that next big step',
            }
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-search-pane{
        position: relative;
        display: flex;
        z-index: 0;
        padding: 20px;
        @include size(100% 300px);
        -webkit-box-shadow: 0px 5px 5px 0px rgba(0,0,0,0.38);
        box-shadow: 0px 5px 5px 0px rgba(0,0,0,0.38);
        .content{
            font-family: Megrim,sans-serif;
            font-weight: 400;
            font-size: 60px;
            text-align: left;
            color: #ffffff;
            z-index: 10;
        }
        &:before{
            @include position(absolute,0);
            @include size(100%);
            background-color: rgba(24, 0, 255, 0.41);
            z-index: -1;
            content: '';
        }
    }


</style>