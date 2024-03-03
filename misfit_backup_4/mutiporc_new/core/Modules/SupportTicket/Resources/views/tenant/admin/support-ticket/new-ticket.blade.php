@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Add New Ticket</div>
    <a href="{{ url('/admin/product/list') }}" class="btn btn-primary w-170">Back</a>
</div>
<form action="" method="POST" enctype="multipart/form-data">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-common">
                <div class="card-topbar-inner">
                    <div class="card-topbar-title">New Ticket</div>
                </div>
                <div class="card-common-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Title</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Subject</label>
                            <input type="text" name="product_name" value="" class="form-control" placeholder="Subject">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Priority</label>
                            <select class="form-control" name="status">
                                <option value="0">Low</option>
                                <option value="1">Medium</option>
                                <option value="2">High</option>
                                <option value="2">Urgent</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Departments</label>
                            <select class="form-control" name="status">
                                <option value="0">Login</option>
                                <option value="1">Install Issue</option>
                                <option value="2">General Issue</option>
                                <option value="2">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Users</label>
                            <select class="form-control" name="status">
                                <option value="0"></option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Description</label>
                            <textarea type="text" name="p_c_t_e" value="" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class="col-md-12 form-group mt-4">
                            <button type="submit" class="btn btn-primary w-170">Submit Ticket</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- button  --}}
</form>
@endsection