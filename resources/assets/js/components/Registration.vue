<template>
    <div id="app">
        <app-nav></app-nav>
        <main id="registration">
            <el-row type="flex" justify="end" class="loginRow">
                <el-col :xs="24" :sm="24" :md="12" :lg="12">
                    <el-col :span="12" :offset="6">
                        <reg-form></reg-form>
                    </el-col>
                </el-col>
            </el-row>
        </main>
    </div>
</template>
<script>
    import Nav from './inc/nav.vue'
    import RegistrationForm from './Registration/RegistrationForm.vue';
    export default {
        components:{
            'app-nav': Nav,
            'reg-form': RegistrationForm
        }
    }
</script>
<style lang="scss">
    //noinspection CssUnknownTarget
    @import "~sass/variables";

    #registration {
        position: absolute;
        display: flex;
        top: $app-toolbar-height;
        right: 0;
        bottom: 0;
        left: 0;
        .loginRow {
            flex: 1 0;
            margin: auto;
        }
    }
</style>