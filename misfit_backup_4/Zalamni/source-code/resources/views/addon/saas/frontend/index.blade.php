@extends('addon.saas.frontend.layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')

    <!-- Start Header & Banner wraper -->
    @if (isset($section['hero_banner']) && $section['hero_banner']->status == STATUS_ACTIVE)
        <section class="ld-hero-banner-section" data-background="{{ asset(getFileUrl($section['hero_banner']->banner_image)) }}">
            <div class="container-fluid">
                <div class="ld-hero-banner-content">
                    <h4 class="title">{{ $section['hero_banner']->title }}</h4>
                    <p class="max-w-818 m-auto pb-32 fs-18 fw-400 lh-28 text-707070">{{ $section['hero_banner']->description }}</p>
                    <a href="{{route('login')}}"
                        class="d-inline-flex justify-content-center align-items-center py-18 px-33 bd-ra-12 bg-cdef84 fs-18 fw-600 lh-22 text-1b1c17 hover-bg-one">{{__('Request A Demo')}}</a>
                </div>
            </div>
        </section>

        <!--  -->
        <section class="position-relative bg-white">
            <div class="container-fluid">
                <div class="ld-hero-banner-feature">
                    <img src="{{ asset(getFileUrl($section['hero_banner']->image)) }}" alt="{{__('Image')}}">
                </div>
            </div>
        </section>
    @endif

    <!-- Start how its work -->
    @if (isset($section['how_its_work_area']) && $section['how_its_work_area']->status == STATUS_ACTIVE)
        <section class="py-150 ld-container-1320 position-relative z-1" id="howItsWork">
            <div class="container">
                <!--  -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center pb-52">
                            <p class="d-inline-block py-8 px-18 bd-ra-50 bg-efece0 fs-18 fw-500 lh-28 text-1b1c17 mb-17">{{ $section['how_its_work_area']->page_title }}</p>
                            <h4 class="pb-9 fs-sm-56 fs-36 fw-700 lh-sm-67 text-1b1c17">{{ $section['how_its_work_area']->title }}
                            </h4>
                            <p class="max-w-631 m-auto fs-18 fw-400 lh-28 text-707070">{{ $section['how_its_work_area']->description }}</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="ld-howItsWork-wrap">

                    @forelse ($howItsWork as $key => $item)
                        <div class="item">
                            <div class="position-relative">
                                <span
                                    class="no w-74 h-74 rounded-circle bg-cdef84 d-flex justify-content-center align-items-center fs-22 fw-600 lh-28 text-1b1c17">{{addLeadingZero($key+1)}}</span>
                                <div class="row align-items-center">
                                    <div class="col-xl-6">
                                        <div class="max-w-469 ld-howItsWork-left">
                                            <p
                                                class="d-inline-block py-8 px-18 bd-ra-50 bg-f4f4f4 fs-18 fw-500 lh-28 text-1b1c17 mb-19">{{$item->name}}</p>
                                            <h4 class="pb-13 fs-48 fs-36 fw-700 lh-58 text-1b1c17">{{$item->title}} </h4>
                                            <p class="fs-18 fw-400 lh-28 text-707070">{{$item->description}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="ld-howItsWork-img max-w-483">
                                            <img src="{{ getFileUrl($item->image) }}"
                                                alt="{{__('Image')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center"><p class="text-main-color">{{__('No Data Found')}}</p></div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif
    <!-- End how its work -->


    <!-- Start Core Features -->
    @if (isset($section['core_features']) && $section['core_features']->status == STATUS_ACTIVE || isset($section['core_pages']) && $section['core_pages']->status == STATUS_ACTIVE)
        <section class="ld-core-feature ld-container-1320 bg-fbf9f1" id="features">
            @if (isset($section['core_features']) && $section['core_features']->status == STATUS_ACTIVE)
                <div class="pt-150">
                    <!--  -->
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center pb-46">
                                <p class="d-inline-block py-8 px-18 bd-ra-50 bg-262722 fs-18 fw-500 lh-28 text-white mb-17">{{ $section['core_features']->page_title }}</p>
                                <h4 class="fs-sm-56 fs-36 fw-700 lh-sm-67 text-white">{{ $section['core_features']->title }}</h4>
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="container">
                        <div class="row rg-24">

                            @forelse ($features as $key => $item)
                                <div class="col-lg-4 col-md-6">
                                    <div class="ld-cf-item">
                                        <div
                                            class="w-76 h-76 mb-22 rounded-circle d-flex justify-content-center align-items-center bg-30312d">
                                            <img src="{{ getFileUrl($item->icon) }}" alt="{{__('Icon')}}">
                                        </div>
                                        <!--  -->
                                        <h4 class="pb-8 fs-24 fw-700 lh-28 text-white">{{$item->title}}</h4>
                                        <p class="fs-18 fw-400 lh-28 text-white-70">{{$item->description}}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center"><p class="text-main-color">{{__('No Data Found')}}</p></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($section['core_features']) && $section['core_features']->status == STATUS_ACTIVE)
                <div class="ld-explore-coreFeature">
                    <div class="container">
                        <!--  -->
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div class="text-center pb-36">
                                    <p class="d-inline-block py-8 px-18 bd-ra-50 bg-262722 fs-18 fw-500 lh-28 text-white mb-17">{{ $section['core_pages']->page_title }}</p>
                                    <h4 class="fs-sm-56 fs-36 fw-700 lh-sm-67 text-white pb-9">{{ $section['core_pages']->title }}</h4>
                                    <p class="fs-18 fw-400 lh-28 text-white-70">{{ $section['core_pages']->description }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tabs -->

                        <div class="">
                            <ul class="nav nav-tabs zTab-reset zTab-two" id="myTab" role="tablist">
                                @forelse ($corePages as $key => $item)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $key === 0 ? ' active' : '' }}" id="tab-{{$key}}-tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#tab-{{$key}}" type="button" role="tab"
                                                aria-controls="tab-{{$key}}"
                                                aria-selected="{{ $key === 0 ? 'true' : 'false' }}">{{$item->name}}
                                        </button>
                                    </li>
                                @empty
                                @endforelse
                            </ul>
                            <div class="tab-content exploreFeatures-tabContent" id="myTabContent">
                                @forelse ($corePages as $key => $item)
                                    <div class="tab-pane fade show {{ $key === 0 ? ' show active' : '' }}"
                                         id="tab-{{$key}}" role="tabpanel" aria-labelledby="tab-{{$key}}-tab"
                                         tabindex="0">
                                        <div class="exploreFeatures-content">
                                            <div class="row align-items-center rg-20">
                                                <div class="col-lg-7 col-md-6">
                                                    <div class="max-w-605">
                                                        <img src="{{getFileUrl($item->image)}}"
                                                             alt=""/>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-6">
                                                    <div class="max-w-351 left">
                                                        <h4 class="fs-36 fw-700 lh-34 text-1b1c17 pb-14">{{$item->title}}</h4>
                                                        <p class="fs-18 fw-400 lh-28 text-1b1c17">{{$item->description}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center"><p class="text-main-color">{{__('No Data Found')}}</p></div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    @endif
    <!-- End Core Features -->

    <!-- Start Pricing Plan -->
    @if (isset($section['pricing_plan']) && $section['pricing_plan']->status == STATUS_ACTIVE)
        <section class="py-150 bg-fbf9f1 ld-container-1320 position-relative z-1" id="price">
            <div class="container">
                <!--  -->
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center pb-32">
                            <p class="d-inline-block py-8 px-18 bd-ra-50 bg-efece0 fs-18 fw-500 lh-28 text-1b1c17 mb-17">{{ $section['pricing_plan']->page_title }}</p>
                            <h4 class="pb-9 fs-sm-56 fs-36 fw-700 lh-sm-67 text-1b1c17">{{ $section['pricing_plan']->title }}</h4>
                            <p class="max-w-631 m-auto fs-18 fw-400 lh-28 text-707070">{{ $section['pricing_plan']->description }}</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="pb-50 w-100 d-flex justify-content-center align-items-center">
                    <ul class="nav nav-tabs flex-column flex-sm-row zTab-reset zTab-three" id="pricePlanTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="billingMonthly-tab" data-bs-toggle="tab"
                                data-bs-target="#billingMonthly-tab-pane" type="button" role="tab"
                                aria-controls="billingMonthly-tab-pane" aria-selected="true">{{__('Billing Monthly')}}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="billingYearly-tab" data-bs-toggle="tab"
                                data-bs-target="#billingYearly-tab-pane" type="button" role="tab"
                                aria-controls="billingYearly-tab-pane" aria-selected="false">{{__('Billing Yearly')}}
                            </button>
                        </li>
                    </ul>
                </div>
                <!--  -->
                <div class="swiper ld-price-plan-wrap">
                    <div class="swiper-wrapper">
                        @foreach($packages as $package)
                            <div class="swiper-slide">
                                <div class="ld-price-plan {{$package->is_default ? 'ld-price-plan-popular' : '' }}">
                                    @if($package->is_default)
                                        <p class="mostPopular">{{__('MOST POPULAR')}}</p>
                                    @endif
                                    <div class="icon">
                                        <img src="{{ getFileUrl($package->icon_id) }}" alt="{{$package->name}}">
                                    </div>
                                    <h4 class="fs-28 fw-600 lh-33 text-1b1c17 pb-16">{{$package->name}}</h4>
                                    <p class="pb-32 mb-27 bd-b-one bd-c-ededed fs-18 fw-400 lh-28 text-707070">{{$package->description}}</p>
                                    <p class="priceAmount priceAmount-monthly ">{{showPrice($package->monthly_price)}}</p>
                                    <p class="priceAmount priceAmount-yearly ">{{showPrice($package->yearly_price)}}</p>
                                    <p class="fs-16 fw-500 lh-19 text-707070 pb-36">{{__('PER ACTIVE USER/MONTH')}}</p>
                                    @if ($currentPackage?->package_id == $package->id)
                                        <button type="submit" class="border-0 priceSubscribe w-100">{{__('Subscribe Now')}}</button>
                                    @else
                                        <form action="{{route('admin.subscription.checkout')}}" method="GET">
                                            <input type="hidden" name="slug" value="{{$package->slug}}">
                                            <input type="hidden" name="type" class="package-type-yearly-monthly" value="{{SUBSCRIPTION_TYPE_MONTHLY}}">
                                            <button type="submit" class="border-0 priceSubscribe w-100">{{__('Subscribe Now')}}</button>
                                        </form>
                                    @endif
                                    <ul class="zList-pb-20">
                                        <li>
                                            <div class="d-flex align-items-center cg-10">
                                                <div class="flex-shrink-0 d-flex">
                                                    <img
                                                        src="{{ asset('super_admin/images/icon/price-plan-icon.svg') }}"
                                                        alt="">
                                                </div>
                                                <p class="fs-18 fw-400 lh-21 text-707070">
                                                    {{__($package->alumni_limit == -1 ? 'Unlimited alumni manage' : $package->alumni_limit.' '.'alumni manage') }}
                                                </p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center cg-10">
                                                <div class="flex-shrink-0 d-flex">
                                                    <img
                                                        src="{{ asset('super_admin/images/icon/price-plan-icon.svg') }}"
                                                        alt="">
                                                </div>
                                                <p class="fs-18 fw-400 lh-21 text-707070">
                                                    {{__($package->event_limit == -1 ? 'Unlimited event manage' : 'Total'.' '.$package->event_limit.' '.'event manage') }}
                                                </p>
                                            </div>
                                        </li>
                                        @if($package->custom_domain)
                                            <li>
                                                <div class="d-flex align-items-center cg-10">
                                                    <div class="flex-shrink-0 d-flex">
                                                        <img
                                                            src="{{ asset('super_admin/images/icon/price-plan-icon.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <p class="fs-18 fw-400 lh-21 text-707070">
                                                        {{__('Custom domain support')}}
                                                    </p>
                                                </div>
                                            </li>
                                        @endif
                                        @foreach(json_decode($package->others) as $feature)
                                            <li>
                                                <div class="d-flex align-items-center cg-10">
                                                    <div class="flex-shrink-0 d-flex">
                                                        <img
                                                            src="{{ asset('super_admin/images/icon/price-plan-icon.svg') }}"
                                                            alt="">
                                                    </div>
                                                    <p class="fs-18 fw-400 lh-21 text-707070">{{$feature}}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="controlBtn">
                        <div class="swiper-button-next">
                            <svg width="24" height="18" viewBox="0 0 24 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.923828 8.25H0.173828V9.75H0.923828V8.25ZM23.0777 9.75C23.4919 9.75 23.8277 9.41421 23.8277 9C23.8277 8.58579 23.4919 8.25 23.0777 8.25V9.75ZM0.923828 9.75H23.0777V8.25H0.923828V9.75Z"
                                    fill="black" fill-opacity="0.12" />
                                <path d="M15.9395 1.7998L23.0778 8.9998L15.9395 16.1998" stroke="black" stroke-opacity="0.12"
                                    stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="swiper-button-prev">
                            <svg width="24" height="18" viewBox="0 0 24 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M23.0762 8.25H23.8262V9.75H23.0762V8.25ZM0.922329 9.75C0.508116 9.75 0.172329 9.41421 0.172329 9C0.172329 8.58579 0.508116 8.25 0.922329 8.25V9.75ZM23.0762 9.75H0.922329V8.25H23.0762V9.75Z"
                                    fill="black" fill-opacity="0.12" />
                                <path d="M8.06055 1.7998L0.922204 8.9998L8.06055 16.1998" stroke="black" stroke-opacity="0.12"
                                    stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Pricing Plan -->

    <!-- Start Testimonials -->
    @if (isset($section['testimonials_area']) && $section['testimonials_area']->status == STATUS_ACTIVE)
        <section class="pt-150 ld-container-1320 position-relative z-1">
            <div class="container">
                <!--  -->
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="text-center pb-52">
                            <p class="d-inline-block py-8 px-18 bd-ra-50 bg-efece0 fs-18 fw-500 lh-28 text-1b1c17 mb-17">{{ $section['testimonials_area']->page_title }}</p>
                            <h4 class="pb-9 fs-sm-56 fs-36 fw-700 lh-sm-67 text-1b1c17">{{ $section['testimonials_area']->title }}</h4>
                            <p class="max-w-631 m-auto fs-18 fw-400 lh-28 text-707070">{{ $section['testimonials_area']->description }}</p>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="ld-testi-wrap m-auto">

                    @forelse ($allTestimonial as $testimonial)
                        <div class="testi-item">
                            <div class="d-flex align-items-center flex-wrap flex-sm-nowrap cg-20 rg-10 pb-22">
                                <div class="flex-shrink-0 w-90 h-90 bd-one bd-c-1b1c17 rounded-circle overflow-hidden">
                                    <img src="{{getFileUrl($testimonial->image)}}" alt="">
                                </div>
                                <div class="">
                                    <h4 class="line-clamp-1 sf-text-ellipsis mb-8 fs-24 fw-500 lh-29 text-1b1c17">{{$testimonial->name}}</h4>
                                    <p class="line-clamp-1 sf-text-ellipsis fs-20 fw-500 lh-24 text-1b1c17">{{$testimonial->designation}}</p>
                                </div>
                            </div>
                            <!--  -->
                            <div class="">
                                <p class="fs-18 fw-400 lh-28 text-707070">“{{$testimonial->comment}}”</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center"><p class="text-main-color">{{__('No Data Found')}}</p></div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif
    <!-- End Testimonials -->


    <!-- Start FAQ's -->
    @if (isset($section['faqs_area']) && $section['faqs_area']->status == STATUS_ACTIVE)
        <section class="py-150 ld-container-1320 position-relative z-1" id="faq">
            <div class="container">
                <!--  -->
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center pb-52">
                            <p class="d-inline-block py-8 px-18 bd-ra-50 bg-efece0 fs-18 fw-500 lh-28 text-1b1c17 mb-17">{{ $section['faqs_area']->page_title }}</p>
                            <h4 class="pb-9 fs-sm-56 fs-36 fw-700 lh-sm-67 text-1b1c17">{{ $section['faqs_area']->title }}</h4>
                            <p class="max-w-631 m-auto fs-18 fw-400 lh-28 text-707070">{{ $section['faqs_area']->description }}</p>
                        </div>
                    </div>
                </div>
                <!--  -->

                <div class="accordion zAccordion-reset zAccordion-one" id="accordionExample">
                    <div class="row rg-24">
                        @php
                            $splitFaqs = $allFaq->split(2);
                        @endphp
                        <div class="col-lg-6">
                            @foreach ($splitFaqs->get(0) ?? [] as $key => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLeft{{$key}}" aria-controls="collapseLeft{{$key}}">{{$key+1}}. {{$faq->title}}</button>
                                    </h2>
                                    <div id="collapseLeft{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body"><p class="">{{$faq->description}}</p></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-6">
                            @php
                                $labelIndex = count($splitFaqs->get(0) ?? []);
                            @endphp
                            @foreach ($splitFaqs->get(1) ?? [] as $key => $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRight{{$key}}" aria-controls="collapseRight{{$key}}">{{++$labelIndex}}. {{$faq->title}}</button>
                                    </h2>
                                    <div id="collapseRight{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body"><p class="">{{$faq->description}}</p></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End FAQ's -->

@endsection
