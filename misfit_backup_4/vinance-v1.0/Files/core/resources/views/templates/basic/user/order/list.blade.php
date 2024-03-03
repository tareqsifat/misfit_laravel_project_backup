@extends($activeTemplate.'layouts.master')
@section('content')
<div class="row justify-content-end gy-3">
 <div class="col-12">
        <div class="dashboard-header-menu justify-content-between">
           <div class="div">
                <a href="{{ route('user.order.open') }}" class="dashboard-header-menu__link   {{ menuActive('user.order.open')}}">@lang('Open')</a>
                <a href="{{ route('user.order.completed') }}" class="dashboard-header-menu__link   {{ menuActive('user.order.completed')}}">@lang('Completed')</a>
                <a href="{{ route('user.order.canceled') }}" class="dashboard-header-menu__link   {{ menuActive('user.order.canceled')}}">@lang('Canceled')</a>
                <a href="{{ route('user.order.history') }}" class="dashboard-header-menu__link   {{ menuActive('user.order.history')}}">@lang('History')</a>
           </div>
            <form class="d-flex gap-2 flex-wrap">
                <div  class="flex-fill">
                    <div class="input-group">
                       <select name="order_type" class="form-control form--control submit-form-on-change form-select">
                            <option value="" selected disabled>@lang('Order Type')</option>
                            <option value="">@lang('All')</option>
                            <option value="{{ Status::ORDER_TYPE_LIMIT }}" @selected(request()->order_type ==  Status::ORDER_TYPE_LIMIT)>
                                @lang('Limit')
                            </option>
                            <option value="{{ Status::ORDER_TYPE_MARKET }}" @selected(request()->order_type ==  Status::ORDER_TYPE_MARKET)>@lang('Market')</option>
                       </select>
                    </div>
                </div>
                <div class="flex-fill">
                   <select class="form-control form--control submit-form-on-change form-select" name="order_side">
                        <option value="" selected disabled>@lang('Order Side')</option>
                        <option value="">@lang('All')</option>
                        <option value="{{ Status::BUY_SIDE_ORDER }}" @selected(request()->order_side ==  Status::BUY_SIDE_ORDER)>@lang('Buy')</option>
                        <option value="{{ Status::SELL_SIDE_ORDER }}" @selected(request()->order_side ==  Status::SELL_SIDE_ORDER)>@lang('Sell')</option>
                   </select>
                </div>
                <div class="flex-fill">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form--control" value="{{ request()->search }}" placeholder="@lang('Pair,coin,currency...')">
                        <button type="submit" class="input-group-text bg--primary text-white">
                            <i class="las la-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
   </div>
    <div class="col-lg-12">
        <div class="table-wrapper">
            <table class="table table--responsive--lg">
                @php
                    $actionShow=request()->routeIs('user.order.open') || request()->routeIs('user.order.history') ;
                @endphp
                <thead>
                    <tr>
                        <th>@lang('Date | Pair')</th>
                        <th>@lang('Side | Type')</th>
                        <th>@lang('Amount | Rate')</th>
                        <th>@lang('Total')</th>
                        <th>@lang('Filled')</th>
                        <th>@lang('Status')</th>
                        @if ($actionShow)
                        <th>@lang('Action')</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="tr-{{ $order->id}}">
                        <td>
                            <div>
                                {{ $order->formatted_date}}
                                <br>
                                {{ @$order->pair->symbol }}
                            </div>
                        </td>
                        <td>
                            <div>
                                @php echo $order->orderSideBadge; @endphp <br>
                                @php echo $order->orderTypeBadge; @endphp
                            </div>
                        </td>
                        <td>
                            <div>
                                <span class="order-amount"> {{ showAmount($order->amount) }}  </span> {{ @$order->pair->coin->symbol }}  <br>
                                {{ showAmount($order->rate) }} {{ @$order->pair->market->currency->symbol }}
                            </div>
                        </td>
                        <td>
                            <div>
                                <span> {{ showAmount($order->total) }}</span>
                                {{ @$order->pair->market->currency->symbol }}
                            </div>
                        </td>
                        <td>
                            <div class="progress-wrapper">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ getAmount($order->filed_percentage) }}%;" aria-valuenow=" {{ getAmount($order->filed_percentage) }}">
                                    </div>
                                </div>
                               <span class="fs-10">
                                    <span>{{ getAmount($order->filed_percentage) }}%</span> |
                                    <span>{{ showAmount($order->filled_amount) }}</span>
                               </span>
                            </div>
                        </td>

                        <td> @php echo $order->statusBadge; @endphp </td>
                        @if ($actionShow)
                        <td>
                            @if ($order->status == Status::ORDER_OPEN)
                            @php
                                $backAmount    = $order->amount-$order->filled_amount;
                                $cancelMessage = __("Are you sure to cancel this order? after cancelling the order you will get ");
                                if($order->order_side==Status::BUY_SIDE_ORDER){
                                    $symbol            = @$order->pair->market->currency->symbol;
                                    $duePercentage     = ($backAmount / $order->amount) * 100;
                                    $chargeBackAmount  = ($order->charge / 100) * $duePercentage;
                                    $amount            = ($backAmount * $order->rate) + $chargeBackAmount;

                                    $cancelMessage    .= showAmount($amount) . __("  $symbol to your $symbol wallet");
                                }else{
                                    $symbol         = @$order->pair->coin->symbol;
                                    $cancelMessage .= showAmount($backAmount) . __("  $symbol to your $symbol wallet");
                                }
                            @endphp
                           <div>
                                <button type="button" class="btn btn--base outline btn--sm editBtn" data-order='@json($order->only('amount','rate','id'))'
                                    data-coin-symbol="{{@$order->pair->coin->symbol}}" data-currency-symbol="{{@$order->pair->market->currency->symbol}}" >
                                    <i class="la la-pencil"></i> @lang('Edit')
                                </button>
                                <button type="button" class="btn btn--danger btn--cancel outline btn--sm confirmationBtn ms-2" data-question="{{ $cancelMessage }}" data-action="{{ route('user.order.cancel',$order->id) }}">
                                    <i class="las la-times-circle"></i> @lang('Cancel')
                                </button>
                           </div>
                           @endif
                        </td>
                        @endif
                    </tr>
                    @empty
                        @php echo userTableEmptyMessage('order') @endphp
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($orders->hasPages())
            {{ paginateLinks($orders) }}
        @endif
     </div>
    </div>
</div>
<x-confirmation-modal isCustom="true"/>


<div class="offcanvas offcanvas-end p-5" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h4 class="mb-0 fs-18 offcanvas-title">
            @lang('Update Order')
        </h4>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fa fa-times-circle"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form  method="post" class="update-form">
            @csrf
            <div class="form-group">
                <label class="form-label">@lang('Rate')</label>
                <div class="input-group">
                    <input type="number" step="any" class="form--control form-control" name="rate" required>
                    <span class="input-group-text text-white order-currency-symbol"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">@lang('Amount')</label>
                <div class="input-group">
                    <input type="number" step="any" class="form--control form-control" name="amount" required>
                    <span class="input-group-text text-white order-coin-symbol"></span>
                </div>
            </div>

            <button type="submit" class="deposit__button btn btn--base w-100">
                @lang('Update')
            </button>
        </form>
    </div>
</div>


@endsection


@push('script')
    <script>
        "use strict";
        (function ($) {

            $('.editBtn').on('click',function(e){
                let order          = $(this).data('order');
                let coinSymbol     = $(this).data('coin-symbol');
                let currencySymbol = $(this).data('currency-symbol');
                let action         = "{{ route('user.order.update',':id') }}";

                $('.order-coin-symbol').text(coinSymbol);
                $('.order-currency-symbol').text(currencySymbol);

                $('.offcanvas input[name=amount]').val(getAmount(order.amount));
                $('.offcanvas input[name=rate]').val(getAmount(order.rate));
                $('.offcanvas .update-form').attr('action',action.replace(':id',order.id));

                var myOffcanvas = document.getElementById('offcanvas');
                var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas).show();
            });

            $('.update-form').on('submit',function(e){
                e.preventDefault();
                let formData = new FormData($(this)[0]);
                let action   = $(this).attr('action');
                let token    = $(this).find('input[name=_token]');
                let $this    = $(this);
                $.ajax({
                    headers    : {'X-CSRF-TOKEN': token},
                    url        : action,
                    method     : "POST",
                    data       : formData,
                    cache      : false,
                    contentType: false,
                    processData: false,
                    beforeSend : function () {
                       $($this).find('button[type=submit]').html(`<i class="fa fa-spinner fa-spin"></i>`);
                       $($this).attr(`disabled`,true);
                    },
                    complete:function(){
                        $($this).find('button[type=submit]').html(`@lang('Submit')`);
                        $($this).attr(`disabled`,false);
                    },
                    success: function (resp) {
                        if(resp.success){
                            $(`.tr-${resp.data.order_id}`).find('.order-amount').text(resp.data.order_amount);
                            notify('success',resp.message);
                            $('.offcanvas').find(`.btn-close`).trigger('click');
                        }else{
                            notify('error',resp.message);
                        }
                    },
                });
            });
        })(jQuery);
    </script>
@endpush

@push('topContent')
    <h4 class="mb-4">{{ __($pageTitle) }}</h4>
@endpush
