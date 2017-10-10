<template>
    <el-menu theme="dark" class="app-toolbar"  mode="horizontal">
        <el-menu-item index="1" class="brand">
            TRANSPARENT
        </el-menu-item>
        <el-menu-item v-if="authenticated" index="2">Login</el-menu-item>
        <el-menu-item v-if="authenticated" index="3" @click="normalRegistration">Register</el-menu-item>
    </el-menu>
</template>
<script>
    import { mapState } from 'vuex';

    export default {
        data(){
          return{

          }
        },
        computed:{
            /*...mapState('Auth',[
                'authenticated',
            ]),*/
            authenticated(){
                return true;
            }
        },
        methods: {
            normalRegistration(){
                this.$router.replace({path: 'normal-registration'});
            }
        }
    }
</script>