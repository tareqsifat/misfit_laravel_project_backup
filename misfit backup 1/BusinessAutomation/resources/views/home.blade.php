@extends('layouts.app')

@section('breadcrumb')
    <title>Home</title>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
{{--            @dump(\Illuminate\Support\Facades\Route::current()->uri())--}}
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="container-fluid">

    <span class="text-bg-info w-100 d-block p-4 h4">Welcome to Dashboard, you have logged in as {{\Illuminate\Support\Facades\Auth::user()->user_type->name}}</span>
{{--    <div class="row">--}}
{{--        <div class="col-md-2">--}}
{{--            @include('includes.side-bar')--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
@endsection
