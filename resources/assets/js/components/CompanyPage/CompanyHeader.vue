<template>
    <div class="fly-twoPane-view companyPage-header" :style="`background: url(${getCoverImage()}) no-repeat center;`">
        <el-col :xs="24" :sm="24" :md="12" :lg="12" style="position: relative;padding: 0;">
            <company-intro></company-intro>
        </el-col>
        <el-col :xs="24" :sm="24" :md="12" :lg="12" style="position: relative;padding: 0;">
            <company-contribute></company-contribute>
        </el-col>
    </div>
</template>
<script>
    import { mapActions,mapState } from 'vuex';
    import CompanyIntro from '@/components/CompanyPage/CompanyHeader/CompanyIntro.vue';
    import CompanyContribute from '@/components/CompanyPage/CompanyHeader/CompanyContribute.vue';

    export default {
        methods:{
            getCoverImage(){
                let src = 'companyPics/coverImages/placeholder.svg';

                //TODO: fetching cover image from company.
                /*if (this.company === undefined || this.company.pictures === undefined){
                    src = 'userPics/placeholder.png';
                }else if(this.company.pictures[0]){
                    src = this.company.pictures[0].location;
                }*/

//                return 'http://laravel.dev/storage/' + src;
                return 'https://loremflickr.com/1350/200';
            }
        },
        components:{
            CompanyIntro,
            CompanyContribute
        },
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .companyPage-header{
        position: relative;
        @include size(100% 200px);
        padding: 0 80px;
    }
</style>