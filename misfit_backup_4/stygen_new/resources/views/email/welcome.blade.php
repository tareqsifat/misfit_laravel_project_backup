@component('mail::message')
<b style="text-align: center;">দেশের সব চেয়ে বড় অনলাইন গিফট মার্কেটপ্লেস STYGEN এ আপনাকে স্বাগতম।</b>

<img src="https://stygen.gift/assets/frontend/img/mail/mail_head.png" alt="">

@component('mail::panel')
জন্মদিন, বিবাহ অনুষ্ঠান, বিবাহবার্ষিকী বা যেকোনো উপলক্ষে প্রিয়জনকে গিফট পাঠানোর সব চেয়ে বিশ্বস্ত নাম stygen.gift। স্টাইজেনে রয়েছে ১০০+  মার্চেন্টের প্রায় ২০০০ এর অধিক পণ্যের বিশাল সমাহার। পাওয়া যাবে সব ধরনের উপহার সামগ্রীঃ ফুল, কেক, কার্ড, চকলেট এর বিভিন্ন সংগ্রহের সঙ্গে রয়েছে নামকরা সব লাইফস্টাইল ব্র্যান্ড। বিভিন্ন ক্যাটাগরির পণ্য থেকে মনের মত উপহার এবং কম্বো তৈরি করতে পারবেন আপনি নিজেই।
অনলাইনে পে করে পাঠিয়ে দিন প্রিয়জনের ঠিকানায়।
@endcomponent

{{-- @component('mail::table')
| ------------- |:-------------:|
| <img src="{{ asset('assets/frontend/img/mail/body1.jpg') }}" alt="">     |    <img src="{{ asset('assets/frontend/img/mail/body2.jpg') }}" alt="">    |
| <img src="{{ asset('assets/frontend/img/mail/body3.jpg') }}" alt="">     |    <img src="{{ asset('assets/frontend/img/mail/body4.jpg') }}" alt="">    |
@endcomponent --}}

{{-- @component('mail::layout')
জন্মদিন, বিবাহ অনুষ্ঠান, বিবাহবার্ষিকী বা যেকোনো উপলক্ষে প্রিয়জনকে গিফট পাঠানোর সব চেয়ে বিশ্বস্ত নাম stygen.gift। স্টাইজেনে রয়েছে ১০০+  মার্চেন্টের প্রায় ২০০০ এর অধিক পণ্যের বিশাল সমাহার। পাওয়া যাবে সব ধরনের উপহার সামগ্রীঃ ফুল, কেক, কার্ড, চকলেট এর বিভিন্ন সংগ্রহের সঙ্গে রয়েছে নামকরা সব লাইফস্টাইল ব্র্যান্ড। বিভিন্ন ক্যাটাগরির পণ্য থেকে মনের মত উপহার এবং কম্বো তৈরি করতে পারবেন আপনি নিজেই।
অনলাইনে পে করে পাঠিয়ে দিন প্রিয়জনের ঠিকানায়।
@endcomponent --}}

@component('mail::table')
<div class="row" style="display: flex;">
    <div class="column" style="flex: 50%; padding: 5px;">
        <img src="https://stygen.gift/assets/frontend/img/mail/body1.jpg" style="padding: 5px" alt="">
        <a href="https://stygen.gift/product-category/watches"  style="text-decoration: none; color: blueviolet;"><b>See Collection</b></a>
        <img src="https://stygen.gift/assets/frontend/img/mail/body2.jpg" style="padding: 5px"  alt="">
        <a href="https://stygen.gift/product-category/cake" style="text-decoration: none; color: blueviolet;"><b>See Collection</b></a>
    </div>
    <div class="column" style="flex: 50%; padding: 5px;">
        <img src="https://stygen.gift/assets/frontend/img/mail/body3.jpg" style="padding: 5px" alt="">
        <a href="https://stygen.gift/product-category/flowers" style="text-decoration: none; color: blueviolet;"><b>See Collection</b></a>
        <img src="https://stygen.gift/assets/frontend/img/mail/body4.jpg" style="padding: 5px" alt="">
        <a href="https://stygen.gift/product-category/gift-combo" style="text-decoration: none; color: blueviolet;"><b>See Collection</b></a>
    </div>
</div>

<div class="row" style="display: flex;">
    <div class="column" style="flex: 50%; padding: 5px;">
        <img src="https://stygen.gift/assets/frontend/img/mail/body5.jpg" style="padding: 5px" alt="">
        <a href="https://stygen.gift/product-category/lifestyle"  style="text-decoration: none; color: blueviolet;"><b>See Collection</b></a>
    </div>
    <div class="column" style="flex: 50%; padding: 5px;">
        <img src="https://stygen.gift/assets/frontend/img/mail/body6.jpg" style="padding: 5px"  alt="">
        <a href="https://stygen.gift/product-category/electronics-gadget" style="text-decoration: none; color: blueviolet;"><b>See Collection</b></a>
    </div>
</div>

@endcomponent

<div class="row" style="display: flex;">
    <div class="column" style="flex: 50%; padding: 5px;">
        @component('mail::button', ['url' => 'https://stygen.gift'])
        Start Shopping
        @endcomponent
    </div>
    <div class="column" style="flex: 50%; padding: 5px;">
        @component('mail::button', ['url' => 'https://goo.gl/maps/8ZvjqFRnvp8mS5rs6'])
        Visit Shop
        @endcomponent
    </div>
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
