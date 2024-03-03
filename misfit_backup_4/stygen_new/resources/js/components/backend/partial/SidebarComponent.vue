<template>
    <div id="admin_sidebar">
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <router-link :to="{name: 'adminDashboard'}" class="brand-link text-center">
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
                        <a href="#" class="d-block">{{ admin.name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'adminDashboard'}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <a :href='reportlink()' class="nav-link">
                                <!-- <i class="nav-icon far fa-file-alt"></i> -->
                                <i class="fas fa-chart-line"></i>
                                <p>
                                    Dashboard Reports
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'sellerList'}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Sellers
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'orderList'}" class="nav-link">
                                <i class="nav-icon fab fa-bitbucket"></i>
                                <p>
                                    Orders
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
                            <router-link :to="{name: 'productList'}" class="nav-link">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Products
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'lowstockproduct'}" class="nav-link">
                                <i class="fa fa-exclamation-circle"></i>
                                <p>
                                    Low stock Products
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'addonProduct'}" class="nav-link">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p>
                                    Add on Product
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'collectionList'}" class="nav-link">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p>
                                    Collection
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'occasionList'}" class="nav-link">
                                <i class="nav-icon fas fa-gift"></i>
                                <p>
                                    Occasion Gifts
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'recipientList'}" class="nav-link">
                                <i class="nav-icon fas fa-gifts"></i>
                                <p>
                                    Recipients
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'sliderList'}" class="nav-link">
                                <i class="nav-icon fab fa-slideshare"></i>
                                <p>
                                    Sliders
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
                            <router-link :to="{name: 'shippingChargeList'}" class="nav-link">
                                <i class="nav-icon fas fa-truck"></i>
                                <p>
                                    Shipping Method
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'packagingList'}" class="nav-link">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>
                                    Packaging
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'cardList'}" class="nav-link">
                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                <p>
                                    Greetings Cards
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'couponList'}" class="nav-link">
                                <i class="nav-icon fas fa-percentage"></i>
                                <p>
                                    Coupons
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'companyInfoList'}" class="nav-link">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    Company Info
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'campaignUserlist'}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Users
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'blogList'}" class="nav-link">
                                <i class="nav-icon fab fa-bootstrap"></i>
                                <p>
                                    Blog
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <router-link :to="{name: 'subscribeList'}" class="nav-link">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                <p>
                                    Subscribes
                                </p>
                            </router-link>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                            <a :href='juniorlink()' class="nav-link">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p>
                                    Junior Project Data
                                </p>
                            </a>
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
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>

<script>
    export default {
        name: "SidebarComponent",
        methods:{
            juniorlink() {
                return location.href + '/junior_project_data';
            },
            reportlink() {
                return 'https://stygen.gift/admin/daily_order';
            },
            logout(){
                axios.get('/admin/logout')
                .then((result) => {
                    localStorage.removeItem('adminLoggedInInfo')
                    this.$router.push({name: 'adminLogin'})
                    this.$message({
                        showClose: true,
                        message: 'You have logged out.',
                        type: 'success'
                    });
                }).catch((error) => {

                });
            },

            getAdminDetails(){
                this.$store.dispatch('admin/getAdmin');
            }
        },
        computed:{
            admin(){
                return this.$store.getters['admin/getAdminDetails'];
            }
        },
        created(){
            this.getAdminDetails();
        }
    }
</script>

<style scoped>

</style>
