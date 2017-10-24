<template>
    <section class="fly-front-view">
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
    //noinspection CssUnknownTarget
    @import "~sass/variables";
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-front-view{
        position: relative;
        background-color: rgba(245, 245, 245, 0.84);
        padding: 40px 80px;
        display: flex;
        .el-col{
            padding: 0 10px;
        }
    }
</style>