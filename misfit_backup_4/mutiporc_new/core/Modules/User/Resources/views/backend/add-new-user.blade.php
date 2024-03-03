@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Add New Staff</div>
    <a href="{{ url('/admin/product/list') }}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">General Infomation</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Write Product Name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>User Name</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Write Product Name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Write Product Name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile</label>
                            <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="form-control" name="status">
                                <option value="0" selected hidden disabled>Select Country</option>
                                <option value="1">Pakistan</option>
                                <option value="2">USA</option>
                                <option value="2">USA</option>
                                <option value="2">USA</option>
                                <option value="2">USA</option>
                            </select>                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="city">

                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input type="password" name="p_c_t_e" value="" class="form-control" placeholder="State">

                        </div>
                        <div class="col-md-6 form-group">
                            <label>Company</label>
                            <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Company">

                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input type="text" name="p_c_t_e" value="" class="form-control" placeholder="Address">

                        </div>
                        <div class="col-md-6 form-group">
                            <label>Password</label>
                            <input type="password" name="p_c_t_e" value="" class="form-control" placeholder="Password">

                        </div>
                        <div class="col-md-6 form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="p_c_t_e" value="" class="form-control" placeholder="Confirm Password">

                        </div>
                        <label>Image</label>
                        <br>
                        <div class="col-md-12 form-group uploadImgWrapper">
                            <input type="file" name="icon" class="foodfile1" accept="image/*">
                            <div class="uploadImgContainer">
                                <div class="cameraIcon"><img class="foodbrowse1" src="{{asset('assets/admin/images/camera.svg')}}"></div>
                                <img id="foodpreview1" src="{{asset('assets/admin/images/placeholderBox.svg')}}">
                            </div>
                        </div>
                        <div class="col-md-12 form-group mt-4">
                            <button type="submit" class="btn btn-primary w-170">Add New User</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button  --}}
</form>
@endsection