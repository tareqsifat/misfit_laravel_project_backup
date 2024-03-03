@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Brand Manage</div>
</div>


<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Brand Manages</div>
            </div>
            <div class="card-topbar-inner">
                <button class="btn btn-sm btn-primary">Create New Brand</button>
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
                                <th>SLNO:</th>
                                <th>Logo</th>
                                <th>Banner</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>URL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($delivery_manages as $item)
                                    <tr>
                                        <td width="80px">{{$loop->iteration}}</td>
                                        <td>
                                            <div class="attachment-preview">
                                                <div class="img-wrap">
                                                    {!! render_image_markup_by_attachment_id($item->image_id) !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="attachment-preview">
                                                <div class="img-wrap">
                                                    {!! render_image_markup_by_attachment_id($item->banner_id) !!}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$item->getTranslation('name',$default_lang)}}</td>
                                        <td>{{$item->getTranslation('title',$default_lang)}}</td>
                                        <td>{{$item->getTranslation('description',$default_lang)}}</td>
                                        <td>{{$item->url}}</td>
                                        <td>
                                            @php
                                                $logo = get_attachment_image_by_id($item->image_id);
                                                $logo_url = !empty($logo) ? $logo['img_url'] : '';

                                                $banner = get_attachment_image_by_id($item->banner_id);
                                                $banner_url = !empty($banner) ? $banner['img_url'] : '';
                                            @endphp

                                            @can('product-delivery_manage-delete')
                                                <x-table.btn.swal.delete :route="route('tenant.admin.product.brand.manage.delete', $item->id)" />
                                            @endcan
                                            @can('product-delivery_manage-edit')
                                                <a href="#"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#brand_manage_edit_modal"
                                                   class="btn btn-primary btn-sm btn-xs mb-3 mr-1 brand_manage_edit_btn"
                                                   data-id="{{$item->id}}"
                                                   data-name="{{$item->getTranslation('name',$default_lang)}}"
                                                   data-slug="{{$item->slug}}"
                                                   data-title="{{$item->getTranslation('title',$default_lang)}}"
                                                   data-description="{{$item->getTranslation('description',$default_lang)}}"
                                                   data-logo-id="{{ $item->image_id }}"
                                                   data-logo="{{ $logo_url }}"
                                                   data-banner-id="{{ $item->banner_id }}"
                                                   data-banner="{{ $banner_url }}"
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
                            <th>SLNO:</th>
                                <th>Logo</th>
                                <th>Banner</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>URL</th>
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