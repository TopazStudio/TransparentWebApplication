<template>
    <el-card class="fly-card fly-card-plain related-blog-card" ref="companyRelatedBlogsCard">
        <span class="header" style="background-color: #301AA0;">Related Blogs</span>
        <div class="fly-card-Content" style="background: #e2e2e2;">
            <blog-item v-for="(item,index) in companyRelatedBlogs"
                    :key="index"
                    :blog="item">
            </blog-item>
            <span v-if="companyRelatedBlogs.length === 0" class="no-data">NO BLOGS YET</span>
        </div>
    </el-card>
</template>
<script>
    import { mapActions,mapState } from 'vuex';

    import BlogItem from '@/components/inc/BlogItem.vue';

    export default {
        name: 'CompanyRelatedBlogs',

        created(){
            this.getCompanyRelatedBlogs();
        },
        computed:{
            ...mapState('Company',[
                'company',
            ]),
            ...mapState('Blog',[
                'companyRelatedBlogs',
            ]),
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
        methods:{
            ...mapActions('Blog',[
                'fetchCompanyRelatedBlogs',
            ]),
            getCompanyRelatedBlogs(){
                try{
                    if(this.company.id !== this.companyId)
                        this.fetchCompanyRelatedBlogs(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
                }
            }
        },
        components:{
            BlogItem
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";
    @import "~sass/variables";
    @import "~sass/mixins";
    .related-blog-card{

    }

</style>