<template>
    <el-card class="fly-card fly-info-Card" ref="companyControls">
        <div class="company-control fly-card-Content">
            <div class="company-brand">
                <img :src="getLogo()" alt="companyLogo">
                <div>
                    <h4>{{company.name}}</h4>
                    <p>{{company.description}}</p>
                </div>
                <div>
                    <el-button type="success">Follow</el-button>
                </div>
            </div>
            <div class="company-links">
                <ul>
                   <li><a href="#" @click="makeReview">Reviews</a></li>
                   <li><a href="#" @click="$router.push({name: 'documents-page'})">Documents</a></li>
                   <li><a href="#">Third</a></li>
                   <li><a href="#">Fourth</a></li>
                </ul>
            </div>
        </div>
    </el-card>

</template>
<script>
    import { mapState } from 'vuex';

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
        methods:{
            getLogo(){
                let src = 'userPics/placeholder.png';

                if (this.company === undefined || this.company.pictures === undefined){
                    src = 'userPics/placeholder.png';
                }else if(this.company.pictures[0]){
                    src = this.company.pictures[0].location;
                }
                return 'http://laravel.dev/storage/' + src;
            },
            makeReview(){
                this.$router.push({name: 'review-page'});
            }
        }
    }
</script>
<style lang="scss">
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
    .company-brand{
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        margin-bottom: 10px;
    }
</style>