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
                                            <h3 class="card-title text-bold">Add on Product</h3>
                                        </div>
                                    </div>
                                </div>

                                <!--   <el-select v-model="form.occasion" filterable clearable placeholder="Select Occasion" @change="categoryChangeProduct">
                                    <el-option v-for="occassion in getAllOccassions" :key="occassion.id" :label="occassion.occasion_name" :value="occassion.id"></el-option>
                                </el-select> -->
                                <!-- Select Product -->
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-9">

                                                <!-- <label class="typo__label">Select with search</label>
                                                <multiselect v-for="product in getAllProducts.data" :key="product.id" :value="product.id" placeholder="Select one" label="name" track-by="name"></multiselect>
                                                <span>{{ product.product_name }}</span> -->
                                            <el-form ref="form" :span="19">
                                                <el-form-item label="Please Select the Products">
                                                    <el-select v-model="form.product_id" filterable clearable placeholder="Please enter a keyword">
                                                        <el-option v-for="product in products" :key="product.id" :label="product.product_name" :value="product.id"> <span>{{ product.product_name }}</span> </el-option>
                                                        <!-- <el-pagination class="text-center mt-3"
                                                            background
                                                            @current-change="paginationChange"
                                                            :current-page.sync="currentPage"
                                                            :page-size="products.per_page"
                                                            layout="prev, pager, next"
                                                            :total="products.total"> -->
                                                        <!-- </el-pagination> -->
                                                    </el-select>
                                                </el-form-item>

                                                <el-form-item label="Please Select the Addon Products">
                                                    <div v-if="this.length">
                                                        <el-select v-model="form.addon_product" multiple filterable remote reserve-keyword placeholder="Please enter a keyword">
                                                            <el-option v-for="product in products" :key="product.id" :label="product.product_name" :value="product.id"> <span>{{ product.product_name }}</span> </el-option>
                                                        </el-select>
                                                    </div>
                                                    <div v-else>
                                                        <span>You cannot select more than 4 products</span>
                                                    </div>
                                                </el-form-item>


                                                <div class="text-right">
                                                    <router-link :to="{name: 'adminDashboard'}" class="btn btn-secondary">Back</router-link>
                                                    <button @click.prevent="addOnProduct" class="btn btn-primary">Save</button>
                                                </div>
                                            </el-form>

                                        </div>
                                    </div>

                                </div>

                                <!-- Select Product Ends -->

                                <div class="add-on-show mt-5">
                                    <h4 class="text-center mt-2 mb-2">Addon Products</h4>
                                    <div class="row">
                                        <div class="container">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Product with addon</th>
                                                        <th scope="col">action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="addon_single in addon_productList" :key="addon_single.id">
                                                        <th scope="row"><p>{{ addon_single.id }}</p></th>
                                                        <td><p>{{ addon_single.product_name }}</p></td>
                                                        <td>
                                                            <router-link class="btn btn-warning" :to="{name: 'editAddon', params: {id:addon_single.id}}">edit</router-link>
                                                            <button type="button" @click.prevent="deleteAddon(addon_single.id)" class="btn btn-danger">Delete</button>
                                                        </td>
                                                        <!-- <td><button type="button" @click.prevent="deleteAddon" class="btn btn-warning">delete</button></td> -->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
    import Multiselect from 'vue-multiselect'
    import $ from 'jquery'
    export default {
        name: "CollectionList",
         components: {
            Multiselect
        },
        data() {
            return {
                value: [],
                form: {
                    product: '',
                    addon_product: [],
                },
                length: 4,
                product: '',
                keyword: '',
                addon_productdata: []
            }
        },
        computed:{
            products(){
                return this.$store.getters['aproduct/getAllProducts'];
            },
            addon_productList() {
                return this.$store.getters['aproduct/getAddonProducts'];
            }
        },
        methods: {
            getAddonProducts() {
                this.$store.dispatch('aproduct/getAddonProducts')
            },
            searchProduct:_.debounce(function(){
                let payload = {'keyword': this.keyword}
                this.$store.dispatch('aproduct/searchAddonProduct', payload)
            }, 1000),
            getAllProducts() {
                this.$store.dispatch('aproduct/getAllProducts')
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
            selectProduct(){
                this.$store.dispatch('aproduct/getAllProducts');
            },
            addOnProduct(){
                if(this.form.addon_product.length == this.length) {
                    this.$message({
                        type: 'info',
                        message: 'You cannot add more than 4 products'
                    });
                }
                this.$confirm('Are you sure want to un publish this add on. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                    }).then(() => {
                        axios.post('/admin/product-add_on-update', {'product_id': this.form.product_id, 'add_on': this.form.addon_product})
                        .then((result) => {
                            this.$router.go()
                            this.$message({
                                showClose: true,
                                message: 'add on un published.',
                                type: 'success'
                            });
                            }).catch((error) => {
                                console.log(error)
                            });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Add on un publish canceled'
                        });
                    });

            },
            deleteAddon(id) {
                axios.post('/admin/product-add_on-delete/'+id)
                .then((result) => {
                    this.$router.go()
                    this.$message({
                        showClose: true,
                        message: 'add on product deleted.',
                        type: 'error'
                    }).catch((error) => {
                        console.log(error)
                    });


                })
            }
        },



        created() {
            this.getAllProducts();
            this.getAddonProducts();
        }
    }
</script>

<style scoped>

</style>
