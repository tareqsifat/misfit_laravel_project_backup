<template>
    <div id="user_dashboard">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="active">My Account</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->

        <!-- <gameComponent></gameComponent> -->

        <!--My Account Area Strat-->
        <div class="my-account white-bg mt-4">
            <div class="container">
                <div class="account-dashboard">
                    <div class="dashboard-upper-info">
                        <div class="row align-items-center no-gutters">
                            <div class="col-lg-3 col-md-12">
                                <div class="d-single-info">
                                    <p class="user-name">Hello <span>{{ user.name }}</span></p>
                                    <p>(not {{ user.name }}? <a href="#" @click.prevent="userLogout()">Log Out</a>)</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="d-single-info">
                                    <p>Need Assistance? Call at:</p>
                                    <p>+880 1971-971520</p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="d-single-info">
                                    <p>E-mail them at </p>
                                    <p>contact@stygen.gift</p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <div class="d-single-info text-lg-center">
                                    <router-link :to="{name: 'cartView'}" class="view-cart"><i class="fa fa-cart-plus"></i>view cart</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-lg-2">
                            <!-- Nav tabs -->
                            <ul class="nav flex-column dashboard-list" role="tablist">
                                <li><a class="nav-link active" data-toggle="tab" href="#dashboard">Dashboard</a></li>
                                <li> <a class="nav-link" data-toggle="tab" href="#orders">Orders</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#downloads">Downloads</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#address">Addresses</a></li>
                                <!--<li><a class="nav-link" data-toggle="tab" href="#account-details">Account details</a></li>-->
                                <li><a class="nav-link" data-toggle="tab" href="#wishlist">Wishlist</a></li>
                                <li><a class="nav-link" href="#" @click.prevent="userLogout">logout</a></li>
                            </ul>
                        </div>
                        <div class="col-md-12 col-lg-10">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content">
                                <div id="dashboard" class="tab-pane fade show active">
                                    <h3>Dashboard </h3>
                                    <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
                                </div>
                                <div id="orders" class="tab-pane fade">
                                    <h3>Orders</h3>
                                    <orders-component></orders-component>
                                </div>
                                <div id="downloads" class="tab-pane fade">
                                    <h3>Downloads</h3>
                                    <download-component></download-component>
                                </div>
                                <div id="address" class="tab-pane">
                                    <p>The following addresses will be used on the checkout page by default.</p>
                                    <h4 class="billing-address">Billing address</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input placeholder="e.g. House#1, Road#1, Dhaka" v-model="form.address" type="text">
                                                <span class="text-danger" v-if="errors['address']">{{ errors['address'][0] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="view" href="#" @click.prevent="updateAddress">Update</a>
                                </div>
                                <!--<div id="account-details" class="tab-pane fade">
                                    <h3>Account details </h3>
                                    <div class="login">
                                        <div class="login-form-container">
                                            <div class="account-login-form">
                                                <form action="#">
                                                    <p>Already have an account? <a href="#">Log in instead!</a></p>
                                                    <label>Social title</label>
                                                    <div class="input-radio">
                                                        <span class="custom-radio"><input name="id_gender" value="1" type="radio"> Mr.</span>
                                                        <span class="custom-radio"><input name="id_gender" value="1" type="radio"> Mrs.</span>
                                                    </div>
                                                    <label>First Name</label>
                                                    <input name="first-name" type="text">
                                                    <label>Last Name</label>
                                                    <input name="last-name" type="text">
                                                    <label>Email</label>
                                                    <input name="email-name" type="text">
                                                    <label>Password</label>
                                                    <input name="user-password" type="password">
                                                    <label>Birthdate</label>
                                                    <input name="birthday" value="" placeholder="MM/DD/YYYY" type="text">
                                                    <span class="example">
                                                      (E.g.: 05/31/1970)
                                                    </span>
                                                    <span class="custom-checkbox">
                                                        <input name="optin" value="1" type="checkbox">
                                                        <label>Receive offers from our partners</label>
                                                    </span>
                                                    <span class="custom-checkbox">
                                                        <input name="newsletter" value="1" type="checkbox">
                                                        <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                                    </span>
                                                    <div class="button-box">
                                                        <button type="submit" class="default-btn">save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <div id="wishlist" class="tab-pane fade">
                                    <h3>Wishlists</h3>
                                    <dashboard-wishlist-component></dashboard-wishlist-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--My Account Area End-->
    </div>
</template>

<script>
    import OrdersComponent from "../order/OrdersComponent";
    import DashboardWishlistComponent from "../wishlist/DashboardWishlistComponent";
    import DownloadComponent from "../order/DownloadComponent";
    // import GameComponent from "../Games/GameComponent";
    export default {
        name: "UserDashboardComponent",
        components:{
            OrdersComponent,
            DashboardWishlistComponent,
            DownloadComponent,
            // GameComponent
        },
        data(){
            return{
                errors: {},
                form:{
                    address: ''
                }
            }
        },
        computed: {
            user(){
                return this.$store.getters['user/getUserDetails']
            }
        },
        methods: {
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
            updateAddress(){
                axios.post('/user/update-address', {'address': this.form.address})
                    .then((result) => {
                        this.getUser();
                        this.$message({
                            message: 'Address updated Successfully.',
                            type: 'success'
                        });
                    }).catch((error) => {

                });
            }
        },
        created() {
            this.getUser();
        },
        watch:{
            user(){
                this.form.address = this.user.address
            },
            '$route':{
                handler: (to, from) => {
                    document.title = 'Dashboard | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
