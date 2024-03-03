@extends('addon.saas.frontend.layouts.app')
@push('title')
    {{ $pageTitle }}
@endpush
@section('content')

    <!-- Star Breadcrumb -->
    <section class="ld-breadcrumb-section">
        <div class="ld-breadcrumb-wrap"
             data-background="{{ asset('super_admin/images/landing-page/breadcrumb-bg.png') }}">
            <div class="container-fluid">
                <div class="ld-breadcrumb-content">
                    <h4 class="title">{{__($pageTitle)}}</h4>
                    <ul class="list">
                        <li><a href="{{route('frontend')}}">{{__('Home')}}</a></li>
                        <li><a>{{__($pageTitle)}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Breadcrumb -->

    <!--  -->
    <section class="pt-86 pb-122 ld-container-320 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                   {!! $description !!}
                </div>
            </div>
        </div>
    </section>
@endsection
