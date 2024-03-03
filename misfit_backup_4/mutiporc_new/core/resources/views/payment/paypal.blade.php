@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Payment Settings</div>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-common-body">
                    <div class="row">
                        <div class="tab-content" id="pills-tabContent">
                            {{-- Bank Account Start --}}
                            <div class="main-heading-container">
                                <div class="common-title">Payment Gateway Settings</div>
                                <div class="common-title mt-2">Paypal</div>
                            </div>
                            <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common-body">
                                            <div class="row">
                                                <div class=" col-md-12 payment-notice alert alert-warning">
                                                    <p>if your currency is not available in paypal, it will convert you currency value to USD value based on your currency exchange rate.</p>
                                                </div>
                                                <div class="form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Paypal</label>
                                                </div>
                                                <div class="form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable Test Mode Paypal</label>
                                                </div>
                                                
                                                <div class="col-md-12 mt-4 form-group uploadImgWrapper">
                                                <label>Logo Paypal</label>
                                                    <input type="file" name="icon" class="foodfile1" accept="image/*">
                                                    <div class="uploadImgContainer">
                                                        <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                        <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Sandbox client id</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                   
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Sandbox client secret</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                   
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Sandbox app id</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Live client id</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                </div>


                                                <div class="col-md-12 form-group">
                                                    <label>Live client secret</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Live app id</label>
                                                    <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
@endsection