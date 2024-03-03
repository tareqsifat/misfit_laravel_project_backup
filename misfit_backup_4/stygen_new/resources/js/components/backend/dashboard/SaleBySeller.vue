<template>
    <div id="sale_by_seller">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Sale By Seller</h3>
                                    <div class="card-tools">
                                        <router-link :to="{name: 'adminDashboard'}" class="btn btn-default btn-sm">Back</router-link>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="sale_by_sellers.sale_by_sellers.data" style="width: 100%">
                                        <el-table-column type="index" label="SL"></el-table-column>
                                        <el-table-column property="name" label="Seller Name"></el-table-column>
                                        <el-table-column property="total" label="Total Sale"></el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="sale_by_sellers.sale_by_sellers.per_page"
                                       layout="prev, pager, next"
                                       :total="sale_by_sellers.sale_by_sellers.total">
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
        name: "SaleBySeller",
        data() {
            return {
                currentPage: 1,
            }
        },

        methods: {
            adminSaleBySeller(){
                this.$store.dispatch('dashboard/adminSaleBySeller', this.currentPage)
            }
        },

        computed:{
            sale_by_sellers(){
                return this.$store.getters['dashboard/adminSaleBySeller'];
            }
        },

        created() {
            this.adminSaleBySeller();
        }
    }
</script>

<style scoped>

</style>
