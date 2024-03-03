@php
    $newCoins = App\Models\Currency::active()
        ->crypto()
        ->orderByRank()
        ->with('marketData')
        ->take(4)
        ->get();
@endphp

<div class="market-overview-card">
    <div class="market-overview-card__header">
        <h6 class="mb-2">@lang('New Coin')</h6>
    </div>
    <div class="market-overview-card__list">
        @forelse ($newCoins as $newCoin)
            <div class="market-overview-card__item">
                <span class="coin-name">
                    <img src="{{ @$newCoin->image_url }}">
                    {{ @$newCoin->symbol }}
                </span>
                <span class="coin-text">
                    <span class="market-price-symbol-{{@$newCoin->merketData->id}} {{ @$newCoin->merketData->html_classes->price_change }}">
                        {{ $general->cur_sym }}
                    </span><span class="market-price-{{@$newCoin->merketData->id}} {{ @$newCoin->merketData->html_classes->price_change }}">
                        {{ showAmount(@$newCoin->marketData->price) }}
                    </span>
                </span>
                <span class="coin-percentage">
                    <span
                        class="market-percent-change-1h-{{ @$newCoin->marketData->id }} {{ @$newCoin->html_classes->percent_change_1h }}">
                        {{ getAmount(@$newCoin->marketData->percent_change_1h) }}%
                    </span>
                </span>
            </div>
        @empty
            <div class="empty-thumb text-center">
                <img src="{{ asset('assets/empty.png') }}" />
                <p class="fs-14">@lang('No coin found')</p>
            </div>
        @endforelse
    </div>
</div>
