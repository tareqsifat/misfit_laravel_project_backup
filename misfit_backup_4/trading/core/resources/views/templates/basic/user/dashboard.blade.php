@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row justify-content-center gy-4">
        <div class=" col-xxl-9 col-lg-12">
            <div class="row gy-3">
                @php
                    $kycContent = getContent('kyc_content.content', true);
                @endphp
                @if ($user->kv == Status::KYC_UNVERIFIED)
                    <div class="col-12">
                        <div class="alert alert--danger skeleton" role="alert">
                            <h5 class="alert-heading text--danger mb-2">@lang('KYC Verification Required')</h5>
                            <p class="mb-0">
                                {{ __(@$kycContent->data_values->unverified_content) }}
                                <a href="{{ route('user.kyc.form') }}" class="text--base">@lang('Click here to verify')</a>
                            </p>
                        </div>
                    </div>
                @endif
                @if ($user->kv == Status::KYC_PENDING)
                    <div class="col-12">
                        <div class="alert alert--warning flex-column justify-content-start align-items-start skeleton"
                            role="alert">
                            <h5 class="alert-heading text--warning mb-2">@lang('KYC Verification Pending')</h5>
                            <p class="mb-0"> {{ __(@$kycContent->data_values->pending_content) }}
                                <a href="{{ route('user.kyc.data') }}" class="text--base">@lang('See KYC Data')</a>
                            </p>
                        </div>
                    </div>
                @endif
                @if (!$user->ts)
                    <div class="col-12">
                        <div class="alert-item 2fa-notice skeleton">
                            <span class="delete-icon skeleton" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Delete">
                                <i class="las la-times"></i></span>
                            <div class="alert flex-align alert--danger remove-2fa-notice" role="alert">
                                <span class="alert__icon">
                                    <i class="fas fa-exclamation"></i>
                                </span>
                                <div class="alert__content">
                                    <span class="alert__title">
                                        @lang('To secure your account add 2FA verification').
                                        <a href="{{ route('user.twofactor') }}"
                                            class="text--base text--small">@lang('Enable')</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="dashboard-card-wrapper">
                <div class="row gy-4 mb-3 justify-content-center">
                    
                    <div class="right-sidebar">
                        <div class="right-sidebar__header mb-3 skeleton">
                            <div class="d-flex flex-between flex-wrap">
                                <div>
                                    <h4 class="mb-0 fs-18">@lang('Wallet Overview')</h4>
                                    <p class="mt-0 fs-12">@lang('Available wallet balance including the converted total balance')</p>
                                </div>
                                <span class="toggle-dashboard-right dashboard--popup-close"><i class="las la-times"></i></span>
                            </div>
                        </div>
                        <div class="text-center mb-3 skeleton">
                            <h3 class="right-sidebar__number mb-0 pb-0">
                                {{ $general->cur_sym }}{{ showAmount($estimatedBalance) }}
                            </h3>
                            <span class="fs-14 mt-0">@lang('Estimated Total Balance')</span>
                        </div>
                        <div class="right-sidebar__menu ">
                            <div class="wallet-wrapper">
                                @forelse ($wallets as $wallet)
                                    <div class="right-sidebar__item flex-wrap wallet-list skeleton">
                                        <div class="d-flex align-items-center">
                                            <span class="right-sidebar__item-icon">
                                                <img src="{{ @$wallet->currency->image_url }}">
                                            </span>
                                            <h6 class="right-sidebar__item-name">
                                                {{ strLimit(@$wallet->currency->name,10) }}
                                                <span class="fs-11 d-block">
                                                    {{ @$wallet->currency->symbol }}
                                                </span>
                                            </h6>
                                        </div>
                                        <h6 class="right-sidebar__item-number"> {{ showAmount($wallet->balance) }} </h6>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <button type="button" class="w-100 show-more-wallet border-0 skeleton">
                                <span class="right-sidebar__button-icon">
                                    <i class="las la-chevron-circle-down"></i>@lang('Show More')
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="right-sidebar mt-3">
                        <div class="right-sidebar__header mb-3 skeleton">
                            <h4 class="mb-0 fs-18">@lang('Easy Deposit')</h4>
                            <p class="mt-0 fs-12">@lang('Make crypto & fiat deposits in a few steps')</p>
                        </div>
                        <div class="right-sidebar__deposit">
                            <form class="skeleton deposit-form">
                                <div class="form-group position-relative" id="currency_list_wrapper">
                                    <div class="input-group">
                                        <input type="number" step="any" name="amount" class="form--control form-control"
                                            placeholder="@lang('Amount')">
                                        <div class="input-group-text skeleton">
                                            <x-currency-list :action="route('user.currency.all')" valueType="2" />
                                        </div>
                                    </div>
                                </div>
                                <button class="deposit__button btn btn--base w-100" type="submit">
                                    <span class="icon-deposit"></span> @lang('Deposit')
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="right-sidebar mt-3">
                        <div class="right-sidebar__header mb-3 skeleton">
                            <h4 class="mb-0 fs-18">@lang('Withdraw Money')</h4>
                            <p class="mt-0 fs-12">@lang('Withdrawal your balance with our world-class withdrawal process')</p>
                        </div>
                        <div class="right-sidebar__deposit">
                            <form class="skeleton withdraw-form">
                                <div class="form-group position-relative" id="withdraw_currency_list_wrapper">
                                    <div class="input-group">
                                        <input type="number" name="amount" step="any" class="form--control form-control"
                                            placeholder="@lang('Amount')">
                                        <div class="input-group-text skeleton">
                                            <x-currency-list :action="route('user.currency.all')" id="withdraw_currency_list"
                                                parent="withdraw_currency_list_wrapper" valueType="2" />
                                        </div>
                                    </div>
                                </div>
                                <button class="deposit__button btn btn--base w-100" type="submit">
                                    <span class="icon-withdraw"></span> @lang('Withdraw')
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="col-xxl-3 col-sm-6">
                        <div class="dashboard-card skeleton">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="dashboard-card__icon text--base">
                                    <i class="las la-spinner"></i>
                                </span>
                                <div class="dashboard-card__content">
                                    <a href="{{ route('user.order.open') }}" class="dashboard-card__coin-name mb-0 ">
                                        @lang('Open Order') </a>
                                    <h6 class="dashboard-card__coin-title"> {{ getAmount($widget['open_order']) }} </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="dashboard-card skeleton">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="dashboard-card__icon text--success">
                                    <i class="las la-check-circle"></i>
                                </span>
                                <div class="dashboard-card__content">
                                    <a href="{{ route('user.order.completed') }}" class="dashboard-card__coin-name mb-0">
                                        @lang('Completed Order') </a>
                                    <h6 class="dashboard-card__coin-title"> {{ getAmount($widget['completed_order']) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="dashboard-card skeleton">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="dashboard-card__icon text--danger">
                                    <i class="las la-times-circle"></i>
                                </span>
                                <div class="dashboard-card__content">
                                    <a href="{{ route('user.order.canceled') }}" class="dashboard-card__coin-name mb-0 ">
                                        @lang('Canceled Order') </a>
                                    <h6 class="dashboard-card__coin-title"> {{ getAmount($widget['canceled_order']) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-sm-6">
                        <div class="dashboard-card skeleton">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="dashboard-card__icon text--base">
                                    <span class="icon-trade fs-50"></span>
                                </span>
                                <div class="dashboard-card__content">
                                    <a href="{{ route('user.trade.history') }}"
                                        class="dashboard-card__coin-name mb-0">@lang('Total Trade') </a>
                                    <h6 class="dashboard-card__coin-title"> {{ getAmount($widget['total_trade']) }} </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row gy-4 mb-3 justify-content-center">
                    <div class="col-lg-6">
                        <div class="transection h-100">
                            <h5 class="transection__title skeleton"> @lang('Recent Order') </h5>
                            @forelse ($recentOrders as $recentOrder)
                                <div class="transection__item skeleton">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="transection__date">
                                            <h6 class="transection__date-number text-white">
                                                {{ showDateTime($recentOrder->created_at, 'd') }}
                                            </h6>
                                            <span class="transection__date-text">
                                                {{ __(strtoupper(showDateTime($recentOrder->created_at, 'M'))) }}
                                            </span>
                                        </div>
                                        <div class="transection__content">
                                            <h6 class="transection__content-title">
                                                @php echo $recentOrder->orderSideBadge; @endphp
                                            </h6>
                                            <p class="transection__content-desc">
                                                @lang('Placed an order in the ')
                                                {{ @$recentOrder->pair->symbol }} @lang('pair to')
                                                {{ __(strtolower(strip_tags($recentOrder->orderSideBadge))) }}
                                                {{ showAmount($recentOrder->amount) }}
                                                {{ @$recentOrder->pair->coin->symbol }}
                                            </p>
                                        </div>
                                    </div>
                                    @php echo $recentOrder->statusBadge; @endphp
                                </div>
                            @empty
                                <div class="transection__item justify-content-center p-5 skeleton">
                                    <div class="empty-thumb text-center">
                                        <img src="{{ asset('assets/empty.png') }}" />
                                        <p class="fs-14">@lang('No order found')</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="transection h-100">
                            <h5 class="transection__title skeleton"> @lang('Recent Transactions') </h5>
                            @forelse ($recentTransactions as $recentTransaction)
                                <div class="transection__item skeleton">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="transection__date">
                                            <h6 class="transection__date-number text-white">
                                                {{ showDateTime($recentTransaction->created_at, 'd') }}
                                            </h6>
                                            <span class="transection__date-text">
                                                {{ __(strtoupper(showDateTime($recentTransaction->created_at, 'M'))) }}
                                            </span>
                                        </div>
                                        <div class="transection__content">
                                            <h6 class="transection__content-title">
                                                {{ __(ucwords(keyToTitle($recentTransaction->remark))) }}
                                            </h6>
                                            <p class="transection__content-desc">
                                                {{ __($recentTransaction->details) }}
                                            </p>
                                        </div>
                                    </div>
                                    @if ($recentTransaction->trx_type == '+')
                                        <span class="badge badge--success">
                                            @lang('Plus')
                                        </span>
                                    @else
                                        <span class="badge badge--danger">
                                            @lang('Minus')
                                        </span>
                                    @endif

                                </div>
                            @empty
                                <div class="transection__item justify-content-center p-5 skeleton">
                                    <div class="empty-thumb text-center">
                                        <img src="{{ asset('assets/empty.png') }}" />
                                        <p class="fs-14">@lang('No transactions found')</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class=" col-xxl-3">-->
        <!--    <div class="dashboard-right">-->
        <!--        <div class="right-sidebar">-->
        <!--            <div class="right-sidebar__header mb-3 skeleton">-->
        <!--                <div class="d-flex flex-between flex-wrap">-->
        <!--                    <div>-->
        <!--                        <h4 class="mb-0 fs-18">@lang('Wallet Overview')</h4>-->
        <!--                        <p class="mt-0 fs-12">@lang('Available wallet balance including the converted total balance')</p>-->
        <!--                    </div>-->
        <!--                    <span class="toggle-dashboard-right dashboard--popup-close"><i class="las la-times"></i></span>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="text-center mb-3 skeleton">-->
        <!--                <h3 class="right-sidebar__number mb-0 pb-0">-->
        <!--                    {{ $general->cur_sym }}{{ showAmount($estimatedBalance) }}-->
        <!--                </h3>-->
        <!--                <span class="fs-14 mt-0">@lang('Estimated Total Balance')</span>-->
        <!--            </div>-->
        <!--            <div class="right-sidebar__menu ">-->
        <!--                <div class="wallet-wrapper">-->
        <!--                    @forelse ($wallets as $wallet)-->
        <!--                        <div class="right-sidebar__item flex-wrap wallet-list skeleton">-->
        <!--                            <div class="d-flex align-items-center">-->
        <!--                                <span class="right-sidebar__item-icon">-->
        <!--                                    <img src="{{ @$wallet->currency->image_url }}">-->
        <!--                                </span>-->
        <!--                                <h6 class="right-sidebar__item-name">-->
        <!--                                    {{ strLimit(@$wallet->currency->name,10) }}-->
        <!--                                    <span class="fs-11 d-block">-->
        <!--                                        {{ @$wallet->currency->symbol }}-->
        <!--                                    </span>-->
        <!--                                </h6>-->
        <!--                            </div>-->
        <!--                            <h6 class="right-sidebar__item-number"> {{ showAmount($wallet->balance) }} </h6>-->
        <!--                        </div>-->
        <!--                    @empty-->
        <!--                    @endforelse-->
        <!--                </div>-->
        <!--                <button type="button" class="w-100 show-more-wallet border-0 skeleton">-->
        <!--                    <span class="right-sidebar__button-icon">-->
        <!--                        <i class="las la-chevron-circle-down"></i>@lang('Show More')-->
        <!--                    </span>-->
        <!--                </button>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="right-sidebar mt-3">-->
        <!--            <div class="right-sidebar__header mb-3 skeleton">-->
        <!--                <h4 class="mb-0 fs-18">@lang('Easy Deposit')</h4>-->
        <!--                <p class="mt-0 fs-12">@lang('Make crypto & fiat deposits in a few steps')</p>-->
        <!--            </div>-->
        <!--            <div class="right-sidebar__deposit">-->
        <!--                <form class="skeleton deposit-form">-->
        <!--                    <div class="form-group position-relative" id="currency_list_wrapper">-->
        <!--                        <div class="input-group">-->
        <!--                            <input type="number" step="any" name="amount" class="form--control form-control"-->
        <!--                                placeholder="@lang('Amount')">-->
        <!--                            <div class="input-group-text skeleton">-->
        <!--                                <x-currency-list :action="route('user.currency.all')" valueType="2" />-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <button class="deposit__button btn btn--base w-100" type="submit">-->
        <!--                        <span class="icon-deposit"></span> @lang('Deposit')-->
        <!--                    </button>-->
        <!--                </form>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="right-sidebar mt-3">-->
        <!--            <div class="right-sidebar__header mb-3 skeleton">-->
        <!--                <h4 class="mb-0 fs-18">@lang('Withdraw Money')</h4>-->
        <!--                <p class="mt-0 fs-12">@lang('Withdrawal your balance with our world-class withdrawal process')</p>-->
        <!--            </div>-->
        <!--            <div class="right-sidebar__deposit">-->
        <!--                <form class="skeleton withdraw-form">-->
        <!--                    <div class="form-group position-relative" id="withdraw_currency_list_wrapper">-->
        <!--                        <div class="input-group">-->
        <!--                            <input type="number" name="amount" step="any" class="form--control form-control"-->
        <!--                                placeholder="@lang('Amount')">-->
        <!--                            <div class="input-group-text skeleton">-->
        <!--                                <x-currency-list :action="route('user.currency.all')" id="withdraw_currency_list"-->
        <!--                                    parent="withdraw_currency_list_wrapper" valueType="2" />-->
        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <button class="deposit__button btn btn--base w-100" type="submit">-->
        <!--                        <span class="icon-withdraw"></span> @lang('Withdraw')-->
        <!--                    </button>-->
        <!--                </form>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    </div>

    <div class="offcanvas offcanvas-end p-5" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h4 class="mb-0 fs-18 offcanvas-title">
                @lang('Deposit Preview')
            </h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fa fa-times-circle"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('user.deposit.insert') }}" method="post">
                @csrf
                <input type="hidden" name="currency">
                <div class="form-group">
                    <label class="form-label">@lang('Amount')</label>
                    <div class="input-group">
                        <input type="number" step="any" class="form--control form-control" name="amount" required>
                        <span class="input-group-text text-white deposit-currency-symbol"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">@lang('Gateway')</label>
                    <select class="form-control form--control" name="gateway" required></select>
                </div>
                <div class="form-group preview-details d-none">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Limit')</span>
                            <span>
                                <span class="min fw-bold">0</span>
                                - <span class="max fw-bold">0</span>
                                <span class="deposit-currency-symbol"></span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Charge')</span>
                            <span>
                                <span class="charge fw-bold">0</span>
                                <span class="deposit-currency-symbol"></span>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span> @lang('Payable')</span>
                            <span>
                                <span class="payable fw-bold">0</span>
                                <span class="deposit-currency-symbol"></span>
                            </span>
                        </li>
                    </ul>
                </div>
                <button class="deposit__button btn btn--base w-100"> @lang('Submit') </button>
            </form>
        </div>
    </div>


    <div class="offcanvas offcanvas-end p-3 p-md-5" tabindex="-1" id="withdraw-offcanvas">
        <div class="offcanvas-header">
            <h4 class="mb-0 fs-18 offcanvas-title">
                @lang('Withdraw')
            </h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fa fa-times-circle"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('user.withdraw.money') }}"  method="post">
                @csrf
                <input type="hidden" name="currency">
                <div class="form-group">
                    <label class="form-label">@lang('Amount')</label>
                    <div class="input-group">
                        <input type="number" step="any" name="amount" value="{{ old('amount') }}"
                            class="form-control form--control" required>
                        <span class="input-group-text text-white withdraw-cur-sym">{{ @$wallet->currency->symbol }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">@lang('Method')</label>
                    <select class="form-control form--control" name="method_code" required></select>
                </div>
                <div class="mt-3 preview-details d-none">
                    <ul class="list-group text-center list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Limit')</span>
                            <span><span class="min fw-bold">0</span> {{ __($general->cur_text) }} - <span
                                    class="max fw-bold">0</span> {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Charge')</span>
                            <span><span class="charge fw-bold">0</span> {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Receivable')</span> <span><span class="receivable fw-bold"> 0</span>
                                {{ __($general->cur_text) }} </span>
                        </li>
                    </ul>
                </div>
                <button type="submit" class="btn btn--base w-100 mt-3">@lang('Submit')</button>
            </form>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush
@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script')
    <script>
        "use strict";
        (function($) {

            $('.2fa-notice').on('click', '.delete-icon', function(e) {
                $(this).closest('.col-12').fadeOut('slow', function() {
                    $(this).remove();
                });
            });

            let walletSkip = 3;

            $('.show-more-wallet').on('click', function(e) {
                let route = "{{ route('user.more.wallet', ':skip') }}";
                let $this = $(this);
                $.ajax({
                    url: route.replace(':skip', walletSkip),
                    type: "GET",
                    dataType: 'json',
                    cache: false,
                    beforeSend: function() {
                        $this.html(`
                        <span class="right-sidebar__button-icon">
                            <i class="las la-spinner la-spin"></i>
                        </span>`).attr('disabled', true);
                    },
                    complete: function(e) {
                        setTimeout(() => {
                            $this.html(`
                        <span class="right-sidebar__button-icon">
                            <i class="las la-chevron-circle-down"></i>
                        </span>@lang('Show More')`).attr('disabled', false);
                            $('.wallet-list').removeClass('skeleton');
                        }, 500);
                    },
                    success: function(resp) {
                        if (resp.success && (resp.wallets && resp.wallets.length > 0)) {
                            let html = "";
                            $.each(resp.wallets, function(i, wallet) {
                                html += `
                            <div class="right-sidebar__item wallet-list skeleton">
                                <div class="d-flex align-items-center">
                                    <span class="right-sidebar__item-icon">
                                        <img src="${wallet.currency.image_url}">
                                    </span>
                                    <h6 class="right-sidebar__item-name">
                                        ${wallet.currency.name}
                                        <span class="fs-11 d-block">
                                            ${wallet.currency.symbol}
                                        </span>
                                    </h6>
                                </div>

                                <h6 class="right-sidebar__item-number">${getAmount(wallet.balance)}</h6>
                            </div>
                            `
                            });
                            walletSkip += 3;
                            $('.wallet-wrapper').append(html);
                        } else {
                            notify('error', "@lang('No more wallet found')");
                            $this.remove();
                        }

                        $('.right-sidebar__menu').animate({
                            scrollTop: $('.right-sidebar__menu')[0].scrollHeight + 150
                        }, "slow");
                    },
                    error: function() {
                        notify('error', "@lang('something went to wrong')");
                        $this.remove();
                    }
                });
            });

            $('.deposit-form').on('submit', function(e) {
                e.preventDefault();
                let currency = $(this).find(`select[name=currency]`).val();
                let amount = $(this).find(`input[name=amount]`).val();

                if (!currency) {
                    notify('error', "@lang('Currency field is required')");
                    return false;
                }

                if (!amount) {
                    notify('error', "@lang('Amount field is required')");
                    return false;
                }

                let gateways = @json($gateways);
                let currencyGateways = gateways.filter(ele => ele.currency == currency);
                let gatewaysOption = "<option selected disabled> @lang('Select Payment Gateway')</option>";

                $.each(currencyGateways, function(i, currencyGateway) {
                    gatewaysOption += `
                    <option value="${currencyGateway.method_code}"  data-gateway='${JSON.stringify(currencyGateway)}'>
                            ${currencyGateway.name}
                    </option>`;
                });

                $("#offcanvas").find('select[name=gateway]').html(gatewaysOption);
                $("#offcanvas").find('.deposit-currency-symbol').text(currency);
                $("#offcanvas").find('input[name=currency]').val(currency);
                $("#offcanvas").find(`input[name=amount]`).val(amount);

                var myOffcanvas = document.getElementById('offcanvas');
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas).show();
            });

            $('#offcanvas').on('change', 'select[name=gateway]', function() {

                if (!$(this).val()) {
                    $('#offcanvas .preview-details').addClass('d-none');
                    return false;
                }

                var resource = $('select[name=gateway] option:selected').data('gateway');
                var fixed_charge = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate = parseFloat(resource.rate);

                if (resource.method.crypto == 1) {
                    var toFixedDigit = 8;
                    $('#offcanvas .crypto_currency').removeClass('d-none');
                } else {
                    var toFixedDigit = 2;
                    $('#offcanvas .crypto_currency').addClass('d-none');
                }
                $('#offcanvas .min').text(parseFloat(resource.min_amount).toFixed(2));
                $('#offcanvas .max').text(parseFloat(resource.max_amount).toFixed(2));

                var amount = parseFloat($('input[name=amount]').val());

                if (!amount) {
                    amount = 0;
                }
                if (amount <= 0) {
                    $('#offcanvas .preview-details').addClass('d-none');
                    return false;
                }
                $('#offcanvas .preview-details').removeClass('d-none');
                var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                var payable = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);
                var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge))) * rate).toFixed(
                    toFixedDigit);

                $('#offcanvas .charge').text(charge);
                $('#offcanvas .payable').text(payable);
                $('#offcanvas .final_amo').text(final_amo);


                $('#offcanvas .method_currency').text(resource.currency);
                $('#offcanvas input[name=amount]').on('input');
            });

            $('#offcanvas').on('input', 'input[name=amount]', function() {
                var data = $('select[name=gateway]').change();
                $('#offcanvas .amount').text(parseFloat($(this).val()).toFixed(2));
            });

            $('.withdraw-form').on('submit', function(e) {
                e.preventDefault();
                let currency = $(this).find(`select[name=currency]`).val();
                let amount = $(this).find(`input[name=amount]`).val();

                if (!currency) {
                    notify('error', "@lang('Currency field is required')");
                    return false;
                }

                if (!amount) {
                    notify('error', "@lang('Amount field is required')");
                    return false;
                }

                let withdrawMethods         = @json($withdrawMethods);
                let currencyWithdrawMethods = withdrawMethods.filter(ele => ele.currency == currency);
                let methodsOptions          = "<option selected disabled> @lang('Select Method')</option>";

                $.each(currencyWithdrawMethods, function(i, currencyWithdrawMethod) {
                    methodsOptions += `<option value="${currencyWithdrawMethod.id}" data-resource='${JSON.stringify(currencyWithdrawMethod)}'>
                            ${currencyWithdrawMethod.name}
                        </option>
                    `;
                });

                $("#withdraw-offcanvas").find('select[name=method_code]').html(methodsOptions);
                $('#withdraw-offcanvas .withdraw-cur-sym').text(currency);
                $('#withdraw-offcanvas input[name=currency]').val(currency);
                $('#withdraw-offcanvas input[name=amount]').val(amount);

                var myOffcanvas = document.getElementById('withdraw-offcanvas');
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas).show();

            });

            $('#withdraw-offcanvas').on('change', 'select[name=method_code]', function() {

                if (!$(this).val()) {
                    $('#withdraw-offcanvas .preview-details').addClass('d-none');
                    return false;
                }
                var resource       = $('select[name=method_code] option:selected').data('resource');
                var fixed_charge   = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate           = parseFloat(resource.rate)
                var toFixedDigit   = 2;

                $('#withdraw-offcanvas  .min').text(parseFloat(resource.min_limit).toFixed(2));
                $('#withdraw-offcanvas  .max').text(parseFloat(resource.max_limit).toFixed(2));
                var amount = parseFloat($('#withdraw-offcanvas input[name=amount]').val());
                if (!amount) {
                    amount = 0;
                }
                if (amount <= 0) {
                    $('#withdraw-offcanvas .preview-details').addClass('d-none');
                    return false;
                }
                $('#withdraw-offcanvas .preview-details').removeClass('d-none');

                var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                $('#withdraw-offcanvas  .charge').text(charge);

                var receivable = parseFloat((parseFloat(amount) - parseFloat(charge))).toFixed(2);
                $('#withdraw-offcanvas .receivable').text(receivable);
                var final_amo = parseFloat(parseFloat(receivable) * rate).toFixed(toFixedDigit);
                $('#withdraw-offcanvas .final_amo').text(final_amo);
                $('#withdraw-offcanvas .base-currency').text(resource.currency);
                $('#withdraw-offcanvas .method_currency').text(resource.currency);
                $('#withdraw-offcanvas input[name=amount]').on('input');
            });

            $('#withdraw-offcanvas input[name=amount]').on('input', function() {
                var data = $('select[name=method_code]').change();
                $('#withdraw-offcanvas .amount').text(parseFloat($(this).val()).toFixed(2));
            });

        })(jQuery);
    </script>
@endpush


@push('topContent')
    <h4 class="mb-4">{{ __($pageTitle) }}</h4>
@endpush
