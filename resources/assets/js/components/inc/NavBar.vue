<template>
    <el-menu theme="dark" class="fly-nav"  mode="horizontal">
        <el-menu-item index="1" class="fly-brand">
            <router-link class="fly-brand-content" to="/">TRANSPARENT</router-link>
        </el-menu-item>
        <div class="right-nav">
            <el-dropdown v-if="!Authenticated" trigger="click" class="fly-nav-dropdown">
                <a class="fly-nav-link">Login</a>
                <el-dropdown-menu slot="dropdown">
                    <app-loginForm></app-loginForm>
                </el-dropdown-menu>
            </el-dropdown>
            <el-dropdown v-if="!Authenticated" trigger="click" :hide-on-click="true" @command="handleCommand" class="fly-nav-dropdown">
                <a class="fly-nav-link">Register</a>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item command="normalRegistration">Become a member</el-dropdown-item>
                    <el-dropdown-item command="companyRegistration">Sign up a business or company</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
            <el-dropdown v-else trigger="click" :hide-on-click="true" @command="handleCommand" class="fly-nav-dropdown">
                <div class="el-dropdown-link fly-menu-item-link">
                    <img :src="getImage()" alt="avatar" class="nav-avatar">
                </div>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item command="logout">Logout</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </el-menu>
</template>
<script>
    import { mapState } from 'vuex';
    import { mapActions } from 'vuex';
    import LoginForm from './LoginForm.vue';
    import ElButton from "../../../../../node_modules/element-ui/packages/button/src/button.vue";

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
                this.$router.push({path: '/register/user'});
            },
            companyRegistration(){
                this.$router.push({path: '/register/company'});
            },
            handleCommand(command){
                this.executeFunctionByName(command,this);
            },
            getImage(){
                let src = 'userPics/placeholder.png';

                if (this.User === undefined || this.User.pictures === undefined){
                    src = 'userPics/placeholder.png';
                }else if(this.User.pictures[0]){
                    src = this.User.pictures[0].location;
                }
                return 'http://laravel.dev/storage/' + src;
            }

        },
        components:{
            ElButton,
            'app-loginForm': LoginForm
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";
    @import "~bourbon/app/assets/stylesheets/bourbon";

    .fly-nav{
        height: $fly-navbar-height !important;
        background-color: $fly-navbar-color;
        transition: 1s all ease-out;
        z-index: 1;
        border-bottom: 1px solid black;
        .el-menu-item{
            height: $fly-navbar-height;
            line-height: $fly-navbar-height;
            color: black;
            border-bottom: 0;
        }
        .fly-brand{
            background-color: $brand-primary;
            color: white;
            position: relative;
            height: 100px;
            .fly-brand-content{
                font-family: monoton,sans-serif;
                line-height: 100px;
                font-size: 40px;
                z-index: 10;
                text-decoration: none;
            }
            &:hover{
                background-color: #000 !important;
                border-bottom: 0;
            }
            &:before{
                @include position(absolute,0);
                @include size(100%);
                content: '';
                z-index: -1;
                background-color: inherit;
                transform-origin: bottom right;
                transform: sKewX(-10deg);
            }
        }
        .right-nav{
            @include position(relative,0 20px 0 0);
            float: right;
            display: flex;
            @include size(null 100%);
            .fly-nav-dropdown{
                margin: auto;
            }
            .fly-nav-link{
                cursor: pointer;
                margin: 0 10px;
                &:hover{
                    border-bottom: 5px black;
                }
            }
        }
        .nav-avatar{
            position: relative;
            border-radius: 50px;
            height: 50px;
            width: 50px;
            margin-left: 10px;
        }
    }


</style>