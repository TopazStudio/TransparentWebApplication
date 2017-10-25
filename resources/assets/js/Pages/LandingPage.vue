<template>
    <main id="landingPage" class="workspace">
        <search-pane></search-pane>
        <front-view></front-view>
    </main>
</template>
<script>
    import Nav from '../components/inc/NavBar.vue';
    import SearchPane from '../components/LandingPage/SearchPane.vue';
    import FrontView from '../components/LandingPage/FrontView.vue';
    export default {
        components:{
            'app-nav':Nav,
            SearchPane,
            FrontView
        },
    }
</script>
<style lang="scss">
    #landingPage{
        margin: 0 40px;
    }
</style>