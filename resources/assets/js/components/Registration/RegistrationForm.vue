<template>
    <el-card class="registerCard" ref="registerCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">REGISTRATION</span>
        </div>
        <el-form ref="registerForm1" :model="form" :rules="rules">
            <div class="register-content">
                <div id="reg-part1">
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
                    <div class="register-footer">
                        <el-button :plain="true" type="danger" @click="cancel">CANCEL</el-button>
                        <el-button :plain="true" type="success"  @click="goForward" icon="d-arrow-right">NEXT</el-button>
                    </div>
                </div>
                <div class="reg-part2" v-if="part2">
                    <div class="photo-view">
                        <!--TODO: Upload and show preview of photo-->
                    </div>
                    <el-form-item class="input-field col s12" prop="image">
                        <el-input type="file" placeholder="Your photo" v-model="form.image" auto-complete="off"></el-input>
                    </el-form-item>
                    <div class="register-footer">
                        <el-button :plain="true" type="danger" @click="goBack">BACK</el-button>
                        <el-button :plain="true" type="success"  @click="register">SIGN UP</el-button>
                    </div>
                </div>
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
                    image: ''
                },
                part2: false,
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
                    ]
                }
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
                    text: "Logging In...",
                    customClass: "preLoader"
                });
            },
            stopLoading(){
                $('.preLoader').remove();
            },
            goForward(){
                //TODO: slide reg-part2 in
            },
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
                                    message: error.toString(),
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
            goBack(){
                //TODO: slide reg-part1 in
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
        opacity: 0.8;
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
            .register-footer {
                border-bottom-color: darkgrey;
                border-top-width: 1px;
            }
        }
    }

</style>