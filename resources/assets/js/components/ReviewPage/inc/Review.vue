<template>
    <div class="list-item fly-review ">
        <img :src="getReviewerPic()" alt="Reviewer Pic" class="list-pic">
        <div class="content">
            <div class="details">
                <span class="item-header">{{review.user.name}}</span>
                <p>{{review.content}}</p>
            </div>
            <div class="analytics">
                <div style="float: left;">
                    <span style="font-size: 14px;">created on {{review.createdAt}}20/17/2017</span>
                </div>
            </div>
        </div>
        <span class="right-decor" style="background-color: #301AA0;"></span>
    </div>
</template>
<script>
    export default {
        props: ['review'],
        methods:{
            getReviewerPic(){
                let src = 'userPics/placeholder.png';

                if (this.User === undefined || this.User.pictures === undefined){
                    src = 'userPics/placeholder.png';
                }else if(this.review.user.pictures[0]){
                    src = this.review.user.pictures[0].location;
                }
                return 'http://laravel.dev/storage/' + src;
            }
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-review{
        display: grid;
        grid-template-columns: 1fr 4fr;
        .content{
            display: grid;
            grid-template-rows: 3fr 1fr;
        }
    }
</style>