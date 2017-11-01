<template>
    <div class="fly-topic-list-item">
        <p>{{topic.name}}</p>
    </div>
</template>
<script>
    export default {
        props: ['topic'],
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-topic-list-item{
        position: relative;
        @include size(100% 100px);
        text-align: left;
        border-top: 1px solid darkgrey;
        border-bottom: 1px solid darkgrey;
    }
</style>