<template>
    <div class="privacy_policy">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="active">Privacy Policy</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->
        <!--Privacy Policy Area Strat-->
        <div class="Shopping-cart-area mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Privacy Policy:</h3>
                        <p v-html="companyInfo.privacy_policy"></p>
                    </div>
                </div>
            </div>
        </div>
        <!--Privacy Policy Area End-->
    </div>
</template>

<script>
    export default {
        name: 'PrivacyPolicy',
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
                    document.title = 'Privacy Policy | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>

