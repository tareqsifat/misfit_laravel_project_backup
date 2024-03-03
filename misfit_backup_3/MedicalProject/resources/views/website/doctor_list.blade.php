@extends('website.layout.webstie')

@section('content')
	<!-- Page Title
		============================================= -->
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
				<div class="container">
					<div class="row col-mb-50 mb-0">
						@foreach ($doctor as $item)
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="team team-list row align-items-center">
											<div class="team-image col-md-5 col-lg-3">
												<img src='{{ asset("/uploads/doctors/$item->photo") }}' alt="{{ $item->photo }}">
											</div>
											<div class="team-desc col-md" id="{{ $item->name }}">
												<div class="team-title">
													<a href="{{ route('website_single_doctor', $item->slug) }}"><h4>{{ $item->name }}</h4></a>
													<a href="#"><span>{{ $item->designation }}</span></a>
												</div>
												<div class="team-content">
													<p>{{ \Illuminate\Support\Str::limit($item->description, 170, $end='...') }}</p>
												</div>
												<a href="{{ $item->facebook_ac }}" class="social-icon si-rounded si-small si-facebook">
													<i class="icon-facebook"></i>
													<i class="icon-facebook"></i>
												</a>
												<a href="{{ $item->twitter_ac }}" class="social-icon si-rounded si-small si-twitter">
													<i class="icon-twitter"></i>
													<i class="icon-twitter"></i>
												</a>
												<a href="{{ $item->google_ac }}" class="social-icon si-rounded si-small si-gplus">
													<i class="icon-gplus"></i>
													<i class="icon-gplus"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
						

						{{-- <div class="col-12">
							<div class="team team-list row align-items-center">
								<div class="team-image col-md-5 col-lg-3">
									<img src="demos/medical/images/doctors/2.jpg" alt="Dr. John Doe">
								</div>
								<div class="team-desc col-md">
									<div class="team-title">
										<a href="#"><h4>Dr. Bryan Mcguire</h4></a>
										<a href="#"><span>Orthopedist</span></a>
									</div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech reductions cornerstone disruptor.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="w-100"></div>

						<div class="col-12">
							<div class="team team-list row align-items-center">
								<div class="team-image col-md-5 col-lg-3">
									<img src="demos/medical/images/doctors/3.jpg" alt="Dr. John Doe">
								</div>
								<div class="team-desc col-md">
									<div class="team-title">
										<a href="#"><h4>Dr. Mary Jane</h4></a>
										<a href="#"><span>Neurologist</span></a>
									</div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-gplus">
										<i class="icon-gplus"></i>
										<i class="icon-gplus"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="team team-list row align-items-center">
								<div class="team-image col-md-5 col-lg-3">
									<img src="demos/medical/images/doctors/4.jpg" alt="Dr. John Doe">
								</div>
								<div class="team-desc col-md">
									<div class="team-title">
										<a href="#"><h4>Dr. Silvia Bush</h4></a>
										<a href="#"><span>Dentist</span></a>
									</div>
									<div class="team-content">
										<p>Emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-linkedin">
										<i class="icon-linkedin"></i>
										<i class="icon-linkedin"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="w-100"></div>

						<div class="col-12">
							<div class="team team-list row align-items-center">
								<div class="team-image col-md-5 col-lg-3">
									<img src="demos/medical/images/doctors/6.jpg" alt="Dr. John Doe">
								</div>
								<div class="team-desc col-md">
									<div class="team-title">
										<a href="#"><h4>Dr. Hugh Baldwin</h4></a>
										<a href="#"><span>Cardiologist</span></a>
									</div>
									<div class="team-content">
										<p>Carbon emissions amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-instagram">
										<i class="icon-instagram"></i>
										<i class="icon-instagram"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="team team-list row align-items-center">
								<div class="team-image col-md-5 col-lg-3">
									<img src="demos/medical/images/doctors/7.jpg" alt="Dr. John Doe">
								</div>
								<div class="team-desc col-md">
									<div class="team-title">
										<a href="#"><h4>Dr. Erika Todd</h4></a>
										<a href="#"><span>Neurologist</span></a>
									</div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-instagram">
										<i class="icon-instagram"></i>
										<i class="icon-instagram"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="w-100"></div>

						<div class="col-12">
							<div class="team team-list row align-items-center">
								<div class="team-image col-md-5 col-lg-3">
									<img src="demos/medical/images/doctors/8.jpg" alt="Dr. John Doe">
								</div>
								<div class="team-desc col-md">
									<div class="team-title">
										<a href="#"><h4>Dr. Randy Adams</h4></a>
										<a href="#"><span>Dentist</span></a>
									</div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-twitter">
										<i class="icon-twitter"></i>
										<i class="icon-twitter"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-gplus">
										<i class="icon-gplus"></i>
										<i class="icon-gplus"></i>
									</a>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="team team-list row align-items-center">
								<div class="team-image col-md-5 col-lg-3">
									<img src="demos/medical/images/doctors/9.jpg" alt="Dr. John Doe">
								</div>
								<div class="team-desc col-md">
									<div class="team-title">
										<a href="#"><h4>Dr. Alan Freeman</h4></a>
										<a href="#"><span>Eye Specialist</span></a>
									</div>
									<div class="team-content">
										<p>Carbon emissions reductions giving, non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor empower.</p>
									</div>
									<a href="#" class="social-icon si-rounded si-small si-facebook">
										<i class="icon-facebook"></i>
										<i class="icon-facebook"></i>
									</a>
									<a href="#" class="social-icon si-rounded si-small si-gplus">
										<i class="icon-gplus"></i>
										<i class="icon-gplus"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div> --}}

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