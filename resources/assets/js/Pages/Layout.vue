<template>
    <div id="app">
        <!--NAV-->
        <nav-bar></nav-bar>
        <!--PAGE-->
        <transition
                v-on:enter="slideUpEnter"
                v-on:leave="slideDownExit">
            <router-view></router-view>
        </transition>

         <!--FOOTER-->
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