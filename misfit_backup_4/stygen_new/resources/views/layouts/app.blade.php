<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}">

    {{-- @dd($meta["title"] &&  $meta["title"] != "") --}}
    <title>{{ isset($meta['title']) ? $meta['title'] : 'Best online Gift Shop in Bangladesh | Stygen' }}</title>
    <meta property="og:title"
        content="{{ isset($meta['title']) ? $meta['title'] : 'Buy gifts online for your loved ones | Stygen.gift' }}" />
    <meta property="og:site_name" content="{{ $meta['site_name'] ?? 'Stygen' }}" />
    <meta property="og:description"
        content="{{ isset($meta['title']) ? $meta['description'] : 'Order and send gifts online to your friends & family for any occasion. Gifts delivery in Bangladesh. Flower, cake, perfume, chocolate, books home delivery.' }}" />
    <meta property="og:image"
        content="{{ isset($meta['title']) ? $meta['image'] : asset('assets/frontend/img/logo/stygen_image.jpg') }}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="400" />


    <meta name="twitter:title"
        content="{{ isset($meta['title']) ? $meta['title'] : 'Buy gifts online for your loved ones | Stygen.gift' }}">
    <meta name="twitter:description"
        content="{{ isset($meta['title']) ? $meta['title'] : 'Buy gifts online for your loved ones | Stygen.gift' }}">
    <meta name="twitter:image"
        content="{{ isset($meta['title']) ? $meta['image'] : asset('assets/frontend/img/logo/stygen_image.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">

    <meta name="google-site-verification" content="f2GHJdIMv4beEoFnjRaawAc2PabeM26ElyJsNKVOeRo" />
    <meta name="robots" content="index, follow" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/bootstrap.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/owl.carousel.min.css">
    {{-- <link rel="stylesheet" href="/js/pace-theme-default.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend') }}/style.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom_style.css') }}">

    @livewireStyles
    <style>
        .container-slider {
            background: #cc99ff;
        }

        #sub_category_product {
            background: #cc99ff;
        }

        .addtocart {
            background-color: #5e2e87;
            font-size: 12px;
        }

        .addtocart i {
            margin-right: 5px;
            padding-left: 1px;
        }

        .detailsbtn {
            background-color: #5e2e87;
            color: white;
            font-size: 12px;
        }

        .checkout-loader {
            display: none;
            left: 50%;
            top: 50%;
            z-index: 999;
            position: absolute;
            width: 50px;
            padding: 8px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #573276;
            --_m:
                conic-gradient(#0000 10%, #000),
                linear-gradient(#000 0 0) content-box;
            -webkit-mask: var(--_m);
            mask: var(--_m);
            -webkit-mask-composite: source-out;
            mask-composite: subtract;
            animation: l3 1s infinite linear;
        }

        @keyframes l3 {
            to {
                transform: rotate(1turn)
            }
        }

        img.lazy {
            background-image: url('{{ asset('assets/frontend/img_loader.gif') }}');
            background-repeat: no-repeat;
            background-position: 50% 50%;
        }
    </style>
    <script src="/js/pace.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/js/vendor/jquery-1.12.4.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/frontend') }}/js/sweetalert.js"></script>
    <script src="{{ asset('assets/frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/js/custom.js"></script>
    

    <script src="{{ asset('assets/frontend') }}/js/cart_management.js" defer></script>
    <script>
        $(function() {
            console.log('lazy loading initialization');
            $('.lazy').lazy();
        });
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        window.toggleSidebar = () => {
            document.getElementById('left_navbar_dashboard').classList.toggle('active');
        }



        window.s_alert = (title = "success", icon = 'success') => {
            Toast.fire({
                icon,
                title
            })
        };
        window.s_confirm = async (title = "Are you sure?", confirmButtonText = 'Yes, do it!', icon = 'warning') => {
            let result = await Swal.fire({
                title,
                text: "",
                icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText
            })
            return result.isConfirmed ? true : false;
        }
    </script>
    <script src="{{ asset('assets/frontend') }}/js/jquery.lazy.min.js" defer></script>
    @livewireScripts
    {{-- <script src="/js/turbolink.min.js"></script> --}}
    <script>
        Livewire.onPageExpired((response, message) => {})
    </script>
    <script src="{{ asset('assets/frontend') }}/js/livewire_hook.js" defer></script>
    <script src="{{ asset('assets/frontend') }}/js/main.js" defer></script>

    @stack('custom-js')


    <!--Facebook Pixel Code-->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '253360395780128');
        fbq('track', 'PageView');
    </script>
    <!--End Facebook Pixel Code-->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94036107-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94036107-1');
    </script>
    @stack('gtag_data')
    <!--End Google Analytics Code-->

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PR53MKR');
        gtag('config', 'AW-10829188403');
    </script>
    <!-- End Google Tag Manager -->

    {{-- mailchimp --}}
    <script id="mcjs">
        ! function(c, h, i, m, p) {
            m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m,
                p)
        }(document, "script",
            "https://chimpstatic.com/mcjs-connected/js/users/184124b8ef714f98db7999b2c/9a1fa74528acb6e5b5d57fb14.js");
    </script>

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PR53MKR" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <header>
        @livewire('frontend.components.header')
        {{-- @livewire('frontend.components.nav') --}}
    </header>
    <!-- <nav>
        <a href="/login">login</a>
        <a href="/register">register</a>
    </nav> -->
    <main>
        <div class="loader"></div>
        @yield('content')

        @livewire('frontend.components.landing-footer')

        @include('frontend.inc.cart_modal')
    </main>

    {{-- @livewire('frontend.components.footer') --}}
    <!--Facebook Plugin Start-->
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=273559519924166&autoLogAppEvents=1"
        nonce="apHemKhH"></script>
    <!--Facebook Plugin End-->
</body>

</html>
