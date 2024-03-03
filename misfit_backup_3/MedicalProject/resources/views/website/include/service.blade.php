<div class="container clearfix">
    <div class="row col-mb-50 mb-0">
        @foreach ($service as $key => $item)
            <div class="col-sm-6 col-lg-4">
                <div class="feature-box fbox-plain">
                    <div class="fbox-icon" data-animate="bounceIn">
                        <a href="#"><i class="icon-medical-i-cardiology"></i></a>
                    </div>
                    <div class="fbox-content">
                        <div class="count" style="display: none">
                        </div>
                        <h3>{{$item->title }}</h3>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
                @break($key==5)
            </div>
        @endforeach

    </div>
    

</div>