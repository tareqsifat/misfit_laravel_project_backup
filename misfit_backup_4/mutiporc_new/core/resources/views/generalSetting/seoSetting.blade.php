@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">SEO Settings</div>
</div>
<form action="" method="POST" enctype="multipart/form-data">
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
                                    <div class="col-md-12 form-group">
                                        <label>Site Meta Title</label>
                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Map Area Title">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Site Meta Tags</label>
                                        <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Site Meta Keywords</label>
                                        <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Site Meta Description</label>
                                        <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Social Area Title"></textarea>
                                    </div>

                                    <div class="card-topbar-inner">
                                        <div class="card-topbar-title">OG Meta Info</div>
                                    </div>
                                    <div class="col-md-12 form-group mt-4">
                                        <label>Og Meta Title</label>
                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Map Area Title">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Og Meta Description</label>
                                        <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title"></textarea>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Dark Mode For Admin Panel</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Maintenance Mode</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Site SSL Redirection</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Disable/Enable User Email Verify</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Live Server or Localhost</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable of Sorting Table List Data</label>
                                    </div>
                                </div>
                            </div>



                        </div>

                        {{-- Bank Account End --}}

                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row mb-4">
                                <div class="col-lg-12">

                                    <div class="card-topbar-inner">
                                        <div class="card-topbar-title">English (USA)</div>
                                    </div>
                                    <div class="card-common-body">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>Site Meta Title</label>
                                                <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Map Area Title">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Site Meta Tags</label>
                                                <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title"></textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Site Meta Keywords</label>
                                                <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title"></textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Site Meta Description</label>
                                                <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Social Area Title"></textarea>
                                            </div>
                                            
                                    <div class="card-topbar-inner">
                                        <div class="card-topbar-title">OG Meta Info</div>
                                    </div>
                                    <div class="col-md-12 form-group mt-4">
                                        <label>Og Meta Title</label>
                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Map Area Title">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>Og Meta Description</label>
                                        <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title"></textarea>
                                    </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Dark Mode For Admin Panel</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Maintenance Mode</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Site SSL Redirection</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Disable/Enable User Email Verify</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Live Server or Localhost</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable of Sorting Table List Data</label>
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