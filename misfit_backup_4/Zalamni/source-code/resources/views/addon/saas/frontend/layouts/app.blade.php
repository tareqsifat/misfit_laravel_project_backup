<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('super_admin.layouts.header')

<body>
    <div class="overflow-x-hidden bg-white">
        @if (getOption('app_preloader_status', 0) == STATUS_ACTIVE)
            <div id="preloader">
                <div id="preloader_status">
                    <img src="{{ getSettingImageCentral('app_preloader') }}" alt="{{ getOption('app_name') }}"/>
                </div>
            </div>
        @endif

        @include('addon.saas.frontend.layouts.navbar')
        @yield('content')
        @include('addon.saas.frontend.layouts.footer')
    </div>
    @if (!empty(getOption('cookie_status')) && getOption('cookie_status') == STATUS_ACTIVE)
        <div class="cookie-consent-wrap shadow-lg">
            @include('cookie-consent::index')
        </div>
    @endif
    @include('super_admin.layouts.script')
</body>

</html>
