<footer id="footer" style="background-color: #F5F5F5; border-top: 2px solid rgba(0,0,0,0.06);">
    <div class="container" style="border-bottom: 1px solid rgba(0,0,0,0.06);">

        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap">

            <div class="row gutter-50 col-mb-50">
                <div class="col-md-8">

                    <div class="widget clearfix">

                        <div class="widget-subscribe-form-result"></div>
                        <form method="POST" id="widget-subscribe-form" action="{{ route('subscribe.store') }}" enctype="multipart/form-data"  class="mb-0 row clearfix">
                            @csrf
                            <div class="col-lg-9">
                                <input type="email" id="widget-subscribe-form-email" name="email" class="sm-form-control required email" placeholder="Enter your Email to Subscribe to our Newsletter">
                                @error('email')
                                    <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                                @enderror
                                @if (session()->has('alert-success'))
                                    <div class="text-success">
                                        {{ session('alert-success') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-3">
                                <button class="button button-rounded m-0 center w-100" type="submit">Subscribe</button>
                            </div>
                        </form>

                        <div class="line line-sm"></div>

                        <div class="row col-mb-30">
                            <div class="col-lg-3 col-6 widget_links">
                                <ul>
                                    <li><a href="{{ route('website_index') }}">Home</a></li>
                                    <li><a href="{{ route('website_about') }}">About</a></li>
                                    <li><a href="{{ route('website_index') }}#faq">FAQs</a></li>
                                    <li><a href="#">Support</a></li>
                                    <li><a href="{{ route('website_contact') }}">Contact</a></li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-6 widget_links">
                                <ul>
                                    <li><a href="#">Shop</a></li>
                                    <li><a href="#">Portfolio</a></li>
                                    <li><a href="{{ route('website_blog') }}">Blog</a></li>
                                    <li><a href="#">Events</a></li>
                                    <li><a href="#">Forums</a></li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-6 widget_links">
                                <ul>
                                    <li><a href="{{ route('login') }}" target="_blank">login</a>
                                    <li><a href="{{ route('register') }}" target="_blank">Register</a></li>
                                    <li><a href="#">eCommerce</a></li>
                                    <li><a href="#">Personal</a></li>
                                    <li><a href="#">One Page</a></li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-6 widget_links">
                                <ul>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Wedding</a></li>
                                    <li><a href="#">App Showcase</a></li>
                                    <li><a href="#">Magazine</a></li>
                                    <li><a href="#">Landing Page</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

                {{-- @foreach ($footer as $footer) --}}
                    <div class="col-md-4">
        

                        <div class="widget">

                            <div class="row col-mb-30">
                                <div class="col-lg-12">
                                    <div class="footer-big-contacts">
                                        <span>Call Us:</span>
                                        {{ $footer->phone }}
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="footer-big-contacts">
                                        <span>Send an Email:</span>
                                        {{ $footer->email }}
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="widget subscribe-widget clearfix">

                            <div class="row col-mb-30">
                                <div class="col-sm-6 col-md-12 col-lg-6 clearfix">
                                    <a href="{{ $footer->facebook }}" class="social-icon si-dark si-colored si-facebook mb-0" style="margin-right: 10px;">
                                        <i class="icon-facebook"></i>
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <a href="{{ $footer->facebook }}"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                                </div>
                                <div class="col-sm-6 col-md-12 col-lg-6 clearfix">
                                    <a href="{{ $footer->feed }}" class="social-icon si-dark si-colored si-rss mb-0" style="margin-right: 10px;">
                                        <i class="icon-rss"></i>
                                        <i class="icon-rss"></i>
                                    </a>
                                    <a href="{{ $footer->feed }}"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
                                </div>
                            </div>

                        </div>

                    </div>
                    {{-- @break --}}
                {{-- @endforeach --}}
            </div>

        </div><!-- .footer-widgets-wrap end -->
    </div>

    <!-- Copyrights
    ============================================= -->
    <div id="copyrights" class="bg-transparent">
        <div class="container clearfix">

            <div class="row col-mb-30">
                <div class="col-md-6 text-center text-md-start">
                    Copyrights &copy; {{ \Carbon\Carbon::parse($footer->created_at)->year }} All Rights Reserved by {{ $footer->company_name }}<br>
                    <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <div class="copyrights-menu copyright-links clearfix">
                        <a href="{{ route('website_index') }}">Home</a>/
                        <a href="{{ route('website_about') }}">About Us</a>/
                        <a href="{{ route('website_doctor') }}">Team</a>/
                        <a href="#">Clients</a>/
                        <a href="{{ route('website_index') }}#faq">FAQs</a>/
                        <a href="{{ route('website_contact') }}">Contact</a>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- #copyrights end -->
</footer>