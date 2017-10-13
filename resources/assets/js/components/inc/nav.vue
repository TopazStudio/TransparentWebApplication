<template>
    <el-menu theme="dark" class="app-toolbar"  mode="horizontal">
        <el-menu-item index="1" class="brand">
            TRANSPARENT
        </el-menu-item>
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
                        <img :src="getImage(User.pictures[0].location)" alt="avatar" class="nav-avatar">
                        {{User.name}}
                        <i class="el-icon-caret-bottom el-icon--right"></i>
                    </div>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command="logout">Logout</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-menu-item>
        </div>
    </el-menu>
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
            getImage(src){
                if (src === undefined){
                    src = 'userPics/placeholder.png';
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

    .app-toolbar{
        height: $app-toolbar-height !important;
        .right-nav{
            float: right;
            .el-menu-item .el-dropdown{
                color: white;
            }
        }
        .nav-avatar{
            position: relative;
            border-radius: 50px;
            height: 40px;
            width: 40px;
        }
    }


</style>