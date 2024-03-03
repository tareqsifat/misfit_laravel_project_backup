@php
	$customCaptcha = loadCustomCaptcha();
    $googleCaptcha = loadReCaptcha()
@endphp
@props(['isCustom' => false])
@if($googleCaptcha)
    <div class="mb-3">
        @php echo $googleCaptcha @endphp
    </div>
@endif
@if($customCaptcha)
@if ($isCustom)
<div class="form-group">
    <div class="mb-3">
        @php echo $customCaptcha @endphp
    </div>
    <label class="form--label">@lang('Captcha')</label>
    <input type="text" name="captcha" class="form--control" placeholder="@lang('Captcha')" required>
</div>
@else

<div class="form-group">
    <div class="mb-2">
        @php echo $customCaptcha @endphp
    </div>
    <label class="form-label">@lang('Captcha')</label>
    <input type="text" name="captcha" class="form-control form--control" required placeholder="@lang('Enter captcha')">
</div>
@endif

@endif
@if($googleCaptcha)
@push('script')
    <script>
        (function($){
            "use strict"
            $('.verify-gcaptcha').on('submit',function(){
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                    return false;
                }
                return true;
            });
        })(jQuery);
    </script>
@endpush
@endif
