<template>
    <div id="subscribe">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Subscribe List</h3>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="subscribes.data" style="width: 100%">
                                        <el-table-column label="Date">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="subscribe_email" label="Subscribe Email"></el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="subscribes.per_page"
                                       layout="prev, pager, next"
                                       :total="subscribes.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Subscribe',
        data() {
            return {
                currentPage: 1,
            }
        },

        methods: {
            subscribeList(){
                this.$store.dispatch('admin/subscribeList', this.currentPage)
            },
            paginationChange(){
                this.$store.dispatch('admin/subscribeList', this.currentPage)
            }
        },

        computed:{
            subscribes(){
                return this.$store.getters['admin/subscribeList'];
            }
        },

        created() {
            this.subscribeList();
        }
    }
</script>

<style scoped>

</style>
