<!-- Start Footer -->
<section class="landing-footer">
    <div class="landing-footer-wrap"
         data-background="{{ asset('super_admin/images/landing-page/footer-bg.png') }}">
        <div class="footer-top pt-114 pb-100">
            <div class="container">
                <div class="row rg-20">
                    <div class="col-lg-4 col-md-6">
                        <div class="max-w-366">
                            <div class="max-w-177 pb-24"><img
                                src="{{ getSettingImageCentral('app_logo') }}" alt="{{ getOption('app_name') }}" />
                            </div>
                            <p class="pb-32 fs-18 fw-400 lh-28 text-white-80">{!! nl2br(getOption('footer_left_text')) !!}</p>
                            <ul class="d-flex align-items-center g-12 footer-social">
                                <li>
                                    <a href="{{ getOption('facebook_url') }}"
                                       class="w-40 h-40 rounded-circle bd-one bd-c-white-10 d-flex justify-content-center align-items-center text-white"><i
                                            class="fa-brands fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="{{ getOption('twitter_url') }}"
                                       class="w-40 h-40 rounded-circle bd-one bd-c-white-10 d-flex justify-content-center align-items-center text-white">
                                       <i class="fa-brands fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ getOption('linkedin_url') }}"
                                       class="w-40 h-40 rounded-circle bd-one bd-c-white-10 d-flex justify-content-center align-items-center text-white"><i
                                            class="fa-brands fa-linkedin-in"></i></a>
                                </li>
                                <li>
                                    <a href="{{ getOption('social_media_skype') }}"
                                       class="w-40 h-40 rounded-circle bd-one bd-c-white-10 d-flex justify-content-center align-items-center text-white"><i
                                            class="fa-brands fa-skype"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="pl-xl-70">
                            <h4 class="pb-37 fs-24 fw-500 lh-30 text-white">{{__('Section')}}</h4>
                            <ul class="zList-pb-21">
                                <li><a href="{{route('index')}}#features"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Features')}}</a></li>
                                <li><a href="{{route('index')}}#price"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Pricing')}}</a>
                                </li>
                                <li><a href="{{route('index')}}#howItsWork"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('How its work')}}</a></li>
                                <li><a href="{{route('index')}}#faq"class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__("FAQ's")}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="pl-xl-70">
                            <h4 class="pb-37 fs-24 fw-500 lh-30 text-white">{{__('Use Cases')}}</h4>
                            <ul class="zList-pb-21">
                                <li><a href="{{ route('pages', 'privacy_policy') }}"
                                    class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Privacy Policy')}}</a>
                                </li>
                                <li><a href="{{ route('pages', 'cookie_policy') }}"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Cookie Policy')}}</a>
                                </li>
                                <li><a href="{{ route('pages', 'terms_condition') }}"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Terms & Condition')}}</a>
                                </li>
                                <li><a href="{{ route('pages', 'refund_policy') }}"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Refund Policy')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="max-w-131 ms-lg-auto">
                            <h4 class="pb-37 fs-24 fw-500 lh-30 text-white">{{__('Support')}}</h4>
                            <ul class="zList-pb-21">
                                <li><a href="{{route('register')}}"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Register')}}</a>
                                </li>
                                <li><a href="{{route('login')}}"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Login')}}</a>
                                </li>
                                <li><a href="{{route('contact-us')}}"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Contact')}}</a>
                                </li>
                                <li><a href="{{route('password.request')}}"
                                       class="fs-18 fw-400 lh-27 text-white-80 hover-color-primary">{{__('Forgot password')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="py-25 bd-t-one bd-c-white-12">
                    <p class="text-center fs-16 fw-400 lh-22 text-white">{!! nl2br(getOption('app_copyright')) !!}
                        <a href="{{centralDomain()}}" class="text-cdef84 fw-600 text-decoration-underline">{!! nl2br(getOption('app_developed')) !!}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Footer -->
