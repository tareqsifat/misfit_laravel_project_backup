<div class="product-categories-area">
    <div class="container custom-container">
        <div class="section_content">
            <div class="">
                <h2 class="section_heading">FEATURED CATEGORIES</h2>
            </div>
            <div class="featured_items">
                @php
                $top_categories =
                \App\Models\Category::where('is_top_category',1)->select(['id','url','name','is_top_category','category_image'])->where('status',1)->get();
                @endphp
                @foreach ($top_categories as $item)
                <div class="item">
                    <a href="{{url($item->url)}}" class=" product-category-item">
                        <div class="product-category-thumb">
                            <img src="{{env('PHOTO_URL')}}/{{ $item->category_image }}" alt="{{ $item->name }}">
                        </div>
                        <h5 class="product-category-title">{{ $item->name }}</h5>
                    </a>
                    {{-- <a href="/category/{{ $item->id }}/{{$item->name}}" class=" product-category-item">
                        <div class="product-category-thumb">
                            <img src="{{env('PHOTO_URL')}}/{{ $item->category_image }}" width="101" height="101"
                                alt="Image-HasTech">
                        </div>
                        <h5 class="product-category-title">{{ $item->name }}</h5>
                    </a> --}}
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
