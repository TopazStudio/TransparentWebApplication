<template>
    <el-menu theme="dark" class="app-toolbar"  mode="horizontal">
        <el-menu-item index="1" class="brand">
            TRANSPARENT
        </el-menu-item>
        <div class="right-nav">
            <el-menu-item v-if="!Authenticated" index="2">Login</el-menu-item>
            <el-menu-item v-if="!Authenticated" index="3" @click="normalRegistration">Register</el-menu-item>
            <el-menu-item v-else-if="Authenticated" index="3" @click="normalRegistration">LOGOUT</el-menu-item>
        </div>
    </el-menu>
</template>
<script>
    import { mapState } from 'vuex';
    import { mapActions } from 'vuex';

    export default {
        data(){
          return{

          }
        },
        computed:{
            ...mapState('Auth',[
                'Authenticated',
            ])
        },
        methods: {
            ...mapActions('Auth',[
                'logout',
            ]),
            normalRegistration(){
                this.$router.replace({path: '/register/user'});
            }
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";

    .app-toolbar{
        height: $app-toolbar-height !important;
        .right-nav{
            text-align: right;
        }
    }


</style>