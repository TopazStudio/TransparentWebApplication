<template>
    <el-row :span="24">
        <el-table
                ref="documentTable"
                class="fly-document-table"
                max-height="750"
                style="width: 100%"
                border
                :data="Documents"
                :row-class-name="rowClassName"
                :default-sort = "defaultSort"
                highlight-current-row
                empty-text="No Documents Available"
                @current-change="handleCurrentChange">
            <el-table-column
                    label="DOCUMENTS"
                    width="100%">
                <el-table-column
                        v-if="onDetails"
                        type="expand">
                    <template scope="props">
                        <!--TEMPLATE-->
                    </template>
                </el-table-column>
                <el-table-column
                        type="index"
                        fixed="true"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="Name"
                        sortable="true"
                        fixed="true"
                        width="200">
                </el-table-column>
                <el-table-column
                        prop="description"
                        label="Description"
                        width="300"
                        show-overflow-tooltip>
                </el-table-column>
                <el-table-column
                        prop="size"
                        label="Size"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="type"
                        label="Type"
                        width="100">
                </el-table-column>
                <el-table-column
                        v-if="onTags"
                        label="Tags"
                        width="300">
                    <template scope="scope">
                        <!--TAGS-->
                        <el-tag :type="onTagType(scope)">{{scope.row.tag}}</el-tag>
                    </template>
                </el-table-column>
            </el-table-column>
        </el-table>
    </el-row>
</template>
<script>
    import { mapState,mapActions } from 'vuex';
    export default {
        created(){

        },
        data(){
            return{
                currentRow: '',
                defaultSort: {prop: 'name', order: 'ascending'},
                onDetails: false,
                onTags:false
            }
        },
        computed:{
            ...mapState('Document',[
                'Documents',
            ]),
        },
        methods:{
            handleCurrentChange(currentRow, oldCurrentRow){
                this.currentRow = currentRow;
            },
            onTagType(scope){
                if (scope.row.tag === 'new'){
                    return 'success';
                }else if(scope.row.tag === 'deleted'){
                    return 'danger';
                }else if(scope.row.tag === 'updated'){
                    return 'info';
                }
            },
            rowClassName(row,index){
                if (row.tag === 'new'){
                    return 'newRow';
                }else if(row.tag === 'deleted'){
                    return 'delRow';
                }else if(row.tag === 'updated'){
                    return 'updatedRow';
                }
            },
        },
    }
</script>
<style lang="scss">
    .fly-document-table{
        .el-table{
            th, thead div{
                background-color: #eef1f6;
            }
            .newRow{
                background: rgba(255, 255, 0, 0.4);
                color: black;
                td{
                    border-right-width: 0;
                    border-left-width: 0;
                }
            }
            .newRow:hover,
            .newRow .current-row{
                background: rgba(255, 255, 0, 0.3);
            }
            .delRow{
                background: rgba(255, 0, 0, 0.4);
                color: white;
                td{
                    border-right-width: 0;
                    border-left-width: 0;
                }
            }
            .delRow:hover,
            .delRow .current-row{
                background: rgba(255, 0, 0, 0.31);
            }
            .updatedRow{
                background: rgba(128, 0, 128, 0.4);
                color: white;
                td{
                    border-right-width: 0;
                    border-left-width: 0;
                }
            }
            .updatedRow:hover,
            .updateRow .current-row{
                background: rgba(128, 0, 128, 0.31);
            }
        }
    }

</style>