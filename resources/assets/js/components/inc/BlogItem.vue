<template>
    <div class="fly-blog-item list-item">
        <img :src="getBlogPic()" alt="Blog Pic" class="list-pic">
        <div class="content">
            <div class="details">
                <span class="item-header">{{blog.heading}}</span>
                <p>{{blog.content}}</p>
            </div>
            <div class="analytics">
                <div style="float: left;">
                        <span style="font-size: 14px;">
                        created on {{blog.createdAt}}20/17/2017</span>
                </div>
                <div style="float:right;">
                    <span @click="goToBlog"><icon name="eye"></icon> {{getViews()}}1,749</span>
                    <span @click="likeBlog"><icon name="thumbs-o-up"></icon> {{blog.likes}}100</span>
                    <span @click="dislikeBlog"><icon name="thumbs-o-down"></icon> {{blog.dislikes}}10</span>
                </div>
            </div>
            <div class="tags">
                <el-tag>New</el-tag>
                <el-tag>Financial</el-tag>
                <el-tag>Crisis</el-tag>

                <el-tag
                        v-for="(tag,index) in blog.tags"
                        :key="index">
                    {{tag.name}}
                </el-tag>
            </div>

        </div>
        <el-button class="external-link-btn"
                   @click="goToBlog">
            <icon name="external-link"></icon>
        </el-button>
        <span class="right-decor" style="background-color: #301AA0;"></span>
    </div>
</template>
<script>
    import { mapState,mapActions } from 'vuex';

    import 'vue-awesome/icons/eye';
    import 'vue-awesome/icons/thumbs-o-down';
    import 'vue-awesome/icons/thumbs-o-up';
    import 'vue-awesome/icons/external-link';
    import Icon from 'vue-awesome/components/Icon';

    export default {
        name: 'BlogItem',
        props: ['blog'],
        methods:{
            getBlogPic(){
                return 'http://laravel.dev/storage/userPics/placeholder.png';
            },
            getViews(){

            },
            goToBlog(){
                window.open(this.blog.url, '_blank');
            },
            likeBlog(){

            },
            dislikeBlog(){

            }
        },
        components:{
            Icon
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";
    @import "~sass/variables";

    .fly-blog-item{
        display: grid;
        grid-template-columns: 1fr 4fr;
    }
</style>