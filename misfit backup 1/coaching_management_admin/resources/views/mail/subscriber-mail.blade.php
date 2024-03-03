@component('mail::message')
# Hello, {{ $data['title'] }}

{{ $data['message'] }}

@component('mail::button', ['url' => ''])
Click here to continue
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
