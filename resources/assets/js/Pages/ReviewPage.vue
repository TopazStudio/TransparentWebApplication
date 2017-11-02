<template>
    <main id="reviewPage" class="page " style="background-color: rgba(245, 245, 245, 0.84);">
        <company-header></company-header>
        <div class="fly-full-list-view">
            <el-col :xs="24" :sm="24" :md="12" :lg="12" class="full-list">
                <review-list></review-list>
            </el-col>
            <el-col :xs="24" :sm="24" :md="12" :lg="12" class="side-controls">
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
        </div>
    </main>
</template>
<script>
    import { mapState,mapActions } from 'vuex';


    import ReviewSummary from '@/components/ReviewPage/ReviewSummary.vue';
    import ReviewList from '@/components/ReviewPage/ReviewList.vue';
    import UserReview from '@/components/ReviewPage/UserReview.vue';
    import ReviewPane from '@/components/ReviewPage/ReviewPane.vue';
    import CompanyHeader from '@/components/CompanyPage/CompanyHeader.vue';

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
            },
            /**
             * Get id of company supposed to be fetched. If none is
             * found then its a 404.
             *
             * */
            companyId(){
                try{
                    return this.$route.params.companyId;
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
                }
            }
        },
        components:{
            ReviewSummary,
            ReviewList,
            UserReview,
            ReviewPane,
            CompanyHeader
        },
        methods:{
            ...mapActions('Company',[
                'fetchCompany',
            ]),
            ...mapActions('User',[
                'fetchReviews',
            ]),
            /**
             * Fetch the company requested for viewing if
             * it wasn't already fetched.
             *
             * */
            getCompany(){
                try{
                    if(this.company.id !== this.companyId)
                        this.fetchCompany(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
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

