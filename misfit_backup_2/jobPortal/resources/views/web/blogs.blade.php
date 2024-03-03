@extends('web.layout.index')

@section('content')
    <!-- Page Heading Section Start -->
    <div class="page-heading-section section bg-parallax" data-bg-image="{{asset('assets/web')}}/images/bg/bg-2.webp" data-overlay="50">
        <div class="container">
            <div class="page-heading-content text-center">
                <h3 class="title">Blog</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- Page Heading Section End -->

    <!-- blog Section Start -->
    <div class="section section-padding">
        <div class="container">

            <!-- blog Wrapper Start -->
            <div class="blog-wrap row">

                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="blog">
                            <div class="media">
                                <a href=""><img src="/{{ $blog->image }}" alt=""></a>
                            </div>
                            <div class="content">
                                <h6 class="title"><a href="{{ route('web.blog_details', $blog->id) }}">{{ $blog->title }}</a></h6>
                                <ul class="meta">
                                    <li> Posted On {{ $blog->created_at->format('M d, Y') }}</li>
                                    {{-- <li><a href="#">3 Comments</a></li> --}}
                                </ul>
                                <div class="desc">
                                    <p>{{ Illuminate\Support\Str::limit($blog->sub_title, 40) }}</p>
                                </div>
                                <a href="{{ route('web.blog_details', $blog->id) }}" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            <!-- Pagination Start -->
            <ul class="pagination pagination-center mt-5">
                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul>
            <!-- Pagination End -->

        </div>
    </div>
    <!-- blog Section End -->
@endsection
