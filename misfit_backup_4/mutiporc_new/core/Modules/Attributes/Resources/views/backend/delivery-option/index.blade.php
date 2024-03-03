@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Product Delivery Manage</div>
</div>


<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">Product Delivery Manage</div>
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
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($delivery_manages as $item)
                                    <tr>
                                        <x-bulk-action.td :id="$item->id" />
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <i class="{{$item->icon}}"></i>
                                        </td>
                                        <td>{{$item->getTranslation('title',$default_lang)}}</td>
                                        <td>{{$item->getTranslation('sub_title',$default_lang)}}</td>
                                        <td>
                                            @can('product-delivery_manage-delete')
                                                <x-table.btn.swal.delete :route="route('tenant.admin.product.delivery.option.delete', $item->id)" />
                                            @endcan
                                            @can('product-delivery_manage-edit')
                                                <a href="javascript:void(0)"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#delivery_manage_edit_modal"
                                                   class="btn btn-primary btn-sm btn-xs mb-3 mr-1 delivery_manage_edit_btn"
                                                   data-id="{{$item->id}}"
                                                   data-title="{{$item->getTranslation('title',$default_lang)}}"
                                                   data-sub-title="{{$item->getTranslation('sub_title',$default_lang)}}"
                                                   data-icon="{{$item->icon}}"
                                                >
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>ID</th>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">Add New Delivery Manage</div>
            </div>
            <form action="{{route('tenant.admin.product.delivery.option.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="lang" value="{{$default_lang}}">
            <div class="col-md-11 form-group mt-2" style="margin-left: 10px;">
                <label>Title</label>
                <input type="text" name="title" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-11 form-group mt-2" style="margin-left: 10px;">
                <label>Sub Title</label>
                <input type="text"  id="sub_title" name="sub_title" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-11 form-group mt-2" style="margin-left: 10px;">
           
                                    <x-fields.icon-picker/>
                    
            </div>
            <div class="col-md-11 form-group mt-2">
                <button type="submit" class="btn btn-primary w-170">Add New</button>
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