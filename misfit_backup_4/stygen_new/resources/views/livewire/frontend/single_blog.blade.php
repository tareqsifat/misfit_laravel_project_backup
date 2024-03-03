@extends('layouts.app')

@section('content')    
    <div id="single_blog">
        <!--Breadcrumb Area Start-->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-content text-center">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="{{ route('blogs')}} ">Blog</a></li>
                                <li class="active" aria-current="page">{{ $blog->title }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Breadcrumb Area End-->
        <!--Blog Area Start-->
        <div class="blog-area">
            <div class="container">
                <div class="row justify-content-center">
                    <!--Blog Post Start-->
                    <div class="col-lg-9">
                        <!-- Post content-->
                        <article>
                            <!-- Post header-->
                            <header class="mb-4">
                                <!-- Post title-->
                                <h2 class="fw-bolder mb-1 text-center"><b>{{ $blog->title }}</b></h2>
                                <!-- Post meta content-->
                                <div class="text-muted fst-italic mb-2 text-center">Posted on {{ date('d-m-Y', strtotime($blog->created_at)); }}
                                <!-- Post categories-->
                            </header>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded" src="/assets/uploads/blog/{{$blog->image}}" alt="..."></figure>
                            {{-- <img src="/assets/uploads/blog/{{$blog->image}}"> --}}
                            <div class="addthis_inline_share_toolbox"></div>
                            <!-- Post content-->
                            <section class="mb-5">
                                <div class="d-flex justify-content-between">
                                    <div class="row p-3">
                                            @php
                                                $description_split = explode('--' ,$blog->description);
                                            @endphp
                                            @foreach ($description_split as $item)
                                            {{-- @dd($blog->description) --}}
                                            @if (Str::contains($item, 'ST') != true)
                                                <p>{!! $item !!}</p>
                                            @else
                                                <div class="col-lg-4 col-xl-4 col-md-4 mb-3">
                                                    @php
                                                        $product = App\Models\Product::where('product_sku', $item)->first();
                                                        // dd($product);
                                                    @endphp
                                                    @if($product)
                                                    {{-- {{-- @foreach ($blog_product as $product) --}}
                                                        <a href="/product/{{$product->pro_slug}}">
                                                            <div class="col-sm-12 card h-100">
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="/assets/uploads/product/{{$product->featured_image}}" alt="...">
                                                                <!-- Product details-->
                                                                <div class="card-body p-4">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <p class="fw-bolder"><b>
                                                                            {{ \Illuminate\Support\Str::limit($product->product_name, 40, $end='...') }}
                                                                        </b></p>
                                                                        <!-- Product price-->
                                                                        <p class="product-price"><b>৳  {{ $product->regular_price }}</b></p>
                                                                    </div>
                                                                </div>
                                                                <!-- Product actions-->
                                                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                                    {{-- @dd(json_encode($product)) --}}
                                                                    <div class="text-center"><a class="btn btn-dark mt-auto" style="background-color:#5e2e87;" href="https://stygen.gift/product/{{$product->pro_slug}}">Buy Now</a></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <br>
                                                        @endif
                                                    </div>
                                                    {{-- @endforeach --}}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </article>
                        <!-- Comments section-->
                    </div>
                    <!--Blog Post End-->
                </div>
            </div>
        </div>
        <!--Blog Area End-->

    </div>
@endsection
