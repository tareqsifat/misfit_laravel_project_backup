<!-- Start Header -->
<section class="inner-header {{ request()->route()->getName() == 'frontend'? 'ld-home-header': '' }}">
    <!-- Start Header -->
    <div class="ld-container-1324">
        <div class="container">
            <!-- Header -->
            <div class="row align-items-center">
                <div class="col-lg-2 col-6">
                    <div class="ld-logo-wrap">
                        <a href="{{ route('index') }}" class="d-flex max-w-177 logo-main">
                            @if(request()->route()->getName() == 'frontend')
                                <img src="{{ getSettingImageCentral('app_black_logo') }}" alt="{{ getOption('app_name') }}" />
                            @else
                                <img src="{{ getSettingImageCentral('app_logo') }}" alt="{{ getOption('app_name') }}" />
                            @endif
                        </a>
                        <a href="{{ route('index') }}" class="d-flex max-w-177 logo-sticky">
                            @if(request()->route()->getName() == 'frontend')
                            <img src="{{ getSettingImageCentral('app_logo') }}" alt="{{ getOption('app_name') }}" />
                            @else
                            <img src="{{ getSettingImageCentral('app_logo') }}" alt="{{ getOption('app_name') }}" />
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-6">
                    <nav class="navbar navbar-expand-lg p-0">
                        <button class="navbar-toggler landing-menu-navbar-toggler ms-auto" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse landing-menu-navbar-collapse offcanvas offcanvas-start"
                            tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                            <button type="button"
                                class="d-lg-none w-30 h-30 p-0 rounded-circle bg-white border-0 position-absolute top-10 right-10 shadow"
                                data-bs-dismiss="offcanvas" aria-label="Close">
                                <i class="fa-solid fa-times"></i>
                            </button>
                            <ul class="navbar-nav landing-menu-navbar-nav justify-content-lg-center flex-wrap w-100">
                                <li class="nav-item"><a class="nav-link" href="{{route('index')}}#features">{{__('Features')}}</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{route('index')}}#price">{{__('Pricing')}}</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('index')}}#howItsWork">{{__('How its work')}}</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{route('index')}}#faq">{{__("FAQ's")}}</a></li>
                                <li class="nav-item d-lg-none"><a href="{{route('login')}}" class="nav-link">{{__('Request A Demo')}}</a></li>
                            </ul>
                            <div class="d-lg-none">
                                <!-- Language switcher -->

                                @if (!empty(getOption('show_language_switcher')) && getOption('show_language_switcher') == STATUS_ACTIVE)
                                    <div class="dropdown headerUserDropdown lanDropdown-2 lanDropdown-2-mobile">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <div class="flagImg">
                                                <img src="{{ asset(selectedLanguage()?->flag) }}"
                                                    alt="" />
                                            </div>
                                        </button>
                                        <ul class="dropdown-menu dropdownItem-one">
                                            @foreach (appLanguages() as $app_lang)
                                                <li>
                                                    <a class="d-flex align-items-center cg-8" href="{{ url('/local/' . $app_lang->iso_code) }}">
                                                        <div class="d-flex">
                                                            <img src="{{ asset($app_lang->flag) }}"
                                                                alt="{{ $app_lang->language }}" class="max-w-26" />
                                                        </div>
                                                        <p class="fs-14 fw-500 lh-16 text-707070">{{ $app_lang->language }}</p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-xl-3 col-lg-4 d-none d-lg-block">
                    <div class="d-flex justify-content-end align-items-center cg-22">
                        <!-- Language switcher -->
                        <div class="dropdown headerUserDropdown lanDropdown-2">

                            @if (!empty(getOption('show_language_switcher')) && getOption('show_language_switcher') == STATUS_ACTIVE)
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="flagImg">
                                        <img src="{{ asset(selectedLanguage()?->flag) }}" alt="" />
                                    </div>
                                </button>
                                <ul class="dropdown-menu dropdownItem-one">
                                    @foreach (appLanguages() as $app_lang)
                                        <li>
                                            <a class="d-flex align-items-center cg-8" href="{{ url('/local/' . $app_lang->iso_code) }}">
                                                <div class="d-flex">
                                                    <img src="{{ asset($app_lang->flag) }}" alt="{{ $app_lang->language }}"
                                                        class="max-w-26" />
                                                </div>
                                                <p class="fs-14 fw-500 lh-16 text-707070">{{ $app_lang->language }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <a href="{{route('login')}}"
                            class="d-inline-flex justify-content-center align-items-center py-18 px-33 bd-ra-12 bg-cdef84 fs-18 fw-600 lh-22 text-1b1c17 hover-bg-one">Request A Demo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->
</section>
<!-- End Header -->
