@extends('addon.saas.frontend.layouts.app')
@push('title')
    Contact US
@endpush
@section('content')

    <!-- Star Breadcrumb -->
    <section class="ld-breadcrumb-section">
        <div class="ld-breadcrumb-wrap"
             data-background="{{ asset('super_admin/images/landing-page/breadcrumb-bg.png') }}">
            <div class="container-fluid">
                <div class="ld-breadcrumb-content">
                    <h4 class="title">{{__('Contact Us')}}</h4>
                    <ul class="list">
                        <li><a href="{{route('index')}}">{{__('Home')}}</a></li>
                        <li><a href="{{route('contact-us')}}">{{__('Contact Us')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <!--  -->
    <section class="pt-100 pb-150 ld-container-1320 bg-white">
        <div class="container">
            <div class="ld-contactUs-wrap">
                <!--  -->
                <div class="left">
                    <h4 class="title">{{__('Get In Touch With Us For Further Info & services.')}}</h4>
                    <form action="{{ route('contact_us.store') }}" method="post" data-handler="settingCommonHandler">
                        @csrf
                        <div class="row rg-20">
                            <div class="col-xl-6">
                                <label for="firstName" class="zForm-label">{{__('Name')}}<span class="text-danger">*</span></label>
                                <input type="text" class="form-control zForm-control" name="name" id="name"
                                       placeholder="{{__('Name')}}">
                            </div>

                            <div class="col-xl-6">
                                <label for="emailAddress" class="zForm-label">{{__('Email Address')}}<span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control zForm-control" id="emailAddress"
                                       placeholder="{{__('Email Address')}}">
                            </div>
                            <div class="col-xl-6">
                                <label for="phoneNumber" class="zForm-label">{{__('Phone Number')}}</label>
                                <input type="text" class="form-control zForm-control" name="phone" id="phone"
                                       placeholder="{{__('phoneNumber')}}">
                            </div>
                            <div class="col-xl-6">
                                <label for="yourIssue" class="zForm-label">{{__('Your Issue')}}</label>
                                <input type="text" class="form-control zForm-control" id="yourIssue"
                                       placeholder="{{__('Your Issue')}}" name="issue">
                            </div>
                            <div class="col-12">
                                <label for="message" class="zForm-label">{{__('Message')}} <span class="text-danger">*</span></label>
                                <textarea class="form-control zForm-control min-h-180" name="message" id="message"
                                          placeholder="{{__('Write your massage here')}}"></textarea>
                            </div>
                        </div>
                        <div class="pt-40">
                            <button type="submit"
                               class="py-18 px-33 bd-ra-12 bg-cdef84 d-inline-block fs-18 fw-600 lh-21 text-1b1c17 hover-bg-one border-0">{{__('Send Massage')}}</button>
                        </div>
                    </form>
                </div>
                <!--  -->
                <div class="right">
                    <h4 class="fs-24 fw-600 lh-31 text-1b1c17 pb-33">{{__('Get in Touch')}}</h4>
                    <ul class="zList-pb-30 pb-40 mb-34 bd-b-one bd-c-ededed">
                        <li class="d-flex align-items-center flex-column flex-sm-row cg-19 rg-10">
                            <div
                                class="flex-shrink-0 w-56 h-56 rounded-circle d-flex justify-content-center align-items-center bg-8d6eff">
                                <img src="{{ asset('super_admin/images/icon/location-2.svg') }}" alt="">
                            </div>
                            <div class="">
                                <p class="fs-18 fw-400 lh-28 text-707070">{!! nl2br(getOption('app_location')) !!}</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-center flex-column flex-sm-row cg-19 rg-10">
                            <div
                                class="flex-shrink-0 w-56 h-56 rounded-circle d-flex justify-content-center align-items-center bg-ff8972">
                                <img src="{{ asset('super_admin/images/icon/mail.svg') }}" alt="">
                            </div>
                            <div class="">
                                <p class="fs-18 fw-400 lh-28 text-707070">{{ getOption('app_email') }}</p>
                            </div>
                        </li>
                        <li class="d-flex align-items-center flex-column flex-sm-row cg-19 rg-10">
                            <div
                                class="flex-shrink-0 w-56 h-56 rounded-circle d-flex justify-content-center align-items-center bg-ffb263">
                                <img src="{{ asset('super_admin/images/icon/phone-3.svg') }}" alt="">
                            </div>
                            <div class="">
                                <p class="fs-18 fw-400 lh-28 text-707070">{{ getOption('app_contact_number') }}</p>
                            </div>
                        </li>
                    </ul>
                    <h4 class="fs-24 fw-600 lh-31 text-1b1c17 pb-23">{{__('Follow us')}}</h4>
                    <ul class="d-flex align-items-center flex-wrap g-12 contact-social">
                        <li>
                            <a href="{{ getOption('facebook_url') }}"
                               class="w-50 h-50 rounded-circle bd-one bd-c-ededed d-flex justify-content-center align-items-center text-1b1c17"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="{{ getOption('twitter_url') }}"
                               class="w-50 h-50 rounded-circle bd-one bd-c-ededed d-flex justify-content-center align-items-center text-1b1c17"><i
                                    class="fa-brands fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="{{ getOption('linkedin_url') }}"
                               class="w-50 h-50 rounded-circle bd-one bd-c-ededed d-flex justify-content-center align-items-center text-1b1c17"><i
                                    class="fa-brands fa-linkedin-in"></i></a>
                        </li>
                        <li>
                            <a href="{{ getOption('social_media_skype') }}"
                               class="w-50 h-50 rounded-circle bd-one bd-c-ededed d-flex justify-content-center align-items-center text-1b1c17"><i
                                    class="fa-brands fa-skype"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--  -->

@endsection
