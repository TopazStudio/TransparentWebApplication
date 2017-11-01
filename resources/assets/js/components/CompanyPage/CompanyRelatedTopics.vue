<template>
    <el-card class="fly-card fly-info-Card" ref="companyRelatedBlogsCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">Related Topics</span>
        </div>
        <div class="fly-card-Content">
            <topic-list-item v-for="(item,index) in companyRelatedTopics"
                       :key="index"
                       :topic="item">
            </topic-list-item>
        </div>
    </el-card>
</template>
<script>
    import { mapActions,mapState } from 'vuex';

    import TopicListItem from '@/components/inc/TopicListItem.vue';

    export default {
        name: 'CompanyRelatedTopics',

        created(){
            this.getCompanyRelatedTopics();
        },
        computed:{
            ...mapState('Company',[
                'company',
            ]),
            ...mapState('Topic',[
                'companyRelatedTopics',
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
            ...mapActions('Topic',[
                'fetchCompanyRelatedTopics',
            ]),
            getCompanyRelatedTopics(){
                try{
                    if(this.company.id !== this.companyId)
                        this.fetchCompanyRelatedTopics(this.companyId);
                }catch (e){
                    this.notifyError(e);
                    this.$router.push('/404');
                }
            }
        },
        components:{
            TopicListItem
        }
    }

</script>