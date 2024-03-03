@extends(route_prefix().'admin.admin-master')
@section('content')
<div class="main-heading-container">
    <div class="common-title">Product</div>
</div>


<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card-common">
            <div class="card-topbar-inner">
                <div class="card-topbar-title">All Staff</div>
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
                                <th>Tax(%)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_state_tax as $tax)
                            <tr>
                                <td>
                                {{ $loop->iteration }}
                                </td>

                                <td>
                                {{ optional($tax->state)->name }}
                                </td>
                                <td>
                                {{ $tax->tax_percentage }}</
                                </td>
                                <td>
                                @can('state-tax-edit')
                                                <a href="#"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#state_tax_edit_modal"
                                                   class="btn btn-primary btn-sm btn-xs mb-3 mr-1 state_tax_edit_btn"
                                                   data-id="{{$tax->id}}"
                                                   data-country_id="{{$tax->country_id}}"
                                                   data-state_id="{{$tax->state_id}}"
                                                   data-tax_percentage="{{$tax->tax_percentage}}"
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
                                <th>Tax(%)</th>
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
@can('state-tax-edit')
        <div class="modal fade" id="state_tax_edit_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Update State Tax')}}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{route('tenant.admin.tax.state.update')}}" method="post">
                        <input type="hidden" name="id" id="state_tax_id">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group country-wrapper">
                                <label for="country_id">{{__('Country')}}</label>
                                <select name="country_id" class="form-control" id="edit_country_id">
                                    <option value="">{{ __('Select Country') }}</option>
                                    @foreach ($all_country as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group state-wrapper">
                                <label for="edit_state_id">{{__('state')}}</label>
                                <select name="state_id" class="form-control" id="edit_state_id">
                                    <option value="">{{ __('select state') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_tax_percentage">{{__('Tax Percentage')}}</label>
                                <input type="number" class="form-control" id="edit_tax_percentage" name="tax_percentage"
                                       placeholder="{{__('Tax Percentage')}}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary"
                                    data-bs-dismiss="modal">{{__('Close')}}</button>
                            <button type="submit" class="btn btn-sm btn-primary">{{__('Save Change')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('state-tax-create')
        <div class="modal fade" id="state_tax_new_modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Add New State Tax')}}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                    </div>
                    <form action="{{route('tenant.admin.tax.state.new')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="country_id">{{__('Country')}}</label>
                                <select name="country_id" class="form-control" id="create_country_id">
                                    <option value="">{{ __('Select Country') }}</option>
                                    @foreach ($all_country as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group create-state-wrapper">
                                <label for="state_id">{{__('State')}}</label>
                                <select name="state_id" class="form-control" id="create_state_id">
                                    <option value="">{{ __('Select Country first') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tax_percentage">{{__('Tax Percentage')}}</label>
                                <input type="number" class="form-control" id="tax_percentage" name="tax_percentage"
                                       placeholder="{{__('Tax Percentage')}}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
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