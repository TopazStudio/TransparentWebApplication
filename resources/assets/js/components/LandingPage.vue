<template>
    <main id="app">
        <app-nav></app-nav>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    TRANSPARENT
                </div>
            </div>
        </div>
    </main>
</template>
<script>
    import Nav from './inc/nav.vue'
    export default {
        components:{
            'app-nav':Nav
        }
    }
</script>