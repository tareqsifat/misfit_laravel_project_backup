@extends('website.layout.webstie')

@section('content')
	{{-- @foreach ($doctor as $item) --}}
		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-dark page-title-center p-0">

			<div class="fslider" data-arrows="false" data-pagi="false" data-animation="fade" data-hover="false">
				<div class="flexslider">
			
					<div class="slider-wrap">
						<div class="slide"><img src='{{ asset("/uploads/doctors/$doctor->photo") }}' alt="{{ $doctor->photo }}"></div>
					</div>
			
					<div class="vertical-middle vertical-middle-overlay">
						<div class="container clearfix">
							<h1>About {{ $doctor->name }}</h1>
							<span>{{ $doctor->designation }}</span>
							{{-- <ol class="breadcrumb justify-content-center">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">About-us</li>
							</ol> --}}
						</div>
					</div>
			
				</div>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="row justify-content-between" style="margin: 25px 0px">
				<div class="col-sm-3">
					{{-- <p>test</p> --}}
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<h2>{{ $doctor->name }}</h2>
							<p>{{ $doctor->designation }}</p>
							<p>{{ $doctor->description }}</p>
						</div>
					  </div>
					
				</div>
				<div class="col-sm-3">
					{{-- <p>test</p> --}}
				</div>
			</div>
		</section><!-- #content end -->
		{{-- @break --}}
	{{-- @endforeach --}}
		

@endsection