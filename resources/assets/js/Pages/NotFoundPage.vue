<template>
    <div class="fly-404">
        <div class="content">
            <h1 class="notfound-header">SORRY</h1>
            <h3 class="notfound-small">WE COULDN'T FIND WHAT YOU WHERE LOOKING FOR.</h3>
            <search-input></search-input>
        </div>

    </div>
</template>
<script>
    import SearchInput from '@/components/inc/SearchInput.vue';
    export default {
        components:{
            SearchInput
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-404{
        display: flex;
        @include position(relative,0);
        background-color: #fff;
        text-align: center;
        .content{
            margin: auto;
            @include size(900px 500px);
            .notfound-header{
                margin: 10px auto;
                width: 400px;
                padding: 10px;
                color: white;
                font-size: 60px;
                font-weight: 100;
                font-family: monoton,sans-serif;
                background-color: black;
            }
            .notfound-small{
                font-size: 20px;
            }
        }
    }
</style>