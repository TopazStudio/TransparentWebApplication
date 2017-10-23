<template>
    <main id="registration" class="workspace">
        <el-row type="flex" class="formRow">
            <!--<transition
                    v-on:enter="enterWorkArea"
                    v-on:leave="leaveWorkArea"
                    appear>
                <router-view></router-view>
            </transition>-->
            <router-view></router-view>

        </el-row>
    </main>
</template>
<style lang="scss">
    #registration {
        display: flex;
        .formRow {
            flex: 1 0;
            margin: auto;
        }
    }
</style>