<template>
    <section class="fly-twoPane-view" style="background-color: rgba(218, 218, 218, 0.84);">
        <el-col :xs="24" :sm="24" :md="12" :lg="12">
            <top-blogs></top-blogs>
            <top-blogs></top-blogs>
        </el-col>
        <el-col :xs="24" :sm="24" :md="12" :lg="12" >
            <top-blogs></top-blogs>
            <top-blogs></top-blogs>
        </el-col>
    </section>
</template>
<script>
    import TopBlogs from './FrontView/TopBlogs.vue';

    export default {
        components:{
            TopBlogs
        }
    }
</script>
<style lang="scss">
</style>