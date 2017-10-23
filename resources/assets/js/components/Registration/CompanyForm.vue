<template>
    <el-card class="fly-card company-reg-card" ref="companyRegCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">COMPANY/BUSINESS REGISTRATION</span>
        </div>
        <div class="fly-card-content">
            <el-form ref="companyRegForm" :model="form" :rules="rules">
                <div class="form-group">
                    <el-form-item class="input-field col s12" prop="name">
                        <el-input type="text" placeholder="Business name" v-model="form.name" auto-complete="off"></el-input>
                    </el-form-item>
                    <el-form-item class="input-field col s12" prop="businessNo">
                        <el-input type="number" placeholder="Business number(optional)" v-model="form.businessNo" auto-complete="off"></el-input>
                    </el-form-item>
                    <el-form-item class="input-field col s12" prop="description">
                        <el-input type="email" placeholder="Small description of the business" v-model="form.description" auto-complete="off"></el-input>
                    </el-form-item>
                </div>
                <div class="form-group">
                    <image-uploader @Uploaded="handleOnUploaded"></image-uploader>
                </div>
                <div class="form-group" style="grid-column: 1/4;">
                    <map-component ></map-component>
                </div>
            </el-form>
            <div class="fly-card-footer" style="text-align: right">
                <el-button :plain="true" type="danger" @click="cancel">CANCEL</el-button>
                <el-button type="info"  @click="register" icon="d-arrow-right">REGISTER</el-button>
            </div>
        </div>

    </el-card>
</template>
<script>
    import { mapActions } from 'vuex';
    import ImageUploader from '../inc/ImageUploader.vue';
    import MapComponent from '../inc/Map.vue';


    export default{
        data(){
            return{
                form:{
                    name:'',
                    businessNo: '',
                    description: '',
                    latitude: '',
                    longitude: '',
                    image: null
                },
                rules:{
                    name:[
                        { required: true, message: 'Please input your name', trigger: 'blur' },
                    ],
                    description:[
                        { required: true, message: 'Please input a small description', trigger: 'blur' },
                    ],
                    latitude:[
                        { required: true, message: 'Please pin point the location of the business', trigger: 'blur' },
                    ],
                    longitude:[
                        { required: true, message: 'Please pin point the location of the business', trigger: 'blur' },
                    ],
                    image:[
                        { required: false }
                    ]

                },
            }
        },
        methods:{
            ...mapActions('Auth',[
                'attemptRegistry',
            ]),

            handleOnUploaded(url){
                this.form.image = url;
            },

            /**
             * Validate and send registration request. If valid return to
             * landing page
             * */
            register(){
                this.startLoading(this.$refs.companyRegCard.$el);
                this.validateForm(this.$refs.companyRegForm)
                    .then(()=>{
                        this.attemptRegistry(this.form)
                            .then(()=>{
                                this.stopLoading();
                                this.$router.replace({ path: 'landing-page' });
                            })
                            .catch((error)=>{
                                this.cancel();
                                this.stopLoading();
                                this.notifyError(error);
                            });
                    })
                    .catch(()=>{
                        this.stopLoading();
                        this.$message.error('Please enter valid input');
                    });
            },
            cancel(){
                this.$refs['companyRegForm'].resetFields();
            },
        },
        components:{
            ImageUploader,
            MapComponent
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .company-reg-card{
        @include size(900px null);
        margin: auto;
        .fly-card-content form{
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }
    }
</style>