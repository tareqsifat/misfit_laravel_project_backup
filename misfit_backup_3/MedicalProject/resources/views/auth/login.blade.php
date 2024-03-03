@extends('layouts.app')

@section('content')
<div class="container p-4" >
    <div class="row justify-content-center">
        <div class="col-sm-6 mb-6">
            <div class="card">
                <div class="card-header">{{ 'Login to Medical Dashboard' }}</div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form> --}}
                    <form method="POST" class="insert_form"  action="{{ route('login') }}" enctype="multipart/form-data" id="horizontal-form">
                        @csrf
                        <div class="preview">
                            <div class="form-group p-4">
                            <label for="horizontal-form-1" class="form-label sm:w-20">Email</label>
                            @error('email')
                                <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                            @enderror
                            <input id="horizontal-form-1" name="email" type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group p-4">
                            <label for="horizontal-form-1" class="form-label sm:w-20">Password</label>
                            @error('password')
                                <div class="text-theme-6 mt-2">{{ $message }}<br></div>
                            @enderror
                            <input id="horizontal-form-1" name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    </div>
                                    <div class="col-sm-8">
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-primary" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
