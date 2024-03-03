@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">All Product Size</div>
</div>


<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Product Sizes</div>
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
                                <th>Name</th>
                                <th>Size Code</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($product_sizes as $product_size)
                                    <tr>
                                        <x-bulk-action.td :id="$product_size->id" />
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$product_size->getTranslation('name',$default_lang)}}</td>
                                        <td>{{ $product_size->size_code }}</td>
                                        <td>{{ $product_size->slug }}</td>
                                        <td>
                                            @can('product-size-delete')
                                            <x-table.btn.swal.delete :route="route('tenant.admin.product.sizes.delete', $product_size->id)" />
                                            @endcan
                                            @can('product-size-edit')
                                            <a href="javascript:void(0)"
                                               data-bs-toggle="modal"
                                               data-bs-target="#size_edit_modal"
                                               class="btn btn-primary btn-xs mb-3 mr-1 size_edit_btn"
                                               data-id="{{ $product_size->id }}"
                                               data-name="{{ $product_size->getTranslation('name',$default_lang) }}"
                                               data-size_code="{{ $product_size->size_code }}"
                                               data-slug="{{ $product_size->slug }}"
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
                                <th>Name</th>
                                <th>Size Code</th>
                                <th>Slug</th>
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
                <div class="card-topbar-title">New Color</div>
            </div>
            <form action="{{ route('tenant.admin.product.sizes.new') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lang" value="{{$default_lang}}">
            <div class="col-md-11 form-group mt-2" style="margin-left: 10px;">
                <label>Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-11 form-group mt-2" style="margin-left: 10px;">
                <label>Size Code</label>
                <input type="text"  id="size_code" name="size_code" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-11 form-group mt-2" style="margin-left: 10px;">
                <label>Slug</label>
                <input type="text" id="slug" name="slug" class="form-control" placeholder="Slug">
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