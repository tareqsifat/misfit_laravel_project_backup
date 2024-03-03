<div>
    {{-- The whole world belongs to you. --}}
    <div class="our-product-area gifts-by-occasion-area">
        <div class="container">
            <div class="row">
                <div class="col-8 ms-auto me-auto">
                    <div class="row text-center">
                        <h3 class="landing-category-title-tag">GIFTS BY OCCASION</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8 col-12 col-sm-12 ms-auto me-auto">
                    <div class="row justify-content-around">
                        @foreach ($occasions as $occasion)

                            <div class="col-sm-6 col-md-6 col-6">
                                <div class="gifts-main-section mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="product-img">
                                                @if ($occasion->occasion_slug)
                                                    <a href="{{ route('ocassion_product', $occasion->occasion_slug) }}">
                                                        <img class="first-img gift-img" src="{{asset('/assets/uploads/occasion/')}}/{{$occasion->occasion_image}}" lazy="loading">
                                                    </a>
                                                @else
                                                    <a href="#">
                                                        <img class="first-img gift-img" src="{{asset('/assets/uploads/occasion/')}}/{{$occasion->occasion_image}}" lazy="loading">
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            @if ($occasion->occasion_slug)
                                                <h4 class="gifts-title"><a href="{{ route('ocassion_product', $occasion->occasion_slug) }}">{{ $occasion->occasion_name }}</a></h4>
                                            @else
                                                <h4 class="gifts-title"><a href="#">{{ $occasion->occasion_name }}</a></h4>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
