<template>
    <el-card class="fly-card fly-card-plain fly-list-card" ref="reviewList">
        <!--Search Bar-->
        <div class="searchbar">
            <search-input style="width: 600px;margin: auto;"></search-input>
        </div>
        <div class="fly-card-Content" style="background: #e2e2e2;">
            <template v-for="(item,index) in Documents">
                <document-item :key="index"
                               :document="item"
                               @handleSelect="$emit('handleSelect',item)">
                </document-item>
            </template>
            <span v-if="Documents.length === 0" class="no-data">NO DOCUMENTS YET</span>

        </div>
    </el-card>
</template>
<script>
    import { mapState } from 'vuex';
    import DocumentItem from './inc/DocumentItem.vue';
    import SearchInput from '@/components/inc/SearchInput.vue';

    export default {
        computed:{
            ...mapState('Document',[
                'Documents',
            ]),
        },
        components:{
            DocumentItem,
            SearchInput
        }
    }
</script>
