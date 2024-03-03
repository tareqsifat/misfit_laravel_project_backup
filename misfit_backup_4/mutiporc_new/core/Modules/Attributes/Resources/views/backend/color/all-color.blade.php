@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">All Product Color</div>
</div>


<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Product Colors</div>
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
                                <th>Color Code</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($product_colors as $product_color)
                                        <tr>
                                            <x-bulk-action.td :id="$product_color->id" />
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$product_color->getTranslation('name',$default_lang)}}</td>
                                            <td>
                                                <p class="mb-0">{{ $product_color->color_code }}</p>
                                                <p style="background-color: {{$product_color->color_code}}; width: 30px;height: 20px"></p>
                                            </td>
                                            <td>{{ $product_color->slug }}</td>
                                            <td>
                                                @can('product-color-delete')
                                                    <x-table.btn.swal.delete :route="route('tenant.admin.product.colors.delete', $product_color->id)" />
                                                @endcan
                                                @can('product-color-edit')
                                                    <a href="javascript:void(0)"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#color_edit_modal"
                                                       class="btn btn-primary btn-xs mb-3 mr-1 color_edit_btn"
                                                       data-id="{{ $product_color->id }}"
                                                       data-name="{{ $product_color->getTranslation('name',$default_lang) }}"
                                                       data-color_code="{{ $product_color->color_code }}"
                                                       data-slug="{{ $product_color->slug }}"
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
                                <th>Color Code</th>
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
            <form action="{{ route('tenant.admin.product.colors.new') }}" method="POST">
            @csrf
                            <input type="hidden" name="lang" value="{{$default_lang}}">
            <div class="col-md-10 form-group mt-2" style="margin-left: 10px;">
                <label>Name</label>
                <input type="text" name="product_name" value="" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-4 form-group mt-2" style="margin-left: 10px;">
                <input type="color" name="product_name" value="" class="form-control" placeholder="Name">
            </div>
            <div class="col-md-10 form-group mt-2" style="margin-left: 10px;">
                <label>Slug</label>
                <input type="text" name="product_name" value="" class="form-control" placeholder="Slug">
            </div>
            <div class="col-md-12 form-group mt-2">
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