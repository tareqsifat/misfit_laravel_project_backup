@extends('layouts.app')
@push('title')
    {{ $title }}
@endpush
@section('content')
    <!-- Page content area start -->
    <div class="p-30">
        <div class="">
            <h4 class="fs-24 fw-500 lh-34 text-black pb-16">{{$title}}</h4>
            <div class="bg-white bd-half bd-c-ebedf0 bd-ra-25 p-30">
                <div class="rg-25 row">
                    <div class="col-md-6">
                        @if (!is_null($userPlan))
                            <div class="bd-c-black-5 bd-one bd-ra-12 mb-24 p-20 shadow-sm h-100">
                                <div class="card-header border-bottom-0">
                                    <div class="current-plan d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <p class="fs-14 fw-400 lh-18 text-para-text">{{ __('Current Package') }}</p>
                                            <h4 class="fs-18 fw-700 lh-28 text-para-text  text-capitalize">{{ $userPlan->package->name }}
                                                <small
                                                    class="small">/{{ $userPlan->subscription_type == SUBSCRIPTION_TYPE_MONTHLY ? __('Monthly') : __('Yearly') }}</small>
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0 ms-3">
                                            <button type="button"
                                                    class="bd-ra-12 bg-cdef84 border-0 fs-15 fw-500 hover-bg-one lh-25 px-26 py-10 text-black"
                                                    id="chooseAPlan"
                                                    title="{{ __('Upgrade Plan') }}">{{ __('Upgrade Plan') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="subscription-plan-box">
                                    <div class="card-body">
                                        <p class="fs-16 fw-400 lh-18 text-para-text pb-12">{{ __('Usage') }}</p>
                                        <div class="plan-usage-list">

                                            <div class="d-flex mb-2 align-items-center cg-10">
                                                <i class="fa fa-check" aria-hidden="true"></i>

                                                <h4 class="flex-grow-1 fs-18 fw-600 lh-28 text-para-text">
                                                    {{ $alumniUsed }} /
                                                    {{__($userPlan->package->alumni_limit == -1 ? 'Unlimited alumni manage' : $userPlan->package->alumni_limit.' '.'alumni manage') }}
                                                </h4>
                                            </div>
                                            <div class="d-flex mb-2 align-items-center cg-10">
                                                <i class="fa fa-check" aria-hidden="true"></i>

                                                <h4 class="flex-grow-1 fs-18 fw-600 lh-28 text-para-text">
                                                    {{ $eventUsed }} /
                                                    {{__($userPlan->package->event_limit == -1 ? 'Unlimited event manage' : 'Total'.' '.$userPlan->package->event_limit.' '.'event manage') }}
                                                </h4>
                                            </div>
                                            @if($userPlan->package->custom_domain)
                                            <div class="d-flex mb-2 align-items-center cg-10">
                                                <i class="fa fa-check" aria-hidden="true"></i>

                                                <h4 class="flex-grow-1 fs-18 fw-600 lh-28 text-para-text">
                                                    {{__('Custom domain support')}}
                                                </h4>
                                            </div>
                                            @endif

                                            @foreach(json_decode($userPlan->package->others) as $feature)
                                                <div class="d-flex mb-2 align-items-center cg-10">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                    <h4 class="flex-grow-1 fs-18 fw-600 lh-28 text-para-text">
                                                        {{ $feature }}
                                                    </h4>
                                                </div>
                                            @endforeach

                                            <div class="d-flex mb-2 align-items-center cg-10">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <h4 class="flex-grow-1 fs-18 fw-600 lh-28 text-para-text">
                                                <span class="h6">
                                                    {{ __('Started at ') }}
                                                </span>
                                                    {{ $userPlan->start_date }}
                                                </h4>
                                            </div>

                                            <div class="d-flex mb-2 align-items-center cg-10">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                                <h4 class="flex-grow-1 fs-18 fw-600 lh-28 text-para-text">
                                                    <span class="h6">{{ __('End in ') }}</span>
                                                    {{ $userPlan->end_date }}
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bd-c-black-5 bd-one bd-ra-12 mb-24 p-20 shadow-sm h-100">
                                <div class="card-body">
                                    <h4 class="mb-20">{{ __("Currently you doesn't have any subscription") }}</h4>
                                    <button type="button"
                                            class="bd-ra-12 bg-cdef84 border-0 fs-15 fw-500 hover-bg-one lh-25 px-26 py-10 text-black"
                                            id="chooseAPlan"
                                            title="{{ __('Choose a plan') }}">{{ __('Choose a plan') }}</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if (!is_null($userPlan))
                            <div class="bd-c-black-5 bd-one bd-ra-12 mb-24 p-20 shadow-sm h-100">
                                <div class="card-body mb-18">
                                    <form action="{{ route('admin.subscription.cancel') }}" method="post">
                                        @csrf
                                        <button type="button"
                                                class="bd-ra-12 bg-warning subscriptionCancel border-0 fs-15 fw-500 lh-25 px-26 py-10 text-black"
                                                title="{{ __('Cancel your subscription') }}">{{ __('Cancel your subscription') }}</button>
                                    </form>
                                </div>
                                <p class="pb-20 fs-16 fw-400 lh-18 text-para-text">
                                    {{ __('Please be aware that cancelling your subscription will cause you to lose all your saved content and earned words on your subscription.') }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="bd-c-black-5 bd-one bd-ra-12 mb-24 p-20 shadow-sm h-100">
                            <h4 class="fs-18 fw-600 lh-24 text-textBlack pb-16">{{ __('Package History') }}</h4>
                            <div class="table-responsive">
                                <table class="table zTable zTable-last-item-right">
                                    <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="min-w-120">{{ __('Package') }}</div>
                                        </th>
                                        <th scope="col">
                                            <div>{{ __('Total') }}</div>
                                        </th>
                                        <th scope="col">
                                            <div>{{ __('Start Date') }}</div>
                                        </th>
                                        <th scope="col">
                                            <div>{{ __('End Date') }}</div>
                                        </th>
                                        <th scope="col">
                                            <div>{{ __('Status') }}</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($packageHistories as $package)
                                        <tr>
                                            <td>{{ $package->packageName }}</td>
                                            <td>{{ showPrice($package->total ?? 0) }}</td>
                                            <td>{{ date('Y-m-d', strtotime($package->start_date)) }}</td>
                                            <td>{{ date('Y-m-d', strtotime($package->end_date)) }}</td>
                                            <td>
                                                @if ($package->status == STATUS_ACTIVE && $package->end_date >= now())
                                                    <div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-0fa958 bg-0fa958-10">{{__('Active')}}</div>
                                                @elseif ($package->status == STATUS_REJECT )
                                                    <div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-f5b40a bg-f5b40a-10">{{__('Rejected')}}</div>
                                                @else
                                                    <div class="d-inline-block py-6 px-10 bd-ra-6 fs-14 fw-500 lh-16 text-ea4335 bg-ea4335-10">{{__('Expired')}}</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="4">{{ __('No Data Found') }}</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bd-c-black-5 bd-one bd-ra-12 mb-24 p-20 shadow-sm h-100">
                            <h4 class="fs-18 fw-600 lh-24 text-textBlack pb-16">{{ __('Transaction History') }}</h4>
                            <div class="table-responsive">
                                <table class="table zTable zTable-last-item-right">
                                    <thead>
                                    <tr>
                                        <th scope="col">
                                            <div class="min-w-120">{{ __('Purpose') }}</div>
                                        </th>
                                        <th scope="col">
                                            <div>{{ __('Total') }}</div>
                                        </th>
                                        <th scope="col">
                                            <div>{{ __('Gateway') }}</div>
                                        </th>
                                        <th scope="col">
                                            <div>{{ __('Payment Time') }}</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($orderHistories as $order)
                                        <tr>
                                            <td>{{ $order->purpose }}</td>
                                            <td>{{ showPrice($order->amount ?? 0) }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->payment_time }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center " colspan="4">{{ __('No Data Found') }}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="choosePlanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bd-c-stroke-color bd-ra-12 py-25 px-20">
                <div class="d-flex justify-content-end align-items-center cg-10 pb-24">
                    <button type="button"
                            class="w-30 h-30 rounded-circle d-flex justify-content-center align-items-center bd-one bd-c-stroke-color bg-transparent"
                            data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/images/icon/close.svg') }}" alt=""/>
                    </button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
    <!-- Choose a plan Modal End -->

    @if (!is_null(request()->id))
        <input type="hidden" id="requestPlanId" value="{{ request()->id }}">
        <input type="hidden" id="gatewayResponse" value="{{ $gateways }}">
    @endif
    <input type="hidden" id="requestCurrentPlan" value="{{ request()->current_plan }}">
    <input type="hidden" id="chooseAPlanRoute" value="{{ route('admin.subscription.get.package') }}">
    <input type="hidden" id="getCurrencyByGatewayRoute" value="{{ route('admin.subscription.get.currency') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/subscription-user.js') }}"></script>
@endpush
