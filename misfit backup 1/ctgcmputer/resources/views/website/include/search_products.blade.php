<div class="list-group list-group-flush p-2">
    @foreach ($products as $product)
    <a href="/{{ $product->product_url }}" class="d-flex gap-3" style="align-items: flex-start;">
        <img src="{{ $product->related_images[0]->image_link }}" width="80" height="80" style="object-fit: contain;" alt="Image-Ctgcomputer">
        <div>
            {{ $product->product_name }}
            <br>
            <div class="text-danger h6">
                {{ $product->sales_price }} ৳
            </div>
            <br>
            <br>
        </div>
    </a>
    @endforeach
    <a href="{{ route('search_product', ["key"=>$key]) }}" class="mt-5 mb-2 active text-center">
        View more
    </a>
</div>
