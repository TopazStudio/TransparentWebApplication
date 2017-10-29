<template>
    <el-card class="fly-card fly-info-Card" ref="companyRelatedBlogsCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">UserReview</span>
        </div>
        <div class="fly-card-Content">
            <div v-if="notLoggedIn || noReview" class="review-error" style="position: absolute;">
                <p v-if="notLoggedIn" style="margin: auto;">Please Log In to manage your review</p>
                <p v-else-if="noReview" style="margin: auto;">You have not reviewed this company yet.
                <br/>Click <a href="#" @click="makeReview">here</a> to make make a review below.</p>
            </div>
            <review v-else :review="userReview"></review>
            <div class="userReview-links">
                <ul>
                    <li><a href="#" @click="updateReview">Update</a></li>
                    <li><a href="#" @click="delReview">Remove</a></li>
                </ul>
            </div>
        </div>
    </el-card>
</template>
<script>
    import { mapState,mapActions } from 'vuex';
    import Review from './inc/Review.vue';

    export default {
        data(){
            return {

            }
        },
        computed:{
            ...mapState('User',[
                'User',
            ]),
            ...mapState('Company',[
                'company',
            ]),
            noReview(){
                //TODO: better way to check if null
                return this.userReview === null || this.userReview === undefined || this.userReview === ''
            },
            notLoggedIn(){
                return this.User === null || this.User === undefined || this.User === ''
            },
            userReview(){
                if(this.User){
                    return this.User.reviews.find((el)=>{
                        if (el) return el.company.id === this.company.id;
                    });
                }
            }
        },
        methods:{
            ...mapActions('User',[
                'deleteReview'
            ]),
            makeReview(){
                this.$emit('makeReview');
            },
            updateReview(){
                this.$emit('updateReview');
            },
            delReview(){
                this.deleteReview(this.userReview);
            },
        },
        components:{
            Review
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .review-error{
        @include position(absolute,0);
        display: flex;
        background-color: #fff;
    }
    .userReview-links{
        border-top: 1px solid darkgrey;
        ul{
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
            overflow: hidden;
            li {
                float: left;
                a{
                    text-decoration: none;
                    margin: 0 10px
                }
            }
        }
    }
</style>