@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">New Portfolio</div>
    <a href="{{url('allEvents')}}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">New Portfolio</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Title</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Organizer</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Organizer">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>URL</label>
                            <input type="email" name="product_name" value="" class="form-control" placeholder="Organizer Email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Organizer Phone</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Organizer Phone">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Category</label>
                                <select class="form-control" name="status">
                                    <option value="0" selected hidden disabled>Select an Option</option>
                                </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Client</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Organizer Phone">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Design</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Organizer Phone">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Typography</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Organizer Phone">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tags</label>
                            <input type="text" name="product_name" value="" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="0">Draft</option>
                                    <option value="0">Publish</option>
                                </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="uploadImagesBarInner">
                                <label>Upload Portfolio File</label>
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
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="btnWrapperPrimary">
        <div class="col-12 d-flex form-btns">
            <button type="submit" class="btn btn-primary w-170">Submit New Portfolio</button>
        </div>
    </div>
</form>
@endsection