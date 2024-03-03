@extends('website.layout.webstie')

@section('content')
<section id="page-title" class="page-title-parallax page-title-dark page-title-center" style="background: url('{{ asset('contents/website') }}/demos/medical/images/contact/page-title.jpg') center 90% / cover; padding: 140px 0;" data-bottom-top="background-position:0px -200px;" data-top-bottom="background-position:0px 0px;">

	<div class="container clearfix" style="z-index: 2">
		<div class="emphasis-title dark mb-0">
			<span class="before-heading" style="color: #FFF;">{{ $footer->email }}</span>
			<h2 class="fw-bold ls0" style="color: #FFF;">{{ $footer->phone }}</h2>
		</div>
		<a href=https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" data-lightbox="iframe"><i class="icon-line-map i-large i-plain dark mx-auto"></i></a>
		<span class="fw-semibold ls1 text-uppercase" style="color: rgb(22, 13, 13);">795 Folsom Ave, Suite 600<br>San Francisco, CA 94107</span>
	</div>

	<div class="video-overlay" style="background: rgba(222,98,98,0.85); z-index: 1"></div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container">

			<div class="row">
				<div class="col-lg-8">

					<h3>Send us an Email</h3>

					<div class="form-widget">

						<div class="form-result"></div>

						<form class="row mb-0" id="template-contactform" name="template-contactform" method="post">
							@csrf
							<div class="form-process">
								<!--<div class="css3-spinner">
									<div class="css3-spinner-scaler"></div>
								</div>-->
							</div>

							<div class="col-md-4 form-group">
								<label for="template-contactform-name">Name <small>*</small></label>
								<input type="text" id="template-contactform-name" name="name" value="" class="required sm-form-control required" />
							</div>

							<div class="col-md-4 form-group">
								<label for="template-contactform-email">Email <small>*</small></label>
								<input type="email" id="template-contactform-email" name="email" value="" class="email sm-form-control" />
							</div>

							<div class="col-md-4 form-group">
								<label for="template-contactform-phone">Phone</label>
								<input type="number" id="template-contactform-phone" name="phone" value="" class="required sm-form-control" />
							</div>

							<div class="w-100"></div>

							<div class="col-md-8 form-group">
								<label for="template-contactform-subject">Subject <small>*</small></label>
								<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
							</div>

							<div class="col-md-4 form-group">
								<label for="template-contactform-service">Services</label>
								<select id="template-contactform-service" name="template-contactform-service" class="sm-form-control">
									<option value="">-- Select One --</option>
									<option value="Wordpress">1</option>
									<option value="PHP / MySQL">2</option>
									<option value="HTML5 / CSS3">3</option>
									<option value="Graphic Design">4</option>
								</select>
							</div>

							<div class="w-100"></div>

							<div class="col-12 form-group">
								<label for="template-contactform-message">Message <small>*</small></label>
								<textarea class="required sm-form-control" id="template-contactform-message" name="message" rows="6" cols="30"></textarea>
							</div>

							<div class="col-12 form-group">
								<button class="button button-3d m-0" type="button" id="abc" >Send Message</button>
							</div>
						</form>
					</div>
					<div class="flash-message"></div>
				</div>

				<div class="col-lg-4">
					<div class="opening-table" style="background-color: #f5f5f5">
						<div class="heading-block bottommargin-sm border-bottom-0">
							<h4>Opening Hours</h4>
							<span>Lorem ipsum dolor sit amet, consecte adipisicing elit molestiae non.</span>
						</div>
						@include('website.include.opening_hour')
					</div>
				</div>
			</div>

		</div>

		<div class="clear"></div>

		<div class="row topmargin-lg footer-stick align-items-stretch">

			<div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #1abc9c;">
				<div data-animate="fadeInLeft">
					<a href="#"><h3 class="text-uppercase" style="font-weight: 600;">Health Insurance</h3></a>
					<p style="line-height: 1.8;">Transform, agency working families thinkers who make change happen communities.&rarr;</p>
				</div>
				<i class="icon-medical-i-cardiology bgicon"></i>
			</div>

			<div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #34495e;">
				<div data-animate="fadeInLeft" data-delay="200">
					<a href="#"><h3 class="text-uppercase" style="font-weight: 600;">Medical Records</h3></a>
					<p style="line-height: 1.8;">Frontline respond, visionary collaborative cities advancement overcome injustice.&rarr;</p>
				</div>
				<i class="icon-medical-i-administration bgicon"></i>
			</div>

			<div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #DE6262;">
				<div data-animate="fadeInLeft" data-delay="400">
					<a href="#"><h3 class="text-uppercase" style="font-weight: 600;">Online Bill Pay</h3></a>
					<p style="line-height: 1.8;">Sustainability involvement fundraising campaign connect carbon rights, collaborative cities.&rarr;</p>
				</div>
				<i class="icon-medical-i-billing bgicon"></i>
			</div>

			<div class="clear"></div>

		</div>
	</div>

	<script>
		$('#abc').click( function(e) {
			e.preventDefault(); // prevent actual form submit
			var form = $('#template-contactform').serialize();
			//var url = form.attr('action'); //get submit url [replace url here if desired]
			$.ajax({
				type: "POST",
				url: "{{ url("send_email") }}",
				data: form, // serializes form input
				success: function(data){
					// console.log(data);
					$('div.flash-message').html(data);
				}
			});
		});
	</script>
</section><!-- #content end -->
@endsection