<template>
    <div id="frontend_master">
        <div v-if="isLoader" class="main-loader"></div>
        <p v-if="isLoader" class="main-loader-p">Loading. Please wait...</p>
        <div class="frontend-main-section">
            <landing-header-component></landing-header-component>
            <router-view></router-view>
            <landing-footer-component></landing-footer-component>
        </div>
    </div>
</template>

<script>
import LandingHeaderComponent from "./partial/LandingHeaderComponent";
import LandingFooterComponent from "./partial/LandingFooterComponent";
import $ from 'jquery'
export default {
    name: "FrontendMaster",
    components: {
        LandingFooterComponent,
        LandingHeaderComponent
    },
    data(){
        return{
            userId: '',
            adminId: '',
            sellerId: '',
            isLoader: true
        }
    },
    mounted() {
        $('.frontend-main-section').css('filter', 'blur(3px)');
        document.onreadystatechange = () => {
            if (document.readyState == "complete") {
                $('.frontend-main-section').css('filter', 'none');
                this.isLoader = false
            }
        }
        
    },
    methods:{
        userDetails(){
            axios.get('/user/get-user-details')
                .then((result) => {
                    this.userId = result.data.id
                    if(this.userId){
                        let logedIn =  localStorage.getItem('userLoggedIn')
                        if(!logedIn){
                           localStorage.setItem('userLoggedIn', true)
                        }
                    }
                }).catch((error) => {
                  localStorage.removeItem("userLoggedIn")
            });
        },
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
        },
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
        this.userDetails();
        this.adminDetails();
        this.sellerDetails();
    }
}
</script>

<style scoped>

</style>
