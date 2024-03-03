<template>
    <div id="checkout">
        <!--Breadcrumb Area Start-->
        <!-- <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="active">Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--Breadcrumb Area End-->

        <div v-if="checkoutLoader" class="loading-checkout"></div>

        <!--Checkout Area Strat-->
        <div class="checkout-area">
            <div class="container checkout-page-main">
                <div class="row">
                    <div class="col-12">
                        <div class="coupon-accordion">
                            <!-- <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                            <div id="checkout-login" class="coupon-content">
                                <div class="coupon-info">
                                    <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>
                                    <form action="#">
                                        <p class="form-row-first">
                                            <label>Username or email <span class="required">*</span></label>
                                            <input type="text">
                                        </p>
                                        <p class="form-row-last">
                                            <label>Password  <span class="required">*</span></label>
                                            <input type="text">
                                        </p>
                                        <p class="form-row">
                                            <input value="Login" type="submit">
                                            <label>
                                                <input type="checkbox">
                                                Remember me
                                            </label>
                                        </p>
                                        <p class="lost-password"><a href="#">Lost your password?</a></p>
                                    </form>
                                </div>
                            </div> -->

                            <!-- <h3>Have a coupon? <span id="showcoupon"> Click here to enter your code</span></h3>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form action="#">
                                        <p class="checkout-coupon">
                                            <input placeholder="Coupon code" type="text" v-model="coupon_code">
                                            <input value="Apply Coupon" type="submit" @click.prevent="applyCoupon"><br>
                                            <span class="text-danger mt-1" v-if="coupon_msg && coupon_msg.length > 0">{{ coupon_msg }}</span>
                                        </p>
                                    </form>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <form action="#">
                            <div class="checkbox-form">
                                <h3>Billing Details</h3>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Full Name <span class="required">*</span></label>
                                            <input placeholder="e.g. Rahim" @change="changeName" v-model="form.name" type="text">
                                            <span class="text-danger" v-if="errors['name']">{{ errors['name'][0] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input v-model="form.address" @change="changeAddress" placeholder="e.g. House#1, Road#1, Dhaka" type="text">
                                            <span class="text-danger" v-if="errors['address']">{{ errors['address'][0] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email Address</label>
                                            <input v-model="form.email" @change="changeEmail" placeholder="e.g. example@exmple.com" type="email">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone  <span class="required">*</span></label>
                                            <input v-model="form.phone" @change="changePhone" type="number" placeholder="e.g. 01xxxxxxxxx">
                                            <span class="text-danger" v-if="errors['phone']">{{ errors['phone'][0] }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Product Delivery Date (Optional)</label>
                                            <input @change="changeDeliveryDate" class="delivery-date" v-model="form.delivery_date" type="date">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>Special Notes (Optional)</label>
                                                <textarea @change="changeNotes" v-model="form.notes" id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" v-if="!user.id">
                                        <p class="new-account-text">For a better experience and order history, create an account with us</p>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list create-acc" v-if="!user.id">
                                            <input id="cbox" type="checkbox" v-model="createAccount">
                                            <label>Create an account?</label>
                                        </div>
                                        <div id="cbox-info" class="checkout-form-list create-account d-block" v-if="createAccount">
                                            <p>Create an account by entering the information below.</p>
                                            <label>Account password  <span class="required">*</span></label>
                                            <input v-model="form.account_password" placeholder="e.g. ********" type="password">
                                            <span class="text-danger" v-if="errors['account_password']">{{ errors['account_password'][0] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="different-address">
                                    <div class="ship-different-title">
                                        <h3>
                                            <label>Send this as a gift</label>
                                            <input id="ship-box" type="checkbox" v-model="shippingDisplay">
                                        </h3>
                                    </div>
                                    <div id="ship-box-info" class="row d-block" v-if="shippingDisplay">
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Full Name <span class="required">*</span></label>
                                                <input v-model="form.shipping_name" placeholder="e.g. Rahim" type="text">
                                                <span class="text-danger" v-if="errors['shipping_name']">{{ errors['shipping_name'][0] }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input v-model="form.shipping_address" placeholder="e.g. House#1, Road#1, Dhaka" type="text">
                                                <span class="text-danger" v-if="errors['shipping_address']">{{ errors['shipping_address'][0] }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Email Address</label>
                                                <input v-model="form.shipping_email" placeholder="e.g. example@exmple.com" type="email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Phone  <span class="required">*</span></label>
                                                <input v-model="form.shipping_phone" placeholder="e.g. 01xxxxxxxxx" type="number">
                                                <span class="text-danger" v-if="errors['shipping_phone']">{{ errors['shipping_phone'][0] }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="order-notes">
                                                <div class="checkout-form-list">
                                                    <label>Personal note for the recipient (Optional)</label>
                                                    <textarea v-model="form.personal_notes" id="checkout-mess" cols="30" rows="10" placeholder="e.g. Personal notes for the recipient."></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div v-if="cards && cards.length > 0">
                                                <div class="country-select clearfix">
                                                    <label>Add Greetings Card (Optional)</label>
                                                    <select @change.prevent="changeGreetingsCard($event)" v-model="card_id" class="form-control">
                                                        <option value="0">Select Greetings Card</option>
                                                        <option v-for="card in cards" :key="card.id" :price="card.price" :value="card.id">{{ card.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div v-if="packagings && packagings.length > 0">
                                                <div class="country-select clearfix">
                                                    <label>Packaging (Optional)</label>
                                                    <select @change.prevent="changePackaging($event)" v-model="packaging_id" class="form-control">
                                                        <option value="0">Select Packaging</option>
                                                        <option v-for="packaging in packagings" :price="packaging.price" :key="packaging.id" :value="packaging.id">{{ packaging.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="shippings_charges && shippings_charges.length > 0">
                                        <div class="country-select clearfix">
		                                    <label>Shipping Method <span class="required">*</span></label>
		                                    <select @change.prevent="shippingMethod" v-model="shipping_charge_id" class="form-control" >
                                                <option value="0">Select Shipping Method</option>
                                                <!-- <option v-if="cart_products.total > 900" value="0">Free Delivary</option> -->
                                                <option v-for="shippings_charge in shippings_charges" :key="shippings_charge.id" :value="shippings_charge.id">{{ shippings_charge.name }}</option>
                                           </select>
                                           <span class="text-danger" v-if="errors.shipping_charge_id || shippingAlert">{{ errors.shipping_charge_id[0] || shippingAlert }}</span>
                                           <!-- <span class="text-danger" v-show="shippingAlert">{{ shippingAlert }}</span> -->
		                                </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-12">

                        <!-- Addon Products Part -->
                        <div class="row mt-3 mb-3">
                            <div class="col-12" v-if="cart_products.addon_products && cart_products.addon_products.length > 0">
                                <!--Section Title Start-->
                                <div class="text-center add-on">
                                    <h4 class="text-white ml-2 mb-2 mt-2">Addons:</h4>
                                </div>
                                <!--Section Title End-->

                                <div class="addon-product-section mt-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- <li v-for="addon_product in get_addon_products" :key="addon_product.id">{{i.id}} {{i.product.product_name}}</li> -->
                                            <div class="row">
                                                <div class="col-md-4" v-for="addon_product in cart_products.addon_products" :key="addon_product.id">
                                                    <div class="single-product style-2">
                                                        <div class="product-img">
                                                            <a @click.prevent="quickView(addon_product.product, addon_product.product.featured_image)" href="#open-modal" data-toggle="modal">
                                                                <img class="first-img" :src="`/assets/uploads/product/${addon_product.product.featured_image}`" alt="addon_product.product_name">
                                                                <img class="hover-img" :src="`/assets/uploads/product/${addon_product.product.featured_image}`" alt="addon_product.product_name">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4><a @click.prevent="quickView(addon_product.product, addon_product.product.featured_image)" href="#open-modal" data-toggle="modal">{{ addon_product.product.product_name }}</a></h4>
                                                            <div class="product-price">
                                                                <span class="price" v-if="addon_product.product.sales_price"><del>৳{{ addon_product.product.regular_price | numFormat }}</del> ৳{{ addon_product.product.sales_price | numFormat }}</span>
                                                                <span class="price" v-else>৳{{ addon_product.product.regular_price | numFormat }}</span>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="d-flex flex-column">
                                                                    <div class="col-md-12 col-sm-12 ">
                                                                        <!-- <span v-if="product.product_variations && product.product_variations.length > 0"><router-link :to="{name: 'singleProduct', params: {slug:product.pro_slug}}"><i class="ion-settings"></i></router-link></span> -->
                                                                        <span><a href="#" @click.prevent="addToCartAddon(addon_product.product)" class="btn btn-primary btn-sm pr-2 addtocart text-center"><i class="ion-bag"></i>Add</a></span>
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
                            </div>
                        </div>
                        <!-- Addon Products Part -->

                        <div class="your-order">
                            <p class="CouponCss mb-4">Have a coupon ? <span id="showcoupon"> Click here to enter your code</span></p>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form action="#">
                                        <p class="checkout-coupon">
                                            <input placeholder="Coupon code" type="text" v-model="coupon_code">
                                            <input value="Apply Coupon" type="submit" @click.prevent="applyCoupon"><br>
                                            <span class="text-success" v-bind:class="{ 'text-danger': hasError }" v-if="coupon_msg && coupon_msg.length > 0">{{ coupon_msg }}</span>
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <h3 class="text-center">Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="cart-product-name">Product</th>
                                        <th class="cart-product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="cart_item" v-for="product in cart_products.products" :key="product.id">
                                        <td class="cart-product-name"> {{ product.name }}<strong class="product-quantity"> × {{ product.quantity }}</strong></td>
                                        <td class="cart-product-total"><span class="amount">৳{{ product.quantity * product.price }}</span></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">৳ {{ cart_products.sub_total }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal" v-if="cart_products.discount > 0">
                                        <th>Discount</th>
                                        <td><span class="amount">৳ {{ cart_products.discount + coupon_amount }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal" v-else>
                                        <template v-if="coupon_amount > 0">
                                            <th>Discount</th>
                                            <td><span class="amount">৳ {{ coupon_amount }}</span></td>
                                        </template>
                                    </tr>
                                    <tr class="cart-subtotal" v-if="cart_products.vat > 0">
                                        <th>Vat</th>
                                        <td><span class="amount">৳ {{ cart_products.vat }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal" v-if="shipping_charge">
                                        <th>Shipping Charge</th>
                                        <td><span class="amount shippingCharge">৳ {{ shipping_charge }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal" v-if="card_price">
                                        <th>Greetings Card</th>
                                        <td><span class="amount shippingCharge">৳ {{ card_price }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal" v-if="packaging_price">
                                        <th>Packaging</th>
                                        <td><span class="amount shippingCharge">৳ {{ packaging_price }}</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">৳ {{ orderTotal(cart_products.total, shipping_charge, card_price, packaging_price) - coupon_amount}}</span></strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method mt-0">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <p><b>Select a Payment Method</b> <span class="text-danger">*</span></p>
                                        <div class="card">

                                            <div class="row mb-2">

                                                <div class="col-md-4 col-sm-12 col-12">
                                                <div class="payment_single text-center">
                                                        <a @click="cashOn" class="btn" :class="{selected: cash_on}" data-toggle="collapse" data-target="#cashOnDelivery" aria-expanded="true" aria-controls="cashOnDelivery">
                                                            <img src="assets/frontend/img/cart/cash-on-delivery.png" class="img-fluid mx-auto d-block mb-2">
                                                            <span><i class="fas fa-truck"></i><b>Cash On Delivery</b></span>
                                                        </a>
                                                        <!-- <div class="card-header" >
                                                            <h5 class="panel-title">
                                                                <a @click="cashOn" class="btn btn-dark" data-toggle="collapse" data-target="#cashOnDelivery" aria-expanded="true" aria-controls="cashOnDelivery">
                                                                    <span :class="{active: cash_on}"><i class="fas fa-truck"></i>Cash On Delivery</span>
                                                                </a>
                                                            </h5>
                                                        </div> -->
                                                </div>
                                                </div>

                                                <div class="col-md-4 col-sm-12">
                                                    <div class="payment_single text-center">
                                                        <div class="card-header" id="#payment-2">
                                                            <h5 class="panel-title">
                                                                <a @click="onlinePay" :class="{selected: online}" class="btn" data-toggle="collapse" data-target="#onlinePayment" aria-expanded="false" aria-controls="onlinePayment">
                                                                    <img src="assets/frontend/img/cart/secure.png" class="img-fluid mx-auto d-block mb-2">
                                                                    <span><i class="fas fa-money-check"></i><b>Online Payment</b></span>
                                                                </a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-sm-12">
                                                    <div class="payment_single text-center">
                                                        <div class="card-header" id="#payment-3">
                                                            <h5 class="panel-title">
                                                                <a @click="bkash()" :class="{selected: Bkash}" class="btn collapsed">
                                                                    <img src="assets/frontend/img/cart/bkash.svg" class="img-fluid mx-auto d-block bkash_img">
                                                                    <span><b>Bkash</b></span>
                                                                </a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="card">
                                            <div id="onlinePayment" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <button id="sslczPayBtn" @click.prevent="sslCommerzePayment" class="btn mln-btn mln-btn--border btn-block" token="data" postdata="data" order="data" endpoint="/pay-via-ajax">PAY NOW</button>
                                                </div>
                                            </div>
                                            <div id="cashOnDelivery" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div v-if="cart_products.total > 0" class="order-button-payment">
                                                        <input :value="place_order" type="submit" @click.prevent="placeOrder">
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
            </div>
        </div>
        <!--Checkout Area End-->

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
                                                <div class="add mt-4">
                                                    <button class="add-to-cart" @click.prevent="addToCartAddon(product)"><i class="zmdi zmdi-shopping-cart-plus"></i> add-to-cart</button>
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
    import $ from 'jquery'
    export default {
        name: "CheckoutComponent",
        data() {
            return {
                form: {
                    name: '',
                    address: '',
                    phone: '',
                    email: '',
                    shipping_name: '',
                    shipping_address: '',
                    shipping_phone: '',
                    shipping_email: '',
                    delivery_date: '',
                    notes: '',
                    personal_notes: '',
                    user_id: '',
                    bkash_number: '',
                    transaction_id: '',
                    account_password: '',
                    payment_method: ''
                },
                product: '',
                errors: [],
                shippingAlert: '',
                shippingDisplay: false,
                createAccount: false,
                product_image: {},
                cartQty: 0,
                product_variations: '',
                cartMsg: '',
                qtyIncDec: '',
                cartQtyMsg: '',
                cashOnDelivery: true,
                shipping_charge_id: 0,
                shipping_charge: null,
                place_order: 'Place Order',
                checkoutLoader: false,
                totalOrderAmount: 0,
                coupon_code: '',
                coupon_msg: '',
                coupon_amount: 0,
                hasError: false,
                payment_type: "1",
                payment_method: '',
                online: false,
                Bkash: false,
                cash_on: true,
                packaging_id: 0,
                packaging_price: 0,
                card_id: 0,
                card_price: 0,
                isActive: 'false'
            }
        },
        methods: {
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
            shippingMethod(){
                let shipping_id = this.shipping_charge_id
                axios.post('get-shipping-charge', {'shipping_id': shipping_id})
                    .then((result) => {
                        this.shipping_charge = result.data
                        this.changeObj();
                        this.onlineValidation();

                    }).catch((error) => {

                });
            },
            changeGreetingsCard(e){
                var options = e.target.options
                if (options.selectedIndex > -1) {
                    var price = options[options.selectedIndex].getAttribute('price');
                    this.card_price = parseInt(price)
                }
            },
            changePackaging(e){
                var options = e.target.options
                if (options.selectedIndex > -1) {
                    var price = options[options.selectedIndex].getAttribute('price');
                    this.packaging_price = parseInt(price)
                }
            },
            orderTotal(cartTotal, shippingCharge, card_price, packaging_price){
                if(this.coupon_amount > 0){
                    this.totalOrderAmount = (cartTotal + shippingCharge + card_price + packaging_price) - this.coupon_amount;
                }else{
                    this.totalOrderAmount = cartTotal + shippingCharge + card_price + packaging_price;
                }
                // console.log(this.cart_products.sku);
                this.changeObj();
                return cartTotal + shippingCharge + card_price + packaging_price;
            },
            // CART ALL PRODUCTS
            productList() {
                this.$store.dispatch('cart/productList');
            },
            placeOrder() {

                //Initial Checkout For Facebook
	            var price      = this.totalOrderAmount;
                var skus = this.product.id;
	            // var skus       = this.cart_products.sku;
                fbq('track', 'InitiateCheckout',{
                    value: price,
                    currency: 'BDT',
                    content_ids: skus,
                    content_type: 'product'
                });

                //Initial Checkout For Facebook


                this.place_order = 'Loading. please wait...'
                this.checkoutLoader = true
                $('.checkout-area').css('filter','blur(2px)');

                const formData = new FormData();
                formData.append("name", this.form.name);
                formData.append("address", this.form.address);
                formData.append("phone", this.form.phone);
                formData.append("email", this.form.email);
                formData.append("shipping_name", this.form.shipping_name);
                formData.append("shipping_address", this.form.shipping_address);
                formData.append("shipping_phone", this.form.shipping_phone);
                formData.append("shipping_email", this.form.shipping_email);
                formData.append("shippingDisplay", this.shippingDisplay);
                formData.append("payment_method", this.payment_method);
                formData.append("transaction_id", this.form.transaction_id);
                formData.append("cashOnDelivery", this.cashOnDelivery);
                formData.append("createAccount", this.createAccount);
                formData.append("notes", this.form.notes);
                formData.append("shipping_charge_id", this.shipping_charge_id);
                formData.append("shipping_charge", this.shipping_charge);
                formData.append("delivery_date", this.form.delivery_date);
                formData.append("payment_type", this.payment_type);
                formData.append("coupon_code", this.coupon_code);
                formData.append("coupon_amount", this.coupon_amount);
                formData.append("personal_notes", this.form.personal_notes);
                formData.append("packaging_id", this.packaging_id);
                formData.append("packaging_price", this.packaging_price);
                formData.append("card_id", this.card_id);
                formData.append("card_price", this.card_price);
                if(this.form.id){
                    formData.append("user_id", this.form.id);
                }else{
                    formData.append("user_id", this.form.user_id);
                }
                axios.post('cash-on-delivery', formData)
                    .then((result) => {
                        this.place_order = 'Place Order'
                        this.checkoutLoader = false
                        $('.checkout-area').css('filter','none');

                        this.$store.dispatch('cart/productList');
                        this.$router.push({ path: 'thank-you', query: { order_id: result.data } })
                        //this.$router.push({name: 'userDashboard'})
                        this.$message({
                            showClose: true,
                            message: 'Your order placed successfully.',
                            type: 'success'
                        });
                    }).catch((error) => {
                        this.place_order = 'Place Order'
                        this.checkoutLoader = false
                        $('.checkout-area').css('filter','none');
                        this.errors = error.response.data.errors
                });

            },
            getUser(){
                this.$store.dispatch('user/getUser');
            },
            checkoutShippingList(){
                this.$store.dispatch('shipping/checkoutShippingList')
            },
            checkoutPackagingList(){
                this.$store.dispatch('packaging/checkoutPackagingList')
            },
            checkoutCardList(){
                this.$store.dispatch('card/checkoutCardList')
            },

            changeObj(){
                var obj = {};
                obj.cus_name            = this.form.name;
                obj.cus_phone           = this.form.phone;
                obj.cus_email           = this.form.email;
                obj.cus_addr1           = this.form.address;
                obj.amount              = this.totalOrderAmount;
                obj.notes               = this.form.notes;
                obj.delivery_date       = this.form.delivery_date;
                obj.shipping_charge     = this.shipping_charge;
                obj.shipping_charge_id  = this.shipping_charge_id;
                obj.payment_type        = this.payment_type;
                obj.shippingDisplay     = this.shippingDisplay;
                obj.createAccount       = this.createAccount;
                obj.coupon_code         = this.coupon_code;
                obj.coupon_amount       = this.coupon_amount;
                obj.packaging_id        = this.packaging_id;
                obj.packaging_price     = this.packaging_price;
                obj.card_id             = this.card_id;
                obj.card_price          = this.card_price;
                obj.personal_notes      = this.form.personal_notes;
                if(this.form.account_password != ''){
                    obj.account_password    = this.form.account_password;
                }else{
                    obj.account_password    = this.form.phone;
                }

                if(this.shippingDisplay === false){
                    obj.shipping_name       = this.form.name;
                    obj.shipping_phone      = this.form.phone;
                    obj.shipping_email      = this.form.email;
                    obj.shipping_address    = this.form.address;
                }else{
                    obj.shipping_name       = this.form.shipping_name;
                    obj.shipping_phone      = this.form.shipping_phone;
                    obj.shipping_email      = this.form.shipping_email;
                    obj.shipping_address    = this.form.shipping_address;
                }

                $('#sslczPayBtn').prop('postdata', obj);
                //console.log(obj)
            },
            changeName(){
                this.changeObj();
                this.onlineValidation();
            },
            changeAddress(){
                this.changeObj();
                this.onlineValidation();
            },
            changeEmail(){
                this.changeObj();
            },
            changePhone(){
                this.changeObj();
                this.onlineValidation();
            },
            changeNotes(){
                this.changeObj();
            },
            changeDeliveryDate(){
                this.changeObj();
            },

            addToCartAddon(product){
                //ADD TO CART EVENT FOR FACEBOOK
                if(product.sales_price && product.sales_price.length > 0){
                    var price = product.sales_price
                }else{
                    var price = product.regular_price
                }
                // var product_sku = product.product_sku.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
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
            // changeShippingmethod() {
            //     this.changeObj();
            //     this.onlineValidation();
            // },
            cashOn(){
                this.online = false
                this.Bkash = false
                this.cash_on = true
            },
            checkinfo() {
                if(this.form.bkash_number && this.form.transaction_id != null) {
                    this.isActive = true;
                }
            },

            bkash(){
                this.online = false
                this.cash_on = false
                this.Bkash = true
                if(this.cart_products.total > 0 && this.form.name != null && this.form.phone != null && this.form.address != null && this.shipping_charge != null) {
                    //Initial Checkout For Facebook
                    var price      = this.totalOrderAmount;
                    var skus = this.product.id;
                    // var skus       = this.cart_products.sku;
                    fbq('track', 'InitiateCheckout',{
                        value: price,
                        currency: 'BDT',
                        content_ids: skus,
                        content_type: 'product'
                    });

                    //Initial Checkout For Facebook


                    this.place_order = 'Loading. please wait...'
                    this.checkoutLoader = true
                    $('.checkout-area').css('filter','blur(2px)');

                    const formData = new FormData();
                    formData.append("name", this.form.name);
                    formData.append("address", this.form.address);
                    formData.append("phone", this.form.phone);
                    formData.append("email", this.form.email);
                    formData.append("shipping_name", this.form.shipping_name);
                    formData.append("shipping_address", this.form.shipping_address);
                    formData.append("shipping_phone", this.form.shipping_phone);
                    formData.append("shipping_email", this.form.shipping_email);
                    formData.append("shippingDisplay", this.shippingDisplay);
                    formData.append("payment_method", this.payment_method);
                    formData.append("transaction_id", this.form.transaction_id);
                    formData.append("cashOnDelivery", this.cashOnDelivery);
                    formData.append("createAccount", this.createAccount);
                    formData.append("notes", this.form.notes);
                    formData.append("shipping_charge_id", this.shipping_charge_id);
                    formData.append("shipping_charge", this.shipping_charge);
                    formData.append("delivery_date", this.form.delivery_date);
                    formData.append("payment_type", this.payment_type);
                    formData.append("coupon_code", this.coupon_code);
                    formData.append("coupon_amount", this.coupon_amount);
                    formData.append("personal_notes", this.form.personal_notes);
                    formData.append("packaging_id", this.packaging_id);
                    formData.append("packaging_price", this.packaging_price);
                    formData.append("card_id", this.card_id);
                    formData.append("card_price", this.card_price);
                    if(this.form.id){
                        formData.append("user_id", this.form.id);
                    }else{
                        formData.append("user_id", this.form.user_id);
                    }
                    axios.post('order_data_bkash', formData)
                        .then((result) => {
                            this.place_order = 'Place Order'
                            this.checkoutLoader = false
                            $('.checkout-area').css('filter','none');

                            console.log(result);
                            window.location.href = '/bkash_payment';
                            //this.$router.push({name: 'userDashboard'})
                            this.$message({
                                showClose: true,
                                message: 'Redirecting to payment page',
                                type: 'success'
                            });
                        }).catch((error) => {
                            this.place_order = 'Place Order'
                            this.checkoutLoader = false
                            $('.checkout-area').css('filter','none');
                            this.errors = error.response.data.errors
                    });

                }else {
                    this.$message({
                        showClose: true,
                        message: 'PLease fill in the required info!',
                        type: 'error'
                    });
                }
            },

            onlinePay(){
                this.online = true
                this.Bkash = false
                this.cash_on = false

                this.onlineValidation();
            },

            onlineValidation(){
                if(this.cart_products.total < 1000) {
                    // console.log('your order < 1000');
                    this.shippingAlert = 'your order amount should be at least 1000 tk to get free delivery'
                    this.changeObj();
                    if(this.shipping_charge != 0) {
                        this.shippingAlert = ''
                    }
                }
                if(this.form.name != "" && this.form.phone != "" && this.form.address != "" && this.shipping_charge_id != 0) {
                    this.errors = {
                        name: [],
                        address: [],
                        phone: [],
                        shipping_charge_id: [],
                    }
                }else if(this.form.name != "" && this.form.phone == "" && this.form.address == "" && this.shipping_charge_id == 0){
                    this.errors = {
                        name: [],
                        address: ['The address field is required.'],
                        phone: ['The phone field is required.'],
                        shipping_charge_id: ['The shipping method field is required.'],
                    }
                }else if(this.form.name != "" && this.form.phone != "" && this.form.address == "" && this.shipping_charge_id == 0){
                    this.errors = {
                        name: [],
                        address: [],
                        phone: ['The phone field is required.'],
                        shipping_charge_id: ['The shipping method field is required.'],
                    }
                }else if(this.form.name != "" && this.form.phone != "" && this.form.address != "" && this.shipping_charge_id == 0){
                    this.errors = {
                        name: [],
                        address: [],
                        phone: [],
                        shipping_charge_id: ['The shipping method field is required.'],
                    }
                }else if(this.form.name == "" && this.form.phone != "" && this.form.address != "" && this.shipping_charge_id != 0){
                    this.errors = {
                        name: ['The name field is required.'],
                        address: [],
                        phone: [],
                        shipping_charge_id: [],
                    }
                }else if(this.form.name != "" && this.form.phone == "" && this.form.address != "" && this.shipping_charge_id != 0){
                    this.errors = {
                        name: [],
                        address: ['The address field is required.'],
                        phone: [],
                        shipping_charge_id: [],
                    }
                }else if(this.form.name == "" && this.form.phone == "" && this.form.address != "" && this.shipping_charge_id == 0){
                    this.errors = {
                        name: ['The name field is required.'],
                        address: [],
                        phone: ['The phone field is required.'],
                        shipping_charge_id: ['The shipping method field is required.'],
                    }
                }else if(this.form.name == "" && this.form.phone != "" && this.form.address == "" && this.shipping_charge_id == 0){
                    this.errors = {
                        name: ['The name field is required.'],
                        address: ['The address field is required.'],
                        phone: [],
                        shipping_charge_id: ['The shipping method field is required.'],
                    }
                }else if(this.form.name != "" && this.form.phone != "" && this.form.address == "" && this.shipping_charge_id != 0){
                    this.errors = {
                        name: [],
                        address: [],
                        phone: ['The phone field is required.'],
                        shipping_charge_id: [],
                    }
                }else if(this.form.name == "" && this.form.phone == "" && this.form.address == "" && this.shipping_charge_id != 0){
                    this.errors = {
                        name: ['The name field is required.'],
                        address: ['The address field is required.'],
                        phone: ['The phone field is required.'],
                        shipping_charge_id: [],
                    }
                }else if(this.form.name == "" && this.form.phone == "" && this.form.address == "" && this.shipping_charge_id == 0){
                    this.errors = {
                        name: ['The name field is required.'],
                        address: ['The address field is required.'],
                        phone: ['The phone field is required.'],
                        shipping_charge_id: ['The shipping method field is required.'],
                    }
                }
            },
            sslCommerzePayment(){
                this.changeObj();

                (function (window, document) {
                    var loader = function () {
                        var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                        script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                        //script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                        tag.parentNode.insertBefore(script, tag);
                    };
                    window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
                })(window, document);
            },
            
            applyCoupon() {

                axios.post('apply-coupon', {coupon_code: this.coupon_code})
                    .then((result) => {
                        if(result.data.error) {
                            this.coupon_msg = result.data.error
                            this.hasError = true
                        }
                        if(result.data.success) {
                            this.changeObj();
                            this.hasError = false
                            this.coupon_amount = result.data.coupon_amount
                            this.coupon_msg = result.data.success
                        } else {
                            this.coupon_amount = 0
                        }
                    }).catch((error) => {
                        this.errors = error.response.data.errors
                });

            }
        },
        computed: {
            // CART ALL PRODUCTS
            // filtershipping() {
            //     if(this.cart_products.total > 1000) {
            //         return this.shippings_charges.shipping_charge = this.shipping_charge.filter(this.shippings_charges.shipping_charge == 0)
            //     }
            // },
            cart_products(){
                return this.$store.getters['cart/productList'];
            },
            user(){
                return this.$store.getters['user/getUserDetails']
            },
            shippings_charges(){
                return this.$store.getters['shipping/sellerShippingList'];
            },
            packagings(){
                return this.$store.getters['packaging/checkoutPackagingList'];
            },
            cards(){
                return this.$store.getters['card/checkoutCardList'];
            }
        },
        created() {
            this.productList();
            this.getUser();
            this.checkoutShippingList();
            this.checkoutPackagingList();
            this.checkoutCardList();
            this.sslCommerzePayment();
        },
        mounted() {

        },
        watch: {
            user: {
                handler: function(newVal, oldVal) {
                    this.form = newVal;
                    this.form.delivery_date = ''
                    this.form.notes = ''
                    this.form.personal_notes = ''
                },
                // IF OBJECT->OBJECT (NESTED)
                deep: true
            },
            '$route':{
                handler: (to, from) => {
                    document.title = 'Checkout | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>
.add-on {
    background-color: #5e2e87;
    padding: 5px;
}
.selected {
    border: 2px solid #5e2e87;
    padding-right: 5px;
    padding-left: 5px;
}
.bkash_img {
    height: 90px;
}
.add-on h4{
    margin-left: 5px;
    padding-top: 3px;
}
.addtocart {
    background-color: #5e2e87;
    font-size: 12px;
    text-transform: capitalize;
    padding-left: 15px;
}
.addtocart i {
    margin-right: 5px;
    padding-left: 1px;
    margin-right: 5px;
    margin-left: -5px;
}
.payment_single i {
    margin-right: 4px;
}
</style>
