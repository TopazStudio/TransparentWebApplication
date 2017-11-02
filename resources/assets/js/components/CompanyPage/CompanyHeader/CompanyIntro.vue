<template>
    <div class="companyIntro">
        <div class="content">
            <img :src="getLogo()" alt="companyLogo" style="width: 150px;height: 150px;">
            <div class="details">
                <div style="display: inline;">
                    <h4 class="company-name">{{company.name}}</h4>
                    <el-button type="success" class="follow-btn">Follow</el-button>
                </div>
                <div style="display: inline;">

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapState } from 'vuex';

    export default {
        name: 'CompanyIntro',
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
        methods:{
            getLogo(){
                let src = 'userPics/placeholder.png';

                if (this.company === undefined || this.company.pictures === undefined){
                    src = 'userPics/placeholder.png';
                }else if(this.company.pictures[0]){
                    src = this.company.pictures[0].location;
                }
//                return 'http://laravel.dev/storage/' + src;
                return 'https://loremflickr.com/320/240/logo,company';
            },
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";
    @import "~sass/variables";

    .companyIntro{
        position: absolute;
        @include size(100% 150px);
        margin: 0;
        padding: 0;
        bottom: 0;
        .content{
            background-color: #fff;
            display: grid;
            grid-template-columns: 1fr 2fr;
            .details{
                display: flex;
                flex-direction: column;
                .company-name{
                    font-size: 30px;
                }
                .follow-btn{
                    position: absolute;
                    right: 0;
                    top: 0;
                    color: white;
                    background: $brand-darkblue;
                    border-radius: 0;
                    border: none;
                }
            }
        }
    }
</style>