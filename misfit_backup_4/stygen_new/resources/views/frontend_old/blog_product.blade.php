<div class="d-flex justify-content-between">
    <div class="row">
            @php
                $description_split = explode('--' ,$blog->description);
            @endphp
            @foreach ($description_split as $item)
            {{-- @dd($blog->description) --}}
            @if (Str::contains($item, 'ST') != true)
                {!! $item !!}
            @else
                <div class="col-lg-4 col-xl-4 col-md-4 mb-3">
                    @php
                        $product = App\Models\Product::where('product_sku', $item)->first();
                        // dd($product);
                    @endphp
                    @if($product)
                    {{-- {{-- @foreach ($blog_product as $product) --}}
                        <a href="https://stygen.gift/product/{{$product->pro_slug}}">
                            <div class="col-sm-12 card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="/assets/uploads/product/{{$product->featured_image}}" alt="...">
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                        <!-- Product price-->
                                        ৳{{ $product->regular_price }}
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





<div class="col-lg-9 ml-auto mr-auto">
    <div class="blog_area">
        <article class="blog_single blog-details">

            <header class="entry-header">
                <h2 class="entry-title">
                    {{ $blog->title }}
                </h2>
                <span class="post-author">
                <span class="post-by"> Posts by : </span> admin </span>
                <span class="post-separator">|</span>
                <span class="blog-post-date"><i class="fas fa-calendar-alt"></i> {{ $blog->created_at }}</span>
            </header>
            <div class="post-thumbnail img-full">
                {{-- <img :src="`/assets/uploads/blog/${blog.image}`" :alt="blog.title"> --}}
                <div class="col-md-12">
                    <img src="/assets/uploads/blog/{{$blog->image}}">
                </div>
            </div>
            <div class="postinfo-wrapper">
                <div class="post-info">
                    <div class="entry-summary blog-post-description">
                        <div class="d-flex justify-content-between">
                            <div class="row">
                                @php
                                        $description_split = explode('--' ,$blog->description);
                                    @endphp
                                    @foreach ($description_split as $item)
                                    {{-- @dd($blog->description) --}}
                                    @if (Str::contains($item, 'ST') != true)
                                        {!! $item !!}
                                    @else
                                        <div class="col-lg-4 col-xl-4 col-md-4 mb-3">
                                            @php
                                                $product = App\Models\Product::where('product_sku', $item)->first();
                                                // dd($product);
                                            @endphp
                                            @if($product)
                                            {{-- {{-- @foreach ($blog_product as $product) --}}
                                                <div class="card">
                                                    <a href="https://stygen.gift/product/{{$product->pro_slug}}">
                                                        <div class="col-sm-12 card h-100" >
                                                            <!-- Product image-->
                                                            <img class="card-img-top" src="/assets/uploads/product/{{$product->featured_image}}" alt="...">
                                                            <!-- Product details-->
                                                            <div class="card-body p-4">
                                                                <div class="text-center">
                                                                    <!-- Product name-->
                                                                    <h5 class="fw-bolder">{{ $product->product_name }}</h5>
                                                                    <!-- Product price-->
                                                                    ৳{{ $product->regular_price }}
                                                                </div>
                                                            </div>
                                                            <!-- Product actions-->
                                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                                {{-- @dd(json_encode($product)) --}}
                                                                <a href="" type="button" class="btn btn-danger flex-fill ms-1">Buy now</a>
                                                                <div class="text-center"><a class="btn btn-dark mt-auto" style="background-color:#5e2e87;" href="https://stygen.gift/product/{{$product->pro_slug}}">Buy Now</a></div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <br>
                                                </div>

                                                @endif
                                            </div>
                                            {{-- @endforeach --}}

                                    @endif

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>



