<template>
    <ul class="fly-nav">
        <li class="fly-brand">
            <div class="fly-brand-content">
                TRANSPARENT
            </div>
        </li>
        <div class="right-nav">
            <el-menu-item v-if="!Authenticated" index="2">
                <el-dropdown trigger="click">
                    <span class="el-dropdown-link">Login</span>
                    <el-dropdown-menu slot="dropdown">
                        <app-loginForm></app-loginForm>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-menu-item>
            <el-menu-item v-if="!Authenticated" index="3">
                <el-dropdown trigger="click" :hide-on-click="true" @command="handleCommand">
                    <span class="el-dropdown-link">Register</span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command="normalRegistration">Become a member</el-dropdown-item>
                        <el-dropdown-item command="companyRegistration">Sign up a business or company</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-menu-item>
            <el-menu-item v-else index="4">
                <el-dropdown trigger="click" :hide-on-click="true" @command="handleCommand">
                    <div class="el-dropdown-link">
                        <img :src="getImage()" alt="avatar" class="fly-nav-avatar">
                        {{User.name}}
                        <i class="el-icon-caret-bottom el-icon--right"></i>
                    </div>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command="logout">Logout</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-menu-item>
        </div>
    </ul>
</template>
<script>
    import { mapState } from 'vuex';
    import { mapActions } from 'vuex';
    import LoginForm from './LoginForm.vue';

    export default {
        data(){
            return{

            }
        },
        computed:{
            ...mapState('Auth',[
                'Authenticated',
                'User'
            ])
        },
        methods: {
            ...mapActions('Auth',[
                'logout',
            ]),
            normalRegistration(){
                this.$router.replace({path: '/register/user'});
            },
            companyRegistration(){
                this.$router.replace({path: '/register/company'});
            },
            handleCommand(command){
                this.executeFunctionByName(command,this);
            },
            getImage(){
                let src = null;
                if (this.User === undefined || this.User.pictures === undefined){
                    src = 'userPics/placeholder.png';
                }else if(this.User.pictures[0].location){
                    src = this.User.pictures[0].location;
                }
                return 'http://laravel.dev/storage/' + src;
            }

        },
        components:{
            'app-loginForm': LoginForm
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";

    .fly-nav{
        height: $app-toolbar-height !important;
        background-color: #fff;
        list-style: none;
        position: relative;
        margin: 0;
        padding-left: 0;
        .fly-brand{
            background-color: $brand-primary;
            color: white;
            position: relative;
            .fly-brand-content{
                font-family: monoton,sans-serif;
                line-height: 100px;
                font-size: 40px;
            }
        }
        .fly-brand:after{
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: inherit;
            transform-origin: top right;
            transform: sKewY(-4deg);
        }
        .right-nav{
            float: right;
            .el-menu-item .el-dropdown{
                color: white;
            }
        }
        .fly-nav-avatar{
            position: relative;
            border-radius: 50px;
            height: 40px;
            width: 40px;
        }
    }


</style>