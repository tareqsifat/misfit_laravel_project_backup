@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Order Setting</div>
    <a href="{{ url('/admin/product/list') }}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title"></div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Order Receiving Email</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Receiving Email">
                            <span>Email address on which admin will receive order notification email</span>
                        </div>
                        <div class="col-md-12 form-group mt-4">
                            <button type="submit" class="btn btn-primary w-170">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button  --}}
</form>
@endsection