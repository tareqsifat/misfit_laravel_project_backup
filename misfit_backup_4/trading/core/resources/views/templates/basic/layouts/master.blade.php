<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>
    @include('partials.seo')

    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}" />

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'dashboard/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'dashboard/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/custom.css') }}">

    @stack('style-lib')
    @stack('style')

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ $general->base_color }}">

</head>

<body>
    @if (!request()->routeIs('user.home'))
        <div class="preloader">
            <div class="loader-p"></div>
        </div>
    @endif

    <div class="body-overlay"></div>
    <div class="sidebar-overlay"></div>
    <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

    <div class="dashboard-fluid position-relative">
        <div class="dashboard__inner">
            @include($activeTemplate . 'partials.user_sidebar')
            <div class="dashboard__right">
                @include($activeTemplate . 'partials.user_topbar')
                <div class="dashboard-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="dashboard-body__bar d-xl-none d-inline-block">
                            <button class="dashboard-sidebar-filter__button">
                                <i class="las la-bars"></i>
                            </button>
                        </div>
                        @if (request()->routeIs('user.home'))
                            <!--<div class="dashboard-body__bar style ">-->
                            <!--    <span class="dashboard-body__bar-two-icon toggle-dashboard-right"><i-->
                            <!--            class="fas fa-bars"></i></span>-->
                            <!--</div>-->
                        @endif
                    </div>
                    @stack('topContent')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark mt-5">
        <div class="mx-auto d-sm-flex d-block flex-sm-nowrap">
            <div class="container">
            
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav" style="font-size: 14px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">
                        <div class="d-block text-center">
                            <i class="las la-home"></i><br>
                            <span>Home</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('trade') }}">
                        <div class="d-block text-center">
                            <i class="las la-signal"></i><br>
                            <span>Trade</span>
                        </div>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('trade') }}">
                        <div class="d-block text-center">
                            <i class="lab la-bitcoin"></i><br>
                            <span>Position</span>
                        </div>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ai_robot') }}">
                        <div class="d-block text-center">
                            <i class="las la-robot"></i><br>
                            <span>AI robot</span>
                        </div>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/user/dashboard">
                        <div class="d-block text-center">
                            <i class="lar la-user"></i><br>
                            <span>My</span>
                        </div>
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </nav>
    <script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'dashboard/js/main.js') }}"></script>

    <script>
        window.allow_decimal = "{{ $general->allow_decimal_after_number }}";
    </script>

    @stack('script-lib')
    @include('partials.notify')
    @include('partials.plugins')
    @stack('script')

    <script>
        (function($) {
            "use strict";

            var inputElements = $('[type=text],[type=password],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input, select, textarea'), function(i, element) {
                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }
            });

            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    if (row.querySelectorAll('td').length > 1) {
                        Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                            colum.setAttribute('data-label', heading[i].innerText)
                        });
                    }
                });
            });
        })(jQuery);
    </script>
</body>

</html>
