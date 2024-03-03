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
                                <th>Order ID</th>
                                <th>Billing Name</th>
                                <th>Billing Email</th>
                                <th>Total Amount</th>
                                <th>Payment Gateway</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($all_orders as $data)
                        <tr>
                                        <td class="text-center">{{$data->id}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->email}}</td>
                                        <td>{{amount_with_currency_symbol($data->total_amount)}}</td>
                                        <td class="text-capitalize">{{$data->checkout_type !== 'cod' ? str_replace('_',' ',$data->payment_gateway) : 'Cash On Delivery'}}</td>
                                        <td>
                                            @if($data->payment_status == 'success' || $data->payment_status =='complete' )
                                                <span
                                                        class="alert alert-success text-capitalize">{{$data->payment_status}}
                                                </span>
                                            @else
                                                <span
                                                        class="alert alert-warning text-capitalize">{{$data->payment_status ?? __('Pending')}}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->status == 'pending')
                                                <span
                                                        class="alert alert-warning text-capitalize">{{$data->status}}</span>
                                            @elseif($data->status == 'cancel')
                                                <span
                                                        class="alert alert-danger text-capitalize">{{$data->status}}</span>
                                            @elseif($data->status == 'in_progress')
                                                <span
                                                        class="alert alert-info text-capitalize">{{str_replace('_', ' ',ucwords($data->status))}}</span>
                                            @else
                                                <span
                                                        class="alert alert-success text-capitalize">{{$data->status}}</span>
                                            @endif
                                        </td>
                                        <td>{{$data->created_at->format('d M Y')}}</td>
                                        <td>
                                            <a href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#user_edit_modal"
                                               class="btn btn-lg btn-info btn-sm mb-3 mr-1 user_edit_btn"
                                            >
                                                <i class="las la-envelope"></i>
                                            </a>
                                            <a href="{{route('tenant.admin.product.order.manage.view',$data->id)}}"
                                               class="btn btn-lg btn-primary btn-sm mb-3 mr-1 view_order_details_btn">
                                                <i class="las la-eye"></i>
                                            </a>

                                            @if($data->status !== 'cancel')
                                                <a href="#"
                                                   data-id="{{$data->id}}"
                                                   data-status="{{$data->status}}"
                                                   data-payment_status="{{$data->payment_status}}"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#order_status_change_modal"
                                                   class="btn btn-lg btn-info btn-sm mb-3 mr-1 order_status_change_btn"
                                                >{{__("Update Status")}}</a>
                                            @endif

                                            @if(!empty($data->user_id) && $data->payment_status == 'pending' || $data->payment_status == null)
                                                <form action="{{route(route_prefix().'admin.product.order.reminder')}}"
                                                      method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$data->id}}">
                                                    <button class="btn btn-secondary mb-2 btn-sm" type="submit"><i
                                                                class="las la-bell"></i></button>
                                                </form>
                                            @endif
                                            <form action="{{route(route_prefix().'admin.order.invoice.generate')}}"
                                                  method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                <button class="btn btn-dark btn-sm"
                                                        type="submit">{{__('Invoice')}}</button>
                                            </form>
                                            <br>

                                            @if(in_array($data->payment_gateway,['manual_payment_','bank_transfer']) && $data->payment_status != 'complete')
                                                {!! \Modules\Appointment\Helpers\DataTableHelpers\AppointmentGeneral::paymentAccept(route('tenant.admin.product.payment.accept',$data->id)) !!}
                                            @endif
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Order ID</th>
                                <th>Billing Name</th>
                                <th>Billing Email</th>
                                <th>Total Amount</th>
                                <th>Payment Gateway</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Date</th>
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