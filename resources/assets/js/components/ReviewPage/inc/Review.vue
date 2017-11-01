<template>
    <div class="fly-review">
        <img :src="getReviewerPic()" alt="Reviewer Pic" class="review-pic">
        <div class="details">
            <span>{{review.user.name}}</span>
            <span>{{review.createdAt}}</span>
            <p>{{review.content}}</p>
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
        position: relative;
        @include size(100% 100px);
        text-align: left;
        background-color: #fff;
        padding: 0 10px;

        @include transition(all 0.4s ease-in-out);

        display: grid;
        grid-template-columns: 1fr 4fr;
        .review-pic{
            @include size(100px);
        }
        .right-decor{
            position: absolute;
            top: 0;
            right: 0;
            width: 10px;
            height: 100%;
            opacity: 0;
        }

        &:hover ~ .right-decor{
            opacity: 1;
        }
    }
</style>