@extends('master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Product</div>
</div>


<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Products</div>
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
                                <th>Product</th>
                                <th>Inventory</th>
                                <th>Type</th>
                                <th>Vender</th>
                                <th>Markets</th>
                                <th>Sale Channels</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="tbl-id">01</td>
                                <td> Name</td>
                                <td>10 in Stock</td>
                                <td>02</td>
                                <td>My store</td>
                                <td>
                                    <div class="btn-group dropdown-menu-action-active-group">
                                        <div class="status-common status-green dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="status-dot">02</span>
                                        </div>
                                        <ul class="dropdown-menu dropdown-menu-action dropdown-menu-action-active">
                                            <li><a class="dropdown-item" href="#!">Bangladesh</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#!">International</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group dropdown-menu-action-active-group">
                                        <div class="status-common status-green dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="status-dot">02</span>
                                        </div>
                                        <ul class="dropdown-menu dropdown-menu-action dropdown-menu-action-active">
                                            <li><a class="dropdown-item" href="#!">online Store</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#!">Point of Sale</a></li>
                                        </ul>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="btn-group dropdown-menu-action-active-group">
                                        <div class="status-common status-green dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="status-dot">Active</span>
                                        </div>
                                        <ul class="dropdown-menu dropdown-menu-action dropdown-menu-action-active">
                                            <li><a class="dropdown-item" href="#!">Active</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#!">Inactive</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions-col">
                                        <a class="actionIcon" href="{{ url('/') }}">
                                            <span>View</span>
                                            <i class="fa-solid fa-eye textOrange"></i>
                                        </a>
                                        <a class="actionIcon" href="{{ url('/admin/representative/edit') }}">
                                            <span>Edit</span>
                                            <i class="fa-solid fa-pen-to-square editProfile textOrange"></i>
                                        </a>
                                        <a class="actionIcon" href="{{ url('/admin/representative/edit') }}">
                                            <span>Duplicate</span>
                                            <i class="fa-solid fa-copy editProfile textOrange"></i>
                                        </a>
                                        <a class="actionIcon" href="#myModal" class="trigger-btn" data-toggle="modal">
                                            <span>Delete</span>
                                            <i class="fa-solid fa-trash-can textRed"> </i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Inventory</th>
                                <th>Type</th>
                                <th>Vender</th>
                                <th>Markets</th>
                                <th>Sale Channels</th>
                                <th>Status</th>
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