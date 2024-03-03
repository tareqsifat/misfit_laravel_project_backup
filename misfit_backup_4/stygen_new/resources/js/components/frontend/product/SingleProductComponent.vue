<template>
    <div id="single_product">

        <div class="container single-product-container">
            <div class="breadcrumb-content single-product-breadcrumb">
                <ul>
                    <li><router-link :to="{name: 'landing'}">Home</router-link> / <router-link :to="{name: 'subCategoryProduct', params: {catSlug:categorySlug}}">{{ categoryName }}</router-link> / Product</li>
                    <!-- <li class="active">{{ categoryName }}</li> -->
                </ul>
            </div>
            <div class="single-product-main-section">
                <!--Single Product Start-->
                <div class="single-product-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="product__details__pic">
                                    <div class="" v-if="product.product_images">
                                        <span v-if="main_image && main_image.length > 0">
                                            <!--<img :src="main_image" :alt="product.product_name">-->
                                            <image-magnifier :src="main_image" :zoom-src="main_image" width="100%" height="100%" zoom-width="440" zoom-height="440"></image-magnifier>
                                        </span>
                                        <span v-else>
                                            <!--<img :src="`/assets/uploads/product/${product.featured_image}`" :alt="product.product_name">-->
                                            <template v-if="product.featured_image != ''">
                                                <image-magnifier :src="`/assets/uploads/product/${product.featured_image}`" :zoom-src="`/assets/uploads/product/${product.featured_image}`" width="100%" height="100%" zoom-width="440" zoom-height="440"></image-magnifier>
                                            </template>

                                            <template v-else>
                                                <img class="first-img" width="400px" height="400px" src="/assets/frontend/img/icon/empty_product.jpeg">
                                            </template>
                                        </span>
                                    </div>

                                    <div class="mt-2" v-if="product && product.product_images && product.product_images.length > 0">
                                        <carousel :autoplay="true" :loop="false" :center="false" :nav="false" :margin="5" :autoplayHoverPause="true">
                                            <img v-for="(product_image, index) in product.product_images" :key="index" class="pr-2" width="150" :src="`/assets/uploads/product/${product_image.image}`" :alt="product.product_name" @click="showImage(product_image.image)">
                                        </carousel>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-7">
                                <div class="single-product-content">
                                    <h1 class="single-product-name mb-0">{{ product.product_name }}</h1>
                                    <div class="single-product-reviews show-rating" style="display: inline-block;">
                                        <star-rating style="display: inline-block;" v-if="product.average_ratting" :rating="product.average_ratting" :show-rating="false" :read-only="true" :increment="0.01"></star-rating>
                                        <p style="display: inline-block;" class="ml-2" v-if="product.reviews.length > 0 && product.reviews.length < 2">{{ product.reviews.length }} Review</p>
                                        <p style="display: inline-block;" class="ml-2" v-else-if="product.reviews.length >= 2">{{ product.reviews.length }} Reviews</p>
                                    </div>
                                    <div class="single-product-price">
                                        <div class="product-discount">
                                            <span class="regular-price" v-if="product.sales_price"><del>৳{{ product.regular_price | numFormat }}</del><span class="price">৳{{ product.sales_price | numFormat }}</span></span>
                                            <span class="price" v-else>৳{{ product.regular_price | numFormat }}</span>
                                            <span class="discount" v-if="discount_percentage(product.regular_price, product.sales_price)">{{ discount_percentage(product.regular_price, product.sales_price) }}</span>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <p v-if="product.short_description && product.short_description != 'null'"><span v-html="product.short_description"></span></p>
                                        <p class="mt-0 single-product-info" v-if="product.product_sku && product.product_sku != 'null'"><b>SKU:</b> {{ product.product_sku }}</p>
                                        <p class="mt-0 single-product-info" v-if="product.brand"><b>Brand:</b> <router-link :to="{name: 'brandProductList', params: {brandSlug:product.brand.brand_slug}}">{{ product.brand.brand_name }}</router-link></p>
                                    </div>
                                    <div class="single-product-action">
                                        <form action="#">
                                            <span v-if="product.product_variations && product.product_variations.length > 0">
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
                                                                                <!--<span>
                                                                                    <input  type="radio" disabled class="colorCls" v-model="form.color" :id="'color'+color.id" data-attr="Color" :value="color.color">
                                                                                    <label :style="'background:'+color.color" class="free-label four col" :for="'color'+color.id" title="Stock Out"><span class="del_variation"></span></label>
                                                                                </span>-->
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
                                                                                <!--<span>
                                                                                    <input  type="radio" disabled class="colorCls" v-model="form.size" :id="'size'+size.id" data-attr="Size" :value="size.size">
                                                                                    <label class="free-label four col" :for="'size'+size.id" title="Stock Out"><span class="del_variation"></span></label>
                                                                                </span>-->
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
                                                                            <!--<span>
                                                                                <input  type="radio" disabled class="colorCls" v-model="form.weight" :id="'weight'+weight.id" data-attr="Weight" :value="weight.weight">
                                                                                <label class="free-label four col" :for="'weight'+weight.id" title="Stock Out"><span class="del_variation"></span></label>
                                                                            </span>-->
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
                                                    <input type="number" @keyup="qtyIncDec" id="cart_quantity" v-model="cartQty" value="1" />
                                                    <div class="value-button" id="increase" @click.prevent="increaseValue" value="Increase Value">+</div>
                                                </div>
                                                <span v-if="cartQtyMsg" class="text-danger">Quantity can't be zero or negative value.</span>
                                                <!-- <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" v-model="cartQty" min="1" type="text" name="qtybutton" value="1">
                                                </div> -->
                                                <p v-if="product.status != 0" class="text-info"><b>{{ this.product_stock }}</b> product left in Stock</p>
                                                <!-- <h2>5 product left</h2> -->
                                                <div class="row d-flex justify-content-start" v-if="product.status != 0">
                                                    <div class="col-md-4">
                                                        <div class="add mt-4">
                                                            <button class="add-to-cart" @click.prevent="addToCart(product)"><i class="ion-bag"></i> add-to-cart</button>
                                                            <!--<span class="product-availability">In stock</span>-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="add mt-4" v-if="product.status != 0">
                                                            <button class="btn btn-primary btn-lg" id="buynowbtn" @click.prevent="buyNow(product)" :to="{name: 'checkout', params: {product}}"><i class="fas fa-money-check-alt"></i>Buy now</button>
                                                            <!--<span class="product-availability">In stock</span>-->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" v-else>
                                                    <div class="alert alert-danger" role="alert">
                                                        This Product is out of stock
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                        <!--Single Product Share-->
                                        <!--<div class="single-product-share mt-20">
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
                    </div>
                </div>
                <!--Single Product End-->



                <div class="container" v-if="product.youtube_link && product.youtube_link != 'null'">
                    <div class="row mt-2">
                        <div class="col-md-5 text-left">
                            <h4>More Details: </h4>
                            <iframe width="480" height="315" :src="product.youtube_link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <!--Single Product Review Tab Start-->
                <div class="single-product-review-tab mt-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="single-product-review-and-description-area">
                                    <!--Review And Description Tab Menu Start-->
                                    <ul class="nav dec-and-review-menu">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#description">Description</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#reviews">Reviews</a>
                                        </li>
                                    </ul>
                                    <!--Review And Description Tab Menu End-->
                                    <!--Review And Description Tab Content Start-->
                                    <div class="tab-content product-review-content-tab mt-30" id="myTabContent-4">
                                        <div class="tab-pane fade show active" id="description">
                                            <div class="single-product-description">
                                                <p v-html="product.long_description"></p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="reviews">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="comments-area">
                                                        <h3 v-if="product.reviews">{{ product.reviews.length }} Reviews</h3>
                                                        <ol class="commentlist" v-for="review in product.reviews" :key="review.id">
                                                            <li>
                                                                <div class="single-comment">
                                                                    <div class="comment-avatar">
                                                                        <img v-if="review.user.image == 'default.png'" src="/assets/frontend/img/icon/user.png" width="50px">
                                                                    </div>
                                                                    <div class="comment-info">
                                                                        <a href="#">{{ review.user.name }}</a>
                                                                        <!-- <div class="reply">
                                                                            <a href="#">Reply</a>
                                                                        </div> -->
                                                                        <span class="date">{{ review.created_at | timeFormat }}</span>
                                                                        <p>{{ review.description }}</p>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div v-if="user.id" class="review-page-comment">
                                                        <div class="review-comment">
                                                            <h2>Write your review</h2>
                                                            <ul class="pro-comments-rating">
                                                                <li>
                                                                    <label class="label-quality">Quality<sup class="required">*</sup></label>
                                                                    <div class="single-product-reviews">
                                                                        <star-rating v-model="rating" :show-rating="false"></star-rating>
                                                                        <span class="text-danger" v-if="errors.rating">{{ errors.rating[0] }}</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="review-form">
                                                            <form action="#">

                                                                <label>Review description<sup class="required">*</sup></label>
                                                                <textarea placeholder="Your Revie Here.." v-model="review_description" id="content" name="content"></textarea>
                                                                <span class="text-danger" v-if="errors.review_description">{{ errors.review_description[0] }}</span><br>

                                                                <label>Your name<sup class="required">*</sup></label>
                                                                <input type="text" placeholder="Your Name" name="title" :value="user.name">

                                                                <div class="send-your-review">
                                                                    <p class="required-fields"><sup>*</sup> Required fields</p>
                                                                    <div class="send-cancel-btn">
                                                                        <button class="send-btn" @click.prevent="sendReview">Send</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div v-else class="review-page-comment bg-danger p-3">
                                                        <div class="review-comment">
                                                            <h4 class="text-white text-center">Please Login First for Review.</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Review And Description Tab Content End-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Single Product Review Tab End-->
            </div>
        </div>

        <!--Our Gift By Occation Area Start-->
        <!--<div class="our-product-area gifts-by-occasion-area">
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
                                                    <img class="first-img gift-img" :src="`/assets/uploads/occasion/${occasion.occasion_image}`" :alt="occasion.occasion_name">
                                                    <img class="hover-img gift-img" :src="`/assets/uploads/occasion/${occasion.occasion_image}`" :alt="occasion.occasion_name">
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
        </div>-->
        <!--Our Gift By Occation Area End-->

        <!-- Start You may also like Section -->
        <div class="related-product-area mt-4" v-if="related_products && related_products.length > 0">
            <div class="container related-product-container">
                <div class="row">
                    <div class="col-12">
                        <!--Section Title Start-->
                        <div class="text-center">
                            <h3>You may also like</h3>
                        </div>
                        <!--Section Title End-->
                    </div>
                </div>

                <div class="recent-addition mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-2-product">
                                <!--<carousel v-if="related_products && related_products.length > 0" :autoplay="true" :loop="false" :center="false" :nav="false" :items="5" :responsive="{0:{items:1,nav:false},600:{items:5,nav:true, dots: true}}" :margin="5" :autoplayHoverPause="true">-->
                                    <div class="row" v-if="related_products && related_products.length > 0">
                                        <div class="col-lg-3 col-xl-3 col-md-3" v-for="related_product in related_products" :key="related_product.id">
                                            <!--Single Product Start-->
                                            <div class="single-product style-2">
                                                <div class="product-img">
                                                    <router-link :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">
                                                        <img class="first-img" :src="`/assets/uploads/product/${related_product.featured_image}`" alt="related_product.product_name">
                                                        <img class="hover-img" :src="`/assets/uploads/product/${related_product.featured_image}`" alt="related_product.product_name">
                                                    </router-link>

                                                    <div class="product-action">
                                                        <ul>
                                                            <li v-if="related_product.product_variations && related_product.product_variations.length > 0"><router-link :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}"><i class="ion-settings"></i></router-link></li>
                                                            <!-- <li v-else><a href="#" @click.prevent="addToCartRelated(related_product)"><i class="ion-bag"></i></a></li> -->
                                                            <li><a @click.prevent="quickView(related_product, related_product.featured_image, related_product.product_variations)" href="#open-modal" data-toggle="modal"><i class="ion-eye"></i></a></li>
                                                            <!-- <li><a href="#" @click.prevent="addToWishlist(related_product)"><i class="ion-heart"></i></a></li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h4><router-link :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">{{ related_product.product_name }}</router-link></h4>
                                                    <div class="product-price">
                                                        <span class="price" v-if="related_product.sales_price"><del>৳{{ related_product.regular_price | numFormat }}</del> ৳{{ related_product.sales_price | numFormat }}</span>
                                                        <span class="price" v-else>৳{{ related_product.regular_price | numFormat }}</span>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-inline-flex justify-content-between mt-3">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <!-- <span v-if="product.product_variations && product.product_variations.length > 0"><router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}"><i class="ion-settings"></i></router-link></span> -->
                                                                    <span v-if="product.product_variations && product.product_variations.length > 0"><a class="btn btn-primary btn-sm pl-2 detailsbtn"><router-link class="detailsbtn" :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">select variant</router-link></a></span>
                                                                    <span v-else><a href="#" @click.prevent="addToCart(product)" class="btn btn-primary btn-sm pr-2 addtocart"><i class="ion-bag"></i>Add to cart</a></span>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <span><a class="btn btn-primary btn-sm pl-2 detailsbtn"><router-link id="detailsbtn" :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">Details</router-link></a></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Single Product End-->
                                        </div>
                                    </div>
                                <!--</carousel>-->
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
        </div>
        <!-- End You may also like Section -->


        <!-- End You may also like Section -->
    </div>
</template>

<script>
    import carousel from 'vue-owl-carousel'
    import $ from 'jquery'
    import StarRating from 'vue-star-rating'
    import {mapGetters} from 'vuex'

    export default {
        name: "SingleProductComponent",
        components: {
            carousel,
            StarRating
        },
        data(){
            return {
                main_image: '',
                attribute: [],
                wishlist:{
                    user_id: '',
                    company_id: '',
                    product_id: '',
                },
                form : {
                    color: '',
                    size: '',
                    weight: ''
                },
                // product: {},
                product_image: {},
                cartQty: 1,
                color_msg: false,
                size_msg: false,
                weight_msg: false,
                cartMsg: false,
                rating: 0,
                review_title: '',
                review_description: '',
                errors:{},
                cartQtyMsg: false,
                categoryName: '',
                categorySlug: '',
                page_title: '',
                meta_title: '',
                meta_description: '',
                meta_image: '',
                items: [],
                product_stock: '',
                productId: ''
            }
        },

        watch: {
            '$route.path': function(val, oldVal){
                this.init_component();
                this.productView();
                this.getstock();
                product.status
            }
        },
        metaInfo: {
            meta: [
                { property: 'title', content: localStorage.getItem('meta_title') },
                { property: 'description', content: localStorage.getItem('meta_description') },
            ]
        },
        methods:{
            openModal(){
                $("#shoppingCart").modal('show');
            },
            quickView(product, image){
                this.product = product
                this.product_image = image
                // this.product_variations = attributes

                axios.post('/get-variations', {'id': product.id})
                    .then((result) => {
                        this.all_attributes = result.data.all_attributes
                    }).catch((error) => {

                });
            },
            facebookViewContent(){
                var product_slug = this.$route.params.slug;
                axios.post('/get-view-content', {'product_slug': product_slug})
                    .then((result) => {
                        var price = result.data.price;
                        var sku = result.data.sku;
                        fbq('track', 'ViewContent', {
                            value: price,
                            currency: 'BDT',
                            content_ids: [
                                sku,
                            ],
                            content_type: 'product'
                        });
                    }).catch((error) => {
                });
            },
            googleview(){
                var product_slug = this.$route.params.slug;

                axios.post('/get-view-content', {'product_slug': product_slug})
                    .then((result) => {
                        var price = result.data.price;
                        var id = result.data.id;
                        var name = result.data.name;

                        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
                        dataLayer.push({
                            'event':'view_item',
                                'ecommerce': {
                                    'detail': {  // 'detail' actions have an optional list property.
                                    'products': [{
                                        'name': name,         // Name or ID is required.
                                        'id': id,
                                        'price': price,
                                    }]
                                }
                            }
                        });
                    }).catch((error) => {
                });

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
            sendReview(){
                axios.post('/user/product-review', {'product_id': this.product.id, 'rating': this.rating, 'review_description': this.review_description,'user_id': this.user.id})
                    .then((result) => {
                        this.$store.dispatch('product/getSingleProduct', this.$route.params.slug)
                        this.rating = 0
                        this.review_title = ''
                        this.review_description = ''
                        this.$message({
                            message: 'Your review successfully submitted.',
                            type: 'success'
                        });
                    }).catch((error) => {
                        this.errors = error.response.data.errors
                });
            },
            singleProductCategory(){
                axios.post('/single-product-category', {'product_slug': this.$route.params.slug})
                    .then((result) => {
                        this.categoryName = result.data.category_name
                        this.categorySlug = result.data.cat_slug
                    }).catch((error) => {

                });
            },
            init_component: function(){
                this.getSingleProduct();
                this.getRelatedProduct();
                // this.getTrendingProduct();
            },
            getSingleProduct(){
                this.$store.dispatch('product/getSingleProduct', this.$route.params.slug)
            },
            getRelatedProduct(){
                this.$store.dispatch('product/getRelatedProduct', this.$route.params.slug)
            },
            // getAddonProduct() {
            //     this.$store.dispatch('product/getAddonProduct', this.$route.params.slug)
            // },
            // getTrendingProduct() {
            //     this.$store.dispatch('product/getTrendingProduct')
            // },
            showImage(image){
                this.main_image = '/assets/uploads/product/'+image
            },
            getAllOccasion(){
                this.$store.dispatch('occasion/getAllOccasion');
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
                // console.log(product.id);
                fbq('track', 'AddToCart', {
                    value: price,
                    currency: 'BDT',
                    content_ids: [
                        sku,
                    ],
                    content_type: 'product'
                });
                //ADD TO CART EVENT FOR FACEBOOK

                if(this.product.product_variations.length > 0) {
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
            addToCartRelated(product){
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
            },
            buyNow(product) {
                if(product.sales_price && product.sales_price.length > 0){
                    var price = product.sales_price
                }else{
                    var price = product.regular_price
                }
                var product_sku = product.product_sku.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                var sku = product.id
                // console.log(product.id);
                fbq('track', 'AddToCart', {
                    value: price,
                    currency: 'BDT',
                    content_ids: [
                        sku,
                    ],
                    content_type: 'product'
                });
                //ADD TO CART EVENT FOR FACEBOOK

                if(this.product.product_variations.length > 0) {
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
                                        // this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$router.push('/checkout');
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
                                        // this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$router.push('/checkout');
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
                                        // this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$router.push('/checkout');
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
                                        // this.openModal();
                                        this.cartMsg = false
                                        this.$store.dispatch('cart/productList');
                                        this.$router.push('/checkout');
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
                                // this.openModal();
                                this.cartMsg = false
                                this.$store.dispatch('cart/productList');
                                this.$router.push('/checkout');
                                this.$message({
                                    message: 'Product added to cart successfully.',
                                    type: 'success'
                                });
                            }
                        }).catch((error) => {

                    });
                }
            },
            productView() {
                axios.post('/product-view-by-user', {'product_slug': this.$route.params.slug})
                    .then((result) => {
                        // console.log(result.data)
                        this.productId = result.data.id;
                        if(result.data.meta_title == null) {
                            document.title = result.data.product_name+' | Stygen.gift'
                        }
                        else if(result.data.meta_title == 'null') {
                            document.title = result.data.product_name+' | Stygen.gift'
                        }
                        else {
                            document.title = result.data.meta_title
                        }

                        //meta_title Section
                        if(result.data.meta_title == null) {
                            localStorage.setItem('meta_title', result.data.product_name+' | Stygen.gift')
                        }
                        else if(result.data.meta_title == 'null') {
                            localStorage.setItem('meta_title', result.data.product_name+' | Stygen.gift')
                        }
                        else {
                            localStorage.setItem('meta_title', result.data.meta_title)
                        }

                        //meta_description Section
                        if(result.data.meta_description == null) {
                            localStorage.setItem('meta_description', result.data.product_name+' at best price in Stygen.gift | up to 50% discount')
                        }
                        else if(result.data.meta_description == 'null') {
                            localStorage.setItem('meta_description', result.data.product_name+' at best price in Stygen.gift | up to 50% discount')
                        }
                        else {
                            localStorage.setItem('meta_description', result.data.meta_description)
                        }
                        // console.log(localStorage.getItem('meta_description'), result.data.id);

                        // this.page_title = result.data.product_name+' | Stygen'
                        this.meta_title = result.data.meta_title
                        this.meta_des = result.data.meta_description
                        this.meta_image = result.data.meta_image
                    }).catch((error) => {

                });
            },
            getstock() {
                axios.post('/get-product-stock', {'slug': this.$route.params.slug})
                .then((res) => {
                    this.product_stock = res.data.product_quantity;
                    console.log(this.product_stock, 'product-id', this.product.id, 'quantity =>', res.product_quantity, res);
                });
            }
        },

        computed:{
            product(){
                return this.$store.getters['product/getSingleProduct'];
            },
            get_addon_products(){
                return this.$store.getters['product/get_addon_products'];
            },
            related_products(){
                return this.$store.getters['product/getRelatedProduct'];
            },
            // trending_products() {
            //     return this.$store.getters['product/getTrendingProduct'];
            // },
            user(){
                return this.$store.getters['user/getUserDetails']
            },
            all_attributes() {
                return this.$store.getters['product/all_attributes']
            },
            occasions(){
                return this.$store.getters['occasion/getAllOccasion']
            }
        },

        created(){
            this.productView();
            this.getSingleProduct();
            this.getRelatedProduct();
            // this.getAddonProduct();
            // this.getTrendingProduct();
            this.getAllOccasion();
            this.facebookViewContent();
            this.singleProductCategory();
            this.getstock();
            this.googleview();
        },

    }
</script>

<style scoped>
.add-on {
    background-color: #573276e0;
    padding: 5px;
}
.add-on h4{
    margin-left: 5px;
    padding-top: 3px;
}
.addtocart {
    background-color: #5e2e87;
    font-size: 12px;
    text-transform: capitalize;
}
.addtocart i {
    margin-right: 5px;
    padding-left: 1px;
}
.detailsbtn {
    background-color: #5e2e87;
    color: white !important;
    font-size: 12px;
    text-transform: capitalize;
}
#detailsbtn {
    color: white !important;
    font-size: 12px;
    text-transform: capitalize;
}
#buynowbtn {
    background-color: #5e2e87;
    padding: 17px;
    text-transform: capitalize;
}

#buynowbtn i{
    padding-right: 12px;
}
.justify-content-start {
    margin-right: 20px;
}
</style>
