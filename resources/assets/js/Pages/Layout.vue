<template>
    <div id="app">
        <nav-bar></nav-bar>
        <router-view></router-view>
        <fly-footer></fly-footer>
    </div>
</template>
<script>
    import NavBar from '../components/inc/NavBar.vue';
    import Footer from '../components/inc/Footer.vue';
    export default {
        components:{
            NavBar,
            "fly-footer":Footer
        },
    }
</script>