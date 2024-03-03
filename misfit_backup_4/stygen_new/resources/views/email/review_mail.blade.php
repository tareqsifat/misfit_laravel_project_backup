<!DOCTYPE html>
<html>
<head>
    <title>STYGEN</title>
</head>
<body>
    <p>Hello {{ $buyer_details['name'] }},</p>
    <h1>{{ $buyer_details['title'] }}</h1>
    <p>{{ $buyer_details['body'] }}</p>

    @component('mail::button', ['url' => 'https://g.page/r/CUAAp1F64rPOEAg/review'])
    Write a review
    @endcomponent
</body>
</html>
