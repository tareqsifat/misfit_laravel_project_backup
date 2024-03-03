@extends('web.layout.index')

@section('content')
    <style>
        .camera-icon {
            border: 1px solid black;
            padding: 8px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

        .camera-icon:hover {
            background-color: #e0e0e0; /* Change the hover background color as needed */
        }
        @media screen and (max-width: 425.95px){
            .offset-xs-10{
                margin-left: 83.66666667%
            }
            .col-xs-2 {
                flex: 0 0 auto;
                width: 8.33333333%;
            }
        }
        .page-heading-section {
            padding: 140px 0 18px;
        }
        .section-padding {
            position: relative;
            /* padding: 20px; Adjust the padding as needed */
        }
        .section-padding::before {
            content: '\00a0';
            position: absolute;
            top: -9%;
            left: 142px;
            width: 153px;
            height: 151px;
            border-radius: 50%;
            border: 2px solid #fff;
            z-index: 8;
            background-image: url('https://via.placeholder.com/30'); /*Replace with the actual image URL */
            background-color: #ff0000;
        }
        .sticky-top {
            top: 94px;
        }
        .link-icon{
            border-radius: 6px;
            border: 1px solid black;
            padding: 6px;
            float: right;
        }
    </style>
{{--    @dd(session()->all())--}}
    <!-- Page Heading Section Start -->
    <div class="page-heading-section section bg-parallax" data-bg-image="{{asset('assets/web/images/cover.jpeg')}}" data-overlay="50">
        <div class="container">
            <div class="page-heading-content text-center">
                <h3 class="title">
                    {{Auth::guard('user_account')->user()->name ? Auth::guard('user_account')->user()->name : Auth::guard('user_account')->user()->email}}
                </h3>
                <p class="text-white h5">
                    {{ Auth::guard('user_account')->user()->title ? Auth::guard('user_account')->user()->title : 'user title' }}
                </p>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-2 offset-xs-10 col-sm-2 offset-sm-10 col-md-1 offset-md-11 col-lg-1 offset-lg-11 col-xl-1 offset-xl-11">
                    <i class="fa fa-camera camera-icon"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading Section End -->
{{--    @dd($countries)--}}

    <!-- Company List Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="card">
                <h5 class="card-header">Create New Experience</h5>
                <div class="card-body">
                    <form action="{{ route('experience.store') }}" method="post">
                        @csrf
                        <div class="m-3">
                            <label for="CompanyName" class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control" id="CompanyName" placeholder="Company Name">
                            @error('company_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="m-3">
                            <label for="JobTitle" class="form-label">Job Title</label>
                            <input type="text" name="job_title" class="form-control" id="JobTitle" placeholder="Job Title">
                            @error('job_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="m-3">
                            <label for="StartDate" class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" id="StartDate" placeholder="Start Date">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="m-3">
                            <label for="EndDate" class="form-label">End Date</label>
                            <input type="text" name="end_date" class="form-control" id="EndDate" placeholder="End Date">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="m-3">
                            <label for="country" class="form-label">Country</label>
                            <select name="country_id" class="form-control" id="country" placeholder="e.x. Bangladesh">
                                <option value="">--select--</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{ $country->name }}</option>
                                @endforeach
                                @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                        <div class="m-3">
                            <label for="state" class="form-label">State</label>
                            <select name="state_id" class="form-control" id="state" placeholder="e.x. Bangladesh">
                                <option value="">--select--</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                                @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                        <div class="m-3">
                            <label for="city" class="form-label">City</label>
                            <select name="city_id" class="form-control" id="city" placeholder="e.x. Bangladesh">
                                <option value="">--select--</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                                @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-primary float-end" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection