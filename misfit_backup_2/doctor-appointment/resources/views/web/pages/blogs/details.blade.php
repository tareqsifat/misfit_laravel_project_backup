@extends('web.app.app')
@section('main-body')

<div class="main-body">


    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="{{asset('')}}uploads/blogs/{{$blog->image}}" class="img-fluid rounded shadow" alt="">

                    <!-- <ul class="list-unstyled mt-4">
                        <li class="list-inline-item user text-muted me-2"><i class="mdi mdi-account"></i> Calvin Carlo</li>
                        <li class="list-inline-item date text-muted"><i class="mdi mdi-calendar-check"></i> 1st January, 2021</li>
                    </ul> -->

                    {!! $blog->description !!}

                </div>
                <!--end col-->


            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <div class="container mt-100 mt-60">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h4 class="title mb-0">Related Post:</h4>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-lg-12 mt-4 pt-2">
                    <div class="slider-range-three">

                        @foreach($blogs as $key => $item)
                        <div class="tiny-slide">
                            <div class="card blog blog-primary border-0 shadow rounded overflow-hidden m-1">
                                <img src="{{ asset('/') }}uploads/blogs/{{ $item->image }}" class="img-fluid" alt="">
                                <div class="card-body p-4">
                                    <ul class="list-unstyled mb-2">
                                        <li class="list-inline-item text-muted small me-3"><i
                                              class="uil uil-calendar-alt text-dark h6 me-1"></i>{{$item->created_at->format('d M Y')}}
                                        </li>

                                    </ul>
                                    <a href="{{ route('blog.details',$item->title) }}"
                                      class="text-dark title h5">{{$item->title }}</a>
                                    <div class="post-meta d-flex justify-content-between mt-3">

                                        <a href="{{ route('blog.details',$item->title) }}" class="link">Read More <i
                                              class="mdi mdi-chevron-right align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!--end container-->
    </section>

</div>
@endsection