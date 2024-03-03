@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Typography Settings</div>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="card-common">
        <div class="card-common-body">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-5">
                <h4 class="text-dark">(Theme Ecommerce)</h4>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Use Custom Font</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Font Family</label>
                        <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title" id="mySelect">
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>

                    </div>
                    <div class="col-md-6 form-group">
                        <label>Font Variant
                        </label>
                        <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title" id="varient">
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>

                    </div>
                </div>
                <div class="col-sm-5">
                <h4 class="text-dark">Heading Font (Theme Ecommerce)</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Heading Font</label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Font Family</label>
                        <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title" id="headFamily">
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>

                    </div>
                    <div class="col-md-6 form-group">
                        <label>Font Variant
                        </label>
                        <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title" id="headVarient">
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                        </select>

                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>

    </div>
    <!-- <div class="row mb-4">
        <div class="card-common">
            <div class="card-common-body">
                <div class="main-heading-container">
                    <div class="common-title">Typography Identity</div>
                </div>
                <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="col-sm-6">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Use Custom Font</label>
                        </div>
                        <h4 class="mt-4 text-primary">(Theme Ecommerce)</h4>
                        <div class="col-md-6 form-group">
                            <label>Font Family</label>
                            <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title" id="mySelect">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>

                        </div>
                        <div class="col-md-6 form-group">
                            <label>Font Variant
                            </label>
                            <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title" id="varient">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-dark mt-4">Heading Font (Ecommerce)</h4>
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Heading Font</label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Font Family</label>
                            <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title" id="mySelect">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>

                        </div>
                        <div class="col-md-6 form-group">
                            <label>Font Variant
                            </label>
                            <select name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title" id="varient">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>

                        </div>

                    </div>
                    <div class="btnWrapperPrimary">
                        <div class="col-12 form-btns">
                            <button type="submit" class="btn btn-primary">Update Changes</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div> -->
</form>
@endsection
<!-- <scr   ipt src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->