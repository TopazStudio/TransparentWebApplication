<template>
    <el-card class="topBlogsCard" ref="topBlogsCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">TOP BLOGS</span>
        </div>
        <div class="content">

        </div>
    </el-card>
</template>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .topBlogsCard{
        position:relative;
        border: 2px solid $brand-accent;
        border-radius: 0px;
        .content {
            padding: 10px;
        }
    }
</style>