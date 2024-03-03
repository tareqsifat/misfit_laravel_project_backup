@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label> @lang('Site Title')</label>
                                    <input class="form-control" type="text" name="site_name" required value="{{$general->site_name}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Currency')</label>
                                    <input class="form-control" type="text" name="cur_text" required value="{{$general->cur_text}}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Currency Symbol')</label>
                                    <input class="form-control" type="text" name="cur_sym" required value="{{$general->cur_sym}}">
                                </div>
                            </div>

                            <div class="form-group col-md-4 col-sm-6">
                                <label> @lang('Timezone')</label>
                                <select class="select2-basic" name="timezone">
                                    @foreach($timezones as $timezone)
                                    <option value="'{{ @$timezone}}'">{{ __($timezone) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                <label> @lang('Site Base Color')</label>
                                <div class="input-group">
                                    <span class="input-group-text p-0 border-0">
                                        <input type='text' class="form-control colorPicker" value="{{$general->base_color}}"/>
                                    </span>
                                    <input type="text" class="form-control colorCode" name="base_color" value="{{ $general->base_color }}"/>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>@lang('Allow Decimal After Number')</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="allow_decimal_after_number" required value="{{$general->allow_decimal_after_number}}">
                                        <span class="input-group-text">@lang('Digit(s)') </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group ">
                                    <label>Ai robot status</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1" role="switch" id="ai_check" @if($ai_status->ai_robot) checked @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/spectrum.css') }}">
@endpush

@push('script')
    <script>
        (function ($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function (color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function () {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('select[name=timezone]').val("'{{ config('app.timezone') }}'").select2();
            $('.select2-basic').select2({
                dropdownParent:$('.card-body')
            });
            
            $('#ai_check').change(function () {
                var isChecked = $(this).is(":checked");
                // console.log(userId, isChecked);
                // Send an AJAX request to update the checkbox state
                $.ajax({
                    type: 'POST',
                    url: '/admin/admin-update-ai-status', // Define the route to handle the request in Laravel
                    data: {
                        _token: '{{ csrf_token() }}', // Include the CSRF token for security
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        isChecked: isChecked,
                    },
                    success: function (response) {
                        alert(response.message);
                        console.log(response);
                    },
                });
            });
        })(jQuery);
    </script>
@endpush


@push('style')
<style>
    .select2-container {
        z-index: 0 !important;
    }
</style>
@endpush
