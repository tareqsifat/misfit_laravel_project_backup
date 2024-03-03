@extends('super_admin.layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <div class="p-30">
        <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{ __($title) }}</h4>
        <div class="row bd-c-ebedf0 bd-half bd-ra-25 bg-white h-100 p-30">
            <div class="col-lg-12">
                <div class="customers__area bg-style mb-30">
                    <ul class="nav nav-tabs zTab-reset zTab-one" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active orderStatusTab text-1b1c17" data-bs-toggle="tab" data-bs-target="#allTabPane"
                                    type="button" data-status="All" role="tab" aria-controls="allTabPane"
                                    aria-selected="true">{{ __('All') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link orderStatusTab text-1b1c17" data-bs-toggle="tab" data-bs-target="#paidTabPane"
                                    type="button" role="tab" data-status="Paid" aria-controls="paidTabPane"
                                    aria-selected="false" tabindex="-1">{{ __('Paid') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link orderStatusTab text-1b1c17" data-bs-toggle="tab" data-status="Pending"
                                    data-bs-target="#pendingTabPane" type="button" role="tab"
                                    aria-controls="pendingTabPane" aria-selected="false" tabindex="-1">{{ __('Pending') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation ">
                            <button class="nav-link orderStatusTab text-1b1c17" data-bs-toggle="tab" data-bs-target="#cancelTabPane"
                                    type="button" role="tab" aria-controls="cancelTabPane" data-status="Cancelled"
                                    aria-selected="false" tabindex="-1">{{ __('Cancelled') }}
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="allTabPane" role="tabpanel" aria-labelledby="all-tab"
                             tabindex="0">
                            <div class="table-responsive zTable-responsive">
                                <table class="table zTable" id="orderDataTableAll" aria-describedby="orderDataTableall">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Transaction Id') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('User Name') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('User Email') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Package') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Gateway') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Amount') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="">{{ __('Date') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Status') }}</div>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="paidTabPane" role="tabpanel" aria-labelledby="paid-tab"
                             tabindex="0">
                            <div class="table-responsive zTable-responsive">
                                <table class="table zTable" id="orderDataTablePaid"
                                       aria-describedby="orderDataTablepaid">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Transaction Id') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('User Name') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('User Email') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Package') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Gateway') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Amount') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Date') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Status') }}</div>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pendingTabPane" role="tabpanel" aria-labelledby="pending-tab"
                             tabindex="0">
                            <div class="table-responsive zTable-responsive">
                                <table class="table zTable" id="orderDataTablePending"
                                       aria-describedby="orderDataTablepending">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Transaction Id') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('User Name') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('User Email') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Package') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Gateway') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Amount') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Date') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Status') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="text-nowrap">{{ __('Payment Info') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Action') }}</div>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cancelTabPane" role="tabpanel"
                             aria-labelledby="cancel-tab"tabindex="0">
                            <div class="table-responsive zTable-responsive">
                                <table class="table zTable" id="orderDataTableCancelled"
                                       aria-describedby="orderDataTablecancelled">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Transaction Id') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('User Name') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('User Email') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Package') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Gateway') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Amount') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-w-150">{{ __('Date') }}</div>
                                        </th>
                                        <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                            <div class="min-sm-w-100">{{ __('Status') }}</div>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table -->

    <div class="modal fade" id="payStatusChangeModal" tabindex="-1" aria-labelledby="payStatusChangeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-18 fw-600 lh-24 text-1b1c17" id="payStatusChangeModalLabel">
                        {{ __('Payment Status Change') }}</h4>
                    <button type="button" class="w-30 h-30 rounded-circle bd-one bd-c-e4e6eb p-0 bg-transparent"
                            data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-times"></i></button>
                </div>
                <form class="ajax reset" action="{{ route('saas.super_admin.subscriptions.order.payment.status.change') }}"
                      method="post" data-handler="commonResponseForModal">
                    @csrf
                    <input type="hidden" name="id" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="primary-form-group">
                                <div class="primary-form-group-wrap">
                                    <label class="form-label">{{ __('Status') }}</label>
                                    <select class="form-select flex-shrink-0" name="payment_status">
                                        <option selected value="{{STATUS_ACTIVE}}">{{ __('Paid') }}</option>
                                        <option value="{{PAYMENT_STATUS_CANCELLED}}">{{ __('Cancelled') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="submit"
                                class="m-0 fs-15 border-0 fw-500 lh-25 py-10 px-26 bg-7f56d9 bd-ra-12">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <input type="hidden" id="ordersStatusRoute" value="{{ route('saas.super_admin.subscriptions.orders.payment.status') }}">
    <input type="hidden" id="ordersGetInfoRoute" value="{{ route('saas.super_admin.subscriptions.orders.get.info') }}">
@endsection


@push('script')
    <script src="{{ asset('super_admin/custom-js/orders.js') }}"></script>
@endpush
