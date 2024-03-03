<div id="single_product">
    <script src="
    https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/js/lightbox.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/lightbox2@2.11.4/dist/css/lightbox.min.css
    " rel="stylesheet">
    <style>
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

        #buynowbtn i {
            padding-right: 12px;
        }
    </style>
    <div class="container single-product-container">
        <div class="breadcrumb-content single-product-breadcrumb">
            <ul>
                <li>
                    {{-- <router-link :to="{name: 'landing'}">Home</router-link> / <router-link
                        :to="{name: 'subCategoryProduct', params: {catSlug:categorySlug}}">{{ categoryName }}
                    </router-link> / Product --}}
                </li>

            </ul>
        </div>


        <div class="single-product-main-section">
            <!--Single Product Start-->
            <div class="single-product-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-xl-5 col-sm-12 col-12">
                            <div class="product__details__pic">
                                @if ($product_details->product_images)
                                    <div id="img-1" class="zoomWrapper single-zoom">
                                        @if ($product_details->featured_image != '')
                                            {{-- <image-magnifier src="`/assets/uploads/product/${product.featured_image}`"
                                        :zoom-src="`/assets/uploads/product/${product.featured_image}`" width="100%"
                                        height="100%" zoom-width="440" zoom-height="440"></image-magnifier> --}}
                                            <img class="first-img img-fluid w-100 lazy"
                                                src="/assets/uploads/product/{{ $product_details->featured_image }}" data-lightbox="roadtrip">
                                                <noscript><img class="first-img"
                                                    src="/assets/uploads/product/{{ $product_details->featured_image }}" loading="lazy"/></noscript>
                                                    
                                                   
                                        @else
                                            <img class="first-img img-fluid w-100 lazy"
                                                data-src="/assets/frontend/img/icon/empty_product.jpeg">
                                            <noscript><img class="first-img"
                                                    src="/assets/frontend/img/icon/empty_product.jpeg" /></noscript>
                                        @endif
                                    </div>
                                    <div class="single-zoom-thumb">
                                        <div class="row">
                                            @foreach ($product_details->product_images as $key=>$item)
                                            <div class="col-3">
                                                <a href="#" class="elevatezoom-gallery {{$key==0?"active":""}}">
                                                    <img
                                                    data-lightbox="roadtrip"
                                                    style="cursor:pointer; margin: 5px;" width="90px"
                                                    src="/assets/uploads/product/{{ $item['image'] }}" alt="zo-th-1">
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                                                                                                                                                                                                                          </ul> --}}
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-7 col-xl-7 col-sm-12 col-12">
                            <div class="single-product-content">
                                <h1 class="single-product-name mb-0">{{ $product_details->product_name }}</h1>
                                <div class="single-product-reviews show-rating" style="display: inline-block;">
                                    <!-- Blade does not have Vue's star-rating component, you'll need to handle this differently -->
                                    <p style="display: inline-block;" class="ml-2">
                                        @if ($product_details->reviews->count() > 0 && $product_details->reviews->count() < 2)
                                            {{ $product_details->reviews->count() }} Review
                                        @elseif ($product_details->reviews->count() >= 2)
                                            {{ $product_details->reviews->count() }} Reviews
                                        @endif
                                    </p>
                                </div>
                                <div class="single-product-price">
                                    <div class="product-discount">
                                        @if ($product_details->sales_price)
                                            <span class="regular-price">
                                                <del>৳{{ $product_details->regular_price }}</del>
                                                <span class="price">৳{{ $product_details->sales_price }}</span>
                                            </span>
                                        @else
                                            <span class="price" v-else>৳{{ $product_details->regular_price }}</span>
                                        @endif

                                        {{--
                                        <span class="discount"
                                            v-if="discount_percentage(product.regular_price, product.sales_price)">{{
                                            discount_percentage(product.regular_price, product.sales_price) }}</span> --}}
                                    </div>
                                </div>
                                {{-- <div class="product-info">

                                    <p v-if="product.short_description && product.short_description != 'null'"><span
                                            v-html="product.short_description"></span></p>
                                    <p class="mt-0 single-product-info"
                                        v-if="product.product_sku && product.product_sku != 'null'"><b>SKU:</b> {{
                                        product.product_sku }}</p>
                                    <p class="mt-0 single-product-info" v-if="product.brand"><b>Brand:</b>
                                        <router-link
                                            :to="{name: 'brandProductList', params: {brandSlug:product.brand.brand_slug}}">
                                            {{ product.brand.brand_name }}</router-link>
                                    </p>
                                </div> --}}
                                <div class="product-info">
                                    @if ($product_details->short_description && $product_details->short_description != 'null')
                                        <p>
                                            <span>{!! $product_details->short_description !!}</span>
                                        </p>
                                    @endif
                                    @if ($product_details->product_sku && $product_details->product_sku != 'null')
                                        {{-- <p>
                                            <span>{!! $product_details->short_description !!}</span>
                                        </p> --}}
                                        <p class="mt-0 mb-2 single-product-info">
                                            <b>SKU:</b> {{ $product_details->product_sku }}
                                        </p>
                                    @endif

                                    @if ($product_details->brand)
                                        <p class="mt-0 single-product-info">
                                            <b>Brand:</b> <a
                                                href="{{ route('brand_product', $product_details->brand->brand_slug) }}">{{ $product_details->brand->brand_name }}</a>
                                        </p>
                                    @endif
                                </div>
                                {{-- <div class="single-product-action">
                                    <form action="#">
                                        <span
                                            v-if="product.product_variations && product.product_variations.length > 0">
                                            <!-- Attribute Color Section Start -->
                                            <div class="product-opts attribute-section"
                                                v-if="all_attributes.color_count > 0">
                                                <template>
                                                    <div class="product-opt-title">
                                                        Color
                                                    </div>

                                                    <div class="product-opt">
                                                        <div class="product-opt-col">
                                                            <div class="form-check-inline">
                                                                <div class="attribute cf">
                                                                    <section class="plan cf">
                                                                        <span
                                                                            v-for="(color, index) in all_attributes.colors"
                                                                            :key="color.color">
                                                                            <span>
                                                                                <input type="radio" class="colorCls"
                                                                                    v-model="form.color"
                                                                                    :id="'color'+index"
                                                                                    data-attr="Color"
                                                                                    :value="color.color">
                                                                                <label
                                                                                    :style="'background:'+color.color_code"
                                                                                    class="free-label four col"
                                                                                    :for="'color'+index"
                                                                                    :title="color.color"></label>
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
                                                    <span class="text-danger" v-if="color_msg">Please select
                                                        color</span>
                                                </template>
                                            </div>
                                            <!-- Attribute Color Section End -->

                                            <!-- Attribute Size Section Start -->
                                            <div class="product-opts attribute-section"
                                                v-if="all_attributes.size_count > 0">
                                                <template>
                                                    <div class="product-opt-title">
                                                        Size
                                                    </div>

                                                    <div class="product-opt">
                                                        <div class="product-opt-col">
                                                            <div class="form-check-inline">
                                                                <div class="attribute cf">
                                                                    <section class="plan cf">
                                                                        <span
                                                                            v-for="(size, index) in all_attributes.sizes"
                                                                            :key="size.size">
                                                                            <span>
                                                                                <input type="radio" class="colorCls"
                                                                                    v-model="form.size"
                                                                                    :id="'size'+index" data-attr="Size"
                                                                                    :value="size.size">
                                                                                <label class="free-label four col"
                                                                                    :for="'size'+index"
                                                                                    :title="size.size">{{ size.size
                                                                                    }}</label>
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
                                            <div class="product-opts attribute-section"
                                                v-if="all_attributes.weight_count > 0">
                                                <template>
                                                    <div class="product-opt-title">
                                                        Weight
                                                    </div>

                                                    <div class="product-opt">
                                                        <div class="product-opt-col">
                                                            <div class="form-check-inline">
                                                                <div class="attribute cf">
                                                                    <section class="plan cf">
                                                                        <span
                                                                            v-for="(weight, index) in all_attributes.weights"
                                                                            :key="weight.weight">
                                                                            <span>
                                                                                <input type="radio" class="colorCls"
                                                                                    v-model="form.weight"
                                                                                    :id="'weight'+index"
                                                                                    data-attr="Weight"
                                                                                    :value="weight.weight">
                                                                                <label class="free-label four col"
                                                                                    :for="'weight'+index"
                                                                                    :title="weight.weight">{{
                                                                                    weight.weight }}</label>
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
                                                    <span class="text-danger" v-if="weight_msg">Please select
                                                        weight</span>
                                                </template>
                                            </div>
                                            <!-- Attribute Weight Section End -->
                                        </span>

                                        <span class="text-danger" v-if="cartMsg">This product is out of stock.</span>

                                        <div class="product-add-to-cart">
                                            <span class="control-label">Quantity</span>
                                            <div class="quantity-section">
                                                <div class="value-button" id="decrease" @click.prevent="decreaseValue"
                                                    value="Decrease Value">-</div>
                                                <input type="number" @keyup="qtyIncDec" id="cart_quantity"
                                                    v-model="cartQty" value="1" />
                                                <div class="value-button" id="increase" @click.prevent="increaseValue"
                                                    value="Increase Value">+</div>
                                            </div>
                                            <span v-if="cartQtyMsg" class="text-danger">Quantity can't be zero or
                                                negative value.</span>
                                            <!-- <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" v-model="cartQty" min="1" type="text" name="qtybutton" value="1">
                                            </div> -->
                                            <p v-if="product.status != 0" class="text-info"><b>{{ this.product_stock
                                                    }}</b> product left in Stock</p>
                                            <!-- <h2>5 product left</h2> -->
                                            <div class="row d-flex justify-content-start" v-if="product.status != 0">
                                                <div class="col-md-4">
                                                    <div class="add mt-4">
                                                        <button class="add-to-cart"
                                                            @click.prevent="addToCart(product)"><i class="ion-bag"></i>
                                                            add-to-cart</button>
                                                        <!--<span class="product-availability">In stock</span>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="add mt-4" v-if="product.status != 0">
                                                        <button class="btn btn-primary btn-lg" id="buynowbtn"
                                                            @click.prevent="buyNow(product)"
                                                            :to="{name: 'checkout', params: {product}}"><i
                                                                class="fas fa-money-check-alt"></i>Buy now</button>
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
                                </div> --}}

                                @if ($product_details->purchase_stock_sum_qty - $product_details->sell_stock_sum_qty > 1 && $product_details->status == 1)
                                    <p class="mt-4 mb-2 single-product-info text-info">
                                        <b>{{ $product_details->purchase_stock_sum_qty - $product_details->sell_stock_sum_qty }}</b> product left in stock
                                    </p>
                                @endif

                                <div class="product-add-to-cart">
                                    @php
                                        $product_data = [];
                                        $product_data['product_id'] = $product_details->id;
                                        $product_data['product_name'] = $product_details->product_name;
                                        $product_data['sales_price'] = $product_details->sales_price;
                                        $product_data['regular_price'] = $product_details->regular_price;
                                        $product_data['slug'] = $product_details->pro_slug;
                                        $product_data = (object) $product_data;
                                        $product_data = json_encode($product_data);
                                    @endphp
                                    <div class="row d-flex justify-content-start">
                                        <div class="col-md-4">
                                            <div class="add mt-4">
                                                
                                                @if ($product_details->purchase_stock_sum_qty - $product_details->sell_stock_sum_qty > 1 && $product_details->status == 1)
                                                    
                                                    <button class="add-to-cart"
                                                    onclick="addToCart({{ $product_data }})"><i
                                                        class="fas fa-shopping-bag"></i>
                                                    add to cart</button>
                                                @else
                                                    <h4>Out of stock</h4>
                                                @endif

                                                <!--<span class="product-availability">In stock</span>-->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            @if ($product_details->purchase_stock_sum_qty - $product_details->sell_stock_sum_qty > 1 && $product_details->status == 1)
                                                <div class="add mt-4">
                                                    
                                                    <button onclick="buyNow({{ $product_data }})"
                                                        class="btn btn-primary btn-lg" id="buynowbtn"><i
                                                            class="fas fa-money-check-alt"></i>Buy now</button>
                                                    <!--<span class="product-availability">In stock</span>-->
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Single Product End-->


            @if ($product_details->youtube_link && $product_details->youtube_link != 'null')
                <div class="row mt-2">
                    <div class="col-md-5 text-left">
                        <h4>More Details: </h4>
                        <iframe width="480" height="315" src="{{ $product_details->youtube_link }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            @endif
            {{-- <div class="container" v-if="product.youtube_link && product.youtube_link != 'null'">
                <div class="row mt-2">
                    <div class="col-md-5 text-left">
                        <h4>More Details: </h4>
                        <iframe width="480" height="315" :src="product.youtube_link" title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div> --}}

            <!--Single Product Review Tab Start-->
            <div class="single-product-review-tab mt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-product-review-and-description-area">
                                <!--Review And Description Tab Menu Start-->
                                {{-- <ul class="nav dec-and-review-menu">
                                    <li>
                                        <a class="active" data-toggle="tab" href="#description">Description</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#reviews">Reviews</a>
                                    </li>
                                </ul> --}}
                                {{-- <nav>
                                    <div class="nav nav-tabs dec-and-review-menu" id="nav-tab" role="tablist">
                                      <a class="nav-link active product_details_nav" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
                                      <a class="nav-link product_details_nav" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Reviews</button>
                                    </div>
                                </nav> --}}
                                <!--Review And Description Tab Menu End-->
                                <!--Review And Description Tab Content Start-->


                                @if ($product_details->long_description)
                                    <h3 class="my-2">More Information</h3>
                                    <div class="single-product-description">
                                        <p>{!! $product_details->long_description !!}</p>
                                    </div>
                                @endif
                                <!--Review And Description Tab Content End-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Single Product Review Tab End-->
        </div>
    </div>

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
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="home-2-product">
                            <div class="row" v-if="related_products && related_products.length > 0">
                                <div class="col-lg-3 col-xl-3 col-md-3" v-for="related_product in related_products"
                                    :key="related_product.id">
                                    <!--Single Product Start-->
                                    <div class="single-product style-2">
                                        <div class="product-img">
                                            <router-link
                                                :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">
                                                <img class="first-img"
                                                    :src="`/assets/uploads/product/${related_product.featured_image}`"
                                                    alt="related_product.product_name">
                                                <img class="hover-img"
                                                    :src="`/assets/uploads/product/${related_product.featured_image}`"
                                                    alt="related_product.product_name">
                                            </router-link>

                                            <div class="product-action">
                                                <ul>
                                                    <li
                                                        v-if="related_product.product_variations && related_product.product_variations.length > 0">
                                                        <router-link
                                                            :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">
                                                            <i class="ion-settings"></i></router-link>
                                                    </li>
                                                    <!-- <li v-else><a href="#" @click.prevent="addToCartRelated(related_product)"><i class="ion-bag"></i></a></li> -->
                                                    <li><a @click.prevent="quickView(related_product, related_product.featured_image, related_product.product_variations)"
                                                            href="#open-modal" data-toggle="modal"><i
                                                                class="ion-eye"></i></a></li>
                                                    <!-- <li><a href="#" @click.prevent="addToWishlist(related_product)"><i class="ion-heart"></i></a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h4>
                                                <router-link
                                                    :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">
                                                    {{ related_product.product_name }}</router-link>
                                            </h4>
                                            <div class="product-price">
                                                <span class="price" v-if="related_product.sales_price"><del>৳{{
                                                        related_product.regular_price | numFormat }}</del> ৳{{
                                                    related_product.sales_price | numFormat }}</span>
                                                <span class="price" v-else>৳{{ related_product.regular_price | numFormat
                                                    }}</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-inline-flex justify-content-between mt-3">
                                                        <div class="col-md-6 col-sm-6">
                                                            <!-- <span v-if="product.product_variations && product.product_variations.length > 0"><router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}"><i class="ion-settings"></i></router-link></span> -->
                                                            <span
                                                                v-if="product.product_variations && product.product_variations.length > 0"><a
                                                                    class="btn btn-primary btn-sm pl-2 detailsbtn">
                                                                    <router-link class="detailsbtn"
                                                                        :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">
                                                                        select variant</router-link>
                                                                </a></span>
                                                            <span v-else><a href="#" @click.prevent="addToCart(product)"
                                                                    class="btn btn-primary btn-sm pr-2 addtocart"><i
                                                                        class="ion-bag"></i>Add to cart</a></span>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <span><a class="btn btn-primary btn-sm pl-2 detailsbtn">
                                                                    <router-link id="detailsbtn"
                                                                        :to="{name: 'singleProduct', params: {slug:related_product.pro_slug}}">
                                                                        Details</router-link>
                                                                </a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Single Product End-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    @if (!empty($related_products) && count($related_products) > 0)
                        @foreach ($related_products as $related_product)
                            <div class="col-lg-3 col-xl-3 col-md-3">
                                <!--Single Product Start-->
                                <div class="single-product style-2 mb-2 mt-1">
                                    <div class="product-img product-img-category">
                                        <a href="{{ route('product_details', $related_product->pro_slug) }}">
                                            <img class="first-img lazy"
                                                data-src="/assets/uploads/product/{{ $related_product->featured_image }}"
                                                alt="{{ $related_product->product_name }}">
                                            <img class="hover-img lazy"
                                                data-src="/assets/uploads/product/{{ $related_product->featured_image }}"
                                                alt="{{ $related_product->product_name }}">
                                            <noscript><img class="first-img"
                                                    src="/assets/uploads/product/{{ $related_product->featured_image }}" /></noscript>
                                        </a>

                                        {{-- <div class="product-action">
                                            <ul>
                                                @if (!empty($related_product->product_variations) && count($related_product->product_variations) > 0)
                                                    <li><a href="#"><i class="ion-settings"></i></a></li>
                                                @endif
                                                <li><a href="#open-modal" data-toggle="modal" data-product="{{ $related_product }}" data-image="{{ $related_product->featured_image }}" data-variations="{{ $related_product->product_variations }}"><i class="ion-eye"></i></a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="product-content">
                                        {{-- <h4><a href="{{ route('singleProduct', ['slug' => $related_product->pro_slug]) }}">{{ $related_product->product_name }}</a></h4> --}}
                                        <h4>
                                            <a href="{{ route('product_details', $related_product->pro_slug) }}">
                                                {{ Illuminate\Support\Str::limit($related_product->product_name, 50) }}
                                            </a>
                                        </h4>
                                        <div class="product-price">
                                            @if (!empty($related_product->sales_price))
                                                <span
                                                    class="price"><del>৳{{ number_format($related_product->regular_price) }}</del>
                                                    ৳{{ number_format($related_product->sales_price) }}</span>
                                            @else
                                                <span
                                                    class="price">৳{{ number_format($related_product->regular_price) }}</span>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-inline-flex gap-3 justify-content-between mt-3">
                                                    <div class="col-md-6 col-sm-6 col-lg-6 col-6">
                                                        @if (!empty($related_product->product_variations) && count($related_product->product_variations) > 0)
                                                            <a class="btn btn-primary btn-sm pl-2 detailsbtn"
                                                                href="{{ route('product_details', $related_product->pro_slug) }}">select variant</a>
                                                            {{-- <a class="btn btn-primary btn-sm pl-2 detailsbtn" href="{{ route('singleProduct', ['slug' => $related_product->pro_slug]) }}">select variant</a> --}}
                                                        @else
                                                            <a href="javascript:void(0)" onclick="addToCart({{ $product_details->id }}, {{ $product_details->regular_price }}, {{ $product_details->sales_price }})"
                                                                class="btn btn-primary btn-sm pr-2 addtocart"><i class="fas fa-shopping-bag me-1"></i>Add to cart</a>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-lg-6 col-6">
                                                        <span>
                                                            {{-- <a class="btn btn-primary btn-sm pl-2 detailsbtn" href="{{ route('singleProduct', ['slug' => $related_product->pro_slug]) }}">Details</a> --}}
                                                            <a class="btn btn-primary btn-sm pl-2 detailsbtn"
                                                                href="{{ route('product_details', $related_product->pro_slug) }}"><i class="fas fa-eye me-1"></i>Details</a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Single Product End-->
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

            <!-- Quick Cart Modal Start -->
            {{-- <div class="modal fade" id="open-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            <img class="first-img" :src="`/assets/uploads/product/${product_image}`"
                                                :alt="product.product_name">
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
                                                <star-rating v-if="product.average_ratting"
                                                    :rating="product.average_ratting" :show-rating="false"
                                                    :read-only="true" :increment="0.01"></star-rating>
                                            </div>
                                        </div>
                                        <div class="single-product-price">
                                            <div class="product-discount">
                                                <span class="regular-price" v-if="product.sales_price"><del>৳{{
                                                        product.regular_price | numFormat }}</del><span
                                                        class="price">৳{{ product.sales_price | numFormat
                                                        }}</span></span>
                                                <span class="price" v-else>৳{{ product.regular_price | numFormat
                                                    }}</span>
                                                <!--<span class="discount">-20%</span>-->
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <p v-if="product.short_description && product.short_description != 'null'">
                                                <span v-html="product.short_description"></span></p>
                                            <p class="mt-0 single-product-info"
                                                v-if="product.product_sku && product.product_sku != 'null'"><b>SKU:</b>
                                                {{ product.product_sku }}</p>
                                            <p class="mt-0 single-product-info" v-if="product.brand"><b>Brand:</b> {{
                                                product.brand.brand_name }}</p>
                                        </div>

                                        <div class="single-product-action">
                                            <form action="#">
                                                <span v-if="product_variations && product_variations.length > 0">
                                                    <!-- Attribute Color Section Start -->
                                                    <div class="product-opts attribute-section"
                                                        v-if="all_attributes.color_count > 0">
                                                        <template>
                                                            <div class="product-opt-title">
                                                                Color
                                                            </div>

                                                            <div class="product-opt">
                                                                <div class="product-opt-col">
                                                                    <div class="form-check-inline">
                                                                        <div class="attribute cf">
                                                                            <section class="plan cf">
                                                                                <span
                                                                                    v-for="(color, index) in all_attributes.colors"
                                                                                    :key="color.color">
                                                                                    <span>
                                                                                        <input type="radio"
                                                                                            class="colorCls"
                                                                                            v-model="form.color"
                                                                                            :id="'color'+index"
                                                                                            data-attr="Color"
                                                                                            :value="color.color">
                                                                                        <label
                                                                                            :style="'background:'+color.color_code"
                                                                                            class="free-label four col"
                                                                                            :for="'color'+index"
                                                                                            :title="color.color"></label>
                                                                                    </span>
                                                                                </span>
                                                                            </section>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span class="text-danger" v-if="color_msg">Please select
                                                                color</span>
                                                        </template>
                                                    </div>
                                                    <!-- Attribute Color Section End -->

                                                    <!-- Attribute Size Section Start -->
                                                    <div class="product-opts attribute-section"
                                                        v-if="all_attributes.size_count > 0">
                                                        <template>
                                                            <div class="product-opt-title">
                                                                Size
                                                            </div>

                                                            <div class="product-opt">
                                                                <div class="product-opt-col">
                                                                    <div class="form-check-inline">
                                                                        <div class="attribute cf">
                                                                            <section class="plan cf">
                                                                                <span
                                                                                    v-for="(size, index) in all_attributes.sizes"
                                                                                    :key="size.size">
                                                                                    <span>
                                                                                        <input type="radio"
                                                                                            class="colorCls"
                                                                                            v-model="form.size"
                                                                                            :id="'size'+index"
                                                                                            data-attr="Size"
                                                                                            :value="size.size">
                                                                                        <label
                                                                                            class="free-label four col"
                                                                                            :for="'size'+index"
                                                                                            :title="size.size">{{
                                                                                            size.size }}</label>
                                                                                    </span>
                                                                                </span>
                                                                            </section>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span class="text-danger" v-if="size_msg">Please select
                                                                size</span>
                                                        </template>
                                                    </div>
                                                    <!-- Attribute Size Section End -->

                                                    <!-- Attribute Weight Section Start -->
                                                    <div class="product-opts attribute-section"
                                                        v-if="all_attributes.weight_count > 0">
                                                        <template>
                                                            <div class="product-opt-title">
                                                                Weight
                                                            </div>

                                                            <div class="product-opt">
                                                                <div class="product-opt-col">
                                                                    <div class="form-check-inline">
                                                                        <div class="attribute cf">
                                                                            <section class="plan cf">
                                                                                <span
                                                                                    v-for="(weight, index) in all_attributes.weights"
                                                                                    :key="weight.weight">
                                                                                    <span>
                                                                                        <input type="radio"
                                                                                            class="colorCls"
                                                                                            v-model="form.weight"
                                                                                            :id="'weight'+index"
                                                                                            data-attr="Weight"
                                                                                            :value="weight.weight">
                                                                                        <label
                                                                                            class="free-label four col"
                                                                                            :for="'weight'+index"
                                                                                            :title="weight.weight">{{
                                                                                            weight.weight }}</label>
                                                                                    </span>
                                                                                </span>
                                                                            </section>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <span class="text-danger" v-if="weight_msg">Please select
                                                                weight</span>
                                                        </template>
                                                    </div>
                                                    <!-- Attribute Weight Section End -->
                                                </span>

                                                <span class="text-danger" v-if="cartMsg">This product is out of
                                                    stock.</span>
                                                <div class="product-add-to-cart">
                                                    <span class="control-label">Quantity</span>
                                                    <div class="quantity-section">
                                                        <div class="value-button" id="decrease"
                                                            @click.prevent="decreaseValue" value="Decrease Value">-
                                                        </div>
                                                        <input type="number" @keyup="qtyIncDec" id="carts_quantity"
                                                            v-model="cartQty" value="1" />

                                                        <div class="value-button" id="increase"
                                                            @click.prevent="increaseValue" value="Increase Value">+
                                                        </div>
                                                    </div>
                                                    <span v-if="cartQtyMsg" class="text-danger">Quantity can't be zero
                                                        or negative value.</span>


                                                    <!--<div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" min="1" type="number" name="qtybutton" v-model="cartQty" value="1">
                                                    </div>-->
                                                    <div class="add mt-4">
                                                        <button class="add-to-cart"
                                                            @click.prevent="addToCart(product)"><i
                                                                class="zmdi zmdi-shopping-cart-plus"></i>
                                                            add-to-cart</button>
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
            </div> --}}
            <!-- Quick Cart Modal End -->

        </div>
    </div>
    <!-- End You may also like Section -->


    <!-- End You may also like Section -->
</div>
<script>
    $("#zoom1").elevateZoom({
        zoomWindowFadeIn : 500,
        zoomLensFadeIn: 500,
        gallery: "gallery_01",
        imageCrossfade: true,
        zoomWindowWidth:200,
        zoomWindowHeight:200,
        zoomWindowOffetx: 10,
        scrollZoom: true,
        cursor:"pointer",
        easyZoom:true,
        easing:true,
        responsive:true,
        lensSize: 10,
        // cursor:"url('http://sobujdiganta.com/images/sample3.png'),auto",
    });

    $("#img_01").bind("click", function(e) {
        var ez =   $('#img_01').data('elevateZoom');
        $.fancybox(ez.getGalleryList());
        return false;
    });
</script>
<style>
    .ratings .fa.fa-star{
        color: #f5ba00;
        display: inline-block;
        padding: 1px 2px;
        cursor: pointer;
    }
    .zoomLens{
        /* cursor: url('http://sobujdiganta.com/images/sample3.png'),auto !important; */
        /* background: url('https://laajim.com//hover.png') !important; */

    }
    .zoomWindow{
        border: 0 !important;
        z-index: 999999;
        box-shadow: 0px 0px 10px rgba(0,0,0,.5);
    }
    .input-group{
        z-index: 0;
    }

    @media (min-width:992px) and (max-width:1199.99px){
        .zoomWindow{
            width: 270px !important;
            height: 300px !important;
        }
        .zoomWrapper img{
            width: 290px !important;
            height: 290px !important;
        }
    }
    @media (min-width:1200px){
        .zoomWindow{
            width: 488px !important;
            height: 400px !important;
            top: -30px !important;
        }
        .zoomWrapper{
            width: 300px !important;
            height: 313px !important;
        }
        .zoomWrapper img{
            width: 300px !important;
            height: 313px !important;
        }
    }

    @media (min-width:768px) and (max-width:991.99px){
        .zoomWindow{
            top: 210px !important;
            left: 0px !important;
        }
        .zoomWrapper img{
            width: 200px !important;
            height: 200px !important;
        }
    }
</style>
