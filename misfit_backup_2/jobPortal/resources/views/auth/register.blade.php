@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark 
                                @if(session()->has('role'))
                                    @if(session()->has('role') && session()->get('role') == 3)
                                        active
                                    @endif
                                @else
                                    active
                                @endif"
                                id="home-tab" data-bs-toggle="tab" data-bs-target="#home" 
                                type="button" role="tab" aria-controls="home"
                                aria-selected="false">
                                    Job Seeker {{ __('Register') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-dark
                                @if(session()->has('role') && session()->get('role') == 2)
                                    active 
                                @endif"
                                id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" 
                                type="button" role="tab" aria-controls="profile">
                                    Company Register
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade
                        @if(session()->has('role')) 
                            @if(session()->has('role') && session()->get('role') == 3)
                                show active 
                            @endif 
                        @else 
                            show active 
                        @endif"
                    id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role_id" value="3">
        
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
        
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade
                        @if(session()->has('role') && session()->get('role') == 2)
                            show active
                        @endif"
                        id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role_id" value="2">
        
                                <div class="row mb-3">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-end">Company {{ __('Name') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}"   autocomplete="full_name" autofocus>
        
                                        @error('full_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nid_number" class="col-md-4 col-form-label text-md-end">Nid Card Number</label>
        
                                    <div class="col-md-6">
                                        <input id="nid_number" type="text" class="form-control @error('nid_number') is-invalid @enderror" name="nid_number" value="{{ old('nid_number') }}"   autocomplete="nid_number" autofocus>
        
                                        @error('nid_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tin_number" class="col-md-4 col-form-label text-md-end">Tin Number</label>
        
                                    <div class="col-md-6">
                                        <input id="tin_number" type="text" class="form-control @error('tin_number') is-invalid @enderror" name="tin_number" value="{{ old('tin_number') }}"   autocomplete="tin_number" autofocus>
        
                                        @error('tin_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"   autocomplete="email">
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required  autocomplete="new-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required  autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="company_name" class="col-md-4 col-form-label text-md-end">Compaany name</label>
        
                                    <div class="col-md-6">
                                        <input id="company_name" type="string" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}"   autocomplete="company_name" autofocus>
        
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="company_email" class="col-md-4 col-form-label text-md-end">Company Email</label>
        
                                    <div class="col-md-6">
                                        <input id="company_email" type="string" class="form-control @error('company_email') is-invalid @enderror" name="company_email" value="{{ old('company_email') }}">
        
                                        @error('company_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="registration_number" class="col-md-4 col-form-label text-md-end">Registration Number</label>
        
                                    <div class="col-md-6">
                                        <input id="registration_number" type="string" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ old('registration_number') }}"   autocomplete="registration_number" autofocus>
        
                                        @error('registration_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
