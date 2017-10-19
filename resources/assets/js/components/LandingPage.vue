<template>
    <div id="app">
        <app-nav></app-nav>
        <main ref="landingPage" id="landingPage">
            <search-pane></search-pane>
            <front-view></front-view>
        </main>
    </div>
</template>
<script>
    import Nav from './inc/nav.vue';
    import SearchPane from './LandingPage/SearchPane.vue';
    import FrontView from './LandingPage/FrontView.vue';
    export default {
        components:{
            'app-nav':Nav,
            SearchPane,
            FrontView
        },
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";

    #landingPage{
        position: absolute;
        top: $fly-navbar-height;
        right: 0;
        bottom: 0;
        left: 0;
        margin: 0 40px;
    }
</style>