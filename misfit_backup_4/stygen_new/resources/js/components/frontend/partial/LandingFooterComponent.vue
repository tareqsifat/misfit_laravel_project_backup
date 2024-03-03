<template>
    <div id="landing_footer">
        <!-- footer section start -->
        <footer>
            <div class="footer-container">
                <!--Footer Middle Area Start-->
                <div class="footer-middle-area footer-style-2">
                    <div class="container">
                        <div class="newsletter-social-block-content pb-0">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="single-footer-wiedget mb-30">
                                        <div class="footer-title">
                                            <div class="footer__about__logo">
                                                <a href="https://www.stygen.gift/"><img src="/assets/frontend/img/logo/logo.png" alt=""></a>
                                            </div>
                                        </div>
                                        <ul class="link-widget hover-color2 mt-3 footer-ul-section">
                                            <li><i class="fa fa-location-arrow fa-1x"></i> House: 65, Level-2, Road: 03, Block: B, Niketon, Gulshan-1, Dhaka</li>
                                            <li><i class="fa fa-mobile-alt fa-1x"></i> Phone: +880 1971 971 520</li>
                                            <li><i class="fa fa-envelope fa-1x"></i> Email: contact.stygen@gmail.com</li>
                                            <li><i class="far fa-clock fa-1x"></i> Sat - Fri / 9:00 AM - 10:00 PM</li>
                                        </ul>
                                        <div class="newsletter-form">
                                            <!-- Newsletter Form -->
                                            <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="popup-subscribe-form validate" target="_blank" novalidate>
                                                <div id="mc_embed_signup_scroll">
                                                    <div id="mc-form" class="mc-form subscribe-form" >
                                                        <input id="mc-email" v-model="subscribe_email" type="email" autocomplete="off" placeholder="Enter your email here" />
                                                        <button id="mc-submit" @click.prevent="Subscribe">Subscribe</button>
                                                    </div>
                                                    <span class="text-danger" v-if="errors.subscribe_email">{{ errors.subscribe_email[0] }}</span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="single-footer-wiedget mb-30">
                                        <div class="footer-title">
                                            <h3>MAIN FEATURES</h3>
                                        </div>
                                        <ul class="link-widget hover-color2 mt-3 footer-ul-section">
                                            <li v-for="landing_cat in landing_categories" :key="landing_cat.id">
                                                <router-link :to="{name: 'subCategoryProduct', params: {catSlug: landing_cat.cat_slug}}">{{ landing_cat.category_name }}</router-link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="single-footer-wiedget mb-30">
                                        <div class="footer-title">
                                            <h3>USEFUL LINKS</h3>
                                        </div>
                                        <ul class="link-widget hover-color2 mt-3 footer-ul-section">
                                            <li><router-link :to="{name: 'aboutUs'}">About Us</router-link></li>
                                            <li><router-link :to="{name: 'blog'}">Blog</router-link></li>
                                            <li><router-link :to="{name: 'privacyPolicy'}">Privacy Policy</router-link></li>
                                            <li><router-link :to="{name: 'termsCondition'}">Terms & Conditions</router-link></li>
                                            <li><router-link :to="{name: 'returnPolicy'}">Return and Refund Policy</router-link></li>
                                            <li><router-link :to="{name: 'warrantyGuide'}">Warranty Guide</router-link></li>
                                            <li><router-link :to="{name: 'contactUs'}">Contact Us</router-link></li>
                                            <!-- <li><a href="/seller/register">Become a Seller</a></li> -->
                                            <li><a href="/seller">Become a Seller</a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="fb-page" data-href="https://www.facebook.com/Stygen/" data-tabs="" data-width="500" data-height="400" data-show-facepile="true" data-lazy="true">
                                        <!-- <blockquote cite="https://www.facebook.com/Stygen/" class="fb-xfbml-parse-ignore">
                                        <a href="https://www.facebook.com/Stygen/">Stygen</a>
                                        </blockquote> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--Footer Middle Area End-->

                <div class="sslImageMain pt-2 pb-2">
                    <div class="container">
                        <img src="/assets/frontend/img/bg/ssl.webp" alt="" width="100%">
                    </div>
                </div>

                <!--Footer Bottom Area Start-->
                <div class="footer-bottom-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <!--Footer Copyright Start-->
                                <div class="footer-copyright">
                                    <p>©{{ new Date().getFullYear() }} <a href="#">Stygen.</a> All Rights Reserved</p>
                                </div>
                                <!--Footer Copyright End-->
                            </div>
                            <div class="col-md-6">
                                <!--Footer Payment Start-->
                                <div class="footer-payments-image text-center text-md-right">
                                    <small class="text-white">Design & Developed by <a class="text-danger" target="_blank" href="https://geekysocial.com/">Geeky Social Ltd.</a></small>
                                    <!--<img src="/assets/frontend/img/payment/payment.png" alt="">-->
                                </div>
                                <!--Footer Payment End-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--Footer Bottom Area End-->
            </div>
        </footer>
        <!-- footer section end -->
    </div>
</template>

<script>
    export default {
        name: "LandingFooterComponent",
        data() {
            return {
                errors: {},
                subscribe_email: '',
            }
        },
        methods:{
            getLandingCompanyInfo(){
                this.$store.dispatch('cinfo/getLandingCompanyInfo');
            },
            Subscribe(){
                axios.post('/user-subscribe', {'subscribe_email': this.subscribe_email})
                    .then((result) => {
                        this.subscribe_email = ''
                        this.errors = {}
                        this.$message({
                            message: 'You have successfully subscribed.',
                            type: 'success'
                        });
                    }).catch((error) => {
                        this.errors = error.response.data.errors
                });
            },
            landingCategory(){
                this.$store.dispatch('category/landingCategory');
            }
        },
        computed: {
            companyInfo(){
                return this.$store.getters['cinfo/getLandingCompanyInfo']
            },
            landing_categories(){
                return this.$store.getters['category/landingCategory']
            }
        },
        created() {
            this.getLandingCompanyInfo();
            this.landingCategory();
        }
    }
</script>

<style scoped>

</style>
