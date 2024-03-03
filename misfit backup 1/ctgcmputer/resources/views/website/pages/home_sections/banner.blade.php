@push('css_plugin')
<link rel="stylesheet" href="{{ asset('contents/website/plugins') }}/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="{{ asset('contents/website/plugins') }}/owlcarousel/assets/owl.theme.default.min.css">
<script src="{{ asset('contents/website/plugins') }}/owlcarousel/owl.carousel.min.js"></script>
<script>
    $(function(){
        slider_reboot();
        window.render_top_deals_product();
    })
</script>
@endpush
<section>
    <div class="container custom-container">
        <div class="banner">
            <div class="left">
                <div class="top">
                    <div class="owl-carousel owl-theme">
                        @foreach(\App\Models\WebsiteBanner::where('show',1)->where('status',1)->orderBy('id','DESC')->get()
                        as $item)
                        <div class="banner_slide_image">
                            <img src="/{{$item->image}}" alt="Image">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="bottom">
                    <div class="two">
                        <img src="/{{$setting->side_banner_left_top}}" class="img-fluid" alt="">
                    </div>
                    <div class="three">
                        <img src="/{{$setting->side_banner_right_top}}" class="img-fluid" alt="">
                    </div>
                    <div class="four">
                        <img src="/{{$setting->side_banner_left_bottom}}" class="img-fluid" alt="">
                    </div>
                    <div class="five">
                        <img src="/{{$setting->side_banner_right_bottom}}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="big_deals">
                    <h2 class="heading">FLASH DEALS</h2>
                    <h3 class="sub_heading">HARRY UP ! LIMITED TIME OFFER</h3>
                    <div id="big_deals_slide">
                    </div>
                    <div class="load_more">
                        <button type="button" data-page="2" onclick="get_top_deals_product()">next</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="banner_body">
            <div class="one">
                <div class="owl-carousel owl-theme">
                    @foreach(\App\Models\WebsiteBanner::where('show',1)->where('status',1)->orderBy('id','DESC')->get()
                    as $item)
                    <div>
                        <img src="{{env('PHOTO_URL')}}/{{$item->image}}" alt="Image">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="two">
                <img src="/{{$setting->side_banner_left_top}}" class="img-fluid" alt="">
            </div>
            <div class="three">
                <img src="/{{$setting->side_banner_right_top}}" class="img-fluid" alt="">
            </div>
            <div class="four">
                <img src="/{{$setting->side_banner_left_bottom}}" class="img-fluid" alt="">
            </div>
            <div class="five">
                <img src="/{{$setting->side_banner_right_bottom}}" class="img-fluid" alt="">
            </div>
        </div> --}}
    </div>
</section>
