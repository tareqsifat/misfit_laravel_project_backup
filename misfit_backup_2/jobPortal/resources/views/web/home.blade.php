
@extends('web.layout.index')

@section('content')
    <!-- Slider Section Start -->
    <div class="slider-section section">
        <div class="slide-item bg-parallax" data-bg-image="{{asset('assets/web')}}/images/slider/slider-1.webp" data-overlay="50">
            <div class="container">
                <div class="slider-content text-center">
                    <h2 class="title">Find Your Next Job</h2>
                    <p>More then <span>1,524</span> job listed here.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Section End -->

    <!-- Job Search Section Start -->
    <div class="job-search-section section">
        <div class="container">
            <div class="job-search-wrap">

                <!-- Job Search Form Start -->
                <div class="job-search-form">
                    <form action="#">
                        <div class="row mb-n4">

                            <div class="col-lg-auto col-sm-6 col-12 flex-grow-1 mb-4">
                                <input type="text" placeholder="e.g. web design">
                            </div>

                            <div class="col-lg-auto col-sm-6 col-12 flex-grow-1 mb-4">
                                <input type="text" placeholder="Location">
                            </div>

                            <div class="col-lg-auto col-sm-6 col-12 flex-grow-1 mb-4">
                                <select>
                                    <option value="1">Any category</option>
                                    <option value="2">Web Designer</option>
                                    <option value="3">Web Developer</option>
                                    <option value="4">Graphic Designer</option>
                                    <option value="5">App Developer</option>
                                    <option value="6">UI &amp; UX Expert</option>
                                </select>
                            </div>

                            <div class="col-lg-auto col-sm-6 col-12 flex-grow-1 mb-4">
                                <button class="btn btn-primary">Search</button>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- Job Search Form End -->

            </div>
        </div>
    </div>
    <!-- Job Search Section End -->

    <!-- Recent Jobs Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="section-title">
                <h2 class="title">Latest Jobs</h2>
                <p>Here's the most recent job listed on the website.</p>
            </div>

            <!-- Job List Wrap Start -->
            <div class="job-list-wrap">

                <!-- Job List Start -->
                @foreach ($job_posts as $job_post)
                    <a href="{{ route('web.job_details',$job_post->id)}}" class="job-list row">
                        <div class="company-logo col-auto">
                            <img src="/{{ $job_post->company->image }}" height="70" width="70" alt="{{ $job_post->company->name }}">
                        </div>
                        <div class="salary-type col-auto order-sm-3">
                            <span class="salary-range">{{ $job_post->job_salary}}</span>
                            <span class="badge bg-success">{{ $job_post->job_type->type_name }}</span>
                        </div>
                        <div class="content col">
                            <h6 class="title">{{ $job_post->job_title}}</h6>
                            <ul class="meta">
                                <li><strong class="text-primary">{{ $job_post->company->name }}</strong></li>
                                <li><i class="fa fa-map-marker"></i>{{ $job_post->job_location }}</li>
                            </ul>
                        </div>
                    </a>
                @endforeach


            </div>
            <!-- Job List Wrap Start -->

            <div class="text-center mt-4 mt-lg-5">
                <a href="{{ route('web.job_post_list') }}" class="btn btn-primary">View All Jobs</a>
            </div>

        </div>
    </div>
    <!-- Recent Jobs End -->

    <!-- Funfact Section Start -->
    <div class="section section-padding bg-parallax" data-bg-image="{{asset('assets/web')}}/images/bg/bg-1.webp" data-overlay="50">
        <div class="container">
            <div class="funfact-wrap row">

                <!-- Funfact Start -->
                <div class="funfact col-md-3 col-sm-6 col-12">
                    <span class="counter">1354</span>
                    <span class="title">Job Post</span>
                </div>
                <!-- Funfact Start -->

                <!-- Funfact Start -->
                <div class="funfact col-md-3 col-sm-6 col-12">
                    <span class="counter">1741</span>
                    <span class="title">Members</span>
                </div>
                <!-- Funfact Start -->

                <!-- Funfact Start -->
                <div class="funfact col-md-3 col-sm-6 col-12">
                    <span class="counter">1204</span>
                    <span class="title">Resume</span>
                </div>
                <!-- Funfact Start -->

                <!-- Funfact Start -->
                <div class="funfact col-md-3 col-sm-6 col-12">
                    <span class="counter">142</span>
                    <span class="title">Company</span>
                </div>
                <!-- Funfact Start -->

            </div>
        </div>
    </div>
    <!-- Funfact Section End -->

    <!-- Featured Conpanies Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="section-title">
                <h2 class="title">Featured Companies</h2>
                <p>Here's the most job listed by those companies.</p>
            </div>

            <!-- Company List Wrap Start -->
            <div class="company-slider row">

                @foreach ($companies as $company)
                    <div class="col">
                        <a href="#" class="feature-company">
                            <span class="company-logo"><img src="/{{ $company->image }}" width="62" alt="company-1"></span>
                            <h6 class="title">{{ $company->name }}</h6>
                            <span class="open-job">2 open positions</span>
                        </a>
                    </div>
                @endforeach
                <!-- Company List Start -->

            </div>
            <!-- Company List Wrap Start -->

        </div>
    </div>
    <!-- Featured Conpanies End -->

    <!-- Testimonial Section Start -->
    <div class="section section-padding bg-parallax" data-bg-image="{{asset('assets/web')}}/images/bg/bg-2.webp" data-overlay="65">
        <div class="container">

            <!-- Testimonial Slider Start -->
            <div class="testimonial-slider row">

                <!-- Testimonial Start -->
                <div class="col">
                    <div class="testimonial text-center text-white">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, modi sed praesentium necessitatibus tenetur neque, veritatis esse voluptatem</p>
                        <img src="{{asset('assets/web')}}/images/authors/author-1.jpg" alt="">
                        <h6 class="name">Sharon Harper</h6>
                        <span class="title">Marketer of Hastech</span>
                    </div>
                </div>
                <!-- Testimonial End -->

                <!-- Testimonial Start -->
                <div class="col">
                    <div class="testimonial text-center text-white">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, modi sed praesentium necessitatibus tenetur neque, veritatis esse voluptatem</p>
                        <img src="{{asset('assets/web')}}/images/authors/author-2.jpg" alt="">
                        <h6 class="name">Harold McCoy</h6>
                        <span class="title">CEO of Hastech</span>
                    </div>
                </div>
                <!-- Testimonial End -->

                <!-- Testimonial Start -->
                <div class="col">
                    <div class="testimonial text-center text-white">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, modi sed praesentium necessitatibus tenetur neque, veritatis esse voluptatem</p>
                        <img src="{{asset('assets/web')}}/images/authors/author-3.jpg" alt="">
                        <h6 class="name">Ronald Wright</h6>
                        <span class="title">Admin of Hastech</span>
                    </div>
                </div>
                <!-- Testimonial End -->

            </div>
            <!-- Testimonial Slider End -->

        </div>
    </div>
    <!-- Testimonial Section End -->

    <!-- blog Section Start -->
    <div class="section section-padding">
        <div class="container">

            <div class="section-title">
                <h3 class="title">Our Blog</h3>
                <p>Get more tips & tricks from out blog post.</p>
            </div>

            <!-- blog Slider Start -->
            <div class="blog-slider slick-space">

                @foreach ($blogs as $blog)
                    <div class="blog">
                        <div class="media">
                            <a href="{{ route('web.blog_details', $blog->id)}}">
                                <img src="/{{ $blog->image }}" width="370px" height="144px" alt="{{ $blog->title }}">
                            </a>
                        </div>
                        <div class="content">
                            <h6 class="title">
                                <a href="{{ route('web.blog_details', $blog->id) }}">{{ $blog->title }}</a>
                            </h6>
                            <ul class="meta">
                                <li> Posted On {{ $blog->created_at->format('M d, Y') }}</li>
                            </ul>
                            <div class="desc">
                                <p>{{ Illuminate\Support\Str::limit($blog->sub_title, 40) }}</p>
                            </div>
                            <a href="{{ route('web.blog_details', $blog->id) }}" class="read-more">Read More <i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- blog Slider End -->

        </div>
    </div>
    <!-- blog Section End -->
    <input type="hidden" class="root_url" name="root_url" value="{{ route('web.home') }}">
    @if(\Illuminate\Support\Facades\Session::has('guard') && \Illuminate\Support\Facades\Session::get('guard') == 'employer' && \Illuminate\Support\Facades\Auth::guard('employer')->check())
        @php
            \Illuminate\Support\Facades\Session::forget('guard');
        @endphp

        @push('js')
            <script>
                let url = $('.root_url').val();
                $(document).on('ready', function (){
                    window.location.href =  url + '/' + 'company/company-dashboard';
                });
            </script>
        @endpush
    @endif
@endsection
