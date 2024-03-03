@extends('seo_dashboard.layouts.seo')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <h5> Dashboard </h5>
            </div>
            <div class="col-lg-6"></div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card border-widgets shadow mb-4">
        @php
            $product = \App\Models\Product::class;
            $category = \App\Models\Category::class;
            $tag = \App\Models\Tag::class;
            $image = \App\Models\ProductImage::class;
        @endphp
        <div class="row m-0">
            <div class="col-xl-3 col-6 xs-width-100">
                <div class="crm-top-widget card-body">
                    <div class="d-flex"><i class="icon-briefcase font-primary align-self-center me-3"></i>
                        <div><span class="mt-0">Products</span>
                            <h4 class="counter">{{ $product::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6 xs-width-100">
                <div class="crm-top-widget card-body">
                    <div class="d-flex"><i class="icon-agenda font-secondary align-self-center me-3"></i>
                        <div><span class="mt-0">Categories</span>
                            <h4 class="counter">{{ $category::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6 xs-width-100">
                <div class="crm-top-widget card-body">
                    <div class="d-flex"><i class="icon-archive font-success align-self-center me-3"></i>
                        <div><span class="mt-0">Tag</span>
                            <h4 class="counter">{{ $tag::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6 xs-width-100">
                <div class="crm-top-widget card-body">
                    <div class="d-flex"><i class="icon-camera font-info align-self-center me-3"></i>
                        <div><span class="mt-0">Images</span>
                            <h4 class="counter">{{ $image::count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
