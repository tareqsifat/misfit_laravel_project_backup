<footer class="">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 mb-0 mb-md-4 pb-0 pb-md-2">
                <a href="#" class="logo-footer">
                    <img src="{{ asset('/uploads/content') }}/{{ $content->website_logo }}" height="22" alt="">
                </a>
                <p class="mt-4 me-xl-5">{{ $content->website_description }}</p>
            </div>
            <!--end col-->
            <div class="col-xl-4 col-lg-4 mb-0 mb-md-4 pb-0 pb-md-2">
                <h5 class="footer-head">Contact us</h5>
                <ul class="list-unstyled footer-list mt-4">
                    <li class="d-flex align-items-center">
                        <i data-feather="mail" class="fea icon-sm text-foot align-middle"></i>
                        <a href="mailto:{{ $content->website_email }}"
                          class="text-foot ms-2">{{ $content->website_email }}</a>
                    </li>

                    <li class="d-flex align-items-center">
                        <i data-feather="phone" class="fea icon-sm text-foot align-middle"></i>
                        <a href="tel:{{ $content->website_phone }}" class="text-foot ms-2">
                            {{ $content->website_phone }}</a>
                    </li>

                    {{-- <li class="d-flex align-items-center">
                        <i data-feather="map-pin" class="fea icon-sm text-foot align-middle"></i>
                        <a href="javascript:void(0)" class="video-play-icon text-foot ms-2">View on
                            Google map</a>
                    </li> --}}
                </ul>

                <ul class="list-unstyled social-icon footer-social mb-0 mt-4">
                    <li class="list-inline-item"><a href="{{ $content->facebook }}" class="rounded-pill"><i
                              data-feather="facebook" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="{{ $content->youtube }}" class="rounded-pill"><i
                              data-feather="youtube" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="{{ $content->linkdin }}" class="rounded-pill"><i
                              data-feather="linkedin" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="https://wa.me/{{ $content->whatsapp }}"
                          class="rounded-pill"><i class="ri-whatsapp-line"></i></a>
                    </li>

                </ul>
                <!--end icon-->
            </div>
            <div class="col-xl-2 col-lg-4 mb-0 mb-md-4 pb-0 pb-md-2">
                <h5 class="footer-head">Quick Links</h5>
                <ul class="list-unstyled footer-list mt-4">
                    {{-- <li><a href="{{ route('index') }}" class="text-foot">Home</a></li> --}}

                    @if(Route::is('index'))
                    <li><a href="#appointment" class="text-foot">Appointment</a></li>
                    <li><a href="#about" class="text-foot">About Us</a></li>
                    <li><a href="#service" class="text-foot">Our Service</a></li>
                    <li><a href="#portfolio" class="text-foot">Portfolio</a></li>
                    <li><a href="#news" class="text-foot">News & Blogs</a></li>
                    @else
                    <li><a href="{{ route('index') }}#appointment" class="text-foot">Appointment</a></li>

                    <li><a href="{{ route('index') }}/#about" class="text-foot">About Us</a></li>
                    <li><a href="{{ route('index') }}/#service" class="text-foot">Our Service</a></li>
                    <li><a href="{{ route('index') }}/#portfolio" class="text-foot">Portfolio</a></li>
                    <li><a href="{{ route('index') }}/#news" class="text-foot">News & Blogs</a></li>

                    @endif
                </ul>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->

</footer>
