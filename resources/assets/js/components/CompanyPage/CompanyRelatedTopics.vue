<template>
    <el-card class="fly-card fly-card-plain" ref="companyRelatedBlogsCard">
        <span class="header" style="background-color: #301AA0;">Related Topics</span>
        <div class="fly-card-Content" style="background: #e2e2e2;">
            <topic-list-item v-for="(item,index) in companyRelatedTopics"
                       :key="index"
                       :topic="item">
            </topic-list-item>
            <span v-if="companyRelatedTopics.length === 0" class="no-data">NO TOPICS YET</span>
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