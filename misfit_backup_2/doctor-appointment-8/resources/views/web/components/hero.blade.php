<section class="mt-5 pt-2 w-100 position-relative">

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach($heros as $key => $hero)
            <div class="swiper-slide">
                <a href="{{ route('appointment.create') }}">
                    <img src="{{ asset('/') }}uploads/hero/{{ $hero->image }}" class="w-100" alt="">
                </a>
            </div>
            @endforeach

        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>