<template>
    <div class="fly-review">
        <p>{{review.content}}</p>
    </div>
</template>
<script>
    export default {
        props: ['review'],
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-review{
        position: relative;
        @include size(100% 100px);
        text-align: left;
        border-top: 1px solid darkgrey;
        border-bottom: 1px solid darkgrey;
    }
</style>