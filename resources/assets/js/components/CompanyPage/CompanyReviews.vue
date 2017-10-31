<template>
    <el-card class="fly-card fly-info-Card" ref="companyReviewsCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">Reviews</span>
        </div>
        <div class="fly-card-Content">
            <review v-for="(item,index) in company.reviews"
                    :key="index"
                    :review="item">
            </review>
        </div>
    </el-card>
</template>
<script>
    import { mapState } from 'vuex';
    import Review from '@/components/ReviewPage/inc/Review.vue';

    export default {
        computed:{
            ...mapState('Company',[
                'company',
            ]),
        },
        components:{
            Review
        }
    }
</script>