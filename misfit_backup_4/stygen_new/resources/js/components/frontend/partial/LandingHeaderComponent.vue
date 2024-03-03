<template>
    <div id="landing_header">
        <header>
            <!--Header Middle Area Start-->
            <div class="header-middle-area header-style-2 header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <!--Category Menu Start-->

                            <div class="category-menu category-menu-hidden">
                                <div class="row">
                                    <div class="col-md-1 browse-category-btn d-none d-md-block">
                                        <div class="category-heading">
                                            <h2 class="categories-toggle category-menu-header"></h2>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-none d-md-block">
                                        <!--Logo Start-->
                                        <div class="logo logo-section">
                                            <router-link :to="{name: 'landing'}">
                                                <img src="/assets/frontend/img/logo/logo.png" width="100px" alt="">
                                            </router-link>
                                        </div>
                                        <!--Logo End-->
                                    </div>
                                    <div class="col-md-9 d-none d-md-block">
                                        <div class="header-top-search">
                                            <div class="search-categories">
                                                <form action="#">
                                                    <div class="search-form-input">
                                                        <input type="text" v-model="keyword" @keyup="SearchProduct" placeholder="Search product...">
                                                        <button class="top-search-btn" @click.prevent="SearchProduct" type="submit"><i class="ion-ios-search-strong"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="cate-toggle" class="category-menu-list">
                                    <ul>
                                        <a href="javascript:void(0)" id="category_close" class="d-flex justify-content-end pr-2 pt-2"><i class="fas fa-times-circle"></i></a>
                                        <li><router-link :to="{name: 'shop'}">All Products</router-link></li>
                                        <li v-for="category in categories" :key="category.id" :class="category.subcategory.length > 0 ? 'right-menu' : ''">
                                            <router-link :to="{name: 'subCategoryProduct', params: {catSlug:category.cat_slug}}">{{ category.category_name }}</router-link>
                                            <ul :class="category.subcategory.length > 0 ? 'cat-dropdown':''" v-if="category.subcategory">
                                                <li v-for="subcategory in category.subcategory" :key="subcategory.id" :class="subcategory.subcategory.length > 0 ? 'right-menu' : ''">
                                                    <router-link :to="{name: 'subCategoryProduct', params: {catSlug:subcategory.cat_slug}}">{{ subcategory.category_name }}</router-link>
                                                    <header-category-list :subcategories="subcategory.subcategory"></header-category-list>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--Category Menu End-->
                        </div>

                        <div class="col-md-4 col-lg-4 col-sm-12 text-center text-md-right d-none d-md-block">
                            <a href="#" @click="openModal"><i class="fas fa-shopping-cart header-icon mr-4"><span class="cart-count">{{ cart_products.total_qty }}</span></i></a>
                            <router-link :to="{name: 'userLogin'}"><i class="fa fa-user-alt header-icon ml-3 mr-3"></i></router-link>
                            <!-- <a href="#" @click.prevent="userLogout"><i class="fas fa-sign-out-alt header-icon ml-3"></i></a> -->
                            <router-link :to="{name: 'wishlist'}" title="wishlist"><i class="fas fa-heart header-icon ml-3"></i></router-link>
                        </div>
                    </div>
                </div>
            </div>
            <!--Header Middle Area End-->


            <!-- Mobile Nav Start-->
            <div class="header-top-area p-0 header-style-2 d-none nav-mobile-screen">
		        <div class="container">
		            <div class="row">
		                <div class="col-md-12">
                            <!--Header Top Right Start-->
		                    <div class="header-top-center">
		                        <ul class="header-top-menu mt-0">
                                    <li>
                                        <div class="category-heading mobile-category-heading">
                                            <h2 class="categories-toggle category-menu-header"></h2>
                                        </div>
                                    </li>
                                    <li class="mobile-li">
                                        <router-link :to="{name: 'landing'}">
                                            <img src="/assets/frontend/img/logo/logo.png" width="70px" alt="">
                                        </router-link>
                                    </li>
		                            <li class="mobile-li-icon"><a href="#" @click="openModal"><i class="fas fa-shopping-cart header-icon"><span class="cart-count">{{ cart_products.total_qty }}</span></i></a></li>
		                            <li class="mobile-li-icon"><router-link :to="{name: 'userLogin'}"><i class="fa fa-user-alt header-icon"></i></router-link></li>
		                            <!-- <li class="mobile-li-icon"><a href="#" @click.prevent="userLogout"><i class="fas fa-sign-out-alt header-icon"></i></a></li> -->
                                    <li class="mobile-li-icon"><router-link :to="{name: 'wishlist'}" title="wishlist"><i class="fas fa-heart header-icon"></i></router-link></li>
                                </ul>
		                    </div>
		                    <!--Header Top Right End-->
		                </div>
		            </div>
		        </div>
		    </div>
            <!-- Mobile Nav End-->

            <!-- Modal -->
            <div class="cart-popup modal right fade modal fade" id="shoppingCart" tabindex="-1" role="dialog" aria-labelledby="shoppingCartLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title cart-popup-title" id="shoppingCartLabel">SHOPPING CART</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="shoping__cart__table" v-if="cart_products.cart_count && cart_products.cart_count > 0">
                                <table width="100%">
                                    <tbody>
                                    <tr v-for="product in cart_products.products" :key="product.id">
                                        <td>
                                            <img v-if="product.attributes.image" :src="`/assets/uploads/product/${product.attributes.image}`" alt="" width="100">
                                        </td>
                                        <td>
                                            <h5>{{ product.name }}</h5>
                                            <small>{{ product.quantity }} x ৳ {{ product.price }}</small><br>
                                            <span v-if="product.attributes.color"><small>Color: {{ product.attributes.color }}</small></span>
                                            <span v-if="product.attributes.size"><small>, Size: {{ product.attributes.size }}</small></span>
                                            <span v-if="product.attributes.weight"><small>, Weight: {{ product.attributes.weight }}</small></span>
                                        </td>
                                        <td class="shoping__cart__item__close" @click.prevent="removeCartProduct(product.id)">
                                            <a href="#"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <img src="/assets/frontend/img/cart/cart_empty.webp" width="100%">
                                <p class="text-center cart-empty-img">Your cart is empty !</p>
                            </div>
                        </div>
                        <!--<div class="modal-footer">-->
                        <div class="p-2">
                                <span class="subTotal">
                                    <div class="sidecart-bot d-flex align-items-center">
                                        <div><b>SUBTOTAL:</b></div>
                                        <div class="ml-auto"><b>৳ {{ cart_products.total }}</b></div>
                                    </div>
                                    <div class="mt-1 text-center">
                                        <!--<router-link :to="{name:'cartView'}" class="btn btn-dark btn-block">VIEW CART</router-link>-->
                                        <a href="#" @click="viewCartBtn" class="btn btn-dark btn-block">VIEW CART</a>
                                    </div>
                                    <div class="mt-1 text-center">
                                        <!-- <router-link :to="{name:'checkout'}" class="primary-btn btn-block">CHECKOUT</router-link> -->
                                        <!--<a href="#" @click="viewCheckout" class="primary-btn btn-block header-checkout-btn">CHECKOUT</a>-->
                                        <a href="/checkout" class="primary-btn btn-block header-checkout-btn">CHECKOUT</a>
                                    </div>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div :class="{ mobile_view: isActive }">
            <div class="col-sm-12">
                <form action="#">
                    <div class="search-form">
                        <input class="form-control mobile_search_input" type="search" v-model="keyword" @keyup="SearchProduct" placeholder="Search product...">
                        <button class="mobile-search-btn btn btn-primary" @click.prevent="SearchProduct" type="submit"><i class="ion-ios-search-strong"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- header section end -->
    </div>
</template>

<script>
    import HeaderCategoryList from "./HeaderCategoryList";
    import _ from 'lodash'
    import $ from 'jquery'
    export default {
        name: "LandingHeaderComponent",
        components:{
            HeaderCategoryList
        },
        data() {
            return {
                product: {
                    quantity: 1,
                },
                keyword: '',
                isActive: false,
            }
        },
        computed: {
            user(){
                return this.$store.getters['user/getUserDetails']
            },
            // CART ALL PRODUCTS
            cart_products(){
                return this.$store.getters['cart/productList'];
            },
            categories(){
                return this.$store.getters['category/browseCategoryList'];
            }
        },
        methods: {
            openModal(){
                $("#shoppingCart").modal('show');
            },
            viewCartBtn(){
                this.$router.push({name: 'cartView'})
                $("#shoppingCart .close").click();
            },
            viewCheckout(){
                this.$router.push({name: 'otpLogin'})
                $("#shoppingCart .close").click();
            },
            SearchProduct:_.debounce(function(){
                this.$router.push({name: 'searching'})
                setTimeout( () => this.$router.push({name: 'searchProduct', query: { keyword: this.keyword }}), 200);

                //this.$router.push({name: 'searchProduct', query: { keyword: this.keyword }})
                //this.$store.dispatch('product/searchProduct', this.keyword)
            }, 1000),

            getUser(){
                this.$store.dispatch('user/getUser');
            },
            userLogout(){
                this.$store.dispatch('user/userLogout');
                localStorage.removeItem('userLoggedIn');
                this.$router.push({name: 'landing'})
                this.$message({
                    message: 'You have logged out.',
                    type: 'success'
                });
            },
            // CART ALL PRODUCTS
            productList() {
                this.$store.dispatch('cart/productList');
            },
            // REMOVE CART SINGLE PRODUCT
            removeCartProduct(id) {
                axios.get('/cart/remove-cart-product/'+id)
                    .then((result) => {
                        this.$store.dispatch('cart/productList');
                    }).catch((error) => {

                });
            },
            browseCategoryList(){
                this.$store.dispatch('category/browseCategoryList');
            },
            isMobile() {
                if (screen.width >= 768) {
                    this.isActive = true
                } else {
                    this.isActive = false
                }
            }
        },
        created() {
            this.getUser();
            // CART ALL PRODUCTS
            this.productList();
            this.browseCategoryList();
            this.isMobile();
        }
    }
</script>

<style scoped>
.mobile_view{
    display: none;
}
.search-form {
    margin-top: 5px;
    margin-bottom: 5px;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    border-radius: 5px;
}
.mobile_search_input{
    width: 75%;
    height: 85%;
    border-radius: 15px;
}
.mobile-search-btn {
    background-color: #573276;
    color: white;
    border-radius: 15px;
    margin-left: 5px;
}
</style>
