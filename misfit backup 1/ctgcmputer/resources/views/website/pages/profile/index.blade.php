@extends('website.layouts.app')
@section('content')

<div>
    {{-- Be like water. --}}
    <div class="account-area section-space">
        <div class="container">
            <div class="myaccount-page-wrapper">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div>
                            {{-- In work, do what you enjoy. --}}
                            <nav class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="myaccount-nav-link {{Route::is('frontend.profile') ? 'active' : ''}}" href="{{ route("frontend.profile") }}" id="dashboad-tab">Dashboard</a>
                                <a class="myaccount-nav-link {{Route::is('frontend.orders') ? 'active' : ''}}" href="{{ route("frontend.orders") }}" id="orders-tab">Orders</a>
                                <a class="myaccount-nav-link {{Route::is('frontend.reviews') ? 'active' : ''}}" href="{{ route("frontend.reviews") }}" id="download-tab">Reviews</a>
                                <a class="myaccount-nav-link {{Route::is('frontend.address') ? 'active' : ''}}" href="{{ route("frontend.address") }}" id="address-edit-tab">address</a>
                                <a class="myaccount-nav-link {{Route::is('frontend.account_details') ? 'active' : ''}}" href="{{ route("frontend.account_details") }}" id="account-info-tab">Account Details</a>
                                <a class="myaccount-nav-link {{Route::is('frontend.reset_password') ? 'active' : ''}}" href="{{ route("frontend.reset_password") }}" id="account-info-tab">Reset Password</a>
                                <a class="myaccount-nav-link" href="javascript:void(0)"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>
                            </nav>
                        </div>

                    </div>

                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade active show" id="dashboad" role="tabpanel" aria-labelledby="dashboad-tab">
                                <div class="myaccount-content">
                                    <h3>Dashboard</h3>
                                    @if (session()->has('access_token'))
                                        <a class="btn btn-info my-3" data-turbolinks="false" href="/admin">go to dashboard</a>
                                    @endif
                                    <div class="welcome">
                                        <p>
                                            Hello,
                                            <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                                            (If Not <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                                            <a href="javascript:void(0)" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}</a>)
                                        </p>
                                    </div>
                                    <p class="mb-0">From your account dashboard. you can easily check &amp; view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        localStorage.setItem('token',`{{session()->get('access_token')}}`);
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
