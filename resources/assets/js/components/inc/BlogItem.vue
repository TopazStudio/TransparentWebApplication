<template>
    <div class="fly-blog-item" @click="handleClick">
        <h4>{{blog.heading}}</h4>
        <p>{{blog.content}}</p>
        <p>{{blog.url}}</p>
    </div>
</template>
<script>
    export default {
        name: 'BlogItem',
        props: ['blog'],
        methods:{
            handleClick(){
                window.open(this.blog.url, '_blank');
            }
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-blog-item{
        position: relative;
        @include size(100% 100px);
        text-align: left;
        border-top: 1px solid darkgrey;
        border-bottom: 1px solid darkgrey;
    }
</style>