<template>
    <el-card class="fly-card fly-info-Card" ref="companyRelatedBlogsCard">
        <div id="review-total">
            <p>{{total}}</p>
            <p>Total</p>
        </div>
    </el-card>
</template>
<script>
    import { mapState } from 'vuex';

    export default {
        computed:{
            ...mapState('Company',[
                'company',
            ]),
            total(){
                if(this.company.reviews){
                    return this.company.reviews.length
                }else{
                    return 0;
                }
            }
        },
    }
</script>
<style lang="scss">
    #review-total{
        display: flex;
        flex-direction: column;
        text-align: center;
        p:first-child{
            flex: 2;
            font-size: 20px;
        }
        P:last-child{
            flex: 1;
        }
    }
</style>