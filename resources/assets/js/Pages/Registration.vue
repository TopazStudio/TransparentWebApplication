<template>
    <main id="registration" class="workspace">
        <el-row type="flex" class="formRow">
            <transition
                    v-on:enter="slideUpEnter"
                    v-on:leave="slideDownExit"
                    appear>
                <router-view></router-view>
            </transition>
        </el-row>
    </main>
</template>
<style lang="scss">
    #registration {
        .formRow {
            width: 100%;
        }
    }
</style>