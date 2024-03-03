@extends('frontend.layouts.app')
@section('content')

<div class="container">
    <section class="bg-white">
        <h1 class="category_products_heading h5">
            Searh results for : {{$key}}
        </h1>
    </section>
    <section>
        <div class="product_row category_product_row" style="justify-content: center;">
            @foreach ($products as $product)
                @include('frontend.include.product',['product'=>$product])
            @endforeach
        </div>
    </section>
    <section class="pt-4 mb-5 text-center">
        <div class="d-inline-block">
            {{ $products->links() }}
        </div>
    </section>
</div>
@endsection
