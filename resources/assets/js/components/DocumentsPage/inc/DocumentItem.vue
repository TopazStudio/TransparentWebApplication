<template>
    <div class="fly-document-item">
        <div class="doc-pic">
            <icon :name="getIconType()" scale="6" style="margin:0 10px;"></icon>
        </div>
        <!--<img :src="getDocPic()" alt="Document Pic" class="doc-pic">-->
        <div class="details">
            <div class="details-upper">
                <span style="color: black;
                            font-weight: 700;
                            font-size: 20px;">
                    {{document.name}}</span>
                <div style="position: absolute;
                            float: right;
                            top: 0px;
                            right: 10px;">
                    <span style="font-size: 14px;">
                        uploaded on {{document.createdAt}}20/17/2017</span>

                    <el-button class="navigation-btn" @click="goToDoc">
                        <icon name="external-link"></icon>
                    </el-button>
                </div>

                <p style="margin: 0;">{{document.description}}</p>

                <div class="analytics">
                    <span @click="goToDoc"><icon name="eye"></icon> {{getViews()}}1,749</span>
                    <span @click="likeDoc"><icon name="thumbs-o-up"></icon> {{document.likes}}100</span>
                    <span @click="dislikeDoc"><icon name="thumbs-o-down"></icon> {{document.dislikes}}10</span>
                </div>
            </div>
            <div class="details-lower">
                <span class="tag-heading">Tags</span>
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
            getViews(){

            },
            getViewerSrc(docLoc){
                return '/Util/ViewerJS/#../../storage/' + docLoc;
            },
            goToDoc(){
                window.location.assign(this.getViewerSrc(this.document.location));
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
        position: relative;
        width: 100%;
        min-height: 150px;
        text-align: left;
        background-color: #fff;
        margin: 10px 0;

        @include transition(all 0.4s ease-in-out);

        display: grid;
        grid-template-columns: 1fr 4fr;
        .details{
            display: grid;
            grid-template-rows: 2fr 1fr;
            .details-upper{
                position: relative;
                padding: 10px;
                .navigation-btn{
                    right: 0;
                    color: white;
                    background: $brand-darkblue;
                    border-radius: 0;
                    border: none;
                }
                .analytics{
                    position: absolute;
                    bottom: 0;
                    right: 20px;
                    span{
                        padding: 0 10px;
                    }
                }
            }
            .details-lower{
                border-top: 1px solid darkgray;
                padding: 10px;
                position: relative;
                .tag-heading{
                    position: absolute;
                    display: block;
                    float: left;
                    margin-left: -20px;
                    margin-top: -20px;
                    background: white;
                }
            }
        }
        .doc-pic{
            @include size(100px);
        }
        .right-decor{
            position: absolute;
            top: 0;
            right: 0;
            width: 10px;
            height: 100%;
            opacity: 1;
        }
    }
</style>