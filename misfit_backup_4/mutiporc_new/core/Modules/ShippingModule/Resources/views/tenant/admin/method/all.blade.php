@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Product</div>
</div>


<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Shipping Zone</div>
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
                                <th>Zone</th>
                                <th>Tax Status</th>
                                <th>Status</th>
                                <th>Cost</th>
                                <th>Minimum Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_shipping_methods as $method)
                                    <tr>
                                        <x-bulk-action.td :id="$method->id" />
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($method->options)->title }}</td>
                                        <td>{{ optional($method->zone)->name }}</td>
                                        <td>{{ optional($method->options)->tax_status ? __('Taxable') : __('None') }}</td>
                                        <td>
                                            <x-status-span :status="optional($method->options)->status == 1 ? 'publish' : 'draft' " />
                                        </td>
                                        <td>{{ amount_with_currency_symbol(optional($method->options)->cost) }}</td>
                                        <td>{{ amount_with_currency_symbol(optional($method->options)->minimum_order_amount) }}</td>
                                        <td>
                                            @can('shipping-method-delete')
                                                @if (!$method->is_default)
                                                <x-table.btn.swal.delete :route="route('tenant.admin.shipping.method.delete', $method->id)" />
                                                @endif
                                            @endcan
                                            @can('shipping-method-edit')
                                            <a href="{{ route('tenant.admin.shipping.method.edit', $method->id) }}"
                                                class="btn btn-primary btn-xs mb-3 mr-1"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @endcan
                                            @can('shipping-method-make-default')
                                                @if (!$method->is_default)
                                                <form action="{{ route('tenant.admin.shipping.method.make.default') }}" method="post" style="display: inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $method->id }}">
                                                    <button class="btn btn-info btn-xs mb-3 mr-1">{{ __('Make Default') }}</button>
                                                </form>
                                                @else
                                                <button class="btn btn-success btn-xs px-4 mb-3 mr-1" disabled>{{ __('Default') }}</button>
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Zone</th>
                                <th>Tax Status</th>
                                <th>Status</th>
                                <th>Cost</th>
                                <th>Minimum Order</th>
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