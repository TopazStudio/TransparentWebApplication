<template>
    <el-card class="loginCard" ref="loginCard">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">LOGIN</span>
        </div>
        <el-form ref="loginForm" :model="form" :rules="rules">
            <div class="login-content">
                <el-form-item class="input-field col s12" prop="email">
                    <el-input type="email" placeholder="Email" v-model="form.authNo" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item class="input-field col s12" prop="password">
                    <el-input type="password" placeholder="Password" v-model="form.password" auto-complete="off"></el-input>
                </el-form-item>
                <div class="login-footer">
                    <el-button :plain="true" type="success"  @click="login">LOGIN</el-button>
                    <el-button :plain="true" type="danger" @click="cancel">CANCEL</el-button>
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
                    email: '',
                    password: '',
                },
                rules:{
                    authNo:[
                        { required: true, message: 'Please input your email', trigger: 'blur' },
                    ],
                    password:[
                        { required: true, message: 'Please input your password', trigger: 'blur' }
                    ]
                }
            }
        },
        methods:{
            ...mapActions('Token',[
                'attemptLogin',
            ]),
            startLoading(){
                this.$loading({
                    target: this.$refs.loginCard.$el,
                    lock: true,
                    text: "Logging In...",
                    customClass: "preLoader"
                });
            },
            stopLoading(){
                $('.preLoader').remove();
            },
            login(){
                this.startLoading();
                this.validateForm()
                    .then(()=>{
                        this.attemptLogin(this.form)
                            .then(()=>{
                                this.stopLoading();
                                this.push({ path: 'shop-management' });
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
                    this.$refs['loginForm'].validate((valid) => {
                        if (valid) resolve(); else reject();
                    })
                })
            },
            cancel(){
                this.$refs['loginForm'].resetFields();
            },
            push(location){
                this.$router.replace(location);
            }
        }
    }
</script>
<style lang="scss">
    .loginCard{
        position:relative;
        width: 400px;
        height: 300px;
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
        .login-content {
            padding: 10px;
            .login-footer {
                border-bottom-color: darkgrey;
                border-top-width: 1px;
            }
        }
    }

</style>