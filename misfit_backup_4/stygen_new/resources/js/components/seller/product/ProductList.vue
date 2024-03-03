<template>
    <div id="product_list">
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
                                            <h3 class="card-title text-bold">Products List</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="keyword" @keyup="searchProduct" class="form-control" placeholder="Search Products..." aria-label="search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary search-button" @click="searchProduct" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <div class="card-tools">
                                                <el-button type="success" icon="el-icon-upload" plain size="small" @click="uploadProduct">Upload Product</el-button>
                                                <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleProductDelete">Delete All</el-button>
                                                <router-link :to="{name: 'productCreate'}" class="btn btn-outline-primary btn-sm"><i class="el-icon-plus"></i>  Create</router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="products.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="50"></el-table-column>
                                        <!--<el-table-column label="Date" width="120">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>-->
                                        <!--<el-table-column label="Brand" width="120">
                                            <template slot-scope="scope" v-if="scope.row.brand">{{ scope.row.brand.brand_name }}</template>
                                        </el-table-column>-->
                                        <el-table-column property="product_name" label="Name" width="180"></el-table-column>
                                        <el-table-column property="product_sku" label="SKU" width="120" show-overflow-tooltip></el-table-column>
                                        <el-table-column property="regular_price" label="Regular Price" width="120" show-overflow-tooltip></el-table-column>
                                        <el-table-column property="sales_price" label="Sales Price" width="120" show-overflow-tooltip></el-table-column>
                                        <el-table-column label="Qty" width="50" show-overflow-tooltip>
                                            <template slot-scope="scope">
                                                <p>{{ calculateQty(scope.row) }}</p>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Status" width="110">
                                            <template slot-scope="scope">
                                                <!-- <span class="badge badge-success" v-if="scope.row.status == 1">Publish</span>
                                                <span class="badge badge-danger" v-else>Un publish</span> -->
                                                <el-button @click.prevent="changePublication(scope.row.id, scope.row.status)" :type="scope.row.status == 1?'danger':'success'" size="mini" :icon="scope.row.status == 1?'el-icon-close':'el-icon-check'">{{ scope.row.status == 1?'Un publish':'Publish' }}</el-button>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Actions" width="450">
                                            <template slot-scope="scope">
                                                <!--<el-button size="mini" icon="el-icon-search">Details</el-button>-->
                                                <a :href="'/product/'+scope.row.pro_slug" target="_blank" class="btn btn-outline-success btn-sm"><i class="el-icon-view"></i></a>
                                                <!-- <router-link :to="{name: 'viewProduct', params: {id:scope.row.id}}" class="btn btn-outline-success btn-sm"><i class="el-icon-view"></i></router-link> -->
                                                <router-link :to="{name: 'duplicateProduct', params: {id:scope.row.id}}" class="btn btn-outline-warning btn-sm"><i class="el-icon-document-copy"></i> Copy</router-link>
                                                <router-link :to="{name: 'editProduct', params: {id:scope.row.id}}" class="btn btn-outline-primary btn-sm"><i class="el-icon-edit"></i> Edit</router-link>
                                                <router-link :to="{name: 'ProductStock', params: {id:scope.row.id}}" class="btn btn-outline-primary btn-sm"><i class="el-icon-box"></i> Manage stock</router-link>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="productDelete(scope.row.id)">Delete</el-button>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Upload Modal Start -->
        <el-dialog :visible.sync="uploadProductModal" width="50%">
            <span>
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="/assets/backend/excel/product_excel.xlsx" download title="Click here to sample data format file"><i class="el-icon-download"></i></a>
                    </div>
                    <div class="col-12 text-center">
                        <p class="title-text">Upload Product</p>
                        <small>Allowed file formats are: xlsx, xls, csv</small><br>
                        <small><a href="/assets/backend/excel/product_excel.xlsx" download>Click here</a> to download sample file</small><br>
                    </div>
                    <div class="col-12 text-center mt-3">
                        <form action="#" id="bulkUpFormId" method="POST">
                            <div class="fileinput_preview"></div>
                            <div class="fileinput_error mb-2">
                                <span class="text-danger" v-if="errors['product_excel']">{{ errors['product_excel'][0] }}</span>
                            </div>
                            <input type="file" @change="changeProductFile" id="upload_file" /> <br>
                            <button type="submit" class="btn btn-danger mt-3" @click.prevent="submitBulkBtn">Upload Product</button>
                        </form>
                    </div>
                </div>
            </span>
        </el-dialog>
        <!-- Product Upload Modal End -->
    </div>
</template>

<script>
    import _ from 'lodash'
    import $ from 'jquery'
    export default {
        name: "ProductList",
        data() {
            return {
                multipleSelection: [],
                form: {},
                errors: {},
                currentPage: 1,
                uploadProductModal: false,
                product_excel: '',
                keyword: ''
            }
        },

        methods: {
            toggleSelection(rows) {
                if (rows) {
                    rows.forEach(row => {
                        this.$refs.multipleTable.toggleRowSelection(row);
                    });
                } else {
                    this.$refs.multipleTable.clearSelection();
                }
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            changePublication(product_id, status){
                if(status == 1){
                    this.$confirm('Are you sure want to un publish this status. Continue?', 'Warning', {
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                        }).then(() => {
                            axios.post('/seller/product-status-update', {'status': 0, 'product_id':product_id})
                            .then((result) => {
                                this.productList();
                                this.$message({
                                    showClose: true,
                                    message: 'Status un published.',
                                    type: 'success'
                                });
                                }).catch((error) => {

                            });
                        }).catch(() => {
                            this.$message({
                                type: 'info',
                                message: 'Status un publish canceled'
                            });
                    });
                }else{
                    this.$confirm('Are you sure want to publish this status. Continue?', 'Warning', {
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                        }).then(() => {
                            axios.post('/seller/product-status-update', {'status': 1, 'product_id':product_id})
                            .then((result) => {
                                this.productList();
                                this.$message({
                                    showClose: true,
                                    message: 'Status published.',
                                    type: 'success'
                                });
                                }).catch((error) => {

                            });
                        }).catch(() => {
                            this.$message({
                                type: 'info',
                                message: 'Status publish canceled'
                            });
                    });
                }
            },
            searchProduct:_.debounce(function(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('product/searchSellerProduct', payload)
            }, 1000),
            uploadProduct(){
                this.uploadProductModal = true
            },
            changeProductFile(e){
                let file = e.target.files[0]
                this.product_excel = file
            },
            submitBulkBtn(){
                const formData = new FormData();
                formData.append("product_excel", this.product_excel);
                axios.post('/seller/product-upload', formData)
                .then((result) => {
                    this.product_excel = ''
                    this.uploadProductModal = false
                    this.productList();
                    this.$router.push({name: 'productList'})
                    this.$message({
                        showClose: true,
                        message: 'Product created successfully.',
                        type: 'success'
                    });
                }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            productList(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('product/productList', payload)
            },
            productDelete(id){
                this.$store.dispatch('product/productDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Product deleted successfully.',
                    type: 'success'
                });
            },
            multipleProductDelete(){
                axios.post('/seller/multiple-product-delete', this.multipleSelection)
                .then((result) => {
                    this.$message({
                        showClose: true,
                        message: 'Selected products deleted successfully.',
                        type: 'success'
                    });
                    this.productList();
                }).catch((error) => {

                });
            },
            paginationChange(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('product/productList', payload)
            },
            calculateQty(product) {
                return product.purchase_stock_sum_qty - product.sell_stock_sum_qty
            }
        },

        computed:{
            products(){
                return this.$store.getters['product/getAllProducts'];
            }
        },

        created() {
            this.productList();
        }
    }
</script>

<style scoped>

</style>
