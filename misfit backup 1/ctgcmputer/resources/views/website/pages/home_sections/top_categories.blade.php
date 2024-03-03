@php
    $categories = \App\Models\Category::where('is_top_category',1)
        ->select([
            'id',
            'name',
            'is_top_category',
            'url',
            'parent_id'
        ])
        ->where('status',1)->latest()->get();
@endphp
@push('css_plugin')
    <script>
        $(function(){
            window.load_home_cat_section();
        })
    </script>
@endpush
@foreach ($categories as $category)
@if ($category->products()->where('status',1)->count())
<div class="home-top-categories-area home_cat_section" data-category="{{ $category->id }}">
    <div class="container custom-container">
        <div class="section_content">
            <div class="top_bar">
                <div>
                    <h2 class="section_heading">
                        {{ $category->name }}
                    </h2>
                </div>
                <div class="navigation_links" id="home_cat_nav{{ $category->id }}">

                </div>
            </div>
            <div class="items" id="home_cat_section{{ $category->id }}">
                <div class="sub_cats">
                    <ul>
                        @foreach ($category->child()->take(7)->get() as $item)
                            <li><a onclick="window.home_cat_load_api_page_content(`/api/v1/category/{{ $item->id }}/{{ $item->name }}?page=1`,{{ $category->id }})" href="/{{ $item->url }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="cat_products_wrapper">
                    <div class="cat_products_items home_cat_product_row">
                        <img src="{{ asset('contents/website/images/placeholder/product.gif') }}" class="w-100" alt="ctg computer placeholder">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
