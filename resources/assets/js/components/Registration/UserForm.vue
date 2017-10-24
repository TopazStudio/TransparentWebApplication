<template>
    <div style="
            position: relative;
            width: 100%;
            height: 100%;
            margin: 80px auto;
        ">
        <el-col :xs="24" :sm="24" :md="12" :lg="12">
            <div class="reg-promotion">

            </div>
        </el-col>

        <el-col :xs="24" :sm="24" :md="12" :lg="12">
            <el-card class="fly-card user-reg-card" ref="registerCard">
                <div slot="header" class="clearfix">
                    <span style="line-height: 36px;">SIGN UP</span>
                </div>
                <el-form ref="registerForm" :model="form" :rules="rules">
                    <div class="fly-card-content">
                        <transition
                                v-on:enter="twoPartSlideRight"
                                v-on:leave="twoPartSlideLeft">
                            <div v-if="!part2" index="1">
                                <el-form-item class="input-field col s12" prop="name">
                                    <el-input type="text" placeholder="Full name" v-model="form.name" auto-complete="off"></el-input>
                                </el-form-item>
                                <el-form-item class="input-field col s12" prop="email">
                                    <el-input type="email" placeholder="Email" v-model="form.email" auto-complete="off"></el-input>
                                </el-form-item>
                                <el-form-item class="input-field col s12" prop="password">
                                    <el-input type="password" placeholder="Password" v-model="form.password" auto-complete="off"></el-input>
                                </el-form-item>
                                <el-form-item class="input-field col s12" prop="password_confirmation">
                                    <el-input type="password" placeholder="Retype Password" v-model="form.password_confirmation" auto-complete="off"></el-input>
                                </el-form-item>
                                <div class="fly-card-footer" style="text-align: right">
                                    <el-button :plain="true" type="danger" @click="cancel">CANCEL</el-button>
                                    <el-button type="info"  @click="part2 = true" icon="d-arrow-right">NEXT</el-button>
                                </div>
                            </div>
                        </transition>
                        <transition
                                v-on:enter="twoPartSlideLeft"
                                v-on:leave="twoPartSlideRight">
                            <div v-if="part2" index="2" style="text-align: center">
                                <image-uploader @Uploaded="handleOnUploaded"></image-uploader>
                                <div class="fly-card-footer" style="text-align: left">
                                    <el-button type="danger" @click="part2 = false" icon="d-arrow-left">BACK</el-button>
                                    <el-button :plain="true" type="success"  @click="register">FINISH</el-button>
                                </div>

                            </div>
                        </transition>
                    </div>
                </el-form>
            </el-card>
        </el-col>
    </div>
</template>
<script>
    import { mapActions } from 'vuex';
    import ImageUploader from '../inc/ImageUploader.vue';

    export default{
        data(){
            return{
                form:{
                    name:'',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role: 'normal',
                    image: null
                },
                rules:{
                    name:[
                        { required: true, message: 'Please input your name', trigger: 'blur' },
                    ],
                    email:[
                        { required: true, message: 'Please input your email', trigger: 'blur' },
                    ],
                    password:[
                        { required: true, message: 'Please input your password', trigger: 'blur' }
                    ],
                    password_confirmation:[
                        { required: true, message: 'Please repeat the password', trigger: 'blur' }
                    ],
                    image:[
                        { required: false }
                    ]

                },
                part2: false,
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
                this.startLoading(this.$refs.registerCard.$el);
                this.validateForm(this.$refs.registerForm)
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
                this.$refs['registerForm'].resetFields();
            },
        },
        components:{
            ImageUploader
        }
    }
</script>
<style lang="scss">
    .user-reg-card{
        width: 400px;
        height: 400px;
        margin: auto;
    }

</style>