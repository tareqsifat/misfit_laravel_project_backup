@extends('website.layout.webstie')

@section('content')
		<!-- Slider
		============================================= -->
		@include('website.include.slider')
		{{-- =============================================
		slider end --}}

		<!-- Content
		============================================= -->
	<section id="content">
		<div class="content-wrap">
			@include('website.include.service')
			<div class="section row p-0 align-items-stretch dark topmargin-sm">
				<div class="col-lg-5" style="background: url('{{ asset('contents/website') }}/demos/medical/images/section-bg.jpg') center center no-repeat; background-size: cover; min-height: 250px;">
					<div>&nbsp;</div>
				</div>
				<div  class="col-lg-7 p-0">
					{{-- Appointment --}}
					<div class="bg-color form-widget col-padding" data-loader="button">
						<h2>Book an Appointment.</h2>
						<div class="form-result"></div>
						@include('website.include.appointment')
					</div>
					<div class="flash-message"></div>
				</div>
			</div>

			<div class="container clearfix" id="faq">

				<div class="row col-mb-50 mb-0">
					<div class="col-md-7">
						{{-- FAQ --}}
						@include('website.include.faq')
					</div>

					<div class="col-md-5">
						{{-- Patient Testimonials --}}
						<h4>Patient Testimonials<span>.</span></h4>
						@include('website.include.testimonial')
					</div>
				</div>

			</div>

			<div class="section mt-0">
				<div class="container clearfix">

					<div class="row">
						{{-- Overview --}}
						@include('website.include.overview')
					</div>

				</div>
			</div>
		</div>
		{{-- Meet Specilists Team --}}
		@include('website.include.meet_specialists')
	</section>
	<script>
		$('#submit_button').click( function(e) {
			e.preventDefault(); // prevent actual form submit
			var form = $('#template-medical-form').serialize();
			//var url = form.attr('action'); //get submit url [replace url here if desired]
			$.ajax({
				type: "POST",
				url: "{{ url("appointments") }}",
				data: form, // serializes form input
				success: function(data){
					// console.log(data);
					$('div.flash-message').html(data);
				}
			});
		});
	</script>
@endsection