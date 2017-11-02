<template>
    <div class="company-contribute">
        <el-button>SUBMIT A RELATED BLOG</el-button>
        <el-button>LINK THIS COMPANY WITH A TOPIC</el-button>
    </div>
</template>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";
    @import "~sass/variables";

    .company-contribute{
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 0;
        right: 0;
        height: 110px;
        width: 300px;
        background-color: #272727;
        button{
            position: relative;
            color: white;
            background: $brand-darkblue;
            border-radius: 0;
            border: none;
            margin: 10px;
        }
    }
</style>