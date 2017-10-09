<template>
    <el-menu theme="dark" class="app-toolbar"  mode="horizontal">
        <el-menu-item index="1" class="brand">
            TRANSPARENT
        </el-menu-item>
        <el-menu-item index="2" @click="normalRegistration">Login</el-menu-item>
        <el-menu-item index="2">Register</el-menu-item>
    </el-menu>
</template>
<script>
    export default {
        methods: {
            normalRegistration(){
                this.$router.replace('normal-registration');
            }
        }
    }
</script>