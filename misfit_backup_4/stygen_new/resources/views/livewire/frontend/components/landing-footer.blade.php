<div>
    {{-- In work, do what you enjoy. --}}
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
                                                    {{-- <span class="text-danger" v-if="errors.subscribe_email">{{ errors.subscribe_email[0] }}</span> --}}
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
                                            @foreach ($landing_categories as $category)
                                                <li>
                                                    <a href="{{ route('category_product', $category->cat_slug) }}">{{ $category->category_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="single-footer-wiedget mb-30">
                                        <div class="footer-title">
                                            <h3>USEFUL LINKS</h3>
                                        </div>
                                        <ul class="link-widget hover-color2 mt-3 footer-ul-section">
                                            <li><a href="{{ route('about_us') }}">About Us</a></li>
                                            <li><a href="{{ route('blogs') }}">Blog</a></li>
                                            <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                                            <li><a href="{{ route('term_condition') }}">Terms & Conditions</a></li>
                                            <li><a href="{{ route('return_policy') }}">Return and Refund Policy</a></li>
                                            <li><a href="#">Warranty Guide</a></li>
                                            <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                                            <!-- <li><a href="/seller/register">Become a Seller</a></li> -->
                                            <li><a href="{{ route('become_seller') }}">Become a Seller</a></li>
                                        </ul>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div
        
                                            data-href="https://www.facebook.com/Stygen/"
                                            data-tabs=""
                                            data-width="500"
                                            data-height="400"
                                            data-show-facepile="true"
                                            data-lazy="true"
                                            class="fb-page fb_iframe_widget"
                                            fb-xfbml-state="rendered"
                                            fb-iframe-plugin-query="app_id=273559519924166&amp;container_width=255&amp;height=400&amp;href=https%3A%2F%2Fwww.facebook.com%2FStygen%2F&amp;lazy=true&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;tabs=&amp;width=500"
                                        >
                                            <span style="vertical-align: bottom; width: 255px; height: 130px;">
                                                <iframe
                                                    name="f236da548b3e5bc"
                                                    width="500px"
                                                    height="400px"
                                                    data-testid="fb:page Facebook Social Plugin"
                                                    title="fb:page Facebook Social Plugin"
                                                    frameborder="0"
                                                    allowtransparency="true"
                                                    allowfullscreen="true"
                                                    scrolling="no"
                                                    allow="encrypted-media"
                                                    loading="lazy"
                                                    src="https://www.facebook.com/v10.0/plugins/page.php?app_id=273559519924166&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dff0b18c73722ac%26domain%3Dstygen.gift%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fstygen.gift%252Ff83f4cc9748af4%26relation%3Dparent.parent&amp;container_width=255&amp;height=400&amp;href=https%3A%2F%2Fwww.facebook.com%2FStygen%2F&amp;lazy=true&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;tabs=&amp;width=500"
                                                    style="border: none; width: 255px; height: 130px; visibility: visible;"
                                                    class=""
                                                ></iframe>
                                            </span>
                                        </div>
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
                                    <p>©{{ date("Y") }} <a href="#">Stygen.</a> All Rights Reserved</p>
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
</div>
