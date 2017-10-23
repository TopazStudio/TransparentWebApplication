<template>
    <div id="app">
        <nav-bar></nav-bar>
        <router-view></router-view>
        <!--FOOTER-->
    </div>
</template>
<script>
    import NavBar from '../components/inc/NavBar.vue';
    export default {
        components:{
            NavBar,
        },
    }
</script>