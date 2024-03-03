<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
	<script src="{{ asset('contents/website') }}/js/jquery.js"></script>

	
    {{-- <meta property="og:url"           content="{{ $url }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ $title }}" />
    <meta property="og:description"   content="{{ $description }}" />
    <meta property="og:image"         content="{{ $image }}" /> --}}

	{{-- @php
		dd($image);
	@endphp --}}
	<!-- Stylesheets
	============================================= -->
	@include('website.partials.part_css')

	<!-- Document Title
	============================================= -->
	<title>Medical Demo | Canvas</title>

</head>

<body class="stretched page-transition" data-loader-html="<div id='css3-spinner-svg-pulse-wrapper'><svg id='css3-spinner-svg-pulse' version='1.2' height='210' width='550' xmlns='https://www.w3.org/2000/svg' viewport='0 0 60 60' xmlns:xlink='https://www.w3.org/1999/xlink'><path id='css3-spinner-pulse' stroke='#DE6262' fill='none' stroke-width='2' stroke-linejoin='round' d='M0,90L250,90Q257,60 262,87T267,95 270,88 273,92t6,35 7,-60T290,127 297,107s2,-11 10,-10 1,1 8,-10T319,95c6,4 8,-6 10,-17s2,10 9,11h210' /></svg></div>">

	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="hod3FV26"></script>
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		@include('website.include.topbar')
		<!-- #top-bar end -->

		<!-- Header
		============================================= -->
		@include('website.include.header')
		<!-- #header end -->
        @yield('content')
		<!-- Footer
		============================================= -->
		@include('website.include.footer')
		<!-- #footer end -->
	<!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up rounded-circle"></div>

	<!-- JavaScripts
	============================================= -->
	@include('website.partials.part_js')

</body>
</html>