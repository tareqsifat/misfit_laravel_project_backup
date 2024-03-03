<template>
    <div id="admin_dashboard">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Admin Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ sellers.total }}</h3>

                                    <p>Total # of seller</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <router-link :to="{name: 'sellerList'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ sale_by_categories.total_sale_by_categories }}</h3>

                                    <p>Sale by category</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <router-link :to="{name: 'saleByCategory'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ sale_by_products.total_sale_by_products }}</h3>

                                    <p>Sale by product</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <router-link :to="{name: 'saleByProduct'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ sale_by_sellers.total_sale_by_sellers }}</h3>

                                    <p>Sale by seller</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <router-link :to="{name: 'saleBySeller'}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></router-link>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
</template>

<script>
import { log } from 'util'
export default {
    name: "DashboardComponent",
    data() {
            return {
                currentPage: 1,

            }
        },

        methods: {
            adminSellerList(){
                this.$store.dispatch('seller/adminSellerList', this.currentPage)
            },
            adminSaleByCateory(){
                this.$store.dispatch('dashboard/adminSaleByCateory', this.currentPage)
            },
            adminSaleByProduct(){
                this.$store.dispatch('dashboard/adminSaleByProduct', this.currentPage)
            },
            adminSaleBySeller(){
                this.$store.dispatch('dashboard/adminSaleBySeller', this.currentPage)
            },

        },
        // ocassion_cat(after, before) {
        //     this.Ocassion_product_sort()
        // }
        watch: {
            data(after, before) {
                this.getdailysales()
            }
        },
        computed:{
            sellers(){
                return this.$store.getters['seller/adminSellerList'];
            },
            sale_by_categories(){
                return this.$store.getters['dashboard/adminSaleByCateory'];
            },
            sale_by_products(){
                return this.$store.getters['dashboard/adminSaleByProduct'];
            },
            sale_by_sellers(){
                return this.$store.getters['dashboard/adminSaleBySeller'];
            }
        },

        created() {
            this.adminSellerList();
            this.adminSaleByCateory();
            this.adminSaleByProduct();
            this.adminSaleBySeller();
        }
}
</script>

<style scoped>

</style>
