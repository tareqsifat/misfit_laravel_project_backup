@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            @php
                                $showStatus = request()->routeIs('admin.order.history');
                            @endphp
                            <thead>
                                <tr>
                                    <th>@lang('Date | Pair')</th>
                                    <th>@lang('Order Side')</th>
                                    <th>@lang('Order Type')</th>
                                    <th>@lang('Amount | Rate')</th>
                                    <th>@lang('Total')</th>
                                    <th>@lang('Filled')</th>
                                    @if ($showStatus)
                                        <th>@lang('Status')</th>
                                    @endif
                                    
                                    <th>Send Commission</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $order->formatted_date }}
                                                <br>
                                                {{ @$order->pair->symbol }}
                                            </div>
                                        </td>
                                        <td> @php echo $order->orderSideBadge; @endphp </td>
                                        <td> @php echo $order->orderTypeBadge; @endphp </td>
                                        <td>
                                            <div>
                                                {{ showAmount($order->amount) }} {{ @$order->pair->coin->symbol }} <br>
                                                {{ showAmount($order->rate) }} {{ @$order->pair->market->currency->symbol }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ showAmount($order->amount) }} {{ @$order->pair->coin->symbol }}
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{ getAmount($order->filed_percentage) }}%;"
                                                        aria-valuenow="{{ getAmount($order->filed_percentage) }} ">
                                                    </div>
                                                </div>
                                                <span class="fs-10">
                                                    <small>{{ getAmount($order->filed_percentage) }}%</small> |
                                                    <small>{{ showAmount($order->filled_amount) }}
                                                        {{ @$order->pair->coin->symbol }}
                                                    </small>
                                                </span>
                                            </div>
                                        </td>
                                        @if ($showStatus)
                                            <td> @php echo $order->statusBadge; @endphp </td>
                                        @endif
                                        @if ($order->status != 1)
                                            <td>
                                                <button onclick="showComissionModal({{ $order }})" class="btn btn-primary btn-sm">Send commission</button>
                                            </td>
                                        @else 
                                            <td>
                                                <button class="btn btn-primary btn-sm" disabled>Send commission</button>
                                            </td>
                                        @endif
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($orders->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($orders) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
     <div id="seminar_modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Send Comssion</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-8 mx-auto">
                        @php 
                            $order_ids = $orders->where('status', '!=', 1)->pluck('id');
                        @endphp
                        
                        <form class="mb-3" id="seminar_form" method="POST" action="{{ route('admin.order.send_comission') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Comission amount: </label>
                                <input type="text" name="amount" class="form-control" id="name">
                            </div>
                            @foreach($order_ids as $id)
                                <input type="hidden" name="order_ids[]" value="{{ $id }}">
                            @endforeach

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <div class="d-flex flex-wrap gap-2 justify-content-between">
        <x-search-form placeholder="Pair,coin,currency..." />
        <form>
            <div class="input-group">
                <select name="order_side" class="form-control">
                    <option value="">@lang('Order Side')</option>
                    <option value="{{ Status::BUY_SIDE_ORDER }}">@lang('Buy')</option>
                    <option value="{{ Status::SELL_SIDE_ORDER }}">@lang('Sell')</option>
                </select>
                <button class="btn btn--primary input-group-text" type="submit"><i class="la la-search"></i></button>
            </div>
        </form>
        <button onclick="showComissionModal({{ $order }})" class="btn btn-primary btn-sm">Send commission</button>
    </div>
    

@endpush

@push('script')
    <script>
        "use strict";
        (function($) {

            $(`select[name=order_side]`).on('change', function(e) {
                $(this).closest('form').submit();
            });

            @if (request()->order_side)
                $(`select[name=order_side]`).val("{{ request()->order_side }}");
            @endif ()

        })(jQuery);
    </script>
    <script>
    var seminar_modal = new bootstrap.Modal(document.getElementById('seminar_modal'));

    function showComissionModal(order) {
        window.order_id = order.id;
        document.getElementById('seminar_form').reset();
        seminar_modal.toggle();
        // console.log(seminar);
    }

    // function comissionSubmit(event) {
    //     event.preventDefault();
    //     let formData = new FormData(event.target);
    //     formData.append("order_id", window.order_id);
    //     // console.log('form submitting!');
    //     var url = '{{ route("admin.order.send_comission") }}';
    //     fetch(url, {
    //         method: "POST",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         body: formData
    //     }).then(async res => {
    //         let response = {}
    //         response.status = res.status
    //         response.data = await res.json();
    //         return response;
    //     }).then(res => {
    //         if (res.status === 200) {
                
    //             // window.toaster("Registration for the seminar submitted!");
    //             seminar_modal.toggle();
    //             document.getElementById('seminar_form').reset();
    //             location.reload();
    //             // location.href = "/order-complete";
    //         }
    //     })
    // }
</script>
@endpush


@push('style')
    <style>
        .progress {
            height: 9px;
        }
    </style>
@endpush
