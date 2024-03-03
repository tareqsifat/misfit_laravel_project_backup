<section id="slider" class="slider-element swiper_wrapper min-vh-50 min-vh-md-100" data-loop="true" data-autoplay="5000">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                @foreach ($slider as $key=>$item)
                    <div class="swiper-slide">
                        <div class="container">@if($key%2==0)@else @endif
                            <div @if($key%2==0)class="slider-caption slider-caption-right" style="max-width: 700px;" @else class="slider-caption" @endif >
                                <div>
                                    <h2 data-animate="flipInX">{{ $item->left_title }}<span>{{ $item->right_title }}</span></h2>
                                    <p class="d-none d-sm-block" data-animate="flipInX" data-delay="500">{{ $item->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide-bg" style="background-image: url('{{ asset("/uploads/sliders/$item->image") }}');">
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
</section><!-- #slider end -->