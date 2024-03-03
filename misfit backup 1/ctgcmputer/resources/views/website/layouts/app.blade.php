<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/{{ $setting->fabicon }}">

    @include('website.include.meta',[
        'meta' => $meta??[]
    ])

    <!-- Style CSS -->
    <script src="{{ asset('contents/website/js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('contents/website/styles/bootstrap.css') }}">
    @stack('css_plugin')
    <link rel="stylesheet" href="{{ asset('contents/website/styles/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('contents/frontend') }}/assets/css/plugins/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('contents/website/styles/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('contents/frontend') }}/assets/css/custom.css"> --}}
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    @include('layouts.website_style')
</head>

<body class="wrapper home-five-wrapper">

    @include('website.layouts.top_header')
    @include('website.layouts.header')
    @include('website.layouts.navbar')

    @if($setting->breaking_news)
        <style>
            .latest_news .marquee_body marquee {
                font-size: 15px;
                line-height: 30px;
                height: 24px;
            }
        </style>
        <div class="latest_news">
            <div class="container custom-container">
                <div class="marquee_body">
                    <marquee>
                        {{ $setting->breaking_news }}
                    </marquee>
                </div>
            </div>
        </div>
    @endif

    @yield('content')

    <footer class="footer-area footer-three-area mt-4">
        <div class="container">
            <!--== Start Footer Main ==-->
            <div class="footer-main py-5">
                <div class="row mb-n6">
                    <div class="col-md-6 col-lg-3 mb-6">
                        <div class="widget-item">
                            <a class="widget-logo" href="/">
                                <img src="/{{$setting->footer_logo}}" alt="Logo" width="" height="60">
                            </a>
                            <br>
                            <div class="widget-contact widget-contact-two">
                                <p class="widget-contact-desc me-n1">
                                    {{ $setting->footer_short_description }}
                                    @for ($i = 1; $i <= 3; $i++)
                                        @php
                                            $key = "email_".$i;
                                        @endphp
                                        @if ($setting->$key)
                                            <a href="mailto://{{$setting->$key}}">{{$setting->$key}}</a>
                                        @endif
                                    @endfor
                                </p>
                                <br>
                                <div class="widget-info-item mb-6">
                                    <img src="{{ asset('contents/frontend') }}/assets/images/icons/pin.png" alt="Icon">
                                    <p>
                                        {{ $setting->address }}
                                    </p>
                                </div>
                                <br>
                                <div class="widget-info-item">
                                    <img src="{{ asset('contents/frontend') }}/assets/images/icons/mobile.png" alt="Icon">
                                    <div class="info-item-call">
                                        @for ($i = 1; $i <= 3; $i++)
                                            @php
                                                $key = "phone_number_".$i;
                                            @endphp
                                            @if ($setting->$key)
                                                <a href="tel://{{ $setting->$key }}">
                                                    {{ $setting->$key }}
                                                </a>
                                            @endif
                                        @endfor

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 offset-lg-1 mb-6">
                        <div class="widget-item">
                            <h4 class="widget-title">Information</h4>
                            <div >
                                <ul class="widget-nav">
                                    <li><a href="{{ route('about_us') }}">About us</a></li>
                                    <li><a href="{{ route('privacy_policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('terms_and_condition') }}">Terms & Conditions</a></li>
                                    <li><a href="{{ route('refund_policy') }}">Refund Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 offset-lg-1 ps-xl-4 mb-6">
                        <div class="widget-item">
                            <h4 class="widget-title">Account</h4>
                            <div >
                                <ul class="widget-nav">
                                    <li><a href="{{ route('frontend.profile') }}">My account</a></li>
                                    <li><a href="{{ route('frontend.orders') }}">My orders</a></li>
                                    <li><a href="{{ route('frontend.reviews') }}">My Reviews</a></li>
                                    <li><a href="{{ route('frontend.address') }}">Shipping Address</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 offset-lg-1 ps-xl-0 mb-6">
                        <div class="widget-item">
                            <h4 class="widget-title">Store</h4>
                            <div >
                                <ul class="widget-nav">
                                    <li><a href="{{ route('offer_products') }}">Discount</a></li>
                                    <li><a href="/">Latest products</a></li>
                                    <li><a href="/category/47/laptop">All Collection</a></li>
                                    <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--== End Footer Main ==-->

            <!--== Start Footer Bottom ==-->
            <div class="footer-bottom pb-2">
                <p class="copyright">
                    © {{ now()->year }} Ctgcomputer. Made with
                    <i class="fa fa-heart"></i> by
                    <a target="_blank" href="https://techparkit.org/">TechPark It</a>
                </p>
                <a href="#">
                    {{-- <img src="{{ asset('contents/frontend') }}/assets/images/shop/payment.png" alt="Image-techparkIt"> --}}
                </a>
            </div>
            <!--== End Footer Bottom ==-->
        </div>
    </footer>
    <!--== End Footer Area Wrapper ==-->

</body>

</html>
