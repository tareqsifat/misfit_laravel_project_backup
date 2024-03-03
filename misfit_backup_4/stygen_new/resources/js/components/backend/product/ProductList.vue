<template>
    <div id="product_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <!-- <div class="alert alert-danger" role="alert">
                                    you have {{ lowstock_data }} <router-link :to="{name: 'lowstockproduct'}">low stock</router-link> products
                                </div> -->
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
                                                <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleProductDelete">Delete All</el-button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <el-form>
                                                <el-form-item>
                                                    <el-select v-model="form.category" filterable clearable placeholder="Filter by category" @change="acategoryFilter">
                                                        <el-option v-for="category in getAllCategories" :key="category.id" :label="category.category_name" :value="category.id"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-form>
                                        </div>
                                        <div class="col-md-2">
                                            <el-form>
                                                <el-form-item>
                                                    <el-select v-model="form.seller" filterable clearable placeholder="Filter by seller" @change="asellerFilter">
                                                        <el-option v-for="seller in getAllSellers" :key="seller.id" :label="seller.name" :value="seller.id"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-form>
                                        </div>
                                        <!-- <div class="col-md-2">
                                            <el-form>
                                                <el-form-item>
                                                    <el-select v-model="form.discount" filterable placeholder="Filter by discount">
                                                        <el-option v-for="category in getAllCategories" :key="category.id" :label="category.category_name" :value="category.id"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-form>
                                        </div> -->
                                        <div class="col-md-2">
                                            <el-form>
                                                <el-form-item>
                                                    <el-select v-model="form.stock" filterable clearable placeholder="Filter by stock status" @change="proStockFilter">
                                                        <el-option label="In stock" value="in_stock"></el-option>
                                                        <el-option label="Out of stock" value="out_of_stock"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-form>
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
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <!--<el-button size="mini" icon="el-icon-search">Details</el-button>-->
                                                <a :href="'/product/'+scope.row.pro_slug" target="_blank" class="btn btn-outline-success btn-sm"><i class="el-icon-view"></i></a>
                                                <router-link :to="{name: 'editProduct', params: {id:scope.row.id}}" class="btn btn-outline-primary btn-sm"><i class="el-icon-edit"></i> Edit</router-link>
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
    </div>
</template>

<script>
    import $ from 'jquery'
    export default {
        name: "ProductList",
        data() {
            return {
                multipleSelection: [],
                form: {
                    category: '',
                    seller: '',
                    discount: '',
                    stock: ''
                },
                errors: {},
                currentPage: 1,
                uploadProductModal: false,
                product_excel: '',
                keyword: '',
                catMsg: false,
                lowstock_data: '',
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
                            axios.post('/admin/product-status-update', {'status': 0, 'product_id':product_id})
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
                            axios.post('/admin/product-status-update', {'status': 1, 'product_id':product_id})
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
            productList(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword, 'category_id': this.form.category, 'seller_id': this.form.seller, 'stock': this.form.stock}
                this.$store.dispatch('aproduct/productList', payload)
            },
            productDelete(id){
                this.$store.dispatch('aproduct/productDelete', id)
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
                let payload = {'page': this.currentPage, 'keyword': this.keyword, 'category_id': this.form.category, 'seller_id': this.form.seller, 'stock': this.form.stock}
                
                this.$store.dispatch('aproduct/productList', payload)
            },
            searchProduct:_.debounce(function(){
                this.form.category = ''
                this.form.seller = ''
                this.form.discount = ''
                this.form.stock = ''
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('aproduct/searchSellerProduct', payload)
            }, 1000),
            getAllCategory(){
                this.$store.dispatch('acategory/getAllCategory');
            },
            getAllSeller() {
                this.$store.dispatch('aseller/getAllSeller')
            },
            acategoryFilter() {
                this.keyword = ''
                let payload = {'page': this.currentPage, 'seller_id': this.form.seller, 'category_id': this.form.category, 'stock': this.form.stock}
                this.$store.dispatch('aproduct/proCatFilter', payload)
            },
            asellerFilter() {
                this.keyword = ''
                let payload = {'page': this.currentPage, 'seller_id': this.form.seller, 'category_id': this.form.category, 'stock': this.form.stock}
                this.$store.dispatch('aproduct/proSellerFilter', payload)
            },
            proStockFilter() {
                this.keyword = ''
                let payload = {'page': this.currentPage, 'seller_id': this.form.seller, 'category_id': this.form.category, 'stock': this.form.stock}
                this.$store.dispatch('aproduct/proStockFilter', payload)
                console.log(productQty);
            },

            // low_stock_count() {
            //     axios.get('/admin/low-stock-count')
            //     .then((res) => {
            //         this.lowstock_data = res.data.low_stock_count
            //     })
            // },
            calculateQty(product) {
                return product.purchase_stock_sum_qty - product.sell_stock_sum_qty
            }
        },

        computed:{
            products(){
                return this.$store.getters['aproduct/getAllProducts'];
            },
            getAllCategories(){
                return this.$store.getters['acategory/getAllCategory'];
            },
            getAllSellers() {
                return this.$store.getters['aseller/getAllSeller']
            }
        },

        created() {
            this.productList()
            this.getAllCategory()
            this.getAllSeller()
            // this.low_stock_count()
        }
    }
</script>

<style scoped>

</style>
