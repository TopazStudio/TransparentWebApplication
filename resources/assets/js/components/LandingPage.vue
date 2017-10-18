<template>
    <main id="app">
        <app-nav></app-nav>
        <div class="flex-center position-ref full-height" ref="workspace">
            <div class="content">
                <div class="title m-b-md">
                    COMING SOON
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    import Nav from './inc/nav.vue';
    export default {
        components:{
            'app-nav':Nav
        },
    }
</script>
<style lang="scss">

</style>