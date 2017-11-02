<template>
    <div class="fly-topic-list-item list-item" @click="goToTopic">
        <div class="content">
            <div class="details">
                <span class="item-header">{{topic.name}}</span>
                <p>{{topic.description}}Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="analytics">
                <div style="float: left;">
                <span style="font-size: 14px;">
                        created on {{topic.createdAt}}20/17/2017</span>
                </div>
                <div style="float:right;">
                    <span><icon name="eye"></icon>{{getViews()}}1,749</span>
                    <span @click="likeTopic"><icon name="thumbs-o-up"></icon> {{topic.likes}}100</span>
                    <span @click="dislikeTopic"><icon name="thumbs-o-down"></icon> {{topic.dislikes}}10</span>
                </div>
            </div>
            <div class="tags">
                <el-tag>New</el-tag>
                <el-tag>Financial</el-tag>
                <el-tag>Crisis</el-tag>

                <el-tag
                        v-for="(tag,index) in topic.tags"
                        :key="index">
                    {{tag.name}}
                </el-tag>
            </div>
        </div>
        <span class="right-decor" style="background-color: #301AA0;"></span>
    </div>
</template>
<script>

    import 'vue-awesome/icons/eye';
    import 'vue-awesome/icons/thumbs-o-down';
    import 'vue-awesome/icons/thumbs-o-up';
    import 'vue-awesome/icons/external-link';

    import Icon from 'vue-awesome/components/Icon';
    export default {
        props: ['topic'],
        components:{
            Icon
        },
        methods:{
            goToTopic(){

            },
            getViews(){

            },
            likeTopic(){

            },
            dislikeTopic(){

            }
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";
    @import "~sass/variables";

    .fly-topic-list-item{

    }
</style>