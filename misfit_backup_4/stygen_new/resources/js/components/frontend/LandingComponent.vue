<template>
    <div id="landing">
        <!--Slider Area Start-->
        <div class="slider-area transparent-bg">
            <!-- <div class="container"> -->
            <div :class="{ container: isActive }">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="">
                            <carousel v-if="sliders.length > 0" :autoplay="true" :loop="true" :center="true" :nav="false" :items="1" :margin="5" :autoplayHoverPause="true">
                                <span v-for="(slider, index) in sliders" :key="index">
                                    <span v-if="slider.occasion">
                                        <router-link :to="{name: 'occasionProduct', params: {occasionSlug: slider.occasion.occasion_slug}}">
                                            <img :src="`/assets/uploads/slider/${slider.image}`" :alt="slider.title" lazy="loading">
                                        </router-link>
                                    </span>
                                    <!-- <span v-if="screen.width <= 480">
                                        <router-link :to="{name: 'occasionProduct', params: {occasionSlug: slider.occasion.occasion_slug}}">
                                            <img :src="`/assets/uploads/slider/mbl-${slider.image}`" :alt="slider.title" lazy="loading">
                                        </router-link>
                                    </span> -->
                                    <span v-else>
                                        <router-link :to="{name: 'shop'}">
                                            <img :src="`/assets/uploads/slider/${slider.image}`" :alt="slider.title" lazy="loading">
                                        </router-link>
                                    </span>
                                </span>
                            </carousel>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Slider Area End-->

        <!--Our Shop by Category Area Start-->
        <div class="our-product-area shop-by-category-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!--Section Title Start-->
                        <div class="row text-center">
                            <div class="col-8 ml-auto mr-auto">
                                <h3 class="landing-category-title-tag">GIFT BY CATEGORIES</h3>
                            </div>
                        </div>
                        <!--Section Title End-->
                    </div>
                </div>

                <!--Category Section Start-->
                <div class="shop-by-department mt-4">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3" v-for="category in landing_categories" :key="category.id">
                            <!--Single Product Start-->
                            <div class="single-product mb-30 category-section-main">
                                <div class="product-img">
                                    <router-link :to="{name: 'subCategoryProduct', params: {catSlug: category.cat_slug}}">
                                        <img class="first-img" :src="`/assets/uploads/category/${category.category_image}`" :alt="category.category_name" lazy="loading">
                                    </router-link>
                                </div>
                                <div class="product-content category-title-section">
                                    <h4 class="text-white"><router-link :to="{name: 'subCategoryProduct', params: {catSlug: category.cat_slug}}">{{ category.category_name }}</router-link></h4>
                                </div>
                            </div>
                            <!--Single Product End-->
                        </div>
                    </div>
                </div>
                <!--Category Section End-->

            </div>
        </div>
        <!--Our Shop by Category Area End-->

        <!--Our Gift By Occation Area Start-->
        <div class="our-product-area gifts-by-occasion-area">
            <div class="container">
                <div class="row">
                    <div class="col-8 ml-auto mr-auto">
                        <div class="row text-center">
                            <h3 class="landing-gifts-title-tag">GIFTS BY OCCASION</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 ml-auto mr-auto">
                        <div class="row justify-content-around">
                            <div class="col-6" v-for="occasion in occasions" :key="occasion.id">
                                <div class="gifts-main-section mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="product-img">
                                                <router-link :to="{name: 'occasionProduct', params: {occasionSlug: occasion.occasion_slug}}">
                                                    <img class="first-img gift-img" :src="`/assets/uploads/occasion/${occasion.occasion_image}`" :alt="occasion.occasion_name" lazy="loading">
                                                </router-link>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <h4 class="gifts-title"><router-link :to="{name: 'occasionProduct', params: {occasionSlug: occasion.occasion_slug}}">{{ occasion.occasion_name }}</router-link></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Our Blog Area Start-->
        <!--Our Blog Area End-->

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
                                        <img class="first-img" :src="`/assets/uploads/product/${product_image}`" :alt="product.product_name" lazy="loading">
                                    </template>
                                    <template v-else>
                                        <img class="first-img" src="/assets/frontend/img/icon/empty_product.jpeg" lazy="loading">
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
                                        <p v-if="product.short_description && product.short_description != 'null'">{{ product.short_description }}</p>
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
                                                                            <span v-for="color in product_variations" :key="color.id">
                                                                                <span v-if="color.attribute_stock > 0">
                                                                                    <input  type="radio" class="colorCls" v-model="form.color" :id="'color'+color.id" data-attr="Color" :value="color.color">
                                                                                    <label :style="'background:'+color.color_code" class="free-label four col" :for="'color'+color.id" :title="color.color"></label>
                                                                                </span>
                                                                                <span v-else>
                                                                                    <input  type="radio" disabled class="colorCls" v-model="form.color" :id="'color'+color.id" data-attr="Color" :value="color.color">
                                                                                    <label :style="'background:'+color.color" class="free-label four col" :for="'color'+color.id" title="Stock Out"><span class="del_variation"></span></label>
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
                                                                            <span v-for="size in product_variations" :key="size.id">
                                                                                <span v-if="size.attribute_stock > 0">
                                                                                    <input  type="radio" class="colorCls" v-model="form.size" :id="'size'+size.id" data-attr="Size" :value="size.size">
                                                                                    <label class="free-label four col" :for="'size'+size.id" :title="size.size">{{ size.size }}</label>
                                                                                </span>
                                                                                <span v-else>
                                                                                    <input  type="radio" disabled class="colorCls" v-model="form.size" :id="'size'+size.id" data-attr="Size" :value="size.size">
                                                                                    <label class="free-label four col" :for="'size'+size.id" title="Stock Out"><span class="del_variation"></span></label>
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
                                                                        <span v-for="weight in product_variations" :key="weight.id">
                                                                            <span v-if="weight.attribute_stock > 0">
                                                                                <input  type="radio" class="colorCls" v-model="form.weight" :id="'weight'+weight.id" data-attr="Weight" :value="weight.weight">
                                                                                <label class="free-label four col" :for="'weight'+weight.id" :title="weight.weight">{{ weight.weight }}</label>
                                                                            </span>
                                                                            <span v-else>
                                                                                <input  type="radio" disabled class="colorCls" v-model="form.weight" :id="'weight'+weight.id" data-attr="Weight" :value="weight.weight">
                                                                                <label class="free-label four col" :for="'weight'+weight.id" title="Stock Out"><span class="del_variation"></span></label>
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

                                            <span class="text-danger" v-if="cartMsg">This product is not available.</span>
                                            <div class="product-add-to-cart">
                                                <span class="control-label">Quantity</span>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" min="1" type="number" name="qtybutton" v-model="cartQty" value="1">
                                                </div>
                                                <div class="add">
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

        <!-- <div class="modal" id="indexmodal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex">
                        <div class="col-md-12">
                            <img src="/assets/frontend/img/logo/stygen_image.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="text-center">Wait! Before you leave drop your email to get a discount coupon.</h3>
                        </div>
                    </div>

                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">email:</label>
                            <input type="text" v-model="popup_email"  class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">phone number:</label>
                            <input type="text" v-model="popup_phone"  class="form-control" id="recipient-name">
                        </div>
                        <button type="button" @click.prevent="popupform" class="btn btn-primary">Submit</button>
                        <span class="text-danger" v-if="errors.popup_email">{{ errors.popup_email[0] }}</span>
                    </form>
                </div>

                </div>
            </div>
            </div>
        </div> -->
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel'
    import StarRating from 'vue-star-rating'
    import $ from 'jquery'
    export default {
        name: "LandingComponent",
        components: {
            carousel,
            StarRating
        },
        data(){
            return{
                product: {},
                product_image: {},
                product_variations: {},
                all_attributes: {},
                wishlist:{
                    user_id: '',
                    company_id: '',
                    product_id: '',
                },
                popup_email: '',
                popup_phone: '',
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
                isActive: false,
                blogs: '',
                errors: ''
            }
        },
        metaInfo: {
            title: 'Best online Gift Shop in Bangladesh ',
            titleTemplate: '%s | Stygen',
            meta: [
                {name: 'title', content: 'Buy gifts online for your loved ones | Stygen.gift'},
                {name: 'description', content: 'Order & send gifts online to your friends & family for any occasion. Gifts delivery in Bangladesh. Flower, cake, perfume, chocolate, books home delivery.'},
            ]
        },
        computed: {
            sliders(){
                return this.$store.getters['slider/getAllSlider']
            },
            occasions(){
                return this.$store.getters['occasion/getAllOccasionLanding']
            },
            landing_categories(){
                return this.$store.getters['category/landingCategory']
            },
            user(){
                localStorage.removeItem('userLoggedIn');
                return this.$store.getters['user/getUserDetails']
            }
        },

        methods: {
            openModal(){
                $("#shoppingCart").modal('show');
            },
            getAllSlider(){
                this.$store.dispatch('slider/getAllSlider');
            },
            getAllOccasionLanding(){
                this.$store.dispatch('occasion/getAllOccasionLanding');
            },
            landingCategory(){
                this.$store.dispatch('category/landingCategory');
            },
            // getAllBrandLanding() {
            //     this.$store.dispatch('brand/getAllBrandLanding');
            // },
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
            isMobile() {
                if (screen.width <= 768) {
                    this.isActive = false
                } else {
                    this.isActive = true
                }
            },
            aykori_api() {
                var url = window.location;
                let query_param = url.toString().split("?");

                let mk_activity_key_param = query_param[1].split("=");

                // console.log(mk_activity_key_param);
                let mk_activity_key = localStorage.getItem("mk_activity_key");
                if(mk_activity_key && mk_activity_key == mk_activity_key_param[1]) {
                    console.log('mk_activity_key found');
                }else {
                    let new_mk_activity_key = mk_activity_key_param[1];
                    axios.post('https://api.mkadsdigital.com/userativity/track', {mk_activity_id: new_mk_activity_key})
                        .then((result) => {
                            console.log(result);
                            if(result.data == true){
                                localStorage.setItem("mk_activity_key", new_mk_activity_key)
                            }
                        }).catch((error) => {
                            console.log('success =>' + error.response.data);
                        });
                }
            }

        },

        created() {
            this.getAllSlider();
            this.getAllOccasionLanding();
            this.landingCategory();
            this.isMobile();
            this.aykori_api();
            // setTimeout(function() {
            //     $('#indexmodal').modal();
            // }, 15000);
            // this.getAllBrandLanding();
        },
        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = to.meta.title || 'Best online Gift Shop in Bangladesh | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>
#landing{
    background-color: white;
}
#landing .blog-area{
    background-color: #e3e3ea;
}
.blog_title {
    color: #444;
    font-size: 20px;
    line-height: normal;
    font-weight: 600;
    text-transform: uppercase;
    margin: 15px 0 12px 0;
}
#landing .blog_area .owl-nav .owl-next {
    display: block !important;
}
</style>
