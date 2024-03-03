<template>
    <div id="backend_master">
        <div class="wrapper">
            <template v-if="$route.name !== 'adminLogin'">
                <!-- Navbar -->
                <header-component></header-component>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <sidebar-component></sidebar-component>
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
            <footer-component v-if="$route.name !== 'adminLogin'"></footer-component>
        </div>
        <!-- ./wrapper -->
    </div>
</template>

<script>
import FooterComponent from "./partial/FooterComponent";
import HeaderComponent from "./partial/HeaderComponent";
import SidebarComponent from "./partial/SidebarComponent";
export default {
    name: "BackendMaster",
    components: {
        SidebarComponent,
        HeaderComponent,
        FooterComponent
    },
    data(){
        return{
            adminId: ''
        }
    },
    methods:{
        adminDetails(){
            axios.get('/admin/get-admin-details')
                .then((result) => {
                    this.adminId = result.data.id
                    if(this.adminId){
                        let logedIn =  localStorage.getItem('adminLoggedInInfo')
                        if(!logedIn){
                           localStorage.setItem('adminLoggedInInfo', JSON.stringify(result.data))
                        }
                    }
                }).catch((error) => {
                  localStorage.removeItem("adminLoggedInInfo")
            });
        }
    },
    created(){
        this.adminDetails();
    }
}
</script>

<style scoped>

</style>
