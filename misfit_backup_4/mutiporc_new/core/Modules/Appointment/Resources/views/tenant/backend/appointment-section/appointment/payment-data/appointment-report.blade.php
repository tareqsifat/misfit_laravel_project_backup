@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Appointment Payment Report</div>
    <a href="{{ url('/admin/product/list') }}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">Appointment Payment Report</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-2 form-group">
                            <label>Start Date</label>
                            <input type="date" name="startDate" value="" class="form-control" placeholder="Write Product Name">
                        </div>
                        <div class="col-md-2 form-group">
                            <label>End Date</label>
                            <input type="date" name="endDate" value="" class="form-control" placeholder="Write Product Name">
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Payment Status</label>
                            <select class="form-control" name="status">
                                <option value="0">All</option>
                                <option value="1">Pending</option>
                                <option value="2">Complete</option>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Items</label>
                            <select class="form-control" name="status">
                                <option value="1">10</option>
                                <option value="2">20</option>
                                <option value="2">50</option>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>

                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button  --}}
</form>
@endsection