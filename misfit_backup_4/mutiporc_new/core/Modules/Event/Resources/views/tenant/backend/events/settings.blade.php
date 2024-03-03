@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Event Setting</div>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    {{-- <div class="card-topbar-title">Categories</div> --}}
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">English (USA)</button>
                        </li>
                         <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="true">Arabic</button>
                        </li> 
                    </ul>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="tab-content" id="pills-tabContent">
                            {{-- Bank Account Start --}} 
                            <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="row mb-4">
                                        <div class="col-lg-12">
                                            <div class="card-common">
                                                <div class="card-topbar-inner">
                                                    <div class="card-topbar-title">English (USA)</div>
                                                </div>
                                                <div class="card-common-body">
                                                    <div class="row">
                                                    @foreach(\App\Facades\GlobalLanguage::all_languages() as $lang)
                            @php $slug = $lang->slug; @endphp
                                                        <div class="col-md-6 form-group">
                                                            <label>Map Area Title</label>
                                                            <input type="text" name="event_map_area_{{$slug}}_title" value="" class="form-control" placeholder="Map Area Title">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Chart Area Title</label>
                                                            <input type="text" name="event_chart_area_{{$slug}}_title" value="" class="form-control" placeholder="Chart Area Title">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Social Area Title</label>
                                                            <input type="text" name="event_social_area_{{$slug}}_title" value="" class="form-control" placeholder="Social Area Title">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Category Area Title</label>
                                                            <input type="text" name="event_category_area_{{$slug}}_title" value="" class="form-control" placeholder="Category Area Title">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Tab Description Title</label>
                                                            <input type="text" name="event_tab_description_{{$slug}}_title" value="" class="form-control" placeholder="Tab Description Title">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Tab Comment Title</label>
                                                            <input type="text" name="event_tab_comment_{{$slug}}_title" value="" class="form-control" placeholder="Tab Comment Title">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Tab Book Title</label>
                                                            <input type="text" name="event_tab_book_{{$slug}}_title" value="" class="form-control" placeholder="Tab Book Title">
                                                        </div>
                                                        @endforeach
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="event_map_area_show_hide" @if(!empty(get_static_option('event_map_area_show_hide'))) checked @endif  type="checkbox" id="flexSwitchCheckDefault">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event Map Aera</label>
                                                        </div>
                                                    
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" name="event_chart_area_show_hide"
                                           @if(!empty(get_static_option('event_chart_area_show_hide'))) checked @endif type="checkbox" id="flexSwitchCheckDefault">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event Chart Aera</label>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="event_social_area_show_hide"
                                           @if(!empty(get_static_option('event_social_area_show_hide'))) checked @endif>
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event Social Aera</label>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="event_category_area_show_hide"
                                           @if(!empty(get_static_option('event_category_area_show_hide'))) checked @endif>
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event Category Aera</label>
                                                        </div>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="event_related_area_show_hide"
                                           @if(!empty(get_static_option('event_related_area_show_hide'))) checked @endif>
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event related Aera</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    
                            {{-- Bank Account End --}} 

                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common">
                                            <div class="card-topbar-inner">
                                                <div class="card-topbar-title">English (USA)</div>
                                            </div>
                                            <div class="card-common-body">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Map Area Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Map Area Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Chart Area Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Social Area Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Social Area Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Category Area Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Category Area Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Tab Description Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Tab Description Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Tab Comment Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Tab Comment Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Tab Book Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Tab Book Title">
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event Map Aera</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event Chart Aera</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event Social Aera</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event Category Aera</label>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Show /Hide Event related Aera</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="btnWrapperPrimary">
        <div class="col-12 d-flex form-btns">
            <button type="submit" class="btn btn-primary w-170">Submit</button>
        </div>
    </div>
</form>
@endsection