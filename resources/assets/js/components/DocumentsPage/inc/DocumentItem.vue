<template>
    <div class="fly-document-item list-item" @click="$emit('handleSelect')">
        <div class="list-pic">
            <icon :name="getIconType()" scale="6" style="margin:0 10px;"></icon>
        </div>
        <div class="content">
            <div class="details">
                <span class="item-header">{{document.name}}</span>
                <p>{{document.description}}</p>
            </div>
            <div class="analytics">
                <div style="float: left;">
                        <span style="font-size: 14px;">
                        created on {{document.createdAt}}20/17/2017</span>
                </div>
                <div style="float:right;">
                    <span @click="goToDoc"><icon name="eye"></icon> {{getViews()}}1,749</span>
                    <span @click="likeDoc"><icon name="thumbs-o-up"></icon> {{document.likes}}100</span>
                    <span @click="dislikeDoc"><icon name="thumbs-o-down"></icon> {{document.dislikes}}10</span>
                </div>
            </div>
            <div class="tags">
                <el-tag>New</el-tag>
                <el-tag>Financial</el-tag>
                <el-tag>Crisis</el-tag>

                <el-tag
                        v-for="(tag,index) in document.tags"
                        :key="index">
                    {{tag.name}}
                </el-tag>
            </div>

        </div>
        <el-button class="external-link-btn"
                   @click="goToDoc">
            <icon name="external-link"></icon>
        </el-button>
        <span class="right-decor" style="background-color: #301AA0;"></span>
    </div>
</template>
<script>
    import { mapState,mapActions } from 'vuex';

    import 'vue-awesome/icons/file-excel-o';
    import 'vue-awesome/icons/file-word-o';
    import 'vue-awesome/icons/file-text-o';
    import 'vue-awesome/icons/file-powerpoint-o';
    import 'vue-awesome/icons/file-picture-o';
    import 'vue-awesome/icons/file-code-o';
    import 'vue-awesome/icons/file-pdf-o';
    import 'vue-awesome/icons/eye';
    import 'vue-awesome/icons/thumbs-o-down';
    import 'vue-awesome/icons/thumbs-o-up';
    import 'vue-awesome/icons/external-link';


    import Icon from 'vue-awesome/components/Icon';

    export default {
        props:['document'],
        created(){

        },
        data(){
            return{

            }
        },
        computed:{
            ...mapState('Document',[
                'Documents',
            ]),
        },
        methods:{
            goToDoc(){
                window.location.assign('/Util/ViewerJS/#../../storage/'+ this.document.location);
            },
            getIconType(){
                switch (this.document.type){
                    case 'pdf':
                        return 'file-pdf-o';
                        break;

                    case 'txt':
                        return 'file-text-o';
                        break;

                    case 'doc':
                        return 'file-word-o';
                        break;

                    default:
                        return 'file-text-o';
                        break;

                }
            },
            getViews(){

            },
            likeDoc(){

            },
            dislikeDoc(){

            }
        },
        components:{
            Icon
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";
    @import "~sass/variables";

    .fly-document-item{
        display: grid;
        grid-template-columns: 1fr 4fr;

    }
</style>