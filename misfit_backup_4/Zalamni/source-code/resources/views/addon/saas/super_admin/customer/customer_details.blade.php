@extends('super_admin.layouts.app')
@push('title')
    {{ $pageTitle }}
@endpush
@section('content')
    <!-- Page content area start -->
    <div class="px-24 pb-24 position-relative">
        <!-- Table -->
        <h4 class="fs-18 fw-600 lh-24 text-textBlack px-1 mt-20">{{ $pageTitle }}</h4>

        <div class="p-20 mt-20 bd-one bd-c-stroke-color bd-ra-12 bg-white overflow-hidden border-0">
            <div id="customersTable_wrapper" class="dataTables_wrapper no-footer">
                <div class="row rg-20">
                    <div class="col-md-4">
                        <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                            <div class=" mb-4">
                                <img src="{{ asset(getFileUrl($customer->image)) }}" alt="{{ $customer->name }}"/>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Current Domain')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6">
                                    <a class="fw-500 text-4cbf4c text-break">{{$customer->domain->domain}}</a>
                                </div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Name')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6 fw-500">{{$customer->name}}</div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Email')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6 fw-500 text-break">{{$customer->email}}</div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Mobile')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6 fw-500">{{$customer->mobile}}</div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Gender')}} :</div>
                                <div
                                    class="col-xl-7 col-md-auto col-sm-6 fw-500">{{$customer->alumni->gender?? __("No")}}</div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Address')}} :</div>
                                <div
                                    class="col-xl-7 col-md-auto col-sm-6 fw-500">{{$customer->alumni->address?? __("No")}}

                                </div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Email Verify')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6 fw-500">
                                    @if ($customer->email_verification_status == ACTIVE)
                                        {{__('Yes')}}
                                    @else
                                        {{__('NO')}}
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Mobile Verify')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6 fw-500">
                                    @if ($customer->phone_verification_status == ACTIVE)
                                        {{__('Yes')}}
                                    @else
                                        {{__('NO')}}
                                    @endif
                                </div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Join Date')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6 fw-500">
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $customer->created_at ?? now())->format('jS F, h:i:s A')}}
                                </div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Last Update')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6 fw-500">
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $customer->updated_at ?? now())->format('jS F, h:i:s A')}}
                                </div>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div class="col-xl-5 col-md-auto col-sm-6">{{__('Status')}} :</div>
                                <div class="col-xl-7 col-md-auto col-sm-6 fw-500">
                                    @if ($customer->status == ACTIVE)
                                        <span
                                            class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">{{__("Active")}}</span>
                                    @else
                                        <span
                                            class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">{{__("Deactivate")}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                            <h4 class="fs-18 fw-600 lh-24 text-textBlack px-1 pb-5 mb-3">{{__('Domain Information')}}</h4>
                            <table class="table align-middle mb-0 zTable" id="domain-information-list">
                                <thead>
                                <tr class="rounded-md">
                                    <th>
                                        <div class="text-nowrap bg-light fs-14 fw-500">{{__('Current Domain')}}</div>
                                    </th>
                                    <th>
                                        <div class="text-nowrap bg-light fs-14 fw-500">{{__('Requested Domain')}}</div>
                                    </th>
                                    <th>
                                        <div class="text-nowrap bg-light fs-14 fw-500">{{__('Status')}}</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($domainInformation as $item)
                                    <tr>
                                        <td class="border-bottom-0">
                                            {{$item->old_domain}}
                                        </td>
                                        <td class="border-bottom-0">
                                            {{$item->request_domain}}
                                        </td>
                                        <td class="border-bottom-0">
                                            @if ($item->status == STATUS_SUCCESS)
                                                <span
                                                    class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">{{__("Approved")}}</span>
                                            @elseif ($item->status == STATUS_PENDING)
                                                <span
                                                    class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">{{ __("Pending")}}</span>
                                            @elseif ($item->status == STATUS_REJECT)
                                                <span
                                                    class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">{{__("Reject")}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="border-0"></td>
                                        <td class="fs-13 pt-28 border-0">{{__('No Data Found')}}</td>
                                        <td class="border-0"></td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>

                        <!-- Table -->
                        <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30 mt-30">
                            <div class="customers__table">
                                <div class="table-responsive zTable-responsive">
                                    <h4 class="fs-18 fw-600 lh-24 text-textBlack px-1 pb-5 mb-3">{{__('Customer Transaction')}}</h4>

                                    <table class="able zTable" id="customerTransactionTable"
                                           aria-describedby="customersTable_info">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                                <div class="min-w-150">{{ __('Purpose') }}</div>
                                            </th>
                                            <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                                <div class="min-w-150">{{ __('Transaction ID') }}</div>
                                            </th>
                                            <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                                <div class="min-sm-w-100">{{ __('Method') }}</div>
                                            </th>
                                            <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                                <div class="min-sm-w-100">{{ __('Date and Time') }}</div>
                                            </th>
                                            <th scope="col" class="sorting_disabled" rowspan="1" colspan="1">
                                                <div class="min-w-150">{{ __('Amount') }}</div>
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
    </div>

    <!-- Page content area end -->
    <input type="hidden" id="customer-transaction-route"
           value="{{ route('saas.super_admin.customer_details', $customer->id) }}">
@endsection

@push('script')
    <script src="{{ asset('super_admin/custom-js/customer-transaction.js') }}"></script>
@endpush
