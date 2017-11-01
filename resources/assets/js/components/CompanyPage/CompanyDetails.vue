<template>
    <el-card class="fly-card company-details" ref="companyDetails">
        <div class="company-description">
            <span class="left-decor" style="background-color: #301AA0;"></span>
            <span class="header" style="background-color: #301AA0;">What There All About</span>
            <p class="content">{{company.description}}</p>
        </div>
        <div class="company-reviews">
            <span class="left-decor" style="background-color: #101010;"></span>
            <span class="header" style="background-color: #101010;">Reviews</span>
            <span v-if="company.reviews.length === 0" class="no-reviews">No Reviews Yet</span>
            <review v-for="(item,index) in company.reviews"
                    :key="index"
                    :review="item">
            </review>
        </div>
        <div class="company-links">
            <ul>
                <li><a href="#" @click="$router.push({name: 'review-page'})">Reviews</a></li>
                <li><a href="#" @click="$router.push({name: 'documents-page'})">Documents</a></li>
                <li><a href="#">Third</a></li>
                <li><a href="#">Fourth</a></li>
            </ul>
        </div>
    </el-card>

</template>
<script>
    import { mapState } from 'vuex';
    import Review from '@/components/ReviewPage/inc/Review.vue';

    export default {
        data(){
            return{
                companyLogo: ''
            }
        },
        computed:{
            ...mapState('Company',[
                'company',
            ])
        },
        components:{
            Review
        },
        methods:{

        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";
    @import "~sass/variables";
    @import "~sass/mixins";

    .company-details{
        top: -40px;
        margin: 0 -10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 0;
        .el-card__body{
            padding: 0;
        }
        .left-decor{
            position: absolute;
            top: 0;
            left: 0;
            width: 10px;
            height: 100%;
            z-index: 1;
        }
        .header{
            padding: 10px;
            display: block;
            position: relative;
            color: white;
            width: 200px;
            text-align: left;
            z-index: 0;
            @include slanted-left();
        }
        .company-description{
            border-top: 1px solid darkgrey;
            position: relative;
            .content{
                margin: 0;
                padding: 15px;
            }
        }
        .company-links{
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
        .company-reviews{
            border-top: 1px solid darkgrey;
            background: #e2e2e2;
            position: relative;
            text-align: center;
            max-height: 300px;
            .no-reviews{
                padding: 50px;
                text-align: center;
                margin: auto;
                display: block;
            }
        }
    }

</style>