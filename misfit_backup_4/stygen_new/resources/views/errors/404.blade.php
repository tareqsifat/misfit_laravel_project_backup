@extends('errors::illustrated-layout')
@section('image')
<div style="background-image: url({{ asset('404.webp') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('The page or product is out-dated or out of stock & has been moved or removed.
The website address URL is not correct.'))
