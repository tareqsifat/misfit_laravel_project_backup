<template>
    <div class="terms_condition">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="active">Terms & Condition</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->
        <!--Terms & Condition Area Strat-->
        <div class="Shopping-cart-area mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Terms & Condition:</h3>
                        <p v-html="companyInfo.terms_condition"></p>
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
