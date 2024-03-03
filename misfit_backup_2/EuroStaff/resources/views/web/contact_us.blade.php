@extends('web.layout.index')

@section('content')
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
                            <form>
                                <div class="row mb-n3">
                                    <div class="col-12 mb-3"><input type="email" placeholder="Email"></div>
                                    <div class="col-12 mb-3"><input type="password" placeholder="Password"></div>
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
                            <form>
                                <div class="row mb-n3">
                                    <div class="col-12 mb-3"><input type="text" placeholder="Your Name"></div>
                                    <div class="col-12 mb-3"><input type="email" placeholder="Your Email Address"></div>
                                    <div class="col-12 mb-3"><input type="password" placeholder="Choose a Password"></div>
                                    <div class="col-12 mb-3"><input class="btn btn-primary w-100" type="submit" value="Sign Up"></div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col text-center">
                                        <p class="text-muted">Or Register With</p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading Section Start -->
    <div class="page-heading-section section bg-parallax" data-bg-image="{{asset('assets/web')}}/images/bg/bg-1.webp" data-overlay="50">

        <div class="container">
            <div class="page-heading-content text-center">
                <h3 class="title">Contact Us</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Contact Us</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Page Heading Section End -->

    <!-- Contact Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row mb-n5">

                <!-- Contact Map Start -->
                <div class="col-12 mb-5">
                    <!-- Google Map Area Start -->
                    <div class="contact-map">
                        <iframe src="https://maps.google.com/maps?q=188%20Grand%20Street,%204th%20Floors%20New%20York,%20NY%2010013&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <!-- End of Google Map Area -->
                </div>
                <!-- Contact Map End -->

                <!-- Contact Information Start -->
                <div class="col-lg-5 col-12 mb-5">
                    <div class="contact-information">
                        <h5 class="title mb-4">Contact Information</h5>
                        <ul>
                            <li><i class="fa fa-map-o"></i><span>188 Grand Street, 4th Floors New York, NY 10013</span></li>
                            <li>
                                <i class="fa fa-phone-square"></i><span>+880 177 571 2640&nbsp;</span>
                                <a href="https://wa.me/+880177571264"><i class="fa fa-whatsapp" style="color:green; font-size: 15px"></i></a>
                            </li>
                            <li><i class="fa fa-envelope-o"></i><span>EuroStaffs@outlook.fr</span></li>
                        </ul>
                        <div class="contact-social">
                            <a target="_blank" rel="noopener" href="https://www.facebook.com/" class="fa fa-facebook"></a>
                            <a target="_blank" rel="noopener" href="https://www.twitter.com/" class="fa fa-twitter"></a>
                            <a target="_blank" rel="noopener" href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
                            <a target="_blank" rel="noopener" href="https://www.instagram.com/" class="fa fa-instagram"></a>
                        </div>
                    </div>
                </div>
                <!-- Contact Information End -->

                <!-- Contact Form Start -->
                <div class="col-lg-7 col-12 mb-5">
                    {{-- <div class="contact-form"> --}}
                    <div>
                        <h5 class="title mb-4">Get in Touch</h5>
                        {{-- <form id="contact-form" action="{{route('web.send-contact-email')}}" method="post"> --}}
                        <form action="{{route('web.send-contact-email')}}" method="post">
                            @csrf
                            <div class="row mb-n3">
                                <div class="col-md-6 col-12 mb-3"><input type="text" name="con_name" placeholder="Your Name" required></div>
                                <div class="col-md-6 col-12 mb-3"><input type="email" name="con_email" placeholder="Email Address" required></div>
                                <div class="col-12 mb-3"><textarea name="con_message" placeholder="Your Message" rows="4" required></textarea></div>
                                {{-- <div class="col-12 mb-3"><button  class="btn btn-primary px-5" type="submit">Send Message</button></div> --}}
                                <div class="col-12 mb-3"><input class="btn btn-primary px-5" type="submit" value="Send Message"></div>
                            </div>
                        </form>
                        <div class="form-message mt-3"></div>
                    </div>
                </div>
                <!-- Contact Form End -->

            </div>
        </div>
    </div>
    <!-- Contact Section End -->



<!-- Mirrored from template.hasthemes.com/keller/keller/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 10 Sep 2023 13:37:40 GMT -->
@endsection

{{-- <script src="{{ asset('assets/web')}}/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="{{ asset('assets/web')}}/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/web')}}/js/vendor/jquery-migrate-3.3.2.min.js"></script>
    <script src="{{ asset('assets/web')}}/js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('assets/web')}}/js/plugins/slick.min.js"></script>
    <script src="{{ asset('assets/web')}}/js/plugins/jquery.waypoints.min.js"></script>
    <script src="{{ asset('assets/web')}}/js/plugins/jquery.counterup.min.js"></script>
    <script src="{{ asset('assets/web')}}/js/plugins/jquery.parallax.js"></script>
    <script src="{{ asset('assets/web')}}/js/plugins/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('assets/web')}}/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="{{ asset('assets/web')}}/js/plugins/jquery.scrollUp.min.js"></script>
<script src="{{ asset('assets/web')}}/js/main.js"></script> --}}
{{-- <script src="{{ asset('assets/web')}}/js/vendor/modernizr-3.11.2.min.js"></script> --}}
{{-- <script src="{{ asset('assets/web')}}/js/vendor/jquery-3.6.0.min.js"></script> --}}
{{-- <script src="{{ asset('assets/web')}}/js/vendor/jquery-migrate-3.3.2.min.js"></script>
<script src="{{ asset('assets/web')}}/js/vendor/bootstrap.bundle.min.js"></script> --}}
{{-- <script>
    $(function () {
        // Get the form.
        var form = $('#contact-form');
        // Get the messages div.
        var formMessages = $('.form-message');
        // Set up an event listener for the contact form.
        $(form).submit(function (e) {
            // Stop the browser from submitting the form.
            e.preventDefault();
            // Serialize the form data.
            var formData = $(form).serialize();
            // Submit the form using AJAX.
            $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData,
            })
            .done(function (response) {
            // Make sure that the formMessages div has the 'success' class.
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');

            // Set the message text.
            $(formMessages).text(response);

            // Clear the form.
            $('#contact-form input,#contact-form textarea').val('');
            })
            .fail(function (data) {
            // Make sure that the formMessages div has the 'error' class.
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');

            // Set the message text.
            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text(
                    'Oops! An error occured and your message could not be sent.'
                );
            }
            });
        });
    }); --}}
</script>