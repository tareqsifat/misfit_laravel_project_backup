@extends('website.layout.webstie')

@section('content')
<section id="page-title" class="bg-color page-title-dark">

	<div class="container clearfix">
		<h1>Departments</h1>
		<span>A Short Page Title Tagline</span>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Departments</li>
		</ol>
	</div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container">

			<div class="tabs tabs-tb tabs-responsive" id="tab" data-accordion-style="accordion-bg">
				<ul class="tab-nav">
					@foreach ($department as $key=> $item)
						<li><a href="#tabs-{{ $key+1}}"><i class="{{ $item->icon }}"></i> {{ $item->title }}</a></li>
						{{-- <li><a href="#tabs-2"><i class="icon-medical-i-surgery"></i> Outpatient Surgery</a></li>
						<li><a href="#tabs-3"><i class="icon-medical-i-dental"></i> Dentist</a></li>
						<li><a href="#tabs-4"><i class="icon-medical-ophthalmology"></i> Ophthalmology Clinic</a></li> --}}
					@endforeach
				</ul>

				<div class="tab-container">
					@foreach ($department as $key=> $item)
						<div class="tab-content" id="tabs-{{$key + 1}}">
						<blockquote class="quote"><p>{{ $item->description }}</p></blockquote>
						<div class="row">
							@if ($item->service)
								<div class="col-lg-4">
									<h4 class="leftmargin-sm"><p>Treatments</p></h4>
									<ul class="price-table leftmargin-sm mb-0">
										{{-- <li>
											<span>Tummy Tuck</span>
											<div class="value">$120</div>
										</li> --}}
										<li>
											<span>{{ $item->treatment_info->name }}</span>
											<div class="value">${{ $item->treatment_info->cost }}</div>
										</li>
										<li>
											<span>Liposuction</span>
											<div class="value">$110</div>
										</li>
										<li>
											<span>Colonoscopy</span>
											<div class="value">$90</div>
										</li>
										<li>
											<span>Cardiac ablation</span>
											<div class="value">$173</div>
										</li>
										<li>
											<span>Dermatology</span>
											<div class="value">$124</div>
										</li>
									</ul>									
									<a href="#" class="more-link leftmargin-sm bottommargin-sm">View Full Services→</a>
								</div>
							@else
								<div class="col-lg-4">
									<h4 class="leftmargin-sm">Therapists</h4>
									<ul class="price-table leftmargin-sm mb-0">
										{{-- <li>
											<span>Tummy Tuck</span>
											<div class="value">$120</div>
										</li> --}}
										<li>
											<span>{{ $item->treatment_info->name }}</span>
											<div class="value">${{ $item->treatment_info->cost }}</div>
										</li>
										<li>
											<span>Liposuction</span>
											<div class="value">$210</div>
										</li>
										<li>
											<span>Heart Patient</span>
											<div class="value">$320</div>
										</li>
										<li>
											<span>Colonoscopy</span>
											<div class="value">$80</div>
										</li>
										<li>
											<span>Cardio</span>
											<div class="value">$42</div>
										</li>
									</ul>
									<a href="#" class="more-link leftmargin-sm bottommargin-sm">View Full Services→</a>
								</div>
							@endif
							<div class="col-lg-4">
								<img src="{{ 'contents/website' }}/demos/medical/images/section-bg.jpg" alt="Image">
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-lg-6">
								<div class="team team-list row align-items-center">
									<div class="team-image col-sm-6">
										<img src="{{ asset('/uploads/doctors') }}/{{ $item->doctor_info->photo }}" alt="{{ $item->doctor_info->photo }}">
									</div>
									<div class="team-desc col-sm-6">
										<div class="team-title"><h4>{{ $item->doctor_info->name }}</h4><span>CEO</span></div>
										<div class="team-content">
											<p>{{ $item->doctor_info->description }}</p>
										</div>
										<a href="{{ $item->doctor_info->facebook_ac }}" class="social-icon si-rounded si-small si-facebook">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>
										<a href="{{ $item->doctor_info->twitter_ac }}" class="social-icon si-rounded si-small si-twitter">
											<i class="icon-twitter"></i>
											<i class="icon-twitter"></i>
										</a>
										<a href="{{ $item->doctor_info->google_ac }}" class="social-icon si-rounded si-small si-gplus">
											<i class="icon-gplus"></i>
											<i class="icon-gplus"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					

					{{-- <div class="tab-content" id="tabs-2">
						<blockquote class="quote"><p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing</p></blockquote>
						<div class="row col-mb-50 mb-0">
							<div class="col-lg-6">

								<div class="team team-list row align-items-center">
									<div class="team-image col-sm-6">
										<img src="{{ 'contents/website' }}/demos/medical/images/doctors/1.jpg" alt="John Doe">
									</div>
									<div class="team-desc col-sm-6">
										<div class="team-title"><h4>John Doe</h4><span>CEO</span></div>
										<div class="team-content">
											<p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan.</p>
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

							<div class="col-lg-6">
								<div class="team team-list row align-items-center">
									<div class="team-image col-sm-6">
										<img src="{{ 'contents/website' }}/demos/medical/images/doctors/4.jpg" alt="Nix Maxwell">
									</div>
									<div class="team-desc col-sm-6">
										<div class="team-title"><h4>Nix Maxwell</h4><span>Support</span></div>
										<div class="team-content">
											<p>Eradicate invest honesty human rights accessibility theory of social change.</p>
										</div>
										<a href="#" class="social-icon si-rounded si-small si-forrst">
											<i class="icon-forrst"></i>
											<i class="icon-forrst"></i>
										</a>
										<a href="#" class="social-icon si-rounded si-small si-skype">
											<i class="icon-skype"></i>
											<i class="icon-skype"></i>
										</a>
										<a href="#" class="social-icon si-rounded si-small si-flickr">
											<i class="icon-flickr"></i>
											<i class="icon-flickr"></i>
										</a>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="tab-content" id="tabs-3">
						<div class="row col-mb-50">
							<div class="col-lg-7">
								<div class="masonry-thumbs grid-container grid-4" data-big="4" data-lightbox="gallery">
									<a class="grid-item" href="demos/medical/images/gallery/1.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/1.jpg" alt="Gallery Thumb 1"></a>
									<a class="grid-item" href="demos/medical/images/gallery/2.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/2.jpg" alt="Gallery Thumb 2"></a>
									<a class="grid-item" href="demos/medical/images/gallery/3.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/3.jpg" alt="Gallery Thumb 3"></a>
									<a class="grid-item" href="demos/medical/images/gallery/4.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/4.jpg" alt="Gallery Thumb 4"></a>
									<a class="grid-item" href="demos/medical/images/gallery/5.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/5.jpg" alt="Gallery Thumb 5"></a>
									<a class="grid-item" href="demos/medical/images/gallery/6.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/6.jpg" alt="Gallery Thumb 6"></a>
									<a class="grid-item" href="demos/medical/images/gallery/7.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/7.jpg" alt="Gallery Thumb 7"></a>
									<a class="grid-item" href="demos/medical/images/gallery/9.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/9.jpg" alt="Gallery Thumb 9"></a>
									<a class="grid-item" href="demos/medical/images/gallery/10.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/10.jpg" alt="Gallery Thumb 10"></a>
									<a class="grid-item" href="demos/medical/images/gallery/11.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/11.jpg" alt="Gallery Thumb 11"></a>
									<a class="grid-item" href="demos/medical/images/gallery/12.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/12.jpg" alt="Gallery Thumb 12"></a>
									<a class="grid-item" href="demos/medical/images/gallery/13.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/13.jpg" alt="Gallery Thumb 13"></a>
									<a class="grid-item" href="demos/medical/images/gallery/14.jpg" data-lightbox="gallery-item"><img src="{{ 'contents/website' }}/demos/medical/images/gallery/thumbs/14.jpg" alt="Gallery Thumb 14"></a>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="feature-box fbox-plain mb-4">
									<div class="fbox-icon">
										<a href="#"><i class="icon-medical-i-cardiology"></i></a>
									</div>
									<div class="fbox-content">
										<h3>Intensive Care</h3>
										<p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>
									</div>
								</div>
								<div class="feature-box fbox-plain mb-4">
									<div class="fbox-icon">
										<a href="#"><i class="icon-medical-i-social-services"></i></a>
									</div>
									<div class="fbox-content">
										<h3>Family Planning</h3>
										<p>Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Retina Icons, Fonts &amp; all others graphics are optimized.</p>
									</div>
								</div>
								<div class="feature-box fbox-plain mb-4">
									<div class="fbox-icon">
										<a href="#"><i class="icon-medical-i-neurology"></i></a>
									</div>
									<div class="fbox-content">
										<h3>Expert Consultation</h3>
										<p>Canvas includes tons of optimized code that are completely customizable and deliver unmatched fast performance.</p>
									</div>
								</div>
								<div class="feature-box fbox-plain mb-4">
									<div class="fbox-icon">
										<a href="#"><i class="icon-medical-i-dental"></i></a>
									</div>
									<div class="fbox-content">
										<h3>Dental Sciences</h3>
										<p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content" id="tabs-4">
						<div class="row">
							<div class="col-md-4">
								<div class="accordion">

									<div class="accordion-header">
										<div class="accordion-icon">
											<i class="accordion-closed icon-ok-circle"></i>
											<i class="accordion-open icon-remove-circle"></i>
										</div>
										<div class="accordion-title">
											Kidney Transplant
										</div>
									</div>
									<div class="accordion-content">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>

									<div class="accordion-header">
										<div class="accordion-icon">
											<i class="accordion-closed icon-ok-circle"></i>
											<i class="accordion-open icon-remove-circle"></i>
										</div>
										<div class="accordion-title">
											Pulmonary Treament
										</div>
									</div>
									<div class="accordion-content">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

									<div class="accordion-header">
										<div class="accordion-icon">
											<i class="accordion-closed icon-ok-circle"></i>
											<i class="accordion-open icon-remove-circle"></i>
										</div>
										<div class="accordion-title">
											Ear, Nose &amp; Throat
										</div>
									</div>
									<div class="accordion-content">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

									<div class="accordion-header">
										<div class="accordion-icon">
											<i class="accordion-closed icon-ok-circle"></i>
											<i class="accordion-open icon-remove-circle"></i>
										</div>
										<div class="accordion-title">
											Cardiology Department
										</div>
									</div>
									<div class="accordion-content">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

								</div>
							</div>
							<div class="col-md-4">
								<h4 class="leftmargin-sm">Treatements</h4>
								<ul class="price-table leftmargin-sm mb-0">
									<li>
										<span>Tummy Tuck</span>
										<div class="value">$130</div>
									</li>
									<li>
										<span>Liposuction</span>
										<div class="value">$110</div>
									</li>
									<li>
										<span>Colonoscopy</span>
										<div class="value">$90</div>
									</li>
									<li>
										<span>Cardiac ablation</span>
										<div class="value">$173</div>
									</li>
									<li>
										<span>Dermatology</span>
										<div class="value">$124</div>
									</li>
								</ul>
								<a href="#" class="more-link leftmargin-sm bottommargin-sm">View Full Services→</a>
							</div>
							<div class="col-md-4">
								<h4 class="leftmargin-sm">Therapists</h4>
								<ul class="price-table leftmargin-sm mb-0">
									<li>
										<span>Tummy Tuck</span>
										<div class="value">$120</div>
									</li>
									<li>
										<span>Liposuction</span>
										<div class="value">$210</div>
									</li>
									<li>
										<span>Heart Patient</span>
										<div class="value">$320</div>
									</li>
									<li>
										<span>Colonoscopy</span>
										<div class="value">$80</div>
									</li>
									<li>
										<span>Cardio</span>
										<div class="value">$42</div>
									</li>
								</ul>
								<a href="#" class="more-link leftmargin-sm">View Full Services→</a>
							</div>
						</div>
					</div> --}}

				</div>

			</div>

		</div>
	</div>
</section><!-- #content end -->
@endsection