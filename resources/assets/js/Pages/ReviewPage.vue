<template>
    <main id="companyPage" class="page fly-twoPane-view" style="background-color: rgba(245, 245, 245, 0.84);">
        <el-col :xs="24" :sm="24" :md="12" :lg="12">
            <review-summary></review-summary>
            <review-list></review-list>
        </el-col>
        <el-col :xs="24" :sm="24" :md="12" :lg="12" >
            <user-review
                    @makeReview="showReviewPane = true"
                    @updateReview="showReviewPane = isUpdateReview = true;">
            </user-review>
            <review-pane
                    :isUpdateReview="isUpdateReview"
                    @finished="showReviewPane = false;"
                    @canceled="showReviewPane = false;"
                    v-if="showReviewPane">
            </review-pane>
        </el-col>
    </main>
</template>

<script>
    import { mapState,mapActions } from 'vuex';


    import ReviewSummary from '@/components/ReviewPage/ReviewSummary.vue';
    import ReviewList from '@/components/ReviewPage/ReviewList.vue';
    import UserReview from '@/components/ReviewPage/UserReview.vue';
    import ReviewPane from '@/components/ReviewPage/ReviewPane.vue';

    export default {
        created(){
            this.getCompany();
            this.getReviews();
        },
        data(){
            return{
                showReviewPane: false,
                isUpdateReview: false,
            }
        },
        computed:{
            ...mapState('User',[
                'User',
            ]),
            ...mapState('Company',[
                'company',
            ]),
            userReview(){
                if(this.User){
                    return this.User.reviews.find((el)=>{
                        if (el) return el.company.id === this.company.id;
                    });
                }
            }
        },
        components:{
            ReviewSummary,
            ReviewList,
            UserReview,
            ReviewPane
        },
        methods:{
            ...mapActions('Company',[
                'fetchCompany',
            ]),
            ...mapActions('User',[
                'fetchReviews',
            ]),
            getCompany(id){
                let companyId = null;

                if(id) companyId = id;
                else {
                    try{
                        companyId = this.$route.params.companyId;
                    }catch (e){
                        this.$router.push('/');
                    }
                }

                try{
                    if(!(this.company.id === companyId))
                        this.fetchCompany(companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/');
                }
            },
            getReviews(){
                if(this.User){
                    if(!this.User.reviews) {
                        this.fetchReviews();
                    }
                }
            },
        }
    }
</script>
<style lang="scss">

</style>