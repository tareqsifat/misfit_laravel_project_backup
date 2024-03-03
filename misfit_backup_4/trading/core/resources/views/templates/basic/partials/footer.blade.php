@php
    $footer      = getContent('footer.content', true);
    $socialIcons = getContent('social_icon.element', orderById: true);
    $policyPages = getContent('policy_pages.element');
@endphp

<footer class="footer-area">
    <div class="py-60">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-sm-6 col-xl-6">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ getImage(getFilePath('logoIcon') . '/logo.png') }}">
                            </a>
                        </div>
                        <p class="footer-item__desc">{{ __(@$footer->data_values->about_info) }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Quick Links')</h5>
                        <ul class="footer-menu">
                            <li class="footer-menu__item">
                                <a href="{{ route('trading') }}" class="footer-menu__link"> @lang('Trade') </a>
                            </li>
                            <li class="footer-menu__item">
                                <a href="{{ route('market') }}" class="footer-menu__link"> @lang('Market') </a>
                            </li>
                            <li class="footer-menu__item">
                                <a href="{{ route('crypto_currencies') }}" class="footer-menu__link"> @lang('Crypto Currency') </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2">
                    <div class="footer-item">
                        <h5 class="footer-item__title"> @lang('Company') </h5>
                        <ul class="footer-menu">
                            <li class="footer-menu__item">
                                <a href="{{ route('home') }}" class="footer-menu__link"> @lang('Home') </a>
                            </li>
                            <li class="footer-menu__item">
                                <a href="{{ route('about') }}" class="footer-menu__link">@lang('About')</a>
                            </li>
                            <li class="footer-menu__item">
                                <a href="{{ route('contact') }}" class="footer-menu__link"> @lang('Contact') </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-2">
                    <div class="footer-item">
                        <h5 class="footer-item__title"> @lang('Legal') </h5>
                        <ul class="footer-menu">
                            @foreach ($policyPages as $policyPage)
                                <li class="footer-menu__item">
                                    <a href="{{ route('policy.pages', [slug($policyPage->data_values->title), $policyPage->id]) }}"
                                        class="footer-menu__link">
                                        {{ __($policyPage->data_values->title) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer">
        <div class="container">
            <div class="bottom-footer__style py-3">
                <div class="gap-4 d-flex flex-wrap justify-content-between align-items-center">
                    <div class="bottom-footer__text">
                        @php echo copyRightText(); @endphp
                    </div>
                    <div class="footer-list-wrapper">
                        <ul class="social-list">
                            @foreach ($socialIcons as $sIcon)
                                <li class="social-list__item">
                                    <a href="{{ @$sIcon->data_values->url }}" target="_blank" class="social-list__link">
                                        @php echo @$sIcon->data_values->icon; @endphp
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

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
