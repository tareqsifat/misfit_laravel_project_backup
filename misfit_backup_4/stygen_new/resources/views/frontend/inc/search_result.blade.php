<div class="list-group list-group-flush">
    @foreach ($search_products as $item)
        {{-- @dd($item->id, $item->slug) --}}

        <a href="{{ route('product_details', $item->pro_slug) }}"
            class="list-group-item list-group-item-action">
            <img src="/assets/uploads/product/{{ $item->featured_image }}" width="80" height="80"
                alt="Image-Ctgcomputer">
            {{ $item->product_name }}
        </a>
    @endforeach
    {{-- <a href="{{ route('search_product', $searchQuery) }}"
        class="my-5 list-group-item list-group-item-action active text-center">View
        more</a> --}}
</div>