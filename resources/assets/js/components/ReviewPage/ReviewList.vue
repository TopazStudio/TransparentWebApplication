<template>
    <el-card class="fly-card fly-card-plain fly-list-card" ref="reviewList">
        <!--Search Bar-->
        <div class="searchbar">
            <search-input style="width: 600px;margin: auto;"></search-input>
        </div>
        <div class="fly-card-Content" style="background: #e2e2e2;">
            <review v-for="(item,index) in company.reviews"
                    :key="index"
                    :review="item">
            </review>
            <span v-if="company.reviews.length === 0" class="no-data">NO BLOGS YET</span>

        </div>
    </el-card>
</template>
<script>
    import { mapState } from 'vuex';
    import Review from './inc/Review.vue';
    import SearchInput from '@/components/inc/SearchInput.vue';

    export default {
        computed:{
            ...mapState('Company',[
                'company',
            ]),
        },
        components:{
            Review,
            SearchInput
        }
    }
</script>