<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- @include('frontend.layouts.includes.pwa') --}}
    @if (!isset($seo))
        @include('frontend.layouts.includes.meta', [
            'seo' => (object) [
                'title' => 'website',
            ],
        ])
    @else
        @include('frontend.layouts.includes.meta', ['seo' => (object) $seo])
    @endif
    <link rel="fabicon" type="image/png" sizes="16x16" href="{{ setting(key:'facebook') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/icon/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/styles/style.css">

    {{-- js plugins --}}
    <script src="{{ asset('js/plugins/localforage.min.js') }}"></script>
    <script src="{{ asset('js/plugins/turbolinks.min.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert.js') }}"></script>
    <script src="{{ asset('js/plugins/axios.js') }}"></script>
    <script src="{{ asset('js/plugins/vue.min.js') }}"></script>

    {{-- frontend vue scripts --}}
    <script src="{{ asset('js/frontend_vue.js') }}"></script>

    {{-- turbo link setup --}}
    <script src="{{ asset('js/frontend.js') }}" defer></script>

    {{-- pwa setup --}}
    {{-- <script src="{{ asset('main.js') }}" defer></script> --}}
</head>

<body id="top">
    <!-- header_area start -->
    <header class="header_area">
        <div class="container">
            <div class="header_area_content">
                <!-- logo_area start -->
                <div class="logo_area">
                    <a href="/">
                        <img src="{{ asset(setting(key:'header_logo')) }}" alt="tech park it">
                    </a>
                </div>
                <!-- logo_area end -->

                <!-- extra login_area start -->
                <div class="extra_login_area">
                    <a href="/login">লগ-ইন</a>
                </div>
                <!-- xs login_area end -->

                <!-- menu_ber area start -->
                <button onclick="active_menu_ber.classList.toggle('activee_class')" class="menu_ber">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <!-- menu_ber area end -->

                <!-- nav_and_login_area start -->
                <div id="active_menu_ber" class="nav_and_login_area">

                    <div class="full_nav_are">

                        <!-- nav_area start -->
                        <nav class="nav-area">
                            <ul>
                                <div class="nav-area_all" onclick="active_menu_ber.classList.toggle('activee_class')"
                                    class="menu_ber">
                                </div>
                                <li>
                                    <a class="" href="/">হোম</a>
                                </li>
                                <li>
                                    <a href="/about">আমাদের সম্পর্কে</a>
                                </li>
                                <li>
                                    <a href="/courses">কোর্সসমূহ</a>
                                </li>
                                <li class="more_link">
                                    <a href="#">আরো দেখুন <i class="fa-solid fa-angle-down"></i></a>
                                    <ul class="more_link_details">
                                        <li>
                                            <a href="/gallery">গ্যালারি</a>
                                        </li>
                                        <li>
                                            <a href="/blog">ব্লগ</a>
                                        </li>
                                        <!-- <li>
                                            <a href="#">এফিলিয়েশন</a>
                                        </li> -->
                                        <li>
                                            <a href="/it-solution-services">আইটি সার্ভিস</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="/contact">যোগাযোগ</a>
                                </li>
                            </ul>
                        </nav>
                        <!-- nav_area end -->

                        <!-- login_area start -->
                        <div class="login_area">
                            <a href="/login">লগ-ইন</a>
                        </div>
                        <!-- login_area end -->

                    </div>
                </div>
                <!-- nav_and_login_area end -->
            </div>
        </div>
    </header>
    <!-- header_area end -->

    <main>
        @yield('contents')
    </main>

    <!-- footer area start -->
    <footer class="footer_area_start">
        <div class="container">
            <div class="footer_area_content">
                <div class="row">

                    <!-- footer_logo_and_contact_area start -->
                    <div class="col-xs-12 col-xl-3">
                        <div class="footer_colum footer_logo_and_contact_area">
                            <!-- footer_logo area start -->
                            <div class="footer_logo_area">
                                <a href="#">
                                    <img src="{{setting(key:'footer_logo')}}"
                                        alt="logo tech_park_it">
                                </a>
                            </div>
                            <!-- footer_logo area end -->

                            <!-- footer_contact_area start -->
                            <div class="footer_contact_area">

                                <!-- contact_title start -->
                                <div class="contact_title">
                                    <p class="title_text">যোগাযোগ করুন</p>
                                </div>
                                <!-- contact_title end -->

                                <!-- contact_number_and_email_area start -->
                                <ul class="contact_number_and_email_area">
                                    <li>
                                        <div href="#" class="contact align-items-start">
                                            <div class="logo phone">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="number">
                                                @foreach (setting(key: 'phone_numbers', multiple: true) as $item)
                                                    <a href="tel:{{ $item->value }}" class="text"> {{ $item->value }} </a> <br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="#" class="contact align-items-start">
                                            <div class="logo whatsapp">
                                                <i class="fa-brands fa-square-whatsapp"></i>
                                            </div>
                                            <div class="number">
                                                <p class="text">{{ setting(key:'whatsapp') }}</p>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="contact align-items-start">
                                            <div class="logo telegram">
                                                <i class="fa-brands fa-telegram"></i>
                                            </div>
                                            <div class="number">
                                                <p class="text">{{ setting(key:'telegram') }}</p>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="contact align-items-start">
                                            <div class="logo email">
                                                <i class="fa-regular fa-envelope"></i>
                                            </div>
                                            <div class="number email_address">
                                                <p class="text">{{ setting(key:'emails') }}</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <!-- contact_number_and_email_area end -->

                                <!-- social_media_area start -->
                                <div class="social_media_area">
                                    <div class="social_media_title">
                                        <p class="text">আমাদের সোসাল মিডিয়া লিংক</p>
                                    </div>

                                    <div class="social_media">
                                        <ul>
                                            <li>
                                                <a href="{{ setting(key:'facebook') }}" class="facebook">
                                                    <i class="fa-brands fa-square-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting(key:'instagram') }}" class="instagram">
                                                    <i class="fa-brands fa-square-instagram"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting(key:'youtube') }}" class="youtube">
                                                    <i class="fa-brands fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting(key:'linkedin') }}" class="linkedin-in">
                                                    <i class="fa-brands fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ setting(key:'twitter') }}" class="twitter">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- social_media_area end -->

                            </div>
                            <!-- footer_contact_area end -->
                        </div>
                    </div>
                    <!-- footer_logo_and_contact_area end -->

                    <!-- footer_blog_area start -->
                    <div class="col-xs-12 col-md-8 col-xl-6">
                        <div class="footer_colum footer_blog_area">

                            <!-- blog_title_and-item_area start -->
                            <div class="blog_title_and-item_area">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">

                                        <!-- quick_link_title start -->
                                        <div class="quick_and_importent_link_title">
                                            <div class="logo">
                                                <i class="fa-solid fa-link"></i>
                                            </div>
                                            <p class="title_text">কুইক লিংক</p>
                                        </div>
                                        <!-- quick_link_title end -->

                                        <!-- blog_item start -->
                                        <ul class="blog_item">
                                            <li>
                                                <a href="#">
                                                    <span class="text"> ব্লগ</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="text"> রিফান্ড পলিসি</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="text">এফিলিয়েশন</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="text"> ক্যারিয়ার</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="text"> শিক্ষক হিসেবে জয়েন করুন</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- blog_item running -->
                                    </div>

                                    <div class="col-xs-12 col-md-6">

                                        <!-- importent_link_title start -->
                                        <div class="quick_and_importent_link_title">
                                            <div class="logo">
                                                <i class="fa-solid fa-link"></i>
                                            </div>
                                            <p class="title_text">জরুরী লিংক</p>
                                        </div>
                                        <!-- importent_link_title end -->

                                        <!-- blog_item running -->
                                        <ul class="blog_item">
                                            <li>
                                                <a href="#">
                                                    <span class="text"> সার্টিফিকেট ভেরিফাই</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="text"> টার্মস এন্ড কন্ডিশন</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="text"> কুকিস পলিসি</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="text"> প্রাইলিসি পলিসি</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="text">সাইট ম্যাপ</span>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- blog_item end -->
                                    </div>
                                </div>
                            </div>
                            <!-- blog_item_area end -->
                        </div>
                    </div>
                    <!-- footer_blog_area end -->


                    <!-- footer_address_area start -->
                    <div class="col-xs-12 col-md-4 col-xl-3">
                        <div class="footer_colum footer_address_area">

                            <!-- address_title_area start -->
                            <div class="address_title_area">
                                <div class="logo">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="title">
                                    <p class="text">ঠিকানা</p>
                                </div>
                            </div>
                            <!-- address_title_area end -->

                            <!-- address start -->
                            <div class="address">
                                <p class="text">{{setting(key:'address_bangla')}}</p>
                            </div>
                            <!-- address end -->

                            <!-- map_area start -->
                            <div class="map_area">
                                <div class="map_title">
                                    <p class="text">ম্যাপে দেখুন</p>
                                </div>

                                <div class="full_map">
                                    {!! setting(key:'map_link')  !!}
                                    {{-- <iframe
                                        src="{{setting(key:'map_link')}}"
                                        width="100%" height="" style="border:0;" allowfullscreen=""
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                                </div>
                            </div>
                            <!-- map_area end -->

                        </div>
                    </div>
                    <!-- footer_address_area end -->
                </div>
            </div>
        </div>

        <!-- footer_copyright_area start -->
        <div class="footer_copyright_area">
            <p class="text">{{setting(key:'copy_right')}}</p>
        </div>
        <!-- footer_copyright_area end -->
    </footer>
    <!-- footer area end -->

    <!-- chating_and_go_to_top_area start -->
    <section class="chating_and_go_to_top_area">
        <!-- chating_area start -->
        <div class="chating_area">
            <div class="logo_and_text">
                <div class="logo">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </div>
                <p class="text">Chat</p>
            </div>

        </div>
        <!-- chating_area end -->
        <!-- go_to_top_area start -->
        <div class="go_to_top_area">
            <a href="#top" class="logo">
                <i class="fa-solid fa-angle-up"></i>
            </a>
        </div>
        <!-- go_to_top_area end -->
    </section>
    <!-- chating_and_go_to_top_area end -->
</body>

</html>
