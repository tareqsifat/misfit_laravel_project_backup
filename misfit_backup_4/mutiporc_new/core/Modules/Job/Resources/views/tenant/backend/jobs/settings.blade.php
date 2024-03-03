@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">All Job Settings</div>
</div>
<form action="{{route('tenant.admin.job.settings')}}" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">English (USA)</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="true">Arabic</button>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="tab-content" id="pills-tabContent">
                        {{-- Bank Account Start --}}
                        <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


                            <div class="card-topbar-inner">
                                <div class="card-topbar-title">English (USA)</div>
                            </div>
                            <div class="card-common-body">
                                <div class="row">
                                @foreach(\App\Facades\GlobalLanguage::all_languages() as $lang)
                            @php $slug = $lang->slug; @endphp
                                    <div class="col-md-12 form-group">
                                        <label>Experience Area Title</label>
                                        <input type="text" name="job_experience_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_experience_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Employee Type Area Title</label>
                                        <input type="text" name="job_employee_type_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_employee_type_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Salary Offer Area Title</label>
                                        <input type="text" name="job_salary_offer_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_salary_offer_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Working Days Area Title</label>
                                        <input type="text" name="job_working_days_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_working_days_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Working type Area Title</label>
                                        <input type="text" name="job_working_type_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_working_type_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Location Area Title</label>
                                        <input type="text" name="job_location_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_location_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Designation Area Title</label>
                                        <input type="text" name="job_deadline_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_deadline_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Deadline Area Title</label>
                                        <input type="text" name="job_deadline_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_deadline_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Application Fee Area Title</label>
                                        <input type="text" name="job_application_fee_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_application_fee_area_'.$slug.'_title')}}">                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Apply Area Title</label>
                                        <input type="text" name="job_apply_area_{{$slug}}_title" class="form-control"
                                       value="{{get_static_option('job_apply_area_'.$slug.'_title')}}">                                    </div>
                                       @endforeach
                                    <div class="card-topbar-inner">
                                        <div class="card-topbar-title">OG Meta Info</div>
                                    </div>
                                    <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="job_application_fee_show_hide"
                                           @if(!empty(get_static_option('job_application_fee_show_hide'))) checked @endif >
                                        <label class="form-check-label" for="flexSwitchCheckDefault">{{__('Show/Hide Job Application Fee')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="job_apply_show_hide"
                                           @if(!empty(get_static_option('job_apply_show_hide'))) checked @endif >
                                        <label class="form-check-label" for="flexSwitchCheckDefault">{{__('Show/Hide Job Apply ')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="job_related_area_show_hide"
                                           @if(!empty(get_static_option('job_related_area_show_hide'))) checked @endif >                                        <label class="form-check-label" for="flexSwitchCheckDefault">{{__('Show/Hide related Area')}}</label>
                                    </div>
                                </div>
                            </div>



                        </div>
                        </form>
@endsection

                        {{-- Bank Account End --}}

                        <!-- <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row mb-4">
                                <div class="col-lg-12">

                                    <div class="card-topbar-inner">
                                        <div class="card-topbar-title">English (USA)</div>
                                    </div>
                                    <div class="card-common-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>Experience Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Map Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Employee Type Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Salary Offer Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Working Days Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Working type Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Location Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Designation Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Deadline Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Application Fee Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Apply Area Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                            </div>
                                       
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Show/Hide Job Application Fee</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Show/Hide Job Apply</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Show/Hide related Area</label>
                                            </div>
                                           
                                        </div>
                                        <div class="btnWrapperPrimary">
                                                <div class="col-md-12 form-btns">
                                                    <button type="submit" class="btn btn-primary w-100">Update Changes</button>
                                                </div>
                                            </div>
                                    </div>

                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

            </div>
        </div>
</div>
