@php
$meta = [
    // "meta" => [],
    "seo" => [
        "title" => "contact",
        "image" => asset('seo.jpg'),
    ]
];
@endphp
@extends('frontend.layouts.layout',$meta)
@section('contents')
<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
</style>
<section class="py-5 my-5">
    <div class="container h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form method="POST" action="{{ route('login_sumbit') }}">
                    @csrf

                    <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        <p class="lead fw-normal mb-0 me-3">LOG IN</p>
                    </div>

                    <div class="divider d-flex align-items-center my-4">
                        {{-- <p class="text-center fw-bold mx-3 mb-0">Or</p> --}}
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Email address</label>
                        <input type="email" name="email" id="form3Example3" class="form-control "
                            placeholder="Enter a valid email address" />
                        @error('email')
                        <div class="text-danger pt-2">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Password</label>
                        <input type="password" name="password" id="form3Example4" class="form-control "
                            placeholder="Enter password" />
                        @error('password')
                        <div class="text-danger pt-2">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    {{-- <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                                Remember me
                            </label>
                        </div>
                        <a href="#!" class="text-body">Forgot password?</a>
                    </div> --}}

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn rounded-pill btn-primary px-4">
                            Login
                        </button>
                        {{-- <p class="small fw-bold mt-2 pt-1 mb-0">
                            Don't have an account?
                            <a href="#!" class="link-danger">Register</a>
                        </p> --}}
                    </div>

                </form>
            </div>
        </div>
    </div>

</section>
@endsection
