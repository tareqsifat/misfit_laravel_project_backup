@component('mail::message')
# Hi, {{ $name }}
# Thank you for registering in stygen.gift, the largest online gift shop in Bangladesh.

Here is your 200TK gift voucher!
<p>Voucher Code: <b>{{ $code }} </b></p>

<small>Use this code as a coupon in your next purchase and get 200TK flat discount from your cart value.</small><br>
<small><b>This code expires in 90 days & available for single use. Please don't share this with anyone.</b></small>
@component('mail::button', ['url' => 'https://stygen.gift/'])
Start Shopping
@endcomponent

Thanks,<br>
Stygen.gift
@endcomponent
