<template>
    <div id="product_create">

        <!-- <div v-if="checkoutLoader" class="loader-css"></div> -->

        <div class="content-wrapper product-create-area">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Product Stock update</h3>
                                </div>

                                <div class="card-body pt-0">
                                    <el-form>
                                        <el-form-item label="Product">
                                            <el-input :value="product_details.product_name" disabled></el-input>
                                            <!-- <span class="text-danger" v-if="errors['brand_name']">{{ errors['brand_name'][0] }}</span> -->
                                        </el-form-item>

                                        <el-form-item label="Current Stock">
                                            <el-input :value="product_details.purchase_stock_sum_qty - product_details.sell_stock_sum_qty" disabled ></el-input>
                                            <!-- <span class="text-danger" v-if="errors['brand_name']">{{ errors['brand_name'][0] }}</span> -->
                                        </el-form-item>

                                        <el-form-item label="Type *">
                                            <el-select v-model="form.type" filterable clearable placeholder="Select stock type">
                                                <el-option v-for="(label, value) in stock_type" :key="value" :label="value" :value="label">
                                                <span>{{ value }}</span>
                                                </el-option>
                                            </el-select>
                                        </el-form-item>

                                        <el-form-item label="Quantity *">
                                            <el-input v-model="form.quantity" type="number"></el-input>
                                            <!-- <span class="text-danger" v-if="errors['brand_website']">{{ errors['brand_website'][0] }}</span> -->
                                        </el-form-item>

                                        <el-form-item class="text-right mt-4">
                                            <router-link :to="{name: 'productList'}" class="btn btn-default">Back</router-link>
                                            <el-button type="primary" @click.prevent="updateStock()">Create</el-button>
                                        </el-form-item>
                                    </el-form>
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
                product_details: '',
                stock_type: {
                    increase: 'purchase',
                    decrease: 'sell'
                },
                form: {
                    type: '',
                    quantity: 0,
                    product_id: this.$route.params.id
                },
            }
        },
        computed:{
            products(){
                // console.log(this.productList());
                return this.$store.dispatch('product/AllSellerProductList');

            },
        },
        methods: {
            getProductDetails(){
                // let product_id = this.$route.params.id
                axios.get(`/seller/product/${this.$route.params.id}/edit`)
                .then((result) => {
                    this.product_details = result.data.product

                }).catch((error) => {
                    console.log(error);
                });
            },

            updateStock(){
                if(this.form.type == null || this.form.type == '') {
                    return this.$message({
                        showClose: true,
                        message: 'type is required',
                        type: 'error'
                    });
                }
                if(this.form.quantity == null || this.form.quantity == '') {
                    return this.$message({
                        showClose: true,
                        message: 'quantity is required',
                        type: 'error'
                    });
                }
                axios.post(`/seller/product-stock-update`, this.form)
                .then((result) => {
                    this.$message({
                        showClose: true,
                        message: 'Product stock updated successfully.',
                        type: 'success'
                    });
                    this.getProductDetails();
                }).catch((error) => {
                    console.log(error);
                    this.$message({
                        showClose: true,
                        message: 'Something went wrong.',
                        type: 'error'
                    });
                });
            },
        },



        created() {
            this.getProductDetails();
            // console.log(this.$store.dispatch('product/AllSellerProductList'));
        }
    }
</script>

<style scoped>

</style>
