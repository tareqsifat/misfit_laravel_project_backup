@extends('frontend.layouts.app',[
    "meta" => [
        "title" => "error",
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
                        <span>Error</span>
                    </a>
                </li>
            </ul>
    </section>

    <section style="background: #f2f4f8;text-align: center;">
        <br>
        <b>
        Request not found
        <br>
        <br>
    </section>
</main>
@endsection
