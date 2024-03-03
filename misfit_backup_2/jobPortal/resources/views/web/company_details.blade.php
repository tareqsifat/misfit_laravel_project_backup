@extends('web.layout.index')

@section('content')
        <!-- Page Heading Section Start -->
        <div class="page-heading-section section bg-parallax" data-bg-image="{{asset('assets/web')}}/images/bg/bg-2.webp" data-overlay="50">
            <div class="container">
                <div class="page-heading-content text-center">
                    <h3 class="title">{{ $company->name }}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="company-list.html">Companies</a></li>
                        <li class="breadcrumb-item active">{{ $company->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- Page Heading Section End -->

            <!-- Company List Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row mb-n5">

                <div class="col-lg-8 col-12 mb-5 pe-lg-5">

                    <!-- Company Details Start -->
                    <div class="company-details">
                        <h5 class="mb-3">About {{$company->name}}</h5>

                        {!! $company->description !!}
                    </div>
                    <!-- Company Details Start -->

                    <!-- Job List Wrap Start -->
                    <div class="job-list-wrap mt-5">
                        @foreach ($company->job_post as $job_post)
                            <a href="job-single.html" class="job-list row">
                                <div class="company-logo col-auto">
                                    <img src="/{{$company->image}}" alt="Company Logo" height="65px">
                                </div>
                                <div class="salary-type col-auto order-sm-3">
                                    <span class="salary-range">{{$job_post->job_salary}}</span>
                                    <span class="badge bg-success">Full Time</span>
                                </div>
                                <div class="content col">
                                    <h6 class="title">{{$job_post->job_title}}</h6>
                                    <ul class="meta">
                                        <li><strong class="text-primary">{{$company->name}}</strong></li>
                                        <li><i class="fa fa-map-marker"></i>{{$job_post->job_location}}</li>
                                    </ul>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <!-- Job List Wrap Start -->

                </div>

                <!-- Company Sidebar Wrap Start -->
                <div class="col-lg-4 col-12 mb-5">
                    <div class="sidebar-wrap">
                        <!-- Sidebar (Company) Start -->
                        <div class="sidebar-widget">
                            <div class="inner">
                                <div class="sidebar-company">
                                    <span class="company-logo"><img src="/{{ $company->image }}" alt="{{ $company->name }}" width="70px"></span>
                                    <h6 class="title">{{ $company->name }}</h6>
                                    <ul>
                                        <li><strong>Categories:</strong> <a href="#">Website</a>, <a href="#">Software</a></li>
                                        <li><strong>Founded:</strong>{{ $company->establishment_date }}</li>
                                        <li><strong>Team Size:</strong> {{ $company->team_size }}</li>
                                        <li><strong>Job Open:</strong>{{ count($company->job_post) }}</li>
                                        <li><strong>Website:</strong> <a href="#">{{ $company->company_website_url }}</a></li>
                                        <li><strong>Location:</strong>{{ $company->location }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar (Company) End -->

                        <!-- Sidebar (Company Location) Start -->
                        <div class="sidebar-widget">
                            <div class="inner">
                                <h6 class="title">Location on Map</h6>
                                <!-- Google Map Area Start -->
                                <div class="company-location-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2224905.8379164026!2d-63.27089988050263!3d-2.8569688249815943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91e8605342744385%3A0x3d3c6dc1394a7fc7!2sAmazon%20Rainforest!5e0!3m2!1sen!2sbd!4v1635401091721!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                </div>
                                <!-- End of Google Map Area -->
                            </div>
                        </div>
                        <!-- Sidebar (Company Location) End -->
                    </div>
                </div>
                <!-- Company Sidebar Wrap End -->

            </div>
        </div>
    </div>
    <!-- Company List End -->
@endsection