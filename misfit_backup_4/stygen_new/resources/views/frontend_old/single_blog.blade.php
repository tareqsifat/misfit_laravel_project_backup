<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $blog->title }}</title>

    <meta name="title" content="{{ isset($blog->meta_title)?$blog->meta_title:$blog->title }}">
    <meta name="description" content="{{ isset($blog->meta_description)?$blog->meta_description:$blog->title }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ isset($blog->meta_title)?$blog->meta_title:$blog->title }}" />
    <meta property="og:description" content="{{ isset($blog->meta_description)?$blog->meta_description:$blog->title }}" />
    <meta property="og:url" content="https://stygen.gift/blog/{{$blog->blog_slug}}" />
    <meta property="og:site_name" content="Stygen" />
    <meta property="og:image" content="/assets/uploads/blog/{{$blog->image}}" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="400" />
    <meta name="google-site-verification" content="f2GHJdIMv4beEoFnjRaawAc2PabeM26ElyJsNKVOeRo" />
    <meta name="robots" content="index, follow" />
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}"> --}}
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/blog_style.css') }}">
</head>

<body>
    <div id="single_blog">
        <!--Breadcrumb Area Start-->

        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/frontend/img/logo/logo.png') }}" alt="">
                  </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="float-right">
                    <div class="navbar-collapse collapse" id="navbarsExample09" style="">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item active">
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="/shop">All products</a>
                          </li>
                        </ul>
                        {{-- <form class="form-inline my-2 my-md-0">
                          <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                        </form> --}}
                    </div>
                </div>
            </div>
        </nav>

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Blog</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
          </nav>
        <!--Breadcrumb Area End-->
        <!--Blog Area Start-->
        <div class="blog-area mt-4">
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

    <footer>
        <div class="footer-container">
            <div class="footer-middle-area footer-style-2">
                <div class="container">
                    <div class="newsletter-social-block-content pb-0">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="single-footer-wiedget mb-30 mr-5">
                                    <div class="footer-title">
                                        <div class="footer__about__logo">
                                            <a href="https://www.stygen.gift/"><img src="/assets/frontend/img/logo/logo.png" alt="" /></a>
                                        </div>
                                    </div>
                                    <ul class="link-widget hover-color2 mt-3 footer-ul-section">
                                        <li><i class="fa fa-location-arrow fa-1x"></i> House: 65, Level-2, Road: 03, Block: B, Niketon, Gulshan-1, Dhaka</li>
                                        <li><i class="fa fa-mobile-alt fa-1x"></i> Phone: +880 1971 971 520</li>
                                        <li><i class="fa fa-envelope fa-1x"></i> Email: contact.stygen@gmail.com</li>
                                        <li><i class="far fa-clock fa-1x"></i> Sat - Fri / 9:00 AM - 10:00 PM</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="single-footer-wiedget mb-30">
                                    <div class="footer-title"><h3>MAIN FEATURES</h3></div>
                                    <ul class="link-widget hover-color2 mt-3 footer-ul-section">
                                        <li><a href="/product-category/cake" class="">Cake</a></li>
                                        <li><a href="/product-category/flowers" class="">Flowers</a></li>
                                        <li><a href="/product-category/watches" class="">Watches</a></li>
                                        <li><a href="/product-category/plushies" class="">Plushies</a></li>
                                        <li><a href="/product-category/books" class="">Books</a></li>
                                        <li><a href="/product-category/chocolate" class="">Chocolate</a></li>
                                        <li><a href="/product-category/home-decor" class="">Home Decor</a></li>
                                        <li><a href="/product-category/lifestyle" class="">Lifestyle</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="single-footer-wiedget mb-30">
                                    <div class="footer-title"><h3>USEFUL LINKS</h3></div>
                                    <ul class="link-widget hover-color2 mt-3 footer-ul-section">
                                        <li><a href="/about-us" class="">About Us</a></li>
                                        <li><a href="/blog" class="">Blog</a></li>
                                        <li><a href="/privacy-policy" class="">Privacy Policy</a></li>
                                        <li><a href="/terms-and-condition" class="">Terms &amp; Conditions</a></li>
                                        <li><a href="/return-policy" class="">Return and Refund Policy</a></li>
                                        <li><a href="/warranty-guide" class="">Warranty Guide</a></li>
                                        <li><a href="/contact-us" class="">Contact Us</a></li>
                                        <li><a href="/seller">Become a Seller</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div

                                    data-href="https://www.facebook.com/Stygen/"
                                    data-tabs=""
                                    data-width="500"
                                    data-height="400"
                                    data-show-facepile="true"
                                    data-lazy="true"
                                    class="fb-page fb_iframe_widget"
                                    fb-xfbml-state="rendered"
                                    fb-iframe-plugin-query="app_id=273559519924166&amp;container_width=255&amp;height=400&amp;href=https%3A%2F%2Fwww.facebook.com%2FStygen%2F&amp;lazy=true&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;tabs=&amp;width=500"
                                >
                                    <span style="vertical-align: bottom; width: 255px; height: 130px;">
                                        <iframe
                                            name="f236da548b3e5bc"
                                            width="500px"
                                            height="400px"
                                            data-testid="fb:page Facebook Social Plugin"
                                            title="fb:page Facebook Social Plugin"
                                            frameborder="0"
                                            allowtransparency="true"
                                            allowfullscreen="true"
                                            scrolling="no"
                                            allow="encrypted-media"
                                            loading="lazy"
                                            src="https://www.facebook.com/v10.0/plugins/page.php?app_id=273559519924166&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Dff0b18c73722ac%26domain%3Dstygen.gift%26is_canvas%3Dfalse%26origin%3Dhttps%253A%252F%252Fstygen.gift%252Ff83f4cc9748af4%26relation%3Dparent.parent&amp;container_width=255&amp;height=400&amp;href=https%3A%2F%2Fwww.facebook.com%2FStygen%2F&amp;lazy=true&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;tabs=&amp;width=500"
                                            style="border: none; width: 255px; height: 130px; visibility: visible;"
                                            class=""
                                        ></iframe>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sslImageMain pt-2 pb-2">
                <div class="container"><img src="/assets/frontend/img/bg/ssl.webp" alt="" width="100%" /></div>
            </div>
            <div class="footer-bottom-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="footer-copyright">
                                <p>©2022 <a href="#">Stygen.</a> All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="footer-payments-image text-center text-md-right">
                                <small class="text-white">Design &amp; Developed by <a target="_blank" href="https://geekysocial.com/" class="text-danger">Geeky Social Ltd.</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61f7b30f095ba039"></script>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
