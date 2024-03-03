<template>
    <div id="collection_set_edit">
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
                                            <h3 class="card-title text-bold">Collections Set Edit</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-4">
                                    <el-form ref="form">
                                        <el-form-item label="Please Select Occasion">
                                             <el-select v-model="form.occasion" filterable clearable placeholder="Select Occasion" @change="categoryChangeProduct">
                                                <el-option v-for="occassion in getAllOccassions" :key="occassion.id" :label="occassion.occasion_name" :value="occassion.id"></el-option>
                                            </el-select>
                                        </el-form-item>

                                        <el-form-item label="Please Select Category">
                                            <el-select v-model="form.category" filterable clearable placeholder="Select Category" @change="categoryChangeProduct">
                                                <el-option v-for="category in getAllCategories" :key="category.id" :label="category.category_name" :value="category.id"></el-option>
                                            </el-select>
                                        </el-form-item>

                                            <div class="row">
                                                <div v-for="product in getProducts.data" class="col-md-3 p-0 m-0 mainProImgDiv" :key="product.id">
                                                    <input class="productImgCheckbox" type="checkbox" :id="product.id" v-model="productIds" @click="select" :value="product.id">
                                                    <label :for="product.id">
                                                        <img width="60%" :src="`/assets/uploads/product/${product.featured_image}`" :alt="product.product_name" class="first-img" />
                                                        <p>{{ product.product_name }}</p>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <el-pagination class="text-center mt-3"
                                                    background
                                                    @current-change="paginationChange"
                                                    :current-page.sync="currentPage"
                                                    :page-size="getProducts.per_page"
                                                    layout="prev, pager, next"
                                                    :total="getProducts.total">
                                                </el-pagination>
                                            </div>
                                            <div class="text-right">
                                                <router-link :to="{name: 'collectionList'}" class="btn btn-secondary">Back</router-link>
                                                <button @click.prevent="collectionUpdateBtn" class="btn btn-primary">Save</button>
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
</template>

<script>
    import $ from 'jquery'
    export default {
        name: "CollectionSetEdit",
        data() {
            return {
                form: {
                    category: '',
                    occasion: ''
                },
                currentPage: 1,
                keyword: '',
                selected: [],
                allSelected: false,
                productIds: []
            }
        },

        methods: {
            paginationChange(){
                let payload = {'page': this.currentPage, 'occasion_id': this.form.occasion,'category_id': this.form.category}
                this.$store.dispatch('aproduct/getProductIDs', payload);
                this.$store.dispatch('aproduct/getProducts', payload);
            },
            getAllOccassion() {
                this.$store.dispatch('aoccasion/getAllOccassion')
            },
            getAllCategory(){
                this.$store.dispatch('acategory/getAllCategory');
            },
            categoryChangeProduct() {
                let payload = {'page': this.currentPage, 'occasion_id': this.form.occasion,'category_id': this.form.category}
                this.$store.dispatch('aproduct/getProductIDs', payload);
                this.$store.dispatch('aproduct/getProducts', payload);
            },
            select: function() {
                this.allSelected = false;
            },
            collectionUpdateBtn() {
                axios.post('/admin/occassion-wise-product-update', {'product_ids': this.productIds, 'occasion_id': this.form.occasion,'category_id': this.form.category})
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Product successfully added in this occassion.',
                            type: 'success'
                        });
                    }).catch((error) => {

                });
            },
        },

        computed:{
            getAllOccassions() {
                return this.$store.getters['aoccasion/getAllOccassion']
            },
            getAllCategories(){
                return this.$store.getters['acategory/getAllCategory'];
            },
            getProducts(){
                return this.$store.getters['aproduct/getAllProducts'];
            },
            getProductIds(){
                return this.$store.getters['aproduct/getAllProductIDS'];
            },
        },

        created() {
            this.getAllOccassion()
            this.getAllCategory()
            this.categoryChangeProduct()
        },
        watch: {
            getProductIds: {
                handler: function(newVal, oldVal) {
                   this.productIds = newVal;
                },
                // IF OBJECT->OBJECT (NESTED)
                deep: true
            }
        }
    }
</script>

<style scoped>

</style>
