@php
    $meta = (object) $meta;
    $pair = @$meta->pair;
@endphp

<div class="trading-table two">
    <div class="flex-between trading-table__header">
        <div class="flex-between">
            <h4 class="trading-table__title mb-2">@lang('My Order')</h4>
            @auth
                <ul class="nav nav-pills mb-2 custom--tab" id="pills-tabtwenty" role="tablist">
                    <li class="nav-item order-status" data-status="all" role="presentation">
                        <button type="button" class="nav-link active" id="pills-allthree-tab">@lang('All')</button>
                    </li>
                    <li class="nav-item order-status" data-status="open" role="presentation">
                        <button type="button" class="nav-link" id="pills-openthree-tab"> @lang('Open') </button>
                    </li>
                    <li class="nav-item order-status" data-status="completed" role="presentation">
                        <button type="button" class="nav-link" id="pills-completedthree-tab"> @lang('Completed') </button>
                    </li>
                    <li class="nav-item order-status" data-status="canceled" role="presentation">
                        <button type="button" class="nav-link" id="pills-completedthree-tab"> @lang('Canceled') </button>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
    <div class="tab-content" id="pills-tabContenttwenty">
        <div class="tab-pane fade show active">
            <div class="table-wrapper-two">
                @auth
                    <table class="table table-two my-order-list-table">
                        <thead>
                            <tr>
                                <th>@lang('Pair') </th>
                                <th>@lang('Buy/Sell') </th>
                                <th>@lang('Amount') </th>
                                <th>@lang('Filled Amount') </th>
                                <th>@lang('Time') </th>
                                <th>@lang('Status') </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="order-list-body"></tbody>
                    </table>
                @else
                    <div class="empty-thumb">
                        <img src="{{ asset('assets/user.png') }}" />
                        <p class="empty-sell">@lang('Please login to explore your order')</p>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>


<x-confirmation-modal isCustom="true" />

@push('script')
    <script>
        "use strict";
        (function($) {
            let status = 'all';

            $('.order-status').on('click', function(e) {
                status = $(this).data('status');
                $('.order-status').find(`button`).removeClass('active');
                $(this).find(`button`).addClass('active');
                orderHistory();
            });

            function orderHistory() {
                let action        = "{{ route('trade.order.list', ':pairSym') }}";
                let cancelMessage = "@lang('Are you sure to cancel this order?')";
                let openStatus    = "{{ Status::ORDER_OPEN }}";
                let actionCancel  = "{{ route('user.order.cancel',':id') }}";
                $.ajax({
                    url: action.replace(':pairSym', "{{ @$pair->symbol }}"),
                    type: "GET",
                    dataType: 'json',
                    cache: false,
                    data: {
                        status
                    },
                    complete: function() {
                        setTimeout(() => {
                            $(`.my-order-list-table tr`).removeClass('skeleton');
                        }, 500);
                    },
                    success: function(resp) {
                        let html = ``;

                        if (!resp.success) {
                            notify('error', resp.message);
                            return
                        }
                        if (resp.orders.length > 0) {
                            $.each(resp.orders, function(i, order) {
                                html += `<tr class="skeleton">
                                        <td> ${order.pair.symbol.replace('_','/')} </td>
                                        <td>${order.order_side_badge}</td>
                                        <td>${getAmount(order.amount)} </td>
                                        <td>${getAmount(order.filled_amount)} </td>
                                        <td> ${order.formatted_date}</td>
                                        <td> ${order.status_badge.replaceAll('badge','text')} </td>
                                        <td>
                                            <div class="action-buttons ${parseInt(order.status) == parseInt(openStatus) ? '' : 'd-none'}">
                                                <button type="button" class="delete-icon p-0 m-0 confirmationBtn" data-question="${cancelMessage}" data-action="${actionCancel.replace(':id',order.id)}"><i class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                </tr>`
                            });
                        } else {
                            html += ` <tr class="text-center">
                                        <td colspan="100%">
                                            <div class="empty-thumb">
                                                <img src="{{ asset('assets/empty.png') }}"/>
                                                <p class="empty-sell">@lang('No order found')</p>
                                            </div>
                                        </td>
                                    </tr>
                                `
                        }
                        $('.order-list-body').html(html);
                    }
                });
            }

          
            orderHistory();

        })(jQuery);
    </script>
@endpush



@push('style')
    <style>
        .custom--modal .modal-content {
            background-color: #0d1e23 !important;
            border-radius: 10px !important;
        }

        .custom--modal .modal-title {
            color: hsl(var(--white)/0.5);
        }

        .custom--modal .modal-header, .custom--modal .modal-footer {
            border-color: hsl(var(--white)/0.2) !important;
        }
        .btn-dark,.btn-dark:hover,.btn-dark:focus{
            border-color: hsl(var(--white)/0.1) !important;
            color: #ffffff !important;
        }
    </style>
@endpush
