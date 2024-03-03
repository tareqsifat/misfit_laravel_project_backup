<template>
    <div id="brand_product">
        <div class="shop-area container occasionShop">
            <div class="main-design">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <product-sidebar></product-sidebar>
                    </div>
                    <div class="col-lg-9 order-2 order-lg-1">
                        <div class="shop-layout">
                            <!--Grid & List View Start-->
                            <div class="shop-topbar-wrapper mb-30 d-md-flex justify-content-md-between align-items-center">
                                <div class="grid-list-option">
                                    <ul class="nav">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#grid"><i class="ion-grid show_grid"></i></a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#list"><i class="ion-android-menu show_list"></i></a>
                                        </li>
                                    </ul>
                                    <p class="show-product">Showing {{ products.total }} results</p>
                                </div>
                                <!--Toolbar Short Area Start-->
                                <!-- <div class="toolbar-short-area d-md-flex align-items-center">
                                    <div class="toolbar-shorter">
                                        <label>Sort By:</label>
                                        <select class="productSorting" v-on:change="productSorting($event)">
                                            <option value="">Default sorting</option>
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="avg_rating">Sort by average rating</option>
                                            <option value="latest">Sort by latest</option>
                                            <option value="low_to_high">Sort by price: low to high</option>
                                            <option value="high_to_low">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </div> -->
                                <!--Toolbar Short Area End-->
                            </div>
                            <!--Grid & List View End-->

                            <!--Shop Product Start-->
                            <div class="shop-product">
                                <div id="myTabContent-2" class="tab-content">
                                    <div id="grid" class="tab-pane fade show active">
                                        <div class="product-grid-view">
                                            <div class="row" v-if="products.data && products.data.length > 0">
                                                <div class="col-lg-4 col-xl-4 col-md-4 mb-3" v-for="product in products.data" :key="product.id">
                                                    <!--Single Product Start-->
                                                    <div class="single-product mb-3 shop-product-single">
                                                        <div class="product-img">
                                                            <router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}">
                                                                <template v-if="product.featured_image != ''">
                                                                    <img class="first-img" :src="`/assets/uploads/product/${product.featured_image}`" :alt="product.product_name" lazy="loading">
                                                                    <img class="hover-img" :src="`/assets/uploads/product/${product.featured_image}`" :alt="product.product_name" lazy="loading">
                                                                </template>
                                                                <template v-else>
                                                                    <img class="first-img" src="/assets/frontend/img/icon/empty_product.jpeg" lazy="loading">
                                                                </template>
                                                            </router-link>
                                                            <span class="sticker" v-if="discount_percentage(product.regular_price, product.sales_price)">{{ discount_percentage(product.regular_price, product.sales_price) }}</span>
                                                            <div class="product-action">
                                                                <ul>
                                                                    <li v-if="product.product_variations && product.product_variations.length > 0"><router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}"><i class="ion-settings"></i></router-link></li>
                                                                    <!-- <li v-else><a href="#" @click.prevent="addToCart(product)"><i class="ion-bag"></i></a></li> -->
                                                                    <li><a @click.prevent="quickView(product, product.featured_image, product.product_variations)" href="#open-modal" data-toggle="modal"><i class="ion-eye"></i></a></li>
                                                                    <!-- <li><a href="#" @click.prevent="addToWishlist(product)"><i class="ion-heart"></i></a></li> -->
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4><router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}">{{ product.product_name }}</router-link></h4>
                                                            <div class="product-price">
                                                                <span class="price" v-if="product.sales_price"><del>৳{{ product.regular_price | numFormat }}</del> ৳{{ product.sales_price | numFormat }}</span>
                                                                <span class="price" v-else>৳{{ product.regular_price | numFormat }}</span>
                                                                <div class="pro-action-btn">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="d-inline-flex justify-content-between mt-3">
                                                                                <div class="col-md-6 col-sm-6">
                                                                                    <!-- <span v-if="product.product_variations && product.product_variations.length > 0"><router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}"><i class="ion-settings"></i></router-link></span> -->
                                                                                    <span v-if="product.product_variations && product.product_variations.length > 0"><a class="btn btn-primary btn-sm pl-2 detailsbtn"><router-link class="detailsbtn" :to="{name: 'singleProduct', params: {slug:product.pro_slug}}">select variant</router-link></a></span>
                                                                                    <span v-else><a href="#" @click.prevent="addToCart(product)" class="btn btn-primary btn-sm pr-2 addtocart"><i class="ion-bag"></i>Add to cart</a></span>
                                                                                </div>
                                                                                <div class="col-md-6 col-sm-6">
                                                                                    <span><a class="btn btn-primary btn-sm pl-2 detailsbtn"><router-link class="detailsbtn" :to="{name: 'singleProduct', params: {slug:product.pro_slug}}">Details</router-link></a></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-reviews d-flex justify-content-center mt-0">
                                                                <div class="show-rating">
                                                                    <star-rating v-if="product.average_ratting" :rating="product.average_ratting" :show-rating="false" :read-only="true" :increment="0.01"></star-rating>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Single Product End-->
                                                </div>
                                            </div>

                                            <div class="row text-center p-5" v-else>
                                                <div class="col-md-12 text-center pl-5 pr-5 productEmtpyMsgBack">
                                                    <p class="mt-3 text-white">We can't find the products matching the selection</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="list" class="tab-pane fade">
                                        <div class="product-list-view">
                                            <div class="product-list-item mb-3" v-for="product in products.data" :key="product.id">
                                                <div class="row shop-list-product-single">
                                                    <!--Single List Product Start-->
                                                    <div class="col-md-4">
                                                        <div class="single-product">
                                                            <div class="product-img">
                                                                <router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}">
                                                                    <template v-if="product.featured_image != ''">
                                                                        <img class="first-img" :src="`/assets/uploads/product/${product.featured_image}`" :alt="product.product_name">
                                                                        <img class="hover-img" :src="`/assets/uploads/product/${product.featured_image}`" :alt="product.product_name">
                                                                    </template>
                                                                    <template v-else>
                                                                        <img class="first-img" src="/assets/frontend/img/icon/empty_product.jpeg">
                                                                    </template>
                                                                </router-link>
                                                                <span class="sticker" v-if="discount_percentage(product.regular_price, product.sales_price)">{{ discount_percentage(product.regular_price, product.sales_price) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="product-content shop-list">
                                                            <h4><router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}">{{ product.product_name }}</router-link></h4>
                                                            <div class="product-price">
                                                                <span class="price" v-if="product.sales_price"><del>৳{{ product.regular_price | numFormat }}</del> ৳{{ product.sales_price | numFormat }}</span>
                                                                <span class="price" v-else>৳{{ product.regular_price | numFormat }}</span>
                                                            </div>
                                                            <div class="product-reviews d-flex justify-content-center mt-0">
                                                                <div class="show-rating">
                                                                    <star-rating v-if="product.average_ratting" :rating="product.average_ratting" :show-rating="false" :read-only="true" :increment="0.01"></star-rating>
                                                                </div>
                                                            </div>
                                                            <div class="product-description">
                                                                <p><span v-html="product.short_description"></span></p>
                                                            </div>
                                                            <div class="product-list-action">
                                                                <ul>
                                                                    <li v-if="product.product_variations && product.product_variations.length > 0"><router-link class="pro-add-btn" :to="{name: 'singleProduct', params: {slug:product.pro_slug}}"><i class="ion-settings"></i>Details</router-link></li>
                                                                    <li v-else><a class="pro-add-btn" href="#" @click.prevent="addToCart(product)"><i class="ion-bag"></i>Add to cart</a></li>
                                                                    <li><a @click.prevent="quickView(product, product.featured_image, product.product_variations)" href="#open-modal" data-toggle="modal"><i class="ion-eye"></i></a></li>
                                                                    <li><a href="#" @click.prevent="addToWishlist(product)"><i class="ion-heart"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Single List Product End-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--Shop Product End-->

                            <!--Pagination Start-->
                            <div class="pagination-product d-md-flex justify-content-md-between align-items-center">
                                <!--<div class="showing-product">
                                    <p> Showing 1-10 of 15 item(s) </p>
                                </div>-->
                                <div class="paginationSection page-list shop-paginate">
                                    <el-pagination class="text-center mt-3 desktopViewPagination"
                                        background
                                        @current-change="paginationChange"
                                        :current-page.sync="currentPage"
                                        :page-size="products.per_page"
                                        layout="prev, pager, next"
                                        :total="products.total">
                                    </el-pagination>

                                    <el-pagination class="mobileViewPagination"
                                        small
                                        @current-change="paginationChange"
                                        :current-page.sync="currentPage"
                                        layout="prev, pager, next"
                                        :total="products.total">
                                    </el-pagination>
                                </div>
                            </div>
                            <!--Pagination End-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Cart Modal Start -->
        <div class="modal fade" id="open-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!--Modal Img-->
                            <div class="col-md-5">
                                <div class="single-product-img img-full">
                                    <template v-if="product.featured_image != ''">
                                        <img class="first-img" :src="`/assets/uploads/product/${product_image}`" :alt="product.product_name">
                                    </template>
                                    <template v-else>
                                        <img class="first-img" src="/assets/frontend/img/icon/empty_product.jpeg">
                                    </template>
                                </div>
                            </div>
                            <!--Modal Img-->
                            <!--Modal Content-->
                            <div class="col-md-7">
                                <div class="single-product-content">
                                    <h1 class="single-product-name mb-0">{{ product.product_name }}</h1>
                                    <div class="single-product-reviews">
                                        <div class="show-rating">
                                            <star-rating v-if="product.average_ratting" :rating="product.average_ratting" :show-rating="false" :read-only="true" :increment="0.01"></star-rating>
                                        </div>
                                    </div>
                                    <div class="single-product-price">
                                        <div class="product-discount">
                                            <span class="regular-price" v-if="product.sales_price"><del>৳{{ product.regular_price | numFormat }}</del><span class="price">৳{{ product.sales_price | numFormat }}</span></span>
                                            <span class="price" v-else>৳{{ product.regular_price | numFormat }}</span>
                                            <!--<span class="discount">-20%</span>-->
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <p v-if="product.short_description && product.short_description != 'null'"><span v-html="product.short_description"></span></p>
                                        <p class="mt-0 single-product-info" v-if="product.product_sku && product.product_sku != 'null'"><b>SKU:</b> {{ product.product_sku }}</p>
                                        <p class="mt-0 single-product-info" v-if="product.brand"><b>Brand:</b> {{ product.brand.brand_name }}</p>
                                    </div>

                                    <div class="single-product-action">
                                        <form action="#">
                                            <span v-if="product_variations && product_variations.length > 0">
                                                <!-- Attribute Color Section Start -->
                                                <div class="product-opts attribute-section" v-if="all_attributes.color_count > 0">
                                                    <template >
                                                        <div class="product-opt-title">
                                                            Color
                                                        </div>

                                                        <div class="product-opt">
                                                            <div class="product-opt-col">
                                                                <div class="form-check-inline">
                                                                    <div class="attribute cf">
                                                                        <section class="plan cf">
                                                                            <span v-for="(color, index) in all_attributes.colors" :key="color.color">
                                                                                <span>
                                                                                    <input  type="radio" class="colorCls" v-model="form.color" :id="'color'+index" data-attr="Color" :value="color.color">
                                                                                    <label :style="'background:'+color.color_code" class="free-label four col" :for="'color'+index" :title="color.color"></label>
                                                                                </span>
                                                                            </span>
                                                                        </section>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger" v-if="color_msg">Please select color</span>
                                                    </template>
                                                </div>
                                                <!-- Attribute Color Section End -->

                                                <!-- Attribute Size Section Start -->
                                                <div class="product-opts attribute-section"  v-if="all_attributes.size_count > 0">
                                                    <template >
                                                        <div class="product-opt-title">
                                                            Size
                                                        </div>

                                                        <div class="product-opt">
                                                            <div class="product-opt-col">
                                                                <div class="form-check-inline">
                                                                    <div class="attribute cf">
                                                                        <section class="plan cf">
                                                                            <span v-for="(size, index) in all_attributes.sizes" :key="size.size">
                                                                                <span>
                                                                                    <input  type="radio" class="colorCls" v-model="form.size" :id="'size'+index" data-attr="Size" :value="size.size">
                                                                                    <label class="free-label four col" :for="'size'+index" :title="size.size">{{ size.size }}</label>
                                                                                </span>
                                                                            </span>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger" v-if="size_msg">Please select size</span>
                                                </template>
                                            </div>
                                                <!-- Attribute Size Section End -->

                                                <!-- Attribute Weight Section Start -->
                                            <div class="product-opts attribute-section"  v-if="all_attributes.weight_count > 0">
                                                <template >
                                                    <div class="product-opt-title">
                                                        Weight
                                                    </div>

                                                    <div class="product-opt">
                                                        <div class="product-opt-col">
                                                            <div class="form-check-inline">
                                                                <div class="attribute cf">
                                                                    <section class="plan cf">
                                                                        <span v-for="(weight, index) in all_attributes.weights" :key="weight.weight">
                                                                            <span>
                                                                                <input  type="radio" class="colorCls" v-model="form.weight" :id="'weight'+index" data-attr="Weight" :value="weight.weight">
                                                                                <label class="free-label four col" :for="'weight'+index" :title="weight.weight">{{ weight.weight }}</label>
                                                                            </span>
                                                                        </span>
                                                                    </section>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger" v-if="weight_msg">Please select weight</span>
                                                </template>
                                            </div>
                                                <!-- Attribute Weight Section End -->
                                            </span>

                                            <span class="text-danger" v-if="cartMsg">This product is out of stock.</span>
                                            <div class="product-add-to-cart">
                                                <span class="control-label">Quantity</span>
                                                <div class="quantity-section">
                                                    <div class="value-button" id="decrease" @click.prevent="decreaseValue" value="Decrease Value">-</div>
                                                    <input type="number" @keyup="qtyIncDec" id="carts_quantity" v-model="cartQty" value="1" />
                                                    <div class="value-button" id="increase" @click.prevent="increaseValue" value="Increase Value">+</div>
                                                </div>
                                                <span v-if="cartQtyMsg" class="text-danger">Quantity can't be zero or negative value.</span>
                                                <!--<div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" min="1" type="number" name="qtybutton" v-model="cartQty" value="1">
                                                </div>-->
                                                <div class="add mt-4">
                                                    <button class="add-to-cart" @click.prevent="addToCart(product)"><i class="zmdi zmdi-shopping-cart-plus"></i> add-to-cart</button>
                                                    <!--<span class="product-availability"><i class="zmdi zmdi-check"></i> In stock</span>-->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Modal Content-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--Single Product Share-->
                        <!--<div class="single-product-share">
                            <ul>
                                <li class="categories-title">Share :</li>
                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                            </ul>
                        </div>-->
                        <!--Single Product Share-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick Cart Modal End -->
    </div>
</template>

<script>
    import ProductSidebar from "./ProductSidebarComponent";
    import StarRating from 'vue-star-rating'
    import carousel from 'vue-owl-carousel'
    import $ from 'jquery';
import { log } from 'util';
    export default {
        name: "BrandProduct",
        components: {
            ProductSidebar,
            StarRating,
            carousel
        },
        data(){
            return {
                currentPage: 1,
                product: {},
                product_image: {},
                product_variations: {},
                all_attributes: {},
                wishlist:{
                    user_id: '',
                    company_id: '',
                    product_id: '',
                },
                cartQty: 1,
                form : {
                    color: '',
                    size: '',
                    weight: ''
                },
                color_msg: false,
                size_msg: false,
                weight_msg: false,
                cartMsg: false,
                occasion_slug_name: '',
                occasion_slug: '',
                cartQtyMsg: false,
                isActive: false,
                sortValue: "selected"
            }
        },

        watch: {
            '$route.path': function(val, oldVal){
                this.init_component();
                this.productBrandName();
            }
        },

        methods:{
            openModal(){
                $("#shoppingCart").modal('show');
            },
            discount_percentage(regular_price, sales_price){
                var percentage = 0;
                if(sales_price){
                    var discount = regular_price - sales_price;
                    if(isNaN(discount) || isNaN(regular_price)){
                        percentage = 0;
                    }else{
                        percentage = Math.ceil((discount/regular_price * 100));
                    }
                }
                if(percentage > 0){
                    return '-'+percentage+'%';
                }
            },
            increaseValue() {
                if(this.cartQty > 0){
                    this.cartQty = this.cartQty + 1
                    this.cartQtyMsg = false
                }else{
                    this.cartQtyMsg = true
                }
            },
            decreaseValue(){
                if(this.cartQty > 1){
                    this.cartQty = this.cartQty - 1
                    this.cartQtyMsg = false
                }else{
                    this.cartQtyMsg = true
                }
            },
            qtyIncDec(){
                if(this.cartQty > 0){
                    this.cartQty = this.cartQty
                    this.cartQtyMsg = false
                }else{
                    this.cartQty = 1
                    this.cartQtyMsg = true
                }
            },
            init_component: function(){
                this.productList();
            },
            productList(){
                let payload = {'page': this.currentPage, 'brand_slug': this.$route.params.brandSlug}
                this.$store.dispatch('product/getBrandProducts', payload)
            },
            scrollToTop() {
                window.scrollTo({top: 0, behavior: "smooth"});
            },
            paginationChange(){
                this.scrollToTop();
                let payload = {'page': this.currentPage, 'brand_slug': this.$route.params.brandSlug}
                this.$store.dispatch('product/getBrandProducts', payload)
            },
            getOccasionSlug(){
                axios.post('/occasion-product-slug', {'occasion_slug': this.$route.params.occasionSlug})
                    .then((result) => {
                        this.occasion_slug_name = result.data.occasion_name
                        this.occasion_slug = result.data.occasion_slug
                    }).catch((error) => {

                });
            },
            addToCart(product){
                //ADD TO CART EVENT FOR FACEBOOK
                if(product.sales_price && product.sales_price.length > 0){
                    var price = product.sales_price
                }else{
                    var price = product.regular_price
                }
                var product_sku = product.product_sku.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                var sku = product.id
                fbq('track', 'AddToCart', {
                    value: price,
                    currency: 'BDT',
                    content_ids: [
                        sku,
                    ],
                    content_type: 'product'
                });
                //ADD TO CART EVENT FOR FACEBOOK

                if(this.product_variations.length > 0) {
                    if(this.all_attributes.color_count > 0 && this.all_attributes.size_count > 0 && this.all_attributes.weight_count > 0) {
                        if(this.form.color == '') {
                            this.color_msg = true
                        }else {
                            this.color_msg = false
                        }
                        if(this.form.size == '') {
                            this.size_msg = true
                        }else {
                            this.size_msg = false
                        }
                        if(this.form.weight == '') {
                            this.weight_msg = true
                        }else {
                            this.weight_msg = false
                        }

                        if(this.color_msg == false && this.size_msg == false && this.weight_msg == false) {
                            axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty, 'color': this.form.color, 'size':this.form.size, 'weight': this.form.weight})
                                .then((result) => {
                                    if(result.data == 'error'){
                                        this.cartMsg = true
                                    }else{
                                        this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$message({
                                            message: 'Product added to cart successfully.',
                                            type: 'success'
                                        });
                                    }
                                }).catch((error) => {

                            });
                        }
                    }
                    if(this.all_attributes.color_count > 0 && this.all_attributes.size_count > 0 && this.all_attributes.weight_count == 0) {
                        if(this.form.color == '') {
                            this.color_msg = true
                        }else {
                            this.color_msg = false
                        }
                        if(this.form.size == '') {
                            this.size_msg = true
                        }else {
                            this.size_msg = false
                        }

                        if(this.color_msg == false && this.size_msg == false) {
                            axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty, 'color': this.form.color, 'size':this.form.size, 'weight': this.form.weight})
                                .then((result) => {
                                    if(result.data == 'error'){
                                        this.cartMsg = true
                                    }else{
                                        this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$message({
                                            message: 'Product added to cart successfully.',
                                            type: 'success'
                                        });
                                    }
                                }).catch((error) => {

                            });
                        }
                    }
                    if(this.all_attributes.color_count > 0 && this.all_attributes.size_count == 0 && this.all_attributes.weight_count > 0) {
                        if(this.form.color == '') {
                            this.color_msg = true
                        }else{
                            this.color_msg = false
                        }
                        if(this.form.weight == '') {
                            this.weight_msg = true
                        }else{
                            this.weight_msg = false
                        }

                        if(this.color_msg == false && this.weight_msg == false) {
                            axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty, 'color': this.form.color, 'size':this.form.size, 'weight': this.form.weight})
                                .then((result) => {
                                    if(result.data == 'error'){
                                        this.cartMsg = true
                                    }else{
                                        this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$message({
                                            message: 'Product added to cart successfully.',
                                            type: 'success'
                                        });
                                    }
                                }).catch((error) => {

                            });
                        }
                    }
                    if(this.all_attributes.color_count == 0 && this.all_attributes.size_count > 0 && this.all_attributes.weight_count > 0) {
                        if(this.form.size == '') {
                            this.size_msg = true
                        }else {
                            this.size_msg = false
                        }
                        if(this.form.weight == '') {
                            this.weight_msg = true
                        }else {
                            this.weight_msg = false
                        }

                        if(this.size_msg == false && this.weight_msg == false) {
                            axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty, 'color': this.form.color, 'size':this.form.size, 'weight': this.form.weight})
                                .then((result) => {
                                    if(result.data == 'error'){
                                        this.cartMsg = true
                                    }else{
                                        this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$message({
                                            message: 'Product added to cart successfully.',
                                            type: 'success'
                                        });
                                    }
                                }).catch((error) => {

                            });
                        }
                    }
                    if(this.all_attributes.color_count > 0 && this.all_attributes.size_count == 0 && this.all_attributes.weight_count == 0) {
                        if(this.form.color == '') {
                            this.color_msg = true
                        }else{
                            this.color_msg = false
                        }

                        if(this.color_msg == false) {
                            axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty, 'color': this.form.color, 'size':this.form.size, 'weight': this.form.weight})
                                .then((result) => {
                                    if(result.data == 'error'){
                                        this.cartMsg = true
                                        this.$message({
                                            message: 'This product is out of stock.',
                                            type: 'error'
                                        });
                                    }else{
                                        this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$message({
                                            message: 'Product added to cart successfully.',
                                            type: 'success'
                                        });
                                    }
                                }).catch((error) => {

                            });
                        }
                    }
                    if(this.all_attributes.color_count == 0 && this.all_attributes.size_count > 0 && this.all_attributes.weight_count == 0) {
                        if(this.form.size == '') {
                            this.size_msg = true
                        }else {
                            this.size_msg = false
                        }

                        if(this.size_msg == false) {
                            axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty, 'color': this.form.color, 'size':this.form.size, 'weight': this.form.weight})
                                .then((result) => {
                                    if(result.data == 'error'){
                                        this.cartMsg = true
                                        this.$message({
                                            message: 'This product is out of stock.',
                                            type: 'error'
                                        });
                                    }else{
                                        this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$message({
                                            message: 'Product added to cart successfully.',
                                            type: 'success'
                                        });
                                    }
                                }).catch((error) => {

                            });
                        }
                    }
                    if(this.all_attributes.color_count == 0 && this.all_attributes.size_count == 0 && this.all_attributes.weight_count > 0) {
                        if(this.form.weight == '') {
                            this.weight_msg = true
                        }else {
                            this.weight_msg = false
                        }

                        if(this.weight_msg == false) {
                            axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty, 'color': this.form.color, 'size':this.form.size, 'weight': this.form.weight})
                                .then((result) => {
                                    if(result.data == 'error'){
                                        this.cartMsg = true
                                        this.$message({
                                            message: 'This product is out of stock.',
                                            type: 'error'
                                        });
                                    }else{
                                        this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$message({
                                            message: 'Product added to cart successfully.',
                                            type: 'success'
                                        });
                                    }
                                }).catch((error) => {

                            });
                        }
                    }

                } else {
                    axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty, 'color': this.form.color, 'size':this.form.size, 'weight': this.form.weight})
                        .then((result) => {
                            if(result.data == 'error'){
                                this.cartMsg = true
                            }else{
                                this.openModal();
                                this.cartMsg = false
                                this.$store.dispatch('cart/productList');
                                this.$message({
                                    message: 'Product added to cart successfully.',
                                    type: 'success'
                                });
                            }
                        }).catch((error) => {

                    });
                }
            },
            addToWishlist(product){
                if(this.user){
                    this.wishlist.user_id = this.user.id
                    this.wishlist.company_id = product.company_id
                    this.wishlist.product_id = product.id
                    axios.post('/user/wishlist', this.wishlist)
                        .then((result) => {
                            if(result.data == 'error'){
                                this.$message({
                                    showClose: true,
                                    message: 'Oops, This product already exist in wishlist.',
                                    type: 'error'
                                });
                            }else{
                                this.$router.push({name: 'wishlist'})
                                this.$message({
                                    message: 'Product added to wishlist successfully.',
                                    type: 'success'
                                });
                            }
                        }).catch((error) => {

                    });
                }else{
                    this.$router.push({name: 'userLogin'})
                    this.$message({
                        showClose: true,
                        message: 'Oops, Please login first for add to wishlist.',
                        type: 'error'
                    });
                }
            },
            quickView(product, image, attributes){
                this.product = product
                this.product_image = image
                this.product_variations = attributes

                axios.post('/get-variations', {'id': product.id})
                    .then((result) => {
                        this.all_attributes = result.data.all_attributes
                    }).catch((error) => {

                });
            },
            isMobile() {
                if (screen.width <= 768) {
                    this.isActive = false
                } else {
                    this.isActive = true
                }
            },
            // productSorting: function productSorting(event) {
            //     this.sortValue = event.target.value;
            //     let payload = {'page': this.currentPage, 'keyword': '', 'sort_value': this.sortValue, 'occasion_slug': this.occasion_slug}
            //     this.$store.dispatch('product/occassionProductSort', payload)
            // },
            productBrandName() {
                axios.post('/product-brand-name', {'brandSlug': this.$route.params.brandSlug})
                    .then((result) => {
                        // console.log(result.data)
                        document.title = result.data.brand_name+' | Stygen'
                        if(document.title == '') {
                            document.title = 'Stygen | Best online Gift Shop in Bangladesh'
                        }

                    }).catch((error) => {

                });
            }
        },

        computed:{
            products(){
                return this.$store.getters['product/getAllProducts'];
            },
            user(){
                return this.$store.getters['user/getUserDetails']
            }
        },

        created(){
            this.productList();
            this.init_component();
            this.isMobile();
            this.productBrandName();
        }
    }
</script>

<style scoped>
.addtocart {
    background-color: #5e2e87;
    font-size: 12px;
}
.addtocart i {
    margin-right: 5px;
    padding-left: 1px;
}
.detailsbtn {
    background-color: #5e2e87;
    color: white;
    font-size: 12px;
}
.pro-action-btn {
    margin-left: -14px;
}
</style>
