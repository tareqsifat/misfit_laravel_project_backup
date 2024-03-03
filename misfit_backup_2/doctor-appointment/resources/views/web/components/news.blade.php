<div class="section" id="news">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <span class="badge rounded-pill bg-soft-primary mb-3">Read News</span>
                    <h4 class="title mb-4">Latest News & Blogs</h4>

                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                <div class="card blog blog-primary border-0 shadow rounded overflow-hidden">
                    <a href="{{ route('blog.details',$blog->title) }}"><img
                          src="{{ asset('/') }}uploads/blogs/{{ $blog->image }}" class="img-fluid" alt=""></a>

                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-2">
                            @if($blog->created_at)
                            <li class="list-inline-item text-muted small me-3"><i
                                  class="uil uil-calendar-alt text-dark h6 me-1"></i>{{ $blog->created_at->format('jS F Y')}}
                            </li>
                            @endif


                        </ul>
                        <a href="{{ route('blog.details',$blog->title) }}"
                          class="text-dark title h5">{{ $blog->title }}</a>
                        <div class="post-meta d-flex justify-content-between mt-3">

                            <a href="{{ route('blog.details',$blog->title) }}" class="link">Read More <i
                                  class="mdi mdi-chevron-right align-middle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if(Route::is('index'))
            <!--end col-->
            <div class="col-12 text-center">
                <a href="{{ route('blogs.all') }}" class="btn btn-primary btn-sm mt-3">view all</a>
            </div>
            @endif
        </div>
        <!--end row-->
    </div>
</div>