@extends('website.layout.webstie')

@section('content')
		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-dark page-title-center p-0">

			@include('website.include.about_slider')

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				
				@include('website.include.service')

				<div class="section mt-0" style="background: #FFF url('{{asset('contents/website')}} demos/medical/images/about-us/1.jpg') right center no-repeat / cover;">

					<div class="d-block d-md-block d-lg-none" style="background-color: rgba(238,238,238,0.9); position: absolute; top: 0;left: 0; z-index: 1;width: 100%; height: 100%;"></div>

					<div class="container clearfix">

						<div class="row justify-content-between">
							<div class="col-lg-6" data-lightbox="gallery">
								@include('website.include.activity')
							</div>
							<div class="col-lg-5">
								<div class="opening-table">
									<div class="heading-block bottommargin-sm border-bottom-0">
										<h4>Opening Hours</h4>
										<span>Emergency section will remain open 24/7 even on holydays</span>
									</div>
									@include('website.include.opening_hour')
								</div>
							</div>
						</div>

					</div>

				</div>

				@include('website.include.meet_specialists')
			</div>
		</section><!-- #content end -->

@endsection