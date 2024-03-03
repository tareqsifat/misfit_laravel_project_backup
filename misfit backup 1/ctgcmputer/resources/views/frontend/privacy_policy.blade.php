@extends('frontend.layouts.app',[
    "meta" => [
        "title" => "privacy and policy",
    ]
])
@section('content')
<main class="main-content">
    <section>
        <div class="container">
            <ul class="breadcrumb pt-4">
                <li>
                    <a href="/"><i class="fa fa-home" title="Home"></i></a>
                </li>
                <li>
                    <a href="#">
                        <span>privacy and policy</span>
                    </a>
                </li>
            </ul>
    </section>

    <section style="background: #f2f4f8;">
        <br>
        <br>
        <div class="container ">
            <div class="card">
                <div class="card-body">
                    <div class="about_website_section">
                        {{-- <h1 class="heading">Our Introduction</h1> --}}
                        {!! \App\Models\Setting::select('privacy_policy')->first()->privacy_policy !!}
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
    </section>
</main>
@endsection
