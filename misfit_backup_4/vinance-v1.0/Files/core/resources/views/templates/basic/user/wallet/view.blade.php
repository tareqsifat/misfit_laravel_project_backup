@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="row gy-3 justify-content-center mb-3">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap flex-between align-items-center">
                <h4 class="mb-0">{{ __($pageTitle) }}</h4>
                <a href="{{ route('user.wallet.list') }}" class="btn btn--base btn--sm outline">
                    <i class="la la-undo"></i> @lang('Back')
                </a>
            </div>
        </div>
    </div>
    <div class="row gy-3 mb-3 justify-content-center">
        <div class="col-xxl-3 col-sm-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="dashboard-card__icon text--base fs-50 icon-order"></span>
                    <div class="dashboard-card__content">
                        <a href="{{ route('user.order.history') }}?search={{ @$wallet->currency->symbol }}" class="dashboard-card__coin-name mb-0">
                            @lang('Total Order')
                        </a>
                        <h6 class="dashboard-card__coin-title">
                            {{ getAmount($widget['total_order']) }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="dashboard-card__icon text--base fs-50 icon-deposit"></span>
                    <div class="dashboard-card__content">
                        <a href="{{ route('user.deposit.history') }}" class="dashboard-card__coin-name mb-0">
                            @lang('Total Deposit')
                        </a>
                        <h6 class="dashboard-card__coin-title">
                            {{ showAmount($widget['total_deposit']) }} {{ @$wallet->currency->symbol }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="dashboard-card__icon text--base fs-50 icon-withdraw">
                    </span>
                    <div class="dashboard-card__content">
                        <a href="{{ route('user.withdraw.history') }}" class="dashboard-card__coin-name mb-0 ">
                            @lang('Total Withdraw')
                        </a>
                        <h6 class="dashboard-card__coin-title">
                            {{ showAmount($widget['total_withdraw']) }} {{ @$wallet->currency->symbol }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-sm-6">
            <div class="dashboard-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="dashboard-card__icon text--base fs-50 icon-transaction"></span>
                    <div class="dashboard-card__content">
                        <a href="{{ route('user.transactions') }}" class="dashboard-card__coin-name mb-0">
                            @lang('Total Transaction')
                        </a>
                        <h6 class="dashboard-card__coin-title">
                            {{ showAmount($widget['total_transaction']) }} {{ @$wallet->currency->symbol }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gy-3 mb-3 justify-content-center">
        <div class="col-lg-12 col-xl-4">
            <div class="card border-0 mb-3">
                <div class="card-body">
                    <div class="wallet-currency text-center mb-3">
                        <img src="{{ @$wallet->currency->image_url }}">
                        <div class="">
                            <p class="mb-0 fs-16">{{ __(@$wallet->currency->name) }}</p>
                            <p class="mt-0 fs-12">{{ __(@$wallet->currency->symbol) }}</p>
                        </div>
                    </div>
                    <div class="wallet-ballance p-3 mb-3">
                        <p class="mb-0 fs-16">{{ showAmount($wallet->balance) }}</p>
                        <p class="mt-0 fs-12">@lang('Available Balance')</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <div class="flex-fill wallet-ballance p-3 mt-3">
                            <p class="mb-0 fs-16">{{ showAmount($wallet->on_order) }}</p>
                            <p class="mt-0 fs-12">@lang('On Order')</p>
                        </div>
                        <div class="flex-fill wallet-ballance p-3 mt-3 ">
                            <p class="mb-0 fs-16">{{ showAmount($wallet->total_balance) }}</p>
                            <p class="mt-0 fs-12">@lang('Total Balance')</p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn--base outline flex-fill btn--sm depositBtn">
                            <span class="icon-deposit"></span> @lang('Deposit')
                        </button>
                        <button type="button" class="btn btn--danger outline flex-fill btn--sm withdrawBtn">
                            <span class="icon-withdraw"></span> @lang('Withdraw')
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-8">
            <div class="card custom--card border-0">
                <div class="card-body p-0">
                    <h4 class="card-title">@lang('Transaction History')</h4>
                    <table class="table table--responsive--lg">
                        <thead>
                            <tr>
                                <th>@lang('Transacted')</th>
                                <th>@lang('Trx')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Post Balance')</th>
                                <th>@lang('Detail')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td>
                                        <div>
                                            {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $trx->trx }}</strong>
                                    </td>
                                    <td class="budget">
                                        <span
                                            class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                            {{ $trx->trx_type }} {{ showAmount($trx->amount) }}
                                            {{ __($trx->wallet->currency->symbol) }}
                                        </span>
                                    </td>
                                    <td class="budget"> {{ showAmount($trx->post_balance) }}
                                        {{ __($trx->wallet->currency->symbol) }}
                                    </td>
                                    <td>{{ __($trx->details) }}</td>
                                </tr>
                            @empty
                                @php echo userTableEmptyMessage('transaction') @endphp
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($transactions->hasPages())
                {{ paginateLinks($transactions) }}
            @endif
        </div>
    </div>

    <div class="offcanvas offcanvas-end p-3 p-md-5" tabindex="-1" id="offcanvas">
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
                <input type="hidden" name="currency" value="{{ @$wallet->currency->symbol }}">
                <div class="form-group">
                    <label class="form-label">@lang('Amount')</label>
                    <div class="input-group">
                        <input type="number" step="any" class="form--control form-control" name="amount" value="{{ old('amount') }}" required>
                        <span class="input-group-text text-white">{{ @$wallet->currency->symbol }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">@lang('Gateway')</label>
                    <select class="form-control form--control" name="gateway" required>
                        <option value="" selected disabled>@lang('Select One')</option>
                        @foreach ($gateways as $gateway)
                            <option value="{{ $gateway->method_code }}" @selected(old('gateway') == $gateway->id) data-gateway='@json($gateway)'>
                                {{ __($gateway->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group preview-details d-none">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Limit')</span>
                            <span><span class="min fw-bold">0</span> {{ __($general->cur_text) }}
                                - <span class="max fw-bold">0</span>
                                {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Charge')</span>
                            <span><span class="charge fw-bold">0</span>
                                {{ __($general->cur_text) }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Payable')</span> <span><span class="payable fw-bold">
                                    0</span> {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item justify-content-between d-none rate-element">

                        </li>
                        <li class="list-group-item justify-content-between d-none in-site-cur">
                            <span>@lang('In') <span class="method_currency"></span></span>
                            <span class="final_amo fw-bold">0</span>
                        </li>
                        <li class="list-group-item justify-content-center crypto_currency d-none">
                            <span>@lang('Conversion with') <span class="method_currency"></span>
                                @lang('and final value will Show on next step')</span>
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
            <form action="{{route('user.withdraw.money')}}" method="post">
                @csrf
                <input type="hidden" name="currency" value="{{ @$wallet->currency->symbol }}">
                <div class="form-group">
                    <label class="form-label">@lang('Method')</label>
                    <select class="form-control form--control" name="method_code" required>
                        <option value="">@lang('Select Gateway')</option>
                        @foreach($withdrawMethods as $data)
                            <option value="{{ $data->id }}"  @selected(old('method_code') == $data->id) data-resource="{{$data}}">  {{__($data->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">@lang('Amount')</label>
                    <div class="input-group">
                        <input type="number" step="any" name="amount" value="{{ old('amount') }}" class="form-control form--control" required>
                        <span class="input-group-text text-white">{{ @$wallet->currency->symbol }}</span>
                    </div>
                </div>
                <div class="mt-3 preview-details d-none">
                    <ul class="list-group text-center list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Limit')</span>
                            <span><span class="min fw-bold">0</span> {{__($general->cur_text)}} - <span class="max fw-bold">0</span> {{__($general->cur_text)}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Charge')</span>
                            <span><span class="charge fw-bold">0</span> {{__($general->cur_text)}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>@lang('Receivable')</span> <span><span class="receivable fw-bold"> 0</span> {{__($general->cur_text)}} </span>
                        </li>
                    </ul>
                </div>
                <button type="submit" class="btn btn--base w-100 mt-3">@lang('Submit')</button>
            </form>
        </div>
    </div>
@endsection


@push('script')
    <script>
        "use strict";
        (function($) {

            $('.depositBtn').on('click', function(e) {
                var myOffcanvas = document.getElementById('offcanvas');
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas).show();
            });

            $('.withdrawBtn').on('click', function(e) {
                var myOffcanvas = document.getElementById('withdraw-offcanvas');
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas).show();
            });

            $('#offcanvas').on('change', 'select[name=gateway]', function() {

                if (!$(this).val()) {
                    $('#offcanvas .preview-details').addClass('d-none');
                    return false;
                }

                var resource       = $('select[name=gateway] option:selected').data('gateway');
                var fixed_charge   = parseFloat(resource.fixed_charge);
                var percent_charge = parseFloat(resource.percent_charge);
                var rate           = parseFloat(resource.rate);

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
                var charge    = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                var payable   = parseFloat((parseFloat(amount) + parseFloat(charge))).toFixed(2);
                var final_amo = (parseFloat((parseFloat(amount) + parseFloat(charge))) * rate).toFixed(toFixedDigit);

                $('#offcanvas .charge').text(charge);
                $('#offcanvas .payable').text(payable);
                $('#offcanvas .final_amo').text(final_amo);

                if (resource.currency != '{{ $general->cur_text }}') {
                    var rateElement =
                        `<span class="fw-bold">@lang('Conversion Rate')</span> <span><span  class="fw-bold">1 {{ __($general->cur_text) }} = <span class="rate">${rate}</span>  <span class="method_currency">${resource.currency}</span></span></span>`;
                    $('#offcanvas .rate-element').html(rateElement)
                    $('#offcanvas .rate-element').removeClass('d-none');
                    $('#offcanvas .in-site-cur').removeClass('d-none');
                    $('#offcanvas .rate-element').addClass('d-flex');
                    $('#offcanvas .in-site-cur').addClass('d-flex');
                } else {
                    $('#offcanvas .rate-element').html('')
                    $('#offcanvas .rate-element').addClass('d-none');
                    $('#offcanvas .in-site-cur').addClass('d-none');
                    $('#offcanvas .rate-element').removeClass('d-flex');
                    $('#offcanvas .in-site-cur').removeClass('d-flex');
                }
                $('#offcanvas .method_currency').text(resource.currency);
                $('#offcanvas input[name=amount]').on('input');
            });

            $('#offcanvas').on('input', 'input[name=amount]', function() {
                var data = $('select[name=method_code]').change();
                $('#offcanvas .amount').text(parseFloat($(this).val()).toFixed(2));
            });

            $('#withdraw-offcanvas').on('change','select[name=method_code]',function(){

                if(!$(this).val()){
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
                if(amount <= 0){
                    $('#withdraw-offcanvas .preview-details').addClass('d-none');
                    return false;
                }
                $('#withdraw-offcanvas .preview-details').removeClass('d-none');

                var charge = parseFloat(fixed_charge + (amount * percent_charge / 100)).toFixed(2);
                $('#withdraw-offcanvas  .charge').text(charge);

                var receivable = parseFloat((parseFloat(amount) - parseFloat(charge))).toFixed(2);
                $('#withdraw-offcanvas .receivable').text(receivable);
                var final_amo = parseFloat(parseFloat(receivable)*rate).toFixed(toFixedDigit);
                $('#withdraw-offcanvas .final_amo').text(final_amo);
                $('#withdraw-offcanvas .base-currency').text(resource.currency);
                $('#withdraw-offcanvas .method_currency').text(resource.currency);
                $('#withdraw-offcanvas input[name=amount]').on('input');
            });

            $('#withdraw-offcanvas input[name=amount]').on('input',function(){
                var data = $('select[name=method_code]').change();
                $('#withdraw-offcanvas .amount').text(parseFloat($(this).val()).toFixed(2));
            });

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .wallet-currency img {
            width: 70px;
            border-radius: 50%;
            object-fit: cover;
        }

        .wallet-ballance {
            background-color: #09171a;
        }

    </style>
@endpush
