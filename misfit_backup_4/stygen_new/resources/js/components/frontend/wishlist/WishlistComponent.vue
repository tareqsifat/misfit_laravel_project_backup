<template>
    <div id="wishlist">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="active">Wishlist</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->
        <!--Wishlist Area Strat-->
        <div class="wishlist-area mt-4">
            <div class="container">
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
                                        <th class="picaboo-product-stock-status">Stock Status</th>
                                        <th class="picaboo-product-add-cart">add to cart</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="wishlist in wishlists.data" :key="wishlist.id">
                                        <td class="picaboo-product-remove">
                                            <a href="#" @click.prevent="wishlistDelete(wishlist.id)"><i class="fa fa-times"></i></a>
                                        </td>
                                        <td class="picaboo-product-thumbnail">
                                            <a href="#">
                                                <img :src="`/assets/uploads/product/${wishlist.product.featured_image}`" width="100px" :alt="wishlist.product.product_name">
                                            </a>
                                        </td>
                                        <td class="picaboo-product-name"><a href="#">{{ wishlist.product.product_name }}</a></td>
                                        <td class="picaboo-product-price">
                                            <span class="amount" v-if="wishlist.product.sales_price"><del>৳{{ wishlist.product.regular_price }}</del> ৳{{ wishlist.product.sales_price }}</span>
                                            <span class="amount" v-else>৳{{ wishlist.product.regular_price }}</span>
                                        </td>
                                        <td class="picaboo-product-stock-status"><span class="in-stock">in stock</span></td>
                                        <td class="picaboo-product-add-cart"><a href="#" @click.prevent="addToCart(wishlist.product)">add to cart</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Wishlist Area End-->
        <div class="product__pagination text-center">
            <el-pagination class="text-center mt-3"
               background
               @current-change="paginationChange"
               :current-page.sync="currentPage"
               :page-size="wishlists.per_page"
               layout="prev, pager, next"
               :total="wishlists.total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WishlistComponent",
        data(){
            return{
                currentPage: 1,
                cartQty: 1
            }
        },

        computed: {
            user(){
                return this.$store.getters['user/getUserDetails']
            },
            wishlists(){
                return this.$store.getters['wishlist/getWishlist']
            },
        },

        methods: {
            getWishlist(){
                this.$store.dispatch('wishlist/getWishlist', this.currentPage);
            },
            paginationChange(){
                this.$store.dispatch('wishlist/getWishlist', this.currentPage)
            },
            addToCart(product){
                axios.post('/cart/add-to-cart', {'product': product, 'qty': this.cartQty})
                    .then((result) => {
                        this.$store.dispatch('cart/productList');
                        this.$message({
                            message: 'Product added to cart successfully.',
                            type: 'success'
                        });
                    }).catch((error) => {

                });
            },
            wishlistDelete(id){
                axios.delete(`/user/wishlist/${id}`)
                .then((result) => {
                    this.getWishlist();
                    this.$message({
                        message: 'wishlist deleted successfully.',
                        type: 'success'
                    });
                }).catch((error) => {

                });
            },
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
            }
        },

        created() {
            this.getUser();
            this.getWishlist();
        }
    }
</script>

<style scoped>

</style>
