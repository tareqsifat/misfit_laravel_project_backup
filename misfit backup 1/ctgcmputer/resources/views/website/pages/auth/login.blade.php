@extends('website.layouts.app',[
    "meta" => [
        "title" => "Login",
    ]
])
@section('content')
<main>
    <div class="login-register-area section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header p-4">
                            <div class="login-register-title mb-30">
                                <h3>Login</h3>
                                <p>Welcome back! Please enter your email and password to login from.</p>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="login-register-content">
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="login-register-style">
                                    <form method="POST" wire:submit.prevent="login">
                                        @csrf
                                        <div class="login-register-input">
                                            <label for="email" class="col-md col-form-label text-md-right"> Email or Phone number</label>
                                            <input id="email" type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required >
                                            {{-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="login-register-input">
                                            <label for="password" class="col-md col-form-label text-md-right">{{ __('Password') }}</label>
                                            <input id="password" type="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" >

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <div class="remember-me-btn">
                                            <input id="remember-me-checkbox" type="checkbox">
                                            <label for="remember-me-checkbox">Remember me</label>

                                        </div> --}}
                                        <div class="form-group row mt-2">
                                            <div class="">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-2">
                                            <div class="">
                                                <button type="submit" class="btn btn-secondary btn-register-now">
                                                    {{ __('Login') }}
                                                </button>

                                                @if (Route::has('password.request'))
                                                    <br>
                                                    <a class="pt-2" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="btn-register mt-3">
                                            Dont have an account? <a href="{{ route('website_register') }}"><b>Register now</b></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
