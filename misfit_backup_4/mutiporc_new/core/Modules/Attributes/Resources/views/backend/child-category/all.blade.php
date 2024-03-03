@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Product Childe-Category</div>
</div>


<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Product Child-Categories</div>
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
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data['all_child_category'] as $child_category)
                                    @php
                                        $category = $child_category->category?->getTranslation('name',$default_lang);
                                        $sub_category = $child_category->sub_category?->getTranslation('name',$default_lang);
                                    @endphp
                                    <tr>
                                        <x-bulk-action.td :id="$child_category->id"/>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $category }}</td>
                                        <td>{{ $sub_category }}</td>
                                        <td>{{$child_category->getTranslation('name',$default_lang)}}</td>
                                        <td>
                                            <x-status-span :status="$child_category->status?->name"/>
                                        </td>
                                        <td>
                                            <div class="attachment-preview">
                                                <div class="img-wrap">
                                                    {!! render_image_markup_by_attachment_id($child_category->image_id) !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @can('product-child-category-delete')
                                                <x-table.btn.swal.delete
                                                    :route="route('tenant.admin.product.child-category.delete', $child_category->id)"/>
                                            @endcan
                                            @can('product-child-category-edit')
                                                @php
                                                    $image = get_attachment_image_by_id($child_category->image_id, null, true);
                                                    $img_path = $image['img_url'];
                                                @endphp

                                                <a href="javascript:void(0)"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#child-category_edit_modal"
                                                   class="btn btn-sm btn-primary btn-xs mb-3 mr-1 child-category_edit_btn"
                                                   data-id="{{$child_category->id}}"
                                                   data-name="{{$child_category->getTranslation('name',$default_lang)}}"
                                                   data-slug="{{$child_category->slug}}"
                                                   data-status="{{ $child_category->status_id }}"
                                                   data-imageid="{!! $child_category->image_id !!}"
                                                   data-image="{{ $img_path }}"
                                                   data-category-id="{{$child_category->category_id}}"
                                                   data-sub-category-id="{{$child_category->sub_category_id}}"
                                                >
                                                    <i class="mdi mdi-lead-pencil"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>ID</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
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