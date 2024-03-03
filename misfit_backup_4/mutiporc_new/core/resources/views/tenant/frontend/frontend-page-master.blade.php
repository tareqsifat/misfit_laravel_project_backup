@include('tenant.frontend.partials.header')

@php
    $user_lang = get_user_lang();
    $default_theme = get_static_option('tenant_default_theme');
    $over_lay_condition =  '';

    $padding_conditions = $default_theme == 'agency'
     || $default_theme == 'newspaper'
     || $default_theme == 'construction'
     || $default_theme == 'consultancy'
     || $default_theme == 'wedding'
     || $default_theme == 'photography'
     || $default_theme == 'software-business'
     || $default_theme == 'barber-shop'
     ? 'agency_and_newspaper_class_condition' : '';

    switch ($default_theme){
        case 'donation':
            $over_lay_condition = '';
            break;

         case 'event':
            $over_lay_condition = 'hero-overly';
            break;

         case 'job-find':
            $over_lay_condition = 'sectionBg2';
            break;
    }

@endphp

<div class=" @if((in_array(request()->route()->getName(),['tenant.frontend.homepage','tenant.dynamic.page']) && !empty($page_post) && $page_post->breadcrumb == 0 ))
     d-none
@endif
">

 @if($default_theme != 'eCommerce')
     @if($default_theme != 'article-listing')

        <section class="sliderAreaInner {{$over_lay_condition}}" {!! render_background_image_markup_by_attachment_id(get_static_option('site_breadcrumb_image')) !!}>


            @if(Route::currentRouteName() !== 'tenant.frontend.appointment.order.page' && Route::currentRouteName() !== 'tenant.frontend.appointment.payment.page')
                <div class="heroPadding2 {{$padding_conditions}}">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-7 col-lg-9 col-md-10">
                                <div class="innerHeroContent text-center">
                                    <h1 class="tittle wow fadeInUp" data-wow-delay="0.0s">
                                        @if(Route::currentRouteName() === 'tenant.dynamic.page')
                                            {!! $page_post->getTranslation('title',$user_lang) !!}
                                        @else
                                            @yield('page-title')
                                        @endif
                                    </h1>
                                    <nav aria-label="breadcrumb">
                                        <ul class="breadcrumb wow fadeInUp" data-wow-delay="0.2s">
                                            <li class="breadcrumb-item"><a href="{{route('tenant.frontend.homepage')}}">{{__('Home')}}</a></li>
                                            @if(Route::currentRouteName() === 'tenant.dynamic.page')
                                                <li class="breadcrumb-item"><a href="#">{!! $page_post->getTranslation('title',$user_lang) ?? '' !!}</a></li>
                                            @else
                                                <li class="breadcrumb-item">@yield('page-title')</li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             @endif

        </section>

        @endif
    @endif

    @if($default_theme == 'article-listing' )
        <section class="sliderAreaInner sectionBg1">
            <div class="heroPadding2">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="innerHeroContent text-center">
                                <h2 class="tittle wow fadeInUp" data-wow-delay="0s">@yield('page-title')</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

        @if($default_theme == 'eCommerce')
            <div class="sliderAreaInner sectionBg1">
                <div class="heroPadding2">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 col-md-8 col-sm-10">
                                <div class="innerHeroContent">
                                    <!-- Bread Crumb S t a r t -->
                                    <nav aria-label="breadcrumb ">
                                        <ul class="breadcrumb wow fadeInLeft" data-wow-delay="0.0s">
                                            <li class="breadcrumb-item"><a href="#!">{{__('Home')}}</a></li>
                                            @if(Route::currentRouteName() === 'tenant.dynamic.page')
                                                <li class="breadcrumb-item">
                                                    <a href="#">{{ $page_post->getTranslation('title',$user_lang) ?? '' }}</a>
                                                </li>
                                            @else
                                                <li class="breadcrumb-item">@yield('page-title')</li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
</div>

{!! \App\Facades\ThemeDataFacade::renderHeaderHookBladeFile() !!}

@yield('content')
@include('tenant.frontend.partials.footer')
