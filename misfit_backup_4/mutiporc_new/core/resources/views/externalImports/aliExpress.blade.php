@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">AliExpress Products</div>
    <a href="{{ url('/admin/product/list') }}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Products In Each Page</label>
                            <input type="number" min="10" name="product_name" value="" class="form-control" placeholder="Write Product Name">
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Page Number</label>
                            <input type="number" min="1" name="product_name" value="" class="form-control" placeholder="Write Product Name">
                        </div>
                        <div class="col-md-4 form-group mt-4">
                            <button type="submit" class="btn btn-primary w-170">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button  --}}
</form>
@endsection