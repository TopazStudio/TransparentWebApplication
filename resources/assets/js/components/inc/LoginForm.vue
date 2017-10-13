<template>
    <div class="loginCard" ref="loginCard">
        <el-form ref="loginForm" :model="form" :rules="rules">
            <div class="login-content">
                <el-form-item class="input-field col s12" prop="email">
                    <el-input type="email" placeholder="Email" v-model="form.email" auto-complete="off"></el-input>
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
    </div>
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
                    email:[
                        { required: true, message: 'Please input your email', trigger: 'blur' },
                    ],
                    password:[
                        { required: true, message: 'Please input your password', trigger: 'blur' }
                    ]
                }
            }
        },
        methods:{
            ...mapActions('Auth',[
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
        .login-content {
            padding: 10px;
            .login-footer {
                text-align: center;
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    }

</style>