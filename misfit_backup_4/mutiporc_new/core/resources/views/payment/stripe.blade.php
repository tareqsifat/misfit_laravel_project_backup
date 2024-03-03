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
                                <div class="common-title mt-2">Stripe</div>
                            </div>
                            <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common-body">
                                            <div class="row">
                                                <div class="form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable Stripe</label>
                                                </div>
                                                <div class="form-check form-switch mt-4">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable Test Mode Stripe</label>
                                                </div>
                                                
                                                <div class="col-md-12 mt-4 form-group uploadImgWrapper">
                                                <label>Logo Stripe</label>
                                                    <input type="file" name="icon" class="foodfile1" accept="image/*">
                                                    <div class="uploadImgContainer">
                                                        <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                        <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Public Key</label>
                                                    <input type="text" name="p_c_t_e" value="pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x" class="form-control" placeholder="">
                                                   
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Secret key</label>
                                                    <input type="text" name="p_c_t_e" value="sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw" class="form-control" placeholder="">
                                                   
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