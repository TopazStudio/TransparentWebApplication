<template>
    <el-card class="fly-card fly-info-Card" ref="companyDocsCard">
        <quill-editor v-model="content"
                      ref="reviewEditor"
                      :options="editorOption">
        </quill-editor>
        <div style="position: relative;
                    padding: 10px 0;
                    text-align: right;">
            <el-button plain type="danger" @click="$emit('canceled')">CANCEL</el-button>
            <el-button type="success" @click="determineMode">SUBMIT</el-button>
        </div>
    </el-card>
</template>
<script>
    import { mapState,mapActions } from 'vuex';
    import { quillEditor } from 'vue-quill-editor'
    export default {
        created(){
            this.content = this.userReview ? this.userReview.content : '';
        },
        props: ['isUpdateReview'],
        data(){
            return{
                content: '',
                editorOption: {
                    // some quill options
                }
            }
        },
        computed:{
            ...mapState('User',[
                'User',
            ]),
            ...mapState('Company',[
                'company',
            ]),
            userReview(){
                if(this.User){
                    return this.User.reviews.find((el)=>{
                        if (el) return el.company.id === this.company.id;
                    });
                }
            },
        },
        methods:{
            ...mapActions('User',[
                'updateReview',
                'addReview'
            ]),
            determineMode(){
                if(this.isUpdateReview){
                    let holder = JSON.parse(JSON.stringify(this.userReview));
                    holder.content = this.content;
                    this.updateReview(holder);
                } else this.addReview(this.content);

                this.$emit('finished');
            }
        },
        components: {
            quillEditor
        }
    }
</script>