@extends('website.layout.webstie')

@section('content')
<section id="page-title" class="bg-transparent">

	<div class="container clearfix">
		<h1>Doctors</h1>
		<span>A Short Page Title Tagline</span>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Doctors</li>
		</ol>
	</div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
	<div class="row justify-content-between">
		<div class="col-sm-10"></div>
		<div class="col-sm-2" style="margin-top: 20px">
			<div class="btn-group" role="group" aria-label="Basic example">
				<a href="{{ route('website_doctor') }}">
					<button type="button" class="btn btn-secondary">Gridview</button>
				</a>
				<a href="{{ route('website_doctor_list') }}">
					<button type="button" class="btn btn-secondary">ListView</button>
				</a>
			</div>
		</div>
	</div>
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="row justify-content-center col-mb-50 mb-0">
				@foreach ($doctor as $key=> $item)
					<div class="col-sm-6 col-md-4 col-xl-3">
						<div class="team">
							<div class="team-image">
								<img src='{{ "/uploads/doctors/$item->photo" }}' alt="{{ $item->photo }}">
							</div>
							<div class="team-desc">
								<div class="team-title">
									<a href="{{ route('website_single_doctor', $item->slug) }}">
										<h4>{{ $item->name }}</h4>
										<span>{{ $item->designation }}</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					@break($key == 7)
				@endforeach

				{{-- <div class="col-sm-6 col-md-4 col-xl-3">
					<div class="team">
						<div class="team-image">
							<img src="{{ 'contents/website' }}/demos/medical/images/doctors/2.jpg" alt="Dr. John Doe">
						</div>
						<div class="team-desc">
							<div class="team-title">
								<a href="#"><h4>Dr. Bryan Mcguire</h4></a>
								<a href="#"><span>Orthopedist</span></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-xl-3">
					<div class="team">
						<div class="team-image">
							<img src="{{ 'contents/website' }}/demos/medical/images/doctors/3.jpg" alt="Dr. John Doe">
						</div>
						<div class="team-desc">
							<div class="team-title">
								<a href="#"><h4>Dr. Mary Jane</h4></a>
								<a href="#"><span>Neurologist</span></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-xl-3">
					<div class="team">
						<div class="team-image">
							<img src="{{ 'contents/website' }}/demos/medical/images/doctors/4.jpg" alt="Dr. John Doe">
						</div>
						<div class="team-desc">
							<div class="team-title">
								<a href="#"><h4>Dr. Silvia Bush</h4></a>
								<a href="#"><span>Dentist</span></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-xl-3">
					<div class="team">
						<div class="team-image">
							<img src="{{ 'contents/website' }}/demos/medical/images/doctors/6.jpg" alt="Dr. John Doe">
						</div>
						<div class="team-desc">
							<div class="team-title">
								<a href="{{ route('website_about') }}#content"><h4>Dr. Hugh Baldwin</h4></a>
								<a href="#"><span>Cardiologist</span></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-xl-3">
					<div class="team">
						<div class="team-image">
							<img src="{{ asset('contents/website') }}/demos/medical/images/doctors/7.jpg" alt="Dr. John Doe">
						</div>
						<div class="team-desc">
							<div class="team-title">
								<a href="#"><h4>Dr. Erika Todd</h4></a>
								<a href="#"><span>Neurologist</span></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-xl-3">
					<div class="team">
						<div class="team-image">
							<img src="{{ 'contents/website' }}/demos/medical/images/doctors/8.jpg" alt="Dr. John Doe">
						</div>
						<div class="team-desc">
							<div class="team-title">
								<a href="#"><h4>Dr. Randy Adams</h4></a>
								<a href="#"><span>Dentist</span></a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-xl-3">
					<div class="team">
						<div class="team-image">
							<img src="{{ 'contents/website' }}/demos/medical/images/doctors/9.jpg" alt="Dr. John Doe">
						</div>
						<div class="team-desc">
							<div class="team-title">
								<a href="#"><h4>Dr. Alan Freeman</h4></a>
								<a href="#"><span>Eye Specialist</span></a>
							</div>
						</div>
					</div>
				</div> --}}
			</div>

		</div>

		<div class="promo promo-dark promo-full promo-uppercase bg-color footer-stick p-5">
			<div class="container">
				<div class="row align-items-center">
					@include('website.include.contact_bar')
				</div>
			</div>
		</div>

	</div>
</section><!-- #content end -->
@endsection