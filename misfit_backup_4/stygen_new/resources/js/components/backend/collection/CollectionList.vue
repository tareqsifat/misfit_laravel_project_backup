<template>
    <div id="collection_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="card-title text-bold">Collections List</h3>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-body pt-4">
                                    <el-row class="tac">
                                        <el-col :span="5">
                                            <h5>Occassions</h5>
                                            <el-menu class="el-menu-vertical-demo" style="border: none !important;" default-active="0">
                                                <el-menu-item v-for="(occassion, index) in getAllOccassions" :key="occassion.id" @click="occassionClick(occassion.id)" :index="index">
                                                    <span>{{ occassion.occasion_name }}</span>
                                                </el-menu-item>
                                            </el-menu>
                                        </el-col>

                                        <el-col :span="19" class="pl-3 collectionProductList">
                                            <div class="col-md-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" v-model="keyword" @keyup="searchProduct" class="form-control" placeholder="Search Products..." aria-label="search" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary search-button mr-3 rounded-right" @click="searchProduct" type="button">Search</button>
                                                        <el-button @click="editCollectionSet" type="primary" icon="el-icon-edit" plain size="small">Edit Set</el-button>
                                                    </div>
                                                </div>
                                            </div>

                                            <el-table ref="multipleTable" :data="products.data" style="width: 100%">
                                                <el-table-column property="product_name" label="Name" width="180"></el-table-column>
                                                <el-table-column label="Availability" width="100">
                                                    <template slot-scope="scope">
                                                        {{ productAvailability(scope.row.stock_ledger) }}
                                                    </template>
                                                </el-table-column>
                                                <el-table-column property="regular_price" label="Regular Price" width="120" show-overflow-tooltip></el-table-column>
                                                <el-table-column property="sales_price" label="Sales Price" width="120" show-overflow-tooltip></el-table-column>

                                                <el-table-column label="Visibility" width="100">
                                                    <template slot-scope="scope">
                                                        <span class="badge badge-success" v-if="scope.row.occasion_status == 1">Visible</span>
                                                        <span class="badge badge-danger" v-else>Not visible</span>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column label="Actions">
                                                    <template slot-scope="scope">
                                                        <el-button @click.prevent="occasionProductVisibility(scope.row.id, scope.row.occasion_status)" :type="scope.row.occasion_status == 1?'danger':'success'" size="mini" :icon="scope.row.occasion_status == 1?'el-icon-close':'el-icon-check'"></el-button>
                                                    </template>
                                                </el-table-column>
                                            </el-table>

                                            <el-pagination class="text-center mt-3"
                                            background
                                            @current-change="paginationChange"
                                            :current-page.sync="currentPage"
                                            :page-size="products.per_page"
                                            layout="prev, pager, next"
                                            :total="products.total">
                                            </el-pagination>
                                        </el-col>
                                    </el-row>
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
    import $ from 'jquery'
    export default {
        name: "CollectionList",
        data() {
            return {
                currentPage: 1,
                keyword: '',
                occasion_id: 1
            }
        },

        methods: {
            occassionProductList(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword, 'occasion_id': this.occasion_id}
                this.$store.dispatch('aproduct/occassionProductList', payload)
            },
            paginationChange(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword, 'occasion_id': this.occasion_id}
                this.$store.dispatch('aproduct/occassionProductList', payload)
            },
            searchProduct:_.debounce(function(){
                let payload = {'page': this.currentPage,'occasion_id': this.occasion_id , 'keyword': this.keyword}
                this.$store.dispatch('aproduct/searchOccasionProduct', payload)
            }, 1000),
            getAllOccassion() {
                this.$store.dispatch('aoccasion/getAllOccassion')
            },
            occassionClick(occasion_id) {
                this.occasion_id = occasion_id
                let payload = {'page': this.currentPage, 'occasion_id': this.occasion_id, 'keyword': this.keyword}
                this.$store.dispatch('aproduct/occassionProduct', payload)
            },
            productAvailability(products) {
                let stock_in = [];
                let stock_out = [];
                products.forEach(function(product) {
                    stock_in.push(product.stock_in)
                    stock_out.push(product.stock_out)
                });
                let stock_in_count = eval(stock_in.join('+'))
                let stock_out_count = eval(stock_out.join('+'))
                return stock_in_count-stock_out_count;
            },
            occasionProductVisibility(product_id, occasion_visibility) {
                if(occasion_visibility == 1) {
                    this.$confirm('Are you sure want to unpublish this product from occassion. Continue?', 'Warning', {
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                        }).then(() => {
                            axios.post('/admin/occassion-product-visibility', {'product_id': product_id, 'occasion_visibility': 0, 'occasion_id': this.occasion_id})
                            //axios.post('/admin/occassion-product-visibility', {'product_id': product_id, 'occasion_visibility': 0})
                                .then((result) => {
                                    this.occassionProductList()
                                    this.$message({
                                        showClose: true,
                                        message: 'Product successfully unpublish from the occassion.',
                                        type: 'success'
                                    });
                                }).catch((error) => {

                            });
                        }).catch(() => {
                            this.$message({
                                type: 'info',
                                message: 'Unpublish canceled'
                            });
                    });
                } else {
                    this.$confirm('Are you sure want to publish this product from occassion. Continue?', 'Warning', {
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                        }).then(() => {
                            axios.post('/admin/occassion-product-visibility', {'product_id': product_id, 'occasion_visibility': 1, 'occasion_id': this.occasion_id})
                            //axios.post('/admin/occassion-product-visibility', {'product_id': product_id, 'occasion_visibility': 1})
                                .then((result) => {
                                    this.occassionProductList()
                                    this.$message({
                                        showClose: true,
                                        message: 'Product successfully publish from the occassion.',
                                        type: 'success'
                                    });
                                }).catch((error) => {

                            });
                        }).catch(() => {
                            this.$message({
                                type: 'info',
                                message: 'Unpublish canceled'
                            });
                    });
                }
            },
            editCollectionSet(){
                this.$router.push({name: 'collectionSetEdit'})
            }
        },

        computed:{
            products(){
                return this.$store.getters['aproduct/getAllProducts'];
            },
            getAllOccassions() {
                return this.$store.getters['aoccasion/getAllOccassion']
            }
        },

        created() {
            this.occassionProductList()
            this.getAllOccassion()
        }
    }
</script>

<style scoped>

</style>
