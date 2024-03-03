<template>
    <div id="warranty">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><router-link :to="{name: 'landing'}">Home</router-link></li>
                                <li class="active">Warranty Guide</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->
        <!--Warranty Guide Area Strat-->
        <div class="Shopping-cart-area mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Warranty Guide:</h3>
                        <p v-html="companyInfo.warranty_guide"></p>
                    </div>
                </div>
            </div>
        </div>
        <!--Warranty Guide Area End-->
    </div>
</template>

<script>
    export default {
        name: "WarrantyComponent",
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
                    document.title = 'Warranty Guide | Stygen'
                },
                immediate: true
            }
        }
    }
</script>

<style scoped>

</style>
