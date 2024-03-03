@extends('website.layout.webstie')

@section('content')
<section id="page-title" class="bg-transparent">

	<div class="container clearfix">
		<h1>Health News</h1>
		<span>A Short Page Title Tagline</span>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Blog</li>
		</ol>
	</div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<!-- Posts
			============================================= -->
			<div id="posts" class="post-grid row grid-container mb-0 gutter-40">
				@foreach ($blog as $item)
					<div class="entry col-12 col-sm-6 col-md-4 col-xl-3">
						<div class="grid-inner">
							<div class="entry-image">
								<a href='{{ asset("/uploads/blogs/$item->image") }}' data-lightbox="image"><img src='{{ asset("/uploads/blogs/$item->image") }}' alt="{{ $item->image }}"></a>
							</div>
							<div class="entry-title">
								<h2><a href="{{ route('website_blog_show', $item->slug) }}">{{ $item->title }}</a></h2>
							</div>
							<div class="entry-meta">
								<ul>
									<li><i class="icon-calendar3"></i>{{ $item->created_at->format('d M Y h:i:s a') }}</li>
									<li><a href="blog-single.html#comments"><i class="icon-comments"></i>{{ $item->comments->count()+$item->reply->count() }}</a></li>
									<li><a href="#"><i class="icon-camera-retro"></i></a></li>
								</ul>
							</div>
							<div class="entry-content">
								<p>{{ \Illuminate\Support\Str::limit($item->body, 70, $end='...') }}</p>
								{{-- <p>{{ $item->body }}</p> --}}
								<a href="{{ route('website_blog_show', $item->slug) }}" class="button button-rounded button-small m-0">Read More</a>
							</div>
						</div>
					</div>
				@endforeach

				

			</div><!-- #posts end -->

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