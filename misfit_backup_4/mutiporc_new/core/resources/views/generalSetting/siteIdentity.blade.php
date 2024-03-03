@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Site Identity</div>
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
                                <div class="common-title">Site Identity</div>
                            
                            </div>
                            <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common-body">
                                            <div class="row">
                                                
                                                <div class="col-md-6 mt-4 form-group uploadImgWrapper" style="display: inline-grid;">
                                                <label>Site Logo</label>
                                                    <input type="file" name="icon" class="foodfile1" accept="">
                                                    <div class="uploadImgContainer">
                                                        <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                        <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                                    </div>
                                                    <span>recommended image size is 100*100</span>
                                                </div>
                                                <div class="col-md-6 mt-4 form-group uploadImgWrapper" style="display: inline-grid;">
                                                <label>Site White Logo</label>
                                                    <input type="file" name="" class="foodfile1" >
                                                    <div class="uploadImgContainer">
                                                        <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                        <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                                    </div>
                                                   <span> recommended image size is 100*100</span>
                                                </div>
                                                <div class="col-md-6 mt-4 form-group uploadImgWrapper" style="display: inline-grid;">
                                                <label>Site Favicon</label>
                                                    <input type="file" name="" class="foodfile1" >
                                                    <div class="uploadImgContainer">
                                                        <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                        <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                                    </div>
                                                    <span>recommended image size is 40*40</span>
                                                </div>
                                                <div class="col-md-6 mt-4 form-group uploadImgWrapper" style="display: inline-grid;">
                                                <label>Breadcrumb Image</label>
                                                    <input type="file" name="" class="foodfile1" >
                                                    <div class="uploadImgContainer">
                                                        <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                        <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                                                    </div>
                                                    <span>recommended image size is 1903*336</span>
                                                </div>
                                                <div class="btnWrapperPrimary">
                                                    <div class="col-12 form-btns">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
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