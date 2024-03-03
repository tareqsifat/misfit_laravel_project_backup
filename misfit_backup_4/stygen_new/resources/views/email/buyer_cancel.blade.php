@component('mail::message')
# Hi, {{ $name }}
# We regret that your order in Stygen.gift is canceled.

Hope that you will shop from our website soon. Here is a 5% coupon code for your next purchase.

<p>Coupon Code: <b>comeback </b></p>

<small>Use this code as a coupon in your next purchase and get 5% discount from your cart value.</small><br>
@component('mail::button', ['url' => 'https://stygen.gift/'])
Start Shopping
@endcomponent

Thanks,<br>
{{ config('app.name') }}.gift
@endcomponent

