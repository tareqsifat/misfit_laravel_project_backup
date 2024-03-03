@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Add New Services</div>
    <a href="{{url('allEvents')}}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">New Services</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Title</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Knowladgebase Description</label>
                            <textarea id="myTextarea" name="content"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Category</label>
                            <select class="form-control" name="status">
                                <option value="0" selected hidden disabled>Select an Option</option>
                                <option value="1">All Products</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Publish</option>
                                <option value="2">Draft</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="uploadImagesBarInner">
                                <label>Image</label>
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
                            <div class="d-flex form-btns">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    {{-- <div class="card-topbar-title">Categories</div> --}}
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">General Meta Info</button>
                        </li>
                         <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="true">Facebook Meta</button>
                        </li> 
                        <li class="nav-item" role="presentation">
                            <button class="nav-link " id="pills-withdraw-tab" data-bs-toggle="pill" data-bs-target="#pills-withdraw" type="button" role="tab" aria-controls="pills-withdraw" aria-selected="true">Twitter Meta</button>
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
                                                    <div class="card-topbar-title">General Info</div>
                                                </div>
                                                <div class="card-common-body">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group">
                                                            <label>Title</label>
                                                            <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Title">
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label>Description</label>
                                                            <textarea name="summery"class="form-control" id="" cols="5" rows="5" placeholder="Description"></textarea>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <div class="uploadImagesBarInner">
                                                                <label>General info image </label>
                                                                    <br>
                                                                <div class="col-md-12 form-group uploadImgWrapper">
                                                                    <input type="file" name="icon" class="customefile1" accept="image/*">
                                                                    <div class="uploadImgContainer">
                                                                        <div class="cameraIcon"><img class="customebrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                                        <img id="customepreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
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
                    
                            {{-- Bank Account End --}} 

                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common">
                                            <div class="card-topbar-inner">
                                                <div class="card-topbar-title">Facebook Info</div>
                                            </div>
                                            <div class="card-common-body">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="General info Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Description</label>
                                                        <textarea name="summery"class="form-control" id="" cols="5" rows="5" placeholder="General info Description"></textarea>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <div class="uploadImagesBarInner">
                                                            <label>General info image </label>
                                                                <br>
                                                            <div class="col-md-12 form-group uploadImgWrapper">
                                                                <input type="file" name="icon" class="promofile1" accept="image/*">
                                                                <div class="uploadImgContainer">
                                                                    <div class="cameraIcon"><img class="promobrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                                    <img id="promopreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
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
                    
                    
                            {{-- Withdraw Start--}}
                            <div class="tab-pane fade" id="pills-withdraw" role="tabpanel" aria-labelledby="pills-withdraw-tab">
                                <div class="row mb-4">
                                    <div class="col-lg-12">
                                        <div class="card-common">
                                            <div class="card-topbar-inner">
                                                <div class="card-topbar-title">Twitter Info</div>
                                            </div>
                                            <div class="card-common-body">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="General info Title">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label>Description</label>
                                                        <textarea name="summery"class="form-control" id="" cols="5" rows="5" placeholder="General info Description"></textarea>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <div class="uploadImagesBarInner">
                                                            <label>Upload image </label>
                                                                <br>
                                                            <div class="col-md-12 form-group uploadImgWrapper">
                                                                <input type="file" name="icon" class="promofile2" accept="image/*">
                                                                <div class="uploadImgContainer">
                                                                    <div class="cameraIcon"><img class="promobrowse2" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                                                    <img id="promopreview2" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
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
                            {{-- Withdraw End--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        tinymce.init({
            selector: "textarea#myTextarea",
            plugins: "autoresize",
            autoresize_bottom_margin: 20,
            menubar: false,
        });
    });
</script>