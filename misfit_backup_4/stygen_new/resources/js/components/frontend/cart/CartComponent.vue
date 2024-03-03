<template>
    <div id="cart">
        <!--Breadcrumb Area Start-->
        <!-- <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="active">Shopping Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--Breadcrumb Area End-->
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area">
            <div class="container cart-page-main">
                <div class="row">
                    <div class="col-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="picaboo-product-remove">remove</th>
                                        <th class="picaboo-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="picaboo-product-price">Unit Price</th>
                                        <th class="picaboo-product-quantity">Quantity</th>
                                        <th class="picaboo-product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="product in cart_products.products" :key="product.id">
                                        <td class="picaboo-product-remove">
                                            <a href="#" @click.prevent="removeCartProduct(product.id)"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td class="picaboo-product-thumbnail">
                                            <a href="#"><img v-if="product.attributes.image" :src="`assets/uploads/product/${product.attributes.image}`" width="100px" :alt="product.name"></a>
                                        </td>
                                        <td class="picaboo-product-name">
                                            <a href="#">{{ product.name }}</a><br>
                                            <span v-if="product.attributes.color"><small>Color: {{ product.attributes.color }}</small></span>
                                            <span v-if="product.attributes.size"><small>, Size: {{ product.attributes.size }}</small></span>
                                            <span v-if="product.attributes.weight"><small>, Weight: {{ product.attributes.weight }}</small></span>
                                        </td>
                                        <td class="picaboo-product-price"><span class="amount">৳{{ product.price }}</span></td>
                                        <td class="picaboo-product-quantity">
                                            <input min="1" value="1" type="number" @keyup.prevent="updateQty(product.id, product.quantity)" v-model="product.quantity">
                                        </td>
                                        <td class="product-subtotal"><span class="amount">৳ {{ product.price * product.quantity }}</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <!-- <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                        </div> -->
                                        <!--<div class="coupon2">
                                            <input class="button" name="update_cart" value="Update cart" type="submit">
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total pt-0">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Subtotal <span>৳ {{ cart_products.sub_total }}</span></li>
                                            <li v-if="cart_products.discount > 0">Discount <span>৳ {{ cart_products.discount }}</span></li>
                                            <li v-if="cart_products.vat > 0">Vat <span>৳ {{ cart_products.vat }}</span></li>
                                            <li>Total <span>৳ {{ cart_products.total }}</span></li>
                                        </ul>
                                        <!-- <router-link :to="{name: 'checkout'}">Proceed to checkout</router-link> -->
                                        <a href="/checkout">Proceed to checkout</a>
                                        <!--<router-link :to="{name: 'otpLogin'}">Proceed to checkout</router-link>-->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
    </div>
</template>

<script>
    export default {
        name: "CartComponent",
        data() {
            return {
                product: {
                    quantity: 1,
                }
            }
        },
        methods: {
            // CART ALL PRODUCTS
            productList() {
                this.$store.dispatch('cart/productList');
            },

            // REMOVE CART SINGLE PRODUCT
            removeCartProduct(id) {
                axios.get('cart/remove-cart-product/'+id)
                    .then((result) => {
                        this.productList();
                    }).catch((error) => {

                });
            },
            //  QUANTITY KEYPRESS SECTION
            updateQty(id, qty) {
                axios.post(`cart/update-cart`, {id:id, qty:qty})
                    .then((result) => {
                        this.productList();
                    }).catch((error) => {

                });
            }
        },
        computed: {
            // CART ALL PRODUCTS
            cart_products(){
                return this.$store.getters['cart/productList'];
            }
        },
        created() {
            this.productList();
        },
        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = 'Cart View | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
