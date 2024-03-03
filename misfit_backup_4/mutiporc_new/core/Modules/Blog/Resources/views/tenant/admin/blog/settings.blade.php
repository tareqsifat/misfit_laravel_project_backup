@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Blog Settings</div>
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
                                                    <div class="col-md-6 form-group">
                                                        <label>Category Page Item Show</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Map Area Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Tag Page Item Show</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Chart Area Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Search Page Item Show</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Social Area Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <div class="uploadImagesBarInner">
                                                            <label>Blog Comment Avater</label>
                                                            <br>
                                                            <div class="col-md-12 form-group uploadImgWrapper">
                                                                <input type="file" name="icon" class="foodfile1" accept="image/*">
                                                                <div class="uploadImgContainer">
                                                                    <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                                    <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="btnWrapperPrimary">
        <div class=" d-flex form-btns">
            <button type="submit" class="btn btn-primary w-170">Save Changes</button>
        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Bank Account End --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
@endsection