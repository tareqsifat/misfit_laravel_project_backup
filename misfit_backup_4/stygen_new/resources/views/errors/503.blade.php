@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('image')
<div style="background-image: url({{ asset('maintain.webp') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection
@section('code', '503')
@section('message', __('Website on maintenance. If you need to you can always follow us on Facebook for updates, otherwise we’ll be back up shortly! — The Stygen Team'))

