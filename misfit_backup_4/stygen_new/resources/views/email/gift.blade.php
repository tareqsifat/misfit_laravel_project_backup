@component('mail::message')
# Hi, {{ $name }}
# Congratulation! You won {{$amount}}% coupon code!

Here is your {{$amount}}% coupon code!
<p>Coupon Code: <b>{{ $code }} </b></p>

<small>Use this code as a coupon in your next purchase and get {{$amount}}% discount (up to 500 tk) from your cart value.</small><br>
<small><b>This code expires in 10 days & available for single use. Please don't share this with anyone.</b></small>
@component('mail::button', ['url' => 'https://stygen.gift/'])
Start Shopping
@endcomponent

Thanks,<br>
Stygen.gift
@endcomponent
