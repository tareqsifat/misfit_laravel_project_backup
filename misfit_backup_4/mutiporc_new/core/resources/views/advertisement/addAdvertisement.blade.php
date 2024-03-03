@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">New Advertisement</div>
    <a href="{{url('allEvents')}}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">New Advertisement</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Title</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Advertisement Type</label>
                            <select class="form-control" name="status">
                                <option value="0">Image</option>
                                <option value="1">Google Adsen</option>
                                <option value="1">Script</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Advertisement Size</label>
                            <select class="form-control" name="status">
                                <option selected="" disabled="">Select a Size</option>
                                <option value="350*250">350 x 250</option>
                                <option value="320*50">320 x 50</option>
                                <option value="160*600">160 x 600</option>
                                <option value="300*600">300 x 600</option>
                                <option value="336*280">336 x 280</option>
                                <option value="728*90">728 x 90</option>
                                <option value="730*180">730 x 180</option>
                                <option value="730*210">730 x 210</option>
                                <option value="300*1050">300 X 1050</option>
                                <option value="950*160">950 X 160</option>
                                <option value="950*200">950 X 200</option>
                                <option value="250*1110">250 X 1110</option>
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
                            <div class="form-btns">
                                <button type="submit" class="btn btn-primary">Submit Advertise</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection