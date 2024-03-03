@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <form action="{{ route('admin.coin.pair.save',@$coinPair->id) }}" method="POST" enctype="multipart/form-data" class="pair-form">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group position-relative" id="currency_list_wrapper">
                                        <label>@lang('Coin')</label>
                                        <x-currency-list name="coin" :type="Status::CRYPTO_CURRENCY"/>
                                    </div>
                                 </div>
                                <div class="form-gropup col-sm-6" id="market-list">
                                    <label>@lang('Market')</label>
                                    <select class="form-control select2-basic" required name="market">
                                        <option selected disabled>@lang('Select One')</option>
                                        @php
                                            $selecetdMarketId=old('market',@$coinPair->market_id) ? old('market',@$coinPair->market_id) :(request()->market_id ?? '');
                                        @endphp
                                        @foreach ($markets as $market)
                                        <option value="{{ $market->id }}" data-cur-sym="{{ $market->currency->symbol }}" @selected($market->id == $selecetdMarketId)>
                                            {{ __($market->name) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>@lang('Minimum Buy Amount')</label>
                                    <small title="@lang('The minimum buy amount is the smallest quantity required to buy coin on this pair.')"><i class="las la-info-circle"></i></small>
                                    <div class="input-group appnend-coin-sym">
                                        <input type="number" step="any" class="form-control" name="minimum_buy_amount" value="{{ old('minimum_buy_amount',@$coinPair->minimum_buy_amount) }}" required >
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>@lang('Maximum Buy Amount')</label>
                                    <small title="@lang('The maximum buy amount is the highest quantity of coin to buy on this pair. Use -1 for no maximum limit.')"><i class="las la-info-circle"></i></small>
                                    <div class="input-group appnend-coin-sym">
                                        <input type="number" step="any" class="form-control" name="maximum_buy_amount" value="{{ old('maximum_buy_amount',@$coinPair->maximum_buy_amount) }}" required >
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>@lang('Minimum Sell Amount')</label>
                                    <small title="@lang('The minimum sell amount is the smallest quantity required to sell coin on this pair.')"><i class="las la-info-circle"></i></small>
                                    <div class="input-group appnend-coin-sym">
                                        <input type="number" step="any" class="form-control" name="minimum_sell_amount" value="{{ old('minimum_sell_amount',@$coinPair->minimum_sell_amount) }}" required >
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>@lang('Maximum Sell Amount')</label>
                                    <small title="@lang('The maximum sell amount is the highest quantity of coin to sell on this pair. Use -1 for no maximum limit.')"><i class="las la-info-circle"></i></small>
                                    <div class="input-group appnend-coin-sym">
                                        <input type="number" step="any" class="form-control" name="maximum_sell_amount" value="{{ old('maximum_sell_amount',@$coinPair->maximum_sell_amount) }}" required >
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>@lang('Percent Charge For Buy')</label>
                                    <small title="@lang('Set applicable percent charge for the buy of coin on this pair.')"><i class="las la-info-circle"></i></small>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="percent_charge_for_buy" value="{{ getAmount(old('percent_charge_for_buy',@$coinPair->percent_charge_for_buy)) }}" required >
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>@lang('Percent Charge For Sell')</label>
                                    <small title="@lang('Set applicable percent charge for the sell of coin on this pair.')"><i class="las la-info-circle"></i></small>
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="percent_charge_for_sell" value="{{ getAmount(old('percent_charge_for_sell',@$coinPair->percent_charge_for_sell)) }}" required >
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>@lang('Listed Market')</label>
                                    <input type="text" class="form-control" name="listed_market_name"  value="{{ old('listed_market_name',@$coinPair->listed_market_name) }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputName">@lang('Default Pair')</label>
                                    <input type="checkbox" @checked(@$coinPair->is_default) data-width="100%" data-height="40px" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('YES')" data-off="@lang('NO')" name="is_default">
                                </div>
                            </div>
                            <button type="submit" class="btn btn--primary w-100 h-45 ">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a  href="{{ route('admin.coin.pair.list') }}" class="btn btn-outline--primary btn-sm">
        <i class="las la-list"></i>@lang('Coin Pair List')
    </a>
@endpush

@push('script')
    <script>
        "use strict";
        (function ($) {

            @if(@$coinPair)
                let newOption = new Option("{{@$coinPair->coin->symbol}}-{{@$coinPair->coin->name }}","{{ @$coinPair->coin_id }}", true, true);
                $('#currency_list').append(newOption).trigger('change');
                $("select[name=coin]").attr('readonly',true);
                coinSym("{{ @$coinPair->coin->symbol }}");
            @endif

            $('select[name=coin]').on('change',function (e) {
                let coin   = $(this).find('option:selected').text().split('-');
                let symbol = coin.pop();
                coinSym(symbol)
            });

            function coinSym(coinSym) {
                $.each($('.appnend-coin-sym'), function (i, element) {
                    let symbolHtml = $(element).find('.input-group-text');
                    if(symbolHtml.length){
                        symbolHtml.text(coinSym)
                    }else{
                        $(element).append(`<span class="input-group-text">${coinSym}</span>`)
                    }
                });
            };
        })(jQuery);
    </script>
@endpush


@push('style')
    <style>
        .select2-container {
            z-index: 99 !important;
        }
    </style>
@endpush
