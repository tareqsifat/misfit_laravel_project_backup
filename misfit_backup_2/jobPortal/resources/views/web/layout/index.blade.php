<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EuroStaff</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/web')}}/images/favicon.png">

    <!-- CSS  -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/web')}}/css/vendor/bootstrap.min.css">

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('assets/web')}}/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/web')}}/css/vendor/flaticon.css">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{asset('assets/web')}}/css/plugins/slick.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/web')}}/css/style.css">


</head>

<body>
    @if(\Illuminate\Support\Facades\Session::has('login_error'))
        <input type="hidden" name="" class="login_error_message" value="{{ \Illuminate\Support\Facades\Session::get('login_error') }}">
    @endif

    @include('web.includes.header')

    <div id="offcanvas" class="offcanvas-section">
        <button class="offcanvas-close" data-bs-target="#offcanvas">&times;</button>
        <div class="offcanvas-wrap">
            <div class="inner">

                <!-- Offcanvas user Start -->
                {{-- <div class="offcanvas-user">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginSignupModal" data-bs-target-sub="#login">Login</a>
                    <span>or</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginSignupModal" data-bs-target-sub="#signup">Sign up</a>
                </div> --}}
                <!-- Offcanvas user End -->

                <!-- Offcanvas Menu Start -->
                <div class="offcanvas-menu">
                    <nav>
                        @include('web.includes.menubar')
                    </nav>
                </div>
                <!-- Offcanvas Menu End -->

            </div>
        </div>
    </div>
    <!--Offcanvas Section End-->
    <!--OffCanvas Overlay-->
    <div class="offcanvas-overlay"></div>

    <input type="hidden" name="" class="home-route" value="{{url('/')}}">
    <div class="loginSignupModal modal fade" id="loginSignupModal" tabindex="-1" role="dialog" aria-labelledby="loginSignupModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <ul class="loginSignupNav nav" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" role="tab" aria-controls="signup" aria-selected="false">Sign up</a>
                        </li>
                    </ul>

                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                            <form action="{{ route('login') }}" method="POST" class="login-signup-form">
                                @csrf
                                <div class="row mb-n3">
                                    <div class="col-12 mb-3"><input type="email" name="email" placeholder="Email" required></div>
                                    <div class="col-12 mb-3"><input type="password" name="password" placeholder="Password" required></div>
                                    <div class="col-12 mb-3">
                                        <div class="row justify-content-between mb-n2">
                                            <div class="col-auto mb-2">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="remember-me" id="remember-me" value="checkedValue" class="custom-control-input">
                                                    <label class="custom-control-label" for="remember-me">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="col-auto mb-2"><a href="#">Forgot Password?</a></div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3"><input class="btn btn-primary w-100" type="submit" value="Login"></div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col text-center">
                                        <p class="text-muted">Or Login With</p>
                                        <div class="login-reg-social">
                                            <a target="_blank" rel="noopener" href="https://www.facebook.com/" class="fa fa-facebook"></a>
                                            <a target="_blank" rel="noopener" href="https://www.twitter.com/" class="fa fa-twitter"></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a target="_blank" rel="noopener" href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                            <form action="{{ route('register') }}" method="POST" class="login-signup-form">
                                <div class="row mb-n3">
                                    @csrf
                                    <input type="hidden" name="user_type_id" value="3">
                                    <div class="col-12 mb-3">
                                        <input name="name" type="text" placeholder="Your Name">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input name="email" type="email" placeholder="Your Email Address">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input name="password" type="password" placeholder="Choose a Password">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input name="password_confirmation" type="password" placeholder="Choose a Password">
                                    </div>
                                    <div class="col-12 mb-3">
                                        {{-- <input class="btn btn-primary w-100" type="submit" value="Sign Up"> --}}
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    {{-- <div class="col text-center">
                                        <p class="text-muted">Or Register With</p>
                                        <div class="login-reg-social">
                                            <a target="_blank" rel="noopener" href="https://www.facebook.com/" class="fa fa-facebook"></a>
                                            <a target="_blank" rel="noopener" href="https://www.twitter.com/" class="fa fa-twitter"></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a target="_blank" rel="noopener" href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
                                        </div>
                                    </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')

    {{-- @include('web.includes.otp_modal') --}}
    @include('web.includes.footer')


    <!-- JS
============================================ -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/web')}}/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="{{asset('assets/web')}}/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/web')}}/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="{{asset('assets/web')}}/js/vendor/bootstrap.bundle.min.js"></script>

    {{-- @if(auth_check('employer') && Auth::guard('user_account')->user()->email_verified_at == null)
        <script>
            $(document).ready(function() {
                $("#Otp_submit_modal").modal('show');
            });
        </script>
    @endif --}}
    @if(\Illuminate\Support\Facades\Session::has('login_error'))
        <script>
            $(document).ready(function() {
                toastr.error($('.login_error_message').val());
            });
        </script>
    @endif

    <!-- Plugins JS -->
    <script src="{{asset('assets/web')}}/js/plugins/slick.min.js"></script>
    <script src="{{asset('assets/web')}}/js/plugins/jquery.waypoints.min.js"></script>
    <script src="{{asset('assets/web')}}/js/plugins/jquery.counterup.min.js"></script>
    <script src="{{asset('assets/web')}}/js/plugins/jquery.parallax.js"></script>
    <script src="{{asset('assets/web')}}/js/plugins/jquery.ajaxchimp.min.js"></script>
    <script src="{{asset('assets/web')}}/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="{{asset('assets/web')}}/js/plugins/jquery.scrollUp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <!-- Main Activation JS -->
    <script src="{{asset('assets/web')}}/js/main.js"></script>
    <script src="{{asset('assets/web')}}/js/custom.js"></script>

    @stack('js')
</body>


<!-- Mirrored from template.hasthemes.com/keller/keller/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Sep 2023 13:37:20 GMT -->
</html>
