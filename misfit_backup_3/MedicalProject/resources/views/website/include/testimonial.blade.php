<ul class="testimonials-grid grid-1">
    @foreach ($testimonial as $key=> $item)
        <li class="grid-item pt-0">
            <div class="testimonial">
                <div class="testi-image">
                    <a href="#"><img src='{{ asset("/uploads/testimonials/$item->image") }}' alt="{{ $item->image }}"></a>
                </div>
                <div class="testi-content">
                    <div class="count" style="display: none">
                        {{ $key+1 }}
                    </div>
                    <p>{{ $item->body }}</p>
                    <div class="testi-meta">
                        John Doe
                        <span>XYZ Inc.</span>
                    </div>
                </div>
            </div>
            @break($key==2)
        </li>
    @endforeach
        
</ul>
<div class="w-100 text-end">
    <a href="#" class="button button-mini button-rounded me-0">More Patient Feedbacks...</a>
</div>