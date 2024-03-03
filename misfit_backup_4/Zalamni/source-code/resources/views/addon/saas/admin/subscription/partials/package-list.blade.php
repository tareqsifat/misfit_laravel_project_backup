<div class="container">
    <!--  -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="text-center pb-32">
                <p class="d-inline-block py-8 px-18 bd-ra-50 bg-efece0 fs-18 fw-500 lh-28 text-1b1c17 mb-17"> {{__('Pricing Plan')}}</p>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="pb-50 w-100 d-flex justify-content-center align-items-center">
        <ul class="nav nav-tabs zTab-reset zTab-three" id="pricePlanTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="billingMonthly-tab" data-bs-toggle="tab"
                        data-bs-target="#billingMonthly-tab-pane" type="button" role="tab"
                        aria-controls="billingMonthly-tab-pane" aria-selected="true">Billing Monthly
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="billingYearly-tab" data-bs-toggle="tab"
                        data-bs-target="#billingYearly-tab-pane" type="button" role="tab"
                        aria-controls="billingYearly-tab-pane" aria-selected="false">Billing Yearly
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
                        <p class="priceAmount priceAmount-monthly">{{showPrice($package->monthly_price)}}</p>
                        <p class="priceAmount priceAmount-yearly">{{showPrice($package->yearly_price)}}</p>
                        <p class="fs-16 fw-500 lh-19 text-707070 pb-36">{{__('PER ACTIVE USER/MONTH')}}</p>

                            <form action="{{route('admin.subscription.checkout')}}" method="GET">
                                <input type="hidden" name="slug" value="{{$package->slug}}">
                                <input type="hidden" name="type" class="package-type-yearly-monthly" value="{{SUBSCRIPTION_TYPE_MONTHLY}}">
                                @if ($currentPackage?->package_id == $package->id)
                                    <button type="submit" class="border-0 priceSubscribe w-100">{{__('Current Plan')}}</button>
                                @else
                                <button type="submit" class="border-0 priceSubscribe w-100">{{__('Subscribe Now')}}</button>
                                @endif
                            </form>

                        <ul class="zList-pb-20">
                            <li>
                                <div class="d-flex align-items-center cg-10">
                                    <div class="flex-shrink-0 d-flex">
                                        <img src="{{ asset('super_admin/images/icon/price-plan-icon.svg') }}" alt="">
                                    </div>
                                    <p class="fs-18 fw-400 lh-21 text-707070">
                                        {{__($package->alumni_limit == -1 ? 'Unlimited alumni manage' : $package->alumni_limit.' '.'alumni manage') }}
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center cg-10">
                                    <div class="flex-shrink-0 d-flex">
                                        <img src="{{ asset('super_admin/images/icon/price-plan-icon.svg') }}" alt="">
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
                                            <img src="{{ asset('super_admin/images/icon/price-plan-icon.svg') }}" alt="">
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
                                            <img src="{{ asset('super_admin/images/icon/price-plan-icon.svg') }}" alt="">
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
