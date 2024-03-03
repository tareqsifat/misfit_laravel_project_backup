@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--md  table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Currency')</th>
                                <th>@lang('Price')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($currencies as $currency)
                            <tr>
                                <td>
                                    <x-currency :currency=$currency/>
                                </td>
                                <td>
                                    @if ($type==Status::CRYPTO_CURRENCY)
                                        {{ $general->cur_sym }}{{ showAmount(@$currency->marketData->price) }}
                                    @else
                                        {{ $general->cur_sym }}{{ showAmount(@$currency->rate) }}
                                    @endif
                                </td>
                                <td> @php echo $currency->statusBadge; @endphp </td>
                                <td>
                                    <div class="button--group">
                                        <button type="button" class="btn btn-sm btn-outline--primary editBtn"
                                            data-currency='@json($currency)' data-image="{{ $currency->image_url }}">
                                            <i class="la la-pencil"></i>@lang('Edit')
                                        </button>
                                        @if($currency->status == Status::DISABLE)
                                        <button class="btn btn-sm btn-outline--success confirmationBtn"
                                            data-question="@lang('Are you sure to enable this currency')?"
                                            data-action="{{ route('admin.currency.status',$currency->id) }}">
                                            <i class="la la-eye"></i> @lang('Enable')
                                        </button>
                                        @else
                                        <button class="btn btn-sm btn-outline--danger confirmationBtn"
                                            data-question="@lang('Are you sure to disable this currency')?"
                                            data-action="{{ route('admin.currency.status',$currency->id) }}">
                                            <i class="la la-eye-slash"></i> @lang('Disable')
                                        </button>
                                        @endif
                                    </div>
                                </td>
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
            @if ($currencies->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($currencies) }}
            </div>
            @endif
        </div>
    </div>
</div>


<div id="modal" class="modal fade" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="las la-times"></i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="payment-method-item">
                                <div class="payment-method-header d-flex flex-wrap justify-content-center">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview"
                                                style="background-image: url({{ getImage('',getFileSize('currency')) }})">
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" name="image" class="profilePicUpload" id="image"
                                                accept=".png, .jpg, .jpeg">
                                            <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <input type="hidden" name="type" value="{{ $type }}">
                            <div class="form-group">
                                <label>@lang('Name')</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label>@lang('Symbol')</label>
                                <input type="text" class="form-control" name="symbol" value="{{ old('symbol') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>@lang('Price')</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" step="any" name="price"
                                        value="{{ old('price') }}" required>
                                    <span class="input-group-text">{{ __($general->cur_text) }}</span>
                                </div>
                            </div>
                            @if ($type == Status::CRYPTO_CURRENCY)
                            <div class="form-group">
                                <label>@lang('Highlight Coin')</label>
                                <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-on="@lang('YES')" data-off="@lang('NO')" name="is_highlighted_coin">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary w-100 h-45 ">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
<div class="d-flex flex-wrap gap-2 justify-content-between">
    <x-search-form placeholder="Name,Symbol...." />
    <button type="button" class="btn btn-outline--primary addBtn">
        <i class="las la-plus"></i>@lang('New Currency')
    </button>
</div>
@endpush

@push('script')
<script>
    "use strict";
    (function ($) {
        let modal = $('#modal');

        @if ($type == Status::CRYPTO_CURRENCY)
        $(`input[name=name]`).attr('placeholder', "@lang('e.g. Bitcoin')");
        $(`input[name=symbol]`).attr('placeholder', "@lang('e.g. BTC')");
        @else
        $(`input[name=name]`).attr('placeholder', "@lang('e.g. Us Dollar')");
        $(`input[name=symbol]`).attr('placeholder', "@lang('e.g. USD')");
        @endif

        $('.addBtn').on('click', function () {
            let action = `{{ route('admin.currency.save') }}`;
            $('.profilePicPreview').css({
                "background-image": "url({{ getImage('',getFileSize('currency')) }})"
            });
            modal.find('form').trigger('reset');
            modal.find('form').prop('action', action);
            modal.find('.modal-title').text("@lang('New Currency')");
            $(modal).modal('show');
        });

        $('input[name=symbol]').on('input', (e) => {
            let symbol = e.target.value.toUpperCase()
            let hasElement = $(`body`).find('.symbol-input-group-text');
            if (symbol) {
                if (hasElement.length) hasElement.text(`1 ${symbol} =`);
                else $('input[name=price]').closest('.input-group').prepend(`<span class="input-group-text symbol-input-group-text">1 ${symbol} =</span>`);
            } else {
                hasElement.remove();
            }
            e.target.value = symbol;
        });

        $('.editBtn').on('click', function (e) {
            let action = `{{ route('admin.currency.save',':id') }}`;
            let data = $(this).data('currency');
            let imagePath = $(this).data('image')
            $('.profilePicPreview').css({
                "background-image": `url(${imagePath})`
            });
            modal.find('form').prop('action', action.replace(':id', data.id))
            modal.find("input[name=name]").val(data.name);
            modal.find("input[name=symbol]").val(data.symbol);
            modal.find("input[name=rank]").val(data.rank);
            modal.find("input[name=price]").val(getAmount(data.rate));
            @if ($type == Status::CRYPTO_CURRENCY)
                if (data.highlighted_coin == 1) {
                    modal.find('input[name=is_highlighted_coin]').bootstrapToggle('on');
                } else {
                    modal.find('input[name=is_highlighted_coin]').bootstrapToggle('off');
                }
            @endif
            modal.find('.modal-title').text("@lang('Update Currency')");
            $('input[name=symbol]').trigger('input');
            $(modal).modal('show');
        });

        }) (jQuery);
</script>
@endpush

@push('style')
<style>
    .payment-method-item .payment-method-header .thumb .profilePicPreview,
    .payment-method-item .payment-method-header .thumb {
        width: 300px !important;
        height: 300px !important;
        box-shadow: unset;
        text-align: center;

    }

    .payment-method-item .payment-method-header .thumb .avatar-edit {
        bottom: -25px;
        left: -38px;
        right: 0;
    }
</style>
@endpush
