<template>
    <div id="sale_by_product">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Sale By Product</h3>
                                    <div class="card-tools">
                                        <router-link :to="{name: 'adminDashboard'}" class="btn btn-default btn-sm">Back</router-link>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="sale_by_products.sale_by_products.data" style="width: 100%">
                                        <el-table-column type="index" label="SL"></el-table-column>
                                        <el-table-column property="product_name" label="Product Name"></el-table-column>
                                        <el-table-column property="total" label="Total Sale"></el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="sale_by_products.sale_by_products.per_page"
                                       layout="prev, pager, next"
                                       :total="sale_by_products.sale_by_products.total">
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
        name: "SaleByProduct",
        data() {
            return {
                currentPage: 1,
            }
        },

        methods: {
            adminSaleByProduct(){
                this.$store.dispatch('dashboard/adminSaleByProduct', this.currentPage)
            }
        },

        computed:{
            sale_by_products(){
                return this.$store.getters['dashboard/adminSaleByProduct'];
            }
        },

        created() {
            this.adminSaleByProduct();
        }
    }
</script>

<style scoped>

</style>
