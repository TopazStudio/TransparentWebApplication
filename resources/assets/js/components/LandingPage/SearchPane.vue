<template>
    <section class="fly-search-pane">
        <div class="fly-search-pane-inner">
            <el-col :xs="24" :sm="24" :md="12" :lg="12" style="margin: auto;">
                <div class="content">
                    <p>{{promoMessage}}</p>
                </div>
            </el-col>
            <el-col :xs="24" :sm="24" :md="12" :lg="12" style="margin: auto;">
                <div class="search">
                    <el-input placeholder="Please input" v-model="searchTerm" size="large">
                        <el-select v-model="searchSelect" slot="prepend" placeholder="Select" style=" width: 110px;">
                            <el-option label="Restaurant" value="1"></el-option>
                            <el-option label="Order No." value="2"></el-option>
                            <el-option label="Tel" value="3"></el-option>
                        </el-select>
                        <el-button slot="append" icon="search"></el-button>
                    </el-input>
                </div>
            </el-col>
        </div>
    </section>
</template>
<script>
    export default {
        data(){
            return{
                promoMessage: 'All the info you need to make that next big step',
                searchTerm: '',
                searchSelect: ['Documents','Topics','Campanies']
            }
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-search-pane{
        position: relative;
        height: 370px;
        .fly-search-pane-inner{
            position: relative;
            display: flex;
            z-index: 0;
            padding: 20px;
            .content{
                font-family: Megrim,sans-serif;
                font-weight: 400;
                font-size: 60px;
                text-align: left;
                color: #ffffff;
                z-index: 10;
            }
            &:before{
                @include position(absolute,0);
                @include size(100%);
                background-color: rgba(24, 0, 255, 0.41);
                z-index: -1;
                content: '';
            }
        }
        /*.fly-search-pane-overlay{

        }*/
    }
</style>