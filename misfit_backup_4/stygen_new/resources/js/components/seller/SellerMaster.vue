<template>
    <div id="seller_master">
        <div class="wrapper">
            <template v-if="$route.name !== 'sellerLogin'">
                <!-- Navbar -->
                <header-component v-if="$route.name !== 'sellerRegister' && $route.name !== 'sellerForgotPassword' && $route.name !== 'sellerPasswordReset'"></header-component>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <sidebar-component v-if="$route.name !== 'sellerRegister' && $route.name !== 'sellerForgotPassword' && $route.name !== 'sellerPasswordReset'"></sidebar-component>
                <!-- /.Main Sidebar Container -->
            </template>

            <!-- Content Wrapper. Contains page content -->
            <router-view></router-view>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <!-- <aside class="control-sidebar control-sidebar-dark">

            </aside>-->
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <template v-if="$route.name !== 'sellerLogin'">
                <footer-component v-if="$route.name !== 'sellerRegister' && $route.name !== 'sellerForgotPassword' && $route.name !== 'sellerPasswordReset'"></footer-component>
            </template>
        </div>
        <!-- ./wrapper -->
    </div>
</template>

<script>
import FooterComponent from "./partial/FooterComponent";
import HeaderComponent from "./partial/HeaderComponent";
import SidebarComponent from "./partial/SidebarComponent";
export default {
    name: "SellerMaster",
    components: {
        SidebarComponent,
        HeaderComponent,
        FooterComponent
    },
    data(){
        return{
            sellerId: ''
        }
    },
    methods:{
        sellerDetails(){
            axios.get('/seller/get-seller-details')
                .then((result) => {
                    this.sellerId = result.data.id
                    if(this.sellerId){
                        let logedIn =  localStorage.getItem('sellerLoggedInInfo')
                        if(!logedIn){
                           localStorage.setItem('sellerLoggedInInfo', JSON.stringify(result.data))
                        }
                    }
                }).catch((error) => {
                  localStorage.removeItem("sellerLoggedInInfo")
            });
        }
    },
    created(){
        this.sellerDetails();
    }
}
</script>

<style scoped>

</style>
