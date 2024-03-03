<template>
    <div class="seller_page">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-right">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="pl-5"><router-link :to="{name: 'sellerTermandCondition'}">Terms & Condition</router-link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->
        <!--Terms & Condition Area Strat-->
        <div class="Shopping-cart-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- <div class="overlay"></div> -->
                        <img src="/assets/frontend/img/bg/terms_condition.jpg" alt="Snow" style="width:100%;">
                        <div class="top-left">
                            <p class="">
                                Have goodies you wanna sell? We are currently accepting applications for seller/vendor who wishes to sell their goods or products on Stygen.
                            </p>
                            <a class="LoginRegisterBtn" href="/seller/register">Register</a>
                            <p class="mt-5 mb-1 alreadySellerCss">Already a seller?</p>
                            <a class="LoginRegisterBtn" href="/seller/login">Login</a>
                        </div>
                        <!-- <img data-v-5e5ec1e8="" src="/assets/uploads/slider/1621670807-fathers-day.jpg" alt="Fathers Day"> -->
                        <!-- <h3 class="mt-4">A step-by-step guide on how to become a seller at Stygen:</h3> -->
                        <p class="mt-4 mb-4" v-html="companyInfo.seller_page"></p>
                    </div>
                </div>
            </div>
        </div>
        <!--Terms & Condition Area End-->
    </div>
</template>

<script>
    export default {
        name: 'TermsCondition',
        methods:{
            getLandingCompanyInfo(){
                this.$store.dispatch('cinfo/getLandingCompanyInfo');
            }
        },
        computed: {
            companyInfo(){
                return this.$store.getters['cinfo/getLandingCompanyInfo']
            },
        },
        created() {
            this.getLandingCompanyInfo();
        },
        watch: {
            '$route':{
                handler: (to, from) => {
                    document.title = 'Term & Condition | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
