@extends('website.layout.webstie')

@section('content')
{{-- @foreach ($appoint_page as $appoint_page) --}}
	<section id="page-title" class="page-title-parallax" style="background-image: url('{{"/uploads/appoint_pages/$appoint_page->title_image"}}'); background-position: bottom center; background-size: cover; padding: 80px 0;">

		<div class="container clearfix">
			<h1>Appointment</h1>
			<span>A Short Page Title Tagline</span>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Appointment</li>
			</ol>
		</div>

	</section>
	{{-- @break
@endforeach --}}
<!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		{{-- @foreach ($appoint_page as $appoint_page) --}}
			
			<div class="container clearfix">

				<div class="heading-block center border-bottom-0 mb-0">
					<h3>Book an Appointment.</h3>
					<span>{{ $appoint_page->title_message }}</span>
				</div>

			</div>

			<div class="section mb-0 parallax"style="background: url('{{ asset('contents/website') }}/contents/website/demos/medical/images/appointment/bg.jpg') top center no-repeat / cover;" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px 200px;">
				<div class="container">
					<div class="row">
						<div class="col-lg-5">
							<div class="d-none d-lg-block" style="position: relative;" data-height-xl="413" >
								<img src='{{ asset("/uploads/appoint_pages/$appoint_page->form_image") }}' alt="Image" style="position: absolute; bottom: -65px;">
							</div>
						</div>

						<div class="form-widget col-lg-7">
							<div class="form-result"></div>

							@include('website.include.appointment')

						</div>
					</div>
				</div>
			</div>

			<div class="section m-0">
				<div class="container clearfix">
					<div class="heading-block center border-bottom-0 bottommargin-lg">
						<h3>Questions Before Booking</h3>
						<span>{{ $appoint_page->question_message }}</span>
					</div>
					<div id="faqs" class="faqs row">
						@foreach ($appoint_que as $key=> $item)
							<div class="col-lg-6">
								<h4><strong class="color">Q.</strong> {{ $item->question }}</h4>
								<p>{{ $item->answer  }}</p>
								<div class="count" style="display: none">{{ $key +1 }}</div>
								<div class="line line-sm"></div>
							</div>
							@break($key==5)
						@endforeach

						{{-- <div class="col-lg-6">

							<h4><strong class="color">Q.</strong> What Images, Videos, Code or Music Can I Use in my Items?</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad odio ab quis architecto recusandae doloremque incidunt! Eius, quidem, pariatur necessitatibus commodi aliquid deleniti repudiandae accusantium nemo voluptate ullam natus illum magnam alias nobis doloremque delectus ipsa dicta repellat maxime dignissimos eveniet quae debitis ratione assumenda tempore officiis fugiat dolor. Saepe iusto praesentium ullam aliquam impedit.</p>

							<div class="line line-sm"></div>

							<h4><strong class="color">Q.</strong> Can I use trademarked names in my items?</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, nisi, laborum autem reprehenderit excepturi harum ipsum quod sit. Inventore et sunt nemo natus labore voluptate omnis reprehenderit culpa. Minus vitae molestiae totam ut a accusamus at fugiat nemo debitis delectus? Consectetur, deleniti, cupiditate ad doloribus numquam minus illum fugit laborum a voluptatum nulla at autem ab beatae odio dolorem assumenda magni laudantium saepe recusandae doloremque illo nesciunt aut quos debitis neque reiciendis veritatis iusto eos aliquid voluptatem pariatur eveniet velit?</p>

							<div class="line line-sm"></div>

							<h4><strong class="color">Q.</strong> How do I pay for items on the Marketplaces?</h4>
							<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo iusto aliquam voluptatem? Reiciendis, beatae, ipsam delectus voluptas ea error voluptates labore corporis ad tenetur sunt temporibus aperiam sit quis quasi tempora enim quo numquam provident ullam velit cumque similique veritatis quidem aliquam voluptatibus atque fugiat recusandae accusamus praesentium aut ipsa.</p>

						</div> --}}
					</div>
				</div>
			</div>

			<div class="promo promo-dark promo-full promo-uppercase bg-color footer-stick p-5">
				<div class="container">
					<div class="row align-items-center">
						@include('website.include.contact_bar')
					</div>
				</div>
			</div>
			{{-- @break
		@endforeach --}}
	</div>
</section><!-- #content end -->
@endsection