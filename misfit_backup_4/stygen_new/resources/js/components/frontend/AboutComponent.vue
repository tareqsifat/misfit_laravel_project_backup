<template>
    <div class="about_us">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="active">About US</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->
        <!--About Area Strat-->
        <div class="Shopping-cart-area mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>About US:</h3>
                        <p v-html="companyInfo.about"></p>
                    </div>
                </div>
            </div>
        </div>
        <!--About Area End-->
    </div>
</template>

<script>
    export default {
        name: 'AboutComponent',
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
                    document.title = 'About Us | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
