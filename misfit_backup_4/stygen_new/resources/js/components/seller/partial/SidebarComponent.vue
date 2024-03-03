<template>
    <div id="seller_sidebar">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link :to="{name: 'sellerDashboard'}" class="brand-link text-center">
                <span class="brand-text font-weight-light">STYGEN</span>
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!--<div class="image">
                        <img src="" class="img-circle elevation-2" alt="">
                    </div>-->
                    <div class="info">
                        <a href="#" class="d-block">{{ seller.name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2" v-if="seller.status == 1">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'sellerDashboard'}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'brandList'}" class="nav-link">
                                <i class="nav-icon fab fa-bootstrap"></i>
                                <p>
                                    Brands
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'categoryList'}" class="nav-link">
                                <i class="nav-icon fas fa-align-justify"></i>
                                <p>
                                    Categories
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'attributeList'}" class="nav-link">
                                <i class="nav-icon fab fa-adn"></i>
                                <p>
                                    Attributes
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'productList'}" class="nav-link">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Products
                                </p>
                            </router-link>
                        </li>
                        <!--<li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'customerList'}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Customers
                                </p>
                            </router-link>
                        </li>-->

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'orderList'}" class="nav-link">
                                <i class="nav-icon fab fa-bitbucket"></i>
                                <p>
                                    Orders
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link" @click.prevent="logout()">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>

                        <!--<li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./index3.html" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard v3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>-->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->

                <!-- Pending Seller Nav Start -->
                <nav class="mt-2" v-else>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'sellerDashboard'}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link" @click.prevent="logout()">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- Pending Seller Nav End -->
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>

<script>
    export default {
        name: "SidebarComponent",
        methods:{
            logout(){
                axios.get('/seller/logout')
                .then((result) => {
                    localStorage.removeItem('sellerLoggedInInfo')
                    this.$router.push({name: 'sellerLogin'})
                    this.$message({
                        showClose: true,
                        message: 'You have logged out.',
                        type: 'success'
                    });
                }).catch((error) => {

                });
            },
            getSellerDetails(){
                this.$store.dispatch('seller/getSeller');
            }
        },
        computed:{
            seller(){
                return this.$store.getters['seller/getSellerDetails'];
            }
        },
        created(){
            this.getSellerDetails();
        }
    }
</script>

<style scoped>

</style>
