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
                                            <h3 class="card-title text-bold">Add on Product Edit</h3>
                                        </div>
                                    </div>
                                </div>

                                <!--   <el-select v-model="form.occasion" filterable clearable placeholder="Select Occasion" @change="categoryChangeProduct">
                                    <el-option v-for="occassion in getAllOccassions" :key="occassion.id" :label="occassion.occasion_name" :value="occassion.id"></el-option>
                                </el-select> -->
                                <!-- Select Product -->
                                <div class="container mb-4">
                                    <div class="row">
                                        <div class="col-md-9">

                                                <!-- <label class="typo__label">Select with search</label>
                                                <multiselect v-for="product in getAllProducts.data" :key="product.id" :value="product.id" placeholder="Select one" label="name" track-by="name"></multiselect>
                                                <span>{{ product.product_name }}</span> -->



                                            <el-form ref="form" :span="19">
                                                <el-form-item class="mt-3" label="Selected Product">
                                                    <el-select class="mb-2" v-model="addon_productList.products[0].product_name" disabled placeholder="Select"></el-select>
                                                </el-form-item>

                                                <!-- <el-collapse-item name="1" accordion>
                                                    <template slot="title">
                                                        Selected Addon Product<i class="header-icon el-icon-info"></i>
                                                        </template>
                                                         -->

                                                <div class="card">
                                                    <el-collapse accordion class="mb-2 ml-5">
                                                        <el-collapse-item title="Selected Addon Products >" name="1">
                                                            <div v-for="selected_addon in addon_productList.addon_product_name" :key="selected_addon.id">{{ selected_addon.product_name }}, </div>
                                                        </el-collapse-item>
                                                    </el-collapse>
                                                </div>

                                                <el-form-item label="Update the Addon Products">

                                                    <div v-if="this.length">
                                                        <el-select v-model="form.addon_product" multiple filterable remote reserve-keyword placeholder="Please enter a keyword">
                                                            <el-option v-for="product in products" :key="product.id" :label="product.product_name" :value="product.id" selected> <span>{{ product.product_name }}</span> </el-option>
                                                        </el-select>
                                                    </div>
                                                    <div v-else>
                                                        <span>You cannot select more than 4 products</span>
                                                    </div>
                                                </el-form-item>


                                                <div class="text-right">
                                                    <router-link :to="{name: 'addonProduct'}" class="btn btn-secondary">Back</router-link>
                                                    <button @click.prevent="updateAddon" class="btn btn-primary">Save</button>
                                                </div>
                                            </el-form>

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
                addon_productList: []
            }
        },
        computed:{
            products(){
                return this.$store.getters['aproduct/getAllProducts'];
            },
        },
        methods: {
            addonProductList() {
                let payload = {'keyword': this.keyword}
                this.$store.dispatch('aproduct/addonProductList', payload)
            },
            searchProduct:_.debounce(function(){
                let payload = {'keyword': this.keyword}
                this.$store.dispatch('aproduct/searchAddonProduct', payload)
            }, 1000),
            getAllProducts() {
                this.$store.dispatch('aproduct/getAllProducts')
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
            selectProduct(){
                this.$store.dispatch('aproduct/getAllProducts');
            },
            updateAddon(){
                var id = location.href.split('/')[5]
                if(this.form.addon_product.length == this.length) {
                    this.$message({
                        type: 'info',
                        message: 'You cannot add more than 4 products'
                    });
                }
                this.$confirm('Are you sure want to update this add on. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                    }).then(() => {
                        axios.post('/admin/product-add_on-edit/'+id, {'add_on': this.form.addon_product})
                        .then((result) => {
                            this.$router.push('/admin/addonProducts');
                            this.$message({
                                showClose: true,
                                message: 'add on updated successfully.',
                                type: 'success'
                            });
                            }).catch((error) => {
                                console.log(error)
                            });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Add on publish canceled'
                        });
                    });

            },
            // editAddon(id){
            //     this.$router.push({name: 'editAddon'}, params, {id:id})
            // },
            showAddonProducts(){
                var id = location.href.split('/')[5]
                axios.get(`/admin/show-addon-products/${id}`)
                .then((res) => {
                    this.addon_productList = res.data
                    console.log(addon_productList);
                }).catch((error) => {

                });
            }
        },
        created() {
            this.getAllProducts();
            this.showAddonProducts();
        }
    }
</script>
