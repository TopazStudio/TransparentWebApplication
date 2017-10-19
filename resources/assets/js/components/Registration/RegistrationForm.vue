<template>
    <el-card class="registerCard" ref="registerCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">REGISTRATION</span>
        </div>
        <el-form ref="registerForm" :model="form" :rules="rules">
            <div class="register-content">
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
                        <div class="register-footer" style="text-align: right">
                            <el-button :plain="true" type="danger" @click="cancel">CANCEL</el-button>
                            <el-button type="info"  @click="part2 = true" icon="d-arrow-right">NEXT</el-button>
                        </div>
                    </div>
                </transition>
                <transition
                        v-on:enter="twoPartSlideLeft"
                        v-on:leave="twoPartSlideRight">
                    <div v-if="part2" index="2" style="text-align: center">
                        <el-upload
                                name="tempImage"
                                class="avatar-uploader"
                                action="http://laravel.dev/api/temp/image"
                                :headers="headers"
                                :show-file-list="false"
                                :on-success="handleSuccess"
                                :before-upload="beforeUpload">
                            <img v-if="tempImageUrl" :src="tempImageUrl" class="avatar">
                            <i ref="avatar-uploader-icon" class="el-icon-plus avatar-uploader-icon" v-else></i>
                            <div slot="tip" class="el-upload__tip">jpg/png files with a size less than 2mb</div>
                        </el-upload>
                        <div class="register-footer" style="text-align: left">
                            <el-button type="danger" @click="part2 = false" icon="d-arrow-left">BACK</el-button>
                            <el-button :plain="true" type="success"  @click="register">FINISH</el-button>
                        </div>

                    </div>
                </transition>
            </div>
        </el-form>
    </el-card>
</template>
<script>
    import { mapActions } from 'vuex';

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
                headers:{
                    'X-CSRF-TOKEN':axios.defaults.headers.common['X-CSRF-TOKEN'],
                    'X-Requested-With':axios.defaults.headers.common['X-Requested-With']
                },
                part2: false,
                tempImageUrl: '',
            }
        },
        methods:{
            ...mapActions('Auth',[
                'attemptRegistry',
            ]),

            /**
             * Store temp image so as to display in the preview while storing
             * the location in the form module which will be used to correctly
             * store the image in the appropriate place.
             *
             * @param res - response object from server
             * @param file - file object being uploaded.
             * */
            handleSuccess(res, file) {

                this.stopLoading();

                //store the temp location
                this.form.image = res.info.location;

                //store the temp url
                this.tempImageUrl = URL.createObjectURL(file.raw);

                this.$message.success('Photo uploaded successfully');
            },

            /**
             * Do a check before uploading the file.
             *
             * @param file - file object being uploaded.
             * */
            beforeUpload(file) {
                this.startLoading(this.$refs['avatar-uploader-icon'].$el);

                const isJPG = file.type === 'image/jpeg' || file.type === 'image/png';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('Avatar picture must be JPG or PNG format!');
                }
                if (!isLt2M) {
                    this.$message.error('Avatar picture size can not exceed 2MB!');
                }
                return isJPG && isLt2M;
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
        }
    }
</script>
<style lang="scss">
    .registerCard{
        position:relative;
        width: 400px;
        height: 400px;
        border-bottom-color: darkgrey;
        border-width: 1px;
        border-radius: 4px;
        .clearfix:before,
        .clearfix:after {
            display: table;
            content: "";
        }
        .clearfix:after {
            clear: both
        }
        .register-content {
            padding: 10px;
        }
    }

    .avatar-uploader .el-upload {
        border: 1px dashed #000000;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        /*margin: 20px;*/
    }
    .avatar-uploader .el-upload:hover {
        border-color: #20a0ff;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 200px;
        height: 200px;
        line-height: 200px;
        text-align: center;
    }
    .avatar {
        width: 200px;
        height: 200px;
        display: block;
    }

</style>