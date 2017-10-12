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
                            <el-button type="info"  @click="goForward" icon="d-arrow-right">NEXT</el-button>
                        </div>
                    </div>
                </transition>
                <transition
                        v-on:enter="twoPartSlideLeft"
                        v-on:leave="twoPartSlideRight">
                    <div v-if="part2" index="2" style="text-align: center">
                        <el-upload
                                class="avatar-uploader"
                                :action="actionUrl"
                                :show-file-list="false"
                                :on-success="handleAvatarSuccess"
                                :before-upload="beforeAvatarUpload">
                            <img v-if="tempImageUrl" :src="tempImageUrl" class="avatar">
                            <i class="el-icon-plus avatar-uploader-icon" v-else></i>
                        </el-upload>
                        <div class="register-footer" style="text-align: left">
                            <el-button type="danger" @click="goBack" icon="d-arrow-left">BACK</el-button>
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
        created(){
            this.actionUrl = 'https://laravel.dev/api/user/avatar';
        },
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
                tempImageUrl: '',
                actionUrl: ''
            }
        },
        methods:{
            ...mapActions('Auth',[
                'attemptRegistry',
            ]),
            startLoading(){
                this.$loading({
                    target: this.$refs.registerCard.$el,
                    lock: true,
                    text: "Please Wait...",
                    customClass: "preLoader"
                });
            },
            stopLoading(){
                $('.preLoader').remove();
            },

            //Uploading Avatar
            handleAvatarSuccess(res, file) {
                //store the temp location
                this.form.image = res.data.info.location;

                //store the temp url
                this.tempImageUrl = URL.createObjectURL(file.raw);
            },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('Avatar picture must be JPG format!');
                }
                if (!isLt2M) {
                    this.$message.error('Avatar picture size can not exceed 2MB!');
                }
                return isJPG && isLt2M;
            },

            //Navigation
            goForward(){
                this.part2 = true;
            },
            goBack(){
                this.part2 = false;
            },

            //Form
            register(){
                this.startLoading();
                this.validateForm()
                    .then(()=>{
                        this.attemptRegistry(this.form)
                            .then(()=>{
                                this.stopLoading();
                                this.push({ path: 'landing-page' });
                            })
                            .catch((error)=>{
                                this.cancel();
                                this.stopLoading();
                                this.$notify.error({
                                    title: 'AN ERROR OCCURED',
                                    message: error.response.data.message,
                                    duration: 0
                                });
                            });
                    })
                    .catch(()=>{
                        this.stopLoading();
                        this.$message.error('Please enter valid input');
                    });
            },
            validateForm(){
                return new Promise((resolve,reject) =>{
                    this.$refs['registerForm'].validate((valid) => {
                        if (valid) resolve(); else reject();
                    })
                })
            },
            cancel(){
                this.$refs['registerForm'].resetFields();
            },
            push(location){
                this.$router.replace(location);
            }
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
        margin: 20px;
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