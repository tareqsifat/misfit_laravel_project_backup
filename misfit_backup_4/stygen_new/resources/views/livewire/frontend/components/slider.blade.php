<div>
    <div class="slider-area transparent-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                    <div class="hero-slider hero-slider-2 mt-0 owl-carousel">
                        <!--Single Slider Start-->
                        @foreach ($sliders as $item)
                            <div class="item">
                                <img src="{{ asset('assets/uploads/slider') }}/{{ $item->image }}" alt="Slider image {{ $item->id }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
