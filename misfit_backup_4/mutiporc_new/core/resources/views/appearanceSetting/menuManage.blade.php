@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">All Menu</div>
</div>


<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Menus</div>
            </div>
            <div class="card-common-body">
                <div class="row">
                    <div class="col-sm-12 lengthFilterCol">

                        <div class="searchFilter">
                            <i class="fa-regular fa-sliders"></i>
                        </div>
                    </div>
                </div>
                <div class="row no-margin filter-trigger" style="display: block;">
                    <div class="col-md-12">
                        <div class="filters-table-wrapper">
                            <div class="filter-heading">Search Filters</div>
                            <div class="filters-table">
                                <div class="main-filters">
                                    <input type="text" class="form-control form-control-filters" placeholder="ID">
                                    <input type="text" class="form-control form-control-filters" placeholder="Number">
                                    <input type="text" class="form-control form-control-filters" placeholder="Inventory">
                                    <select class="form-control form-control-filters" name="country">
                                        <option value="" selected hidden disabled> Status</option>
                                        <option value="Active">Active</option>
                                        <option value="France">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filters-control">
                                <a href="#!" class="btn btn-transparent clear-filter">Clear Filter</a>
                                <button type="submit" href="#!" class="btn btn-primary">Search</button>
                                <a href="#!" class="btn  btn-transparent btn-tra hide-filter">Hide Filter</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-table-responsive">
                    <table id="customers" class="table tableCommon table-striped table-single-line">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created AT</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_menu as $data)
                            <tr>
                                <td>
                                {{$data->id}}
                                </td>

                                <td>
                                {{$data->title}}
                                </td>
                                <td>
                                @if($data->status == 'default')
                                                <span class="alert alert-success">{{__('Default Menu')}}</span>
                                            @else
                                                <form action="{{route('tenant.admin.menu.default',$data->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-info btn-sm mb-3 mr-1 set_default_menu">{{__('Set Default')}}</button>
                                                </form>
                                            @endif
                                </td>
                                <td>
                                {{$data->created_at->format('d-M-Y')}}
                                </td>
                                <td>
                                @if($data->status != 'default')
                                           
                                        <a class="actionIcon" href="{{url('tenant.admin.menu.delete',$data->id)}}" class="trigger-btn" data-toggle="modal">
                                        <span>Delete</span>
                                            <i class="fa-solid fa-trash-can textRed"> </i>
                                        </a>
                                                @endif

                                            <x-edit-icon :url="route('tenant.admin.menu.edit',$data->id)"/>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created AT</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-common" style="justify-content: center;">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">Add New Menu</div>
            </div>
            <form action="{{route('tenant.admin.menu.new')}}" method="post" enctype="multipart/form-data"  style="justify-content: center;">

                <div class="col-md-10 form-group mt-2" style="margin-left: 10px;">
                    <label>Title</label>
                    <input type="text" name="product_name" value="" class="form-control" placeholder="Title">
                </div>

                <div class="col-md-10 form-group mt-2">
                    <button type="submit" class="btn btn-primary w-170 ml-2">create New</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- delete model  -->

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="fa-solid fa-trash-can textRed"> </i>
                </div>
                <h4 class="modal-title w-100">{{ __('messages.Are_you_sure') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>{{ __('messages.Do_you_really') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Cancel') }}</button>
                <button type="button" class="btn btn-danger">{{ __('messages.Delete') }}</button>
            </div>
        </div>
    </div>
</div>



@endsection