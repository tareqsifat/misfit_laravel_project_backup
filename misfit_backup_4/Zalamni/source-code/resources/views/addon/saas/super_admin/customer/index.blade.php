@extends('super_admin.layouts.app')
@push('title')
    {{ $pageTitle }}
@endpush
@section('content')
    <!-- Page content area start -->
    <div class="px-24 pb-24 position-relative">
        <!-- -->
        <div class="d-flex justify-content-between align-items-center g-10 flex-wrap pb-20">
            <div class="pt-25">
                <h4 class="fs-24 fw-500 lh-24 text-black">{{$pageTitle}}</h4>
            </div>
        </div>

        <!-- Table -->
        <div class="col-lg-12">
            <div class="col-md-12 bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <div class="customers__table">
                    <div class="table-responsive zTable-responsive">
                        <table class="able zTable" id="customersTable"
                               aria-describedby="customersTable_info">
                            <thead>
                                <tr>
                                    <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                        <div class="min-w-150">{{ __('Customer Name') }}</div>
                                    </th>
                                    <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                        <div class="min-w-150">{{ __('Domain') }}</div>
                                    </th>
                                    <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                        <div class="min-sm-w-100">{{ __('Emails') }}</div>
                                    </th>
                                    <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                        <div class="text-nowrap">{{ __('Registration Date') }}</div>
                                    </th>
                                    <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                        <div class="text-nowrap">{{ __('Current Plan') }}</div>
                                    </th>

                                    <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                        <div class="min-sm-w-100">{{ __('Status') }}</div>
                                    </th>
                                    <th scope="col" class="sorting_disabled text-center" rowspan="1" colspan="1">
                                        <div class="min-sm-w-100">{{ __('Action') }}</div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content area end -->

    <!-- Edit Modal section start -->
    <div class="modal fade zModalTwo" id="edit-modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content zModalTwo-content">

            </div>
        </div>
    </div>
    <!-- Edit Modal section end -->

    <input type="hidden" id="customer-list-route" value="{{ route('saas.super_admin.customer_list') }}">
@endsection

@push('script')
<script src="{{ asset('super_admin/custom-js/customer.js') }}"></script>
@endpush
