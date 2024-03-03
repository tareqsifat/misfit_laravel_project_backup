@extends('frontend.layouts.app')
@section('content')
{{-- Success is as dangerous as failure. --}}
<main class="main-content">
    @include('frontend.home.banner')
    @include('frontend.home.categories')
    @include('frontend.home.home-page-product')

    <section>
        <div class="custom-container px-3">

            <div class="section-two-space">
                <h2 class="text-center">Gallery</h2>
                <h4 class="text-center mb-5">Our Happy Customers & Activities</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="/blog1.jpg" class="card-img-top" alt="/blog1.jpg">
                            <div class="card-body">
                                <h3 class="card-title">Gaming pc build</h3>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="/blog2.jpg" class="card-img-top" alt="/blog2.jpg">
                            <div class="card-body">
                                <h3 class="card-title">PC Build Under 50k</h3>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <img src="/blog3.jpg" class="card-img-top" alt="/blog3.jpg">
                            <div class="card-body">
                                <h3 class="card-title">Gaming laptop</h3>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3 mb-2 about_website_section">
                {{-- <h1 class="heading">Our Introduction</h1> --}}
                {!! \App\Models\Setting::select('descriptive_about')->first()->descriptive_about !!}
            </div>

            <div class="btns_section">
                <div class="row">
                    @if($setting->phone_number_desktop)
                    <div class="col-2">
                        <button class="btn_box">
                            <div class="d-block">
                                <i class="fa fa-phone"></i>
                            </div>
                            <span style="display: inline-block;line-height: 1.6;">
                                <b>
                                    <p>DESKTOP</p>
                                </b>
                                <b>
                                    <p>{{$setting->phone_number_desktop}}</p>
                                </b>
                            </span>
                        </button>
                    </div>
                    @endif

                    @if($setting->phone_number_laptop)
                    <div class="col-2">
                        <button class="btn_box">
                            <div class="d-block">
                                <i class="fa fa-phone"></i>
                            </div>
                            <span style="display: inline-block;line-height: 1.6;">
                                <b>
                                    <p>LAPTOP</p>
                                </b>
                                <b>
                                    <p>{{$setting->phone_number_laptop}}</p>
                                </b>
                            </span>
                        </button>
                    </div>
                    @endif

                    @if($setting->phone_number_service)
                    <div class="col-2">
                        <button class="btn_box">
                            <div class="d-block">
                                <i class="fa fa-phone"></i>
                            </div>
                            <span style="display: inline-block;line-height: 1.6;">
                                <b>
                                    <p>SERVICE</p>
                                </b>
                                <b>
                                    <p>{{$setting->phone_number_service}}</p>
                                </b>
                            </span>
                        </button>
                    </div>
                    @endif

                    @if($setting->phone_number_accessories)
                    <div class="col-2">
                        <button class="btn_box">
                            <div class="d-block">
                                <i class="fa fa-phone"></i>
                            </div>
                            <span style="display: inline-block;line-height: 1.6;">
                                <b>
                                    <p>ACCESSORIES</p>
                                </b>
                                <b>
                                    <p>{{$setting->phone_number_accessories}}</p>
                                </b>
                            </span>
                        </button>
                    </div>
                    @endif

                    @if($setting->phone_number_helpline)
                    <div class="col-2">
                        <button class="btn_box">
                            <div class="d-block">
                                <i class="fa fa-phone"></i>
                            </div>
                            <span style="display: inline-block;line-height: 1.6;">
                                <b>
                                    <p>HELPLINE</p>
                                </b>
                                <b>
                                    <p>{{$setting->phone_number_helpline}}</p>
                                </b>
                            </span>
                        </button>
                    </div>
                    @endif

                    @if($setting->phone_number_rma)
                    <div class="col-2">
                        <button class="btn_box">
                            <div class="d-block">
                                <i class="fa fa-phone"></i>
                            </div>
                            <span style="display: inline-block;line-height: 1.6;">
                                <b>
                                    <p>RMA</p>
                                </b>
                                <b>
                                    <p>{{$setting->phone_number_rma}}</p>
                                </b>
                            </span>
                        </button>
                    </div>
                    @endif
                </div>
            </div>


        </div>
    </section>
</main>
@endsection
