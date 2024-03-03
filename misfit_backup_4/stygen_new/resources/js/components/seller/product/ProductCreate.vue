<template>
    <div id="product_create">

        <div v-if="checkoutLoader" class="loader-css"></div>

        <div class="content-wrapper product-create-area">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Product Create</h3>
                                </div>

                                <div class="card-body pt-0">
                                    <el-form ref="form" @submit.prevent="createProduct()">
                                        <el-row :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Category *">
                                                    <el-select v-model="form.category_id" multiple placeholder="Please Select Category">
                                                        <template v-for="category in categories">
                                                            <el-option :key="category.id" :label="category.category_name" :value="category.id"></el-option>
                                                            <ul v-if="category.subcategory">
                                                                <li v-for="subcategory in category.subcategory" :key="subcategory.id">
                                                                    <el-option :key="subcategory.id" :label="subcategory.category_name" :value="subcategory.id"></el-option>
                                                                    <sub-category-list :subcategories="subcategory.subcategory"></sub-category-list>
                                                                </li>
                                                            </ul>
                                                        </template>
                                                    </el-select>
                                                    <span class="text-danger" v-if="errors['category_id']">{{ errors['category_id'][0] }}</span>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Brand">
                                                    <el-select v-model="form.brand_id" placeholder="Please Select Brand">
                                                        <el-option v-for="brand in brands" :key="brand.id" :label="brand.brand_name" :value="brand.id">
                                                            <span v-if="brand.approve == 0" title="Not Approved" class="text-danger"><i class="el-icon-error"></i></span> {{ brand.brand_name }}
                                                        </el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-col>
                                        </el-row>

                                        <el-form-item label="Product Name *">
                                            <el-input v-model="form.product_name" placeholder="e.g. Angel Water Sipper"></el-input>
                                            <span class="text-danger" v-if="errors['product_name']">{{ errors['product_name'][0] }}</span>
                                        </el-form-item>

                                        <el-row :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Product SKU *">
                                                    <el-input v-model="form.product_sku" placeholder="e.g. STS-1"></el-input>
                                                    <span class="text-danger" v-if="errors['product_sku']">{{ errors['product_sku'][0] }}</span>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Quantity *">
                                                    <el-input type="number" :min="0" v-model="form.quantity" placeholder="e.g. 10"></el-input>
                                                    <span class="text-danger" v-if="errors['quantity']">{{ errors['quantity'][0] }}</span>
                                                </el-form-item>
                                            </el-col>
                                        </el-row>

                                        <el-row :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Regular Price *">
                                                    <el-input type="number" :min="1" v-model="form.regular_price" placeholder="e.g. 500"></el-input>
                                                    <span class="text-danger" v-if="errors['regular_price']">{{ errors['regular_price'][0] }}</span>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Sales Price">
                                                    <el-input type="number" v-model="form.sales_price" placeholder="e.g. 400"></el-input>
                                                </el-form-item>
                                            </el-col>
                                        </el-row>

                                        <el-row :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Gift by Occasion">
                                                    <el-select multiple v-model="form.occasion_id" placeholder="Please Select Occasion">
                                                        <el-option v-for="occasion in occasions" :key="occasion.id" :label="occasion.occasion_name" :value="occasion.id"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Recipient">
                                                    <el-select multiple v-model="form.recipient_id" placeholder="Please Select Recipient">
                                                        <el-option v-for="recipient in recipients" :key="recipient.id" :label="recipient.recipient_name" :value="recipient.id"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-col>
                                        </el-row>

                                        <el-row :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Vat (%)">
                                                    <el-input type="number" v-model="form.vat" placeholder="e.g. 2"></el-input>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                                                <el-form-item label="Shipping Method">
                                                    <el-select multiple v-model="form.shipping_charge_id" placeholder="Please Select Shipping Method">
                                                        <el-option v-for="shipping in shippings" :key="shipping.id" :label="shipping.name" :value="shipping.id"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-col>
                                        </el-row>

                                        <el-form-item label="Featured Image * (800X800)" class="image-label">
                                            <input type="file" class="form-control" @change="changeImage">
                                            <div class="mt-2">
                                                <img :src="imageShow" v-if="imageShow.length > 0" width="100" height="100" alt="">
                                            </div>
                                            <span class="text-danger" v-if="errors['featured_image']">{{ errors['featured_image'][0] }}</span>
                                        </el-form-item>

                                        <el-form-item label="Image (800X800)" class="image-label">
                                            <uploader v-model="fileList" :autoUpload="false" limit="100" title=""></uploader>
                                            <span class="text-danger" v-if="errors['images']">{{ errors['images'][0] }}</span>
                                        </el-form-item>

                                        <el-form-item>
                                            <label>YouTube Link <a href="#" @click="youtubeModalOpen"><i class="el-icon-warning"></i></a></label>
                                            <el-input v-model="form.youtube_link" placeholder="e.g. www.youtube.com"></el-input>
                                        </el-form-item>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Short Description</label>
                                                <ckeditor :editor="editor" v-model="form.short_description" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <el-row class="mb-4" :gutter="20">
                                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                                <label>Long Description</label>
                                                <ckeditor :editor="editor" v-model="form.long_description" :config="editorConfig"></ckeditor>
                                            </el-col>
                                        </el-row>

                                        <!-- Attribute Section -->
                                        <el-row :gutter="20" v-for="(input,k) in inputs" :key="k">
                                            <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6">
                                                <el-form-item label="Color">
                                                    <el-select v-model="input.color" placeholder="Please Select Color">
                                                        <el-option v-for="color in allAttributes.colors" :key="color.id" :label="color.attribute_value" :value="color.attribute_value"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6">
                                                <el-form-item label="Size">
                                                    <el-select v-model="input.size" placeholder="Please Select Size">
                                                        <el-option v-for="size in allAttributes.sizes" :key="size.id" :label="size.attribute_value" :value="size.attribute_value"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="12" :sm="12" :md="6" :lg="6" :xl="6">
                                                <el-form-item label="Weight">
                                                    <el-select v-model="input.weight" placeholder="Please Select Weight">
                                                         <el-option v-for="weight in allAttributes.weights" :key="weight.id" :label="weight.attribute_value" :value="weight.attribute_value"></el-option>
                                                    </el-select>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="12" :sm="12" :md="2" :lg="2" :xl="2">
                                                <el-form-item label="Quantity">
                                                    <el-input type="number" v-model="input.attribute_stock" placeholder="e.g. 10"></el-input>
                                                </el-form-item>
                                            </el-col>

                                            <el-col :xs="9" :sm="9" :md="4" :lg="4" :xl="4">
                                                <span>
                                                    <el-form-item class="attr-value">
                                                        <span class="mobile-screen">
                                                            <i class="el-icon-delete" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></i>
                                                            <i class="el-icon-plus" @click="add(k)" v-show="k == inputs.length-1"></i>
                                                        </span>

                                                        <span class="large-screen">
                                                            <el-button type="danger" icon="el-icon-delete" plain size="small" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></el-button>
                                                            <el-button type="success" icon="el-icon-plus" plain size="small" @click="add(k)" v-show="k == inputs.length-1"></el-button>
                                                        </span>
                                                    </el-form-item>
                                                </span>
                                            </el-col>
                                        </el-row>

                                        <el-form-item>
                                            <label>Publish</label>
                                            <el-switch v-model="status"></el-switch>
                                        </el-form-item>


                                        <el-form-item class="text-right mt-4">
                                            <router-link :to="{name: 'productList'}" class="btn btn-default">Back</router-link>
                                            <el-button type="primary" @click.prevent="createProduct()">Create</el-button>
                                        </el-form-item>
                                    </el-form>

                                    <!-- Youtube Modal Start -->
                                    <el-dialog
                                        title="YouTube Link Instruction"
                                        :visible.sync="youtubeModal"
                                        width="50%">
                                        <span>
                                            <p><b>Step 1: </b> Click share button</p>
                                            <img width="100%" class="img-thumbnail" src="/assets/frontend/img/youtube/y1.png">
                                        </span>
                                        <span>
                                            <p class="mt-3"><b>Step 2: </b> Now click Embed</p>
                                            <img width="100%" class="img-thumbnail" src="/assets/frontend/img/youtube/y2.png">
                                        </span>
                                        <span>
                                            <p class="mt-3"><b>Step 3: </b> Now, copy the link from src</p>
                                            <img width="100%" class="img-thumbnail" src="/assets/frontend/img/youtube/y3.png">
                                        </span>
                                    </el-dialog>
                                    <!-- Youtube Modal End -->
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
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import Uploader from "vux-uploader-component";
    import SubCategoryList from '../category/SubCategoryList';

    export default {
        name: "ProductCreate",
        components: {
            Uploader,
            SubCategoryList,
        },
        data() {
            return {
                form: {
                    category_id: [],
                    brand_id: '',
                    product_name:'',
                    product_sku:'',
                    regular_price:'',
                    sales_price:'',
                    quantity:'',
                    short_description:'',
                    long_description:'',
                    youtube_link: '',
                    vat: '',
                    shipping_charge_id: [],
                    occasion_id: [],
                    recipient_id: []
                },
                fileList: [],
                subcategories: [],
                errors: {},
                editor: ClassicEditor,
                editorConfig: {

                },
                attribute : {},
                attribute_message: '',
                inputs: [{
                    color: '',
                    size: '',
                    weight: '',
                    attribute_stock: ''
                }],
                featured_image:'',
                imageShow:'',
                youtubeModal: false,
                status: false,
                checkoutLoader: false,
            }
        },

        methods: {
            youtubeModalOpen(){
                this.youtubeModal = true
            },
            changeImage(e){
                this.featured_image = e.target.files[0]
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageShow = e.target.result
                };
                reader.readAsDataURL(file);
            },
            add () {
                this.inputs.push({
                    color: '',
                    size: '',
                    weight: '',
                    attribute_stock: ''
                })
            },
            remove (index) {
                this.inputs.splice(index, 1)
            },
            categoriesList(){
                this.$store.dispatch('category/categoriesList');
            },
            brandsList(){
                this.$store.dispatch('brand/brandsList')
            },
            getAllOccasion(){
                this.$store.dispatch('occasion/getAllOccasion');
            },
            getAllRecipient(){
                this.$store.dispatch('recipient/getAllRecipient');
            },
            sellerShippingList(){
                this.$store.dispatch('shipping/sellerShippingList')
            },
            createProduct(){
                let colors = [];
                let sizes = [];
                let weights = [];
                let attribute_stocks = [];
                $.each(this.inputs, function(key, value) {
                    $.each(value, function(Index, Values) {
                        if(Index == 'color') {
                            colors.push(Values);
                        }
                        if(Index == 'size') {
                            sizes.push(Values);
                        }
                        if(Index == 'weight') {
                            weights.push(Values);
                        }
                        if(Index == 'attribute_stock') {
                            attribute_stocks.push(Values);
                        }
                    });
                });
                this.checkoutLoader = true
                $('.product-create-area').css('filter','blur(2px)');

                const formData = new FormData();
                formData.append("color", JSON.stringify(colors));
                formData.append("size", JSON.stringify(sizes));
                formData.append("weight", JSON.stringify(weights));
                formData.append("attribute_stock", JSON.stringify(attribute_stocks));
                formData.append("category_id", JSON.stringify(this.form.category_id));
                formData.append("occasion_id", JSON.stringify(this.form.occasion_id));
                formData.append("recipient_id", JSON.stringify(this.form.recipient_id));
                formData.append("shipping_charge_id", JSON.stringify(this.form.shipping_charge_id));
                formData.append("brand_id", this.form.brand_id);
                formData.append("product_name", this.form.product_name);
                formData.append("product_sku", this.form.product_sku);
                formData.append("short_description", this.form.short_description);
                formData.append("long_description", this.form.long_description);
                formData.append("regular_price", this.form.regular_price);
                formData.append("sales_price", this.form.sales_price);
                formData.append("quantity", this.form.quantity);
                formData.append("youtube_link", this.form.youtube_link);
                formData.append("vat", this.form.vat);
                formData.append("status", this.status);
                formData.append("featured_image", this.featured_image);
                for (let i = 0; i < this.fileList.length; i++) {
                    formData.append("images["+ i +"]", this.fileList[i].blob);
                }
                axios.post('/seller/product', formData)
                .then((result) => {
                    this.checkoutLoader = false
                    $('.product-create-area').css('filter','none');
                    this.$router.push({name: 'productList'})
                    this.$message({
                        showClose: true,
                        message: 'Product created successfully.',
                        type: 'success'
                    });
                }).catch((error) => {
                    this.checkoutLoader = false
                    $('.product-create-area').css('filter','none');
                    this.errors = error.response.data.errors
                });
            },
            getAttributes(){
                this.$store.dispatch('attribute/getAttributes')
            }
        },

        computed:{
            categories(){
                return this.$store.getters['category/getAllCategories'];
            },
            brands(){
                return this.$store.getters['brand/getAllBrands'];
            },
            occasions(){
                return this.$store.getters['occasion/getAllOccasion']
            },
            recipients(){
                return this.$store.getters['recipient/getAllRecipient']
            },
            allAttributes(){
                return this.$store.getters['attribute/getAttributes'];
            },
            shippings(){
                return this.$store.getters['shipping/sellerShippingList'];
            }
        },

        created(){
            this.categoriesList();
            this.brandsList();
            this.getAttributes();
            this.sellerShippingList();
            this.getAllOccasion();
            this.getAllRecipient();
        }
    }
</script>

<style scoped>

</style>
