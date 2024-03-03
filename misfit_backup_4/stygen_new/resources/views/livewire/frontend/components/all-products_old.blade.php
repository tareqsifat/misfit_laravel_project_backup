<div>


    <!-- resources/views/livewire/product-details.blade.php -->

    <div>
        <!-- ... (other HTML content) ... -->

        <!--Shop Product Start-->
        <div class="shop-product">
            <div id="myTabContent-2" class="tab-content">
                <div id="grid" class="tab-pane fade show active">
                    <div class="product-grid-view">
                        <div class="row" wire:loading.remove wire:target="loadProducts">
                            @if ($products->count() > 0)
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-xl-4 col-md-4 mb-3">
                                        <!--Single Product Start-->
                                        <div class="single-product mb-3 shop-product-single">
                                            <div class="product-img">
                                                <a href="#">
                                                    @if ($product->featured_image)
                                                        <img class="first-img" src="/assets/uploads/product/{{ $product->featured_image }}" alt="{{ $product->product_name }}" lazy="loading">
                                                        <img class="hover-img" src="/assets/uploads/product/{{ $product->featured_image }}" alt="{{ $product->product_name }}" lazy="loading">
                                                    @else
                                                        <img class="first-img" src="/assets/frontend/img/icon/empty_product.jpeg" lazy="loading">
                                                    @endif
                                                </a>
                                                {{-- @if (discount_percentage($product->regular_price, $product->sales_price))
                                                    <span class="sticker">{{ discount_percentage($product->regular_price, $product->sales_price) }}</span>
                                                @endif --}}
                                                <div class="product-action">
                                                    <ul>
                                                        @if ($product->product_variations && count($product->product_variations) > 0)
                                                            <li><a href="#"><i class="ion-settings"></i></a></li>
                                                        @else
                                                            <li><a href="#" wire:click.prevent="addToCart({{ $product->id }}, {{ $product->regular_price }}, {{ $product->sales_price }})"><i class="ion-bag"></i></a></li>
                                                        @endif
                                                        <li><a wire:click.prevent="quickView({{ $product->id }}, '{{ $product->featured_image }}', {{ $product->product_variations }})" href="#open-modal" data-toggle="modal"><i class="ion-eye"></i></a></li>
                                                        <li><a href="#" wire:click.prevent="addToWishlist({{ $product->id }})"><i class="ion-heart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="#">{{ $product->product_name }}</a></h4>
                                                <div class="product-price">
                                                    @if ($product->sales_price)
                                                        <span class="price"><del>৳{{ $product->regular_price }}</del> ৳{{ $product->sales_price }}</span>
                                                    @else
                                                        <span class="price">৳{{ $product->regular_price }}</span>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="d-inline-flex justify-content-between mt-3">
                                                                <div class="col-md-6 col-sm-6">
                                                                    @if ($product->product_variations && count($product->product_variations) > 0)
                                                                        <span><a class="btn btn-primary btn-sm pl-2 detailsbtn" href="#">select variant</a></span>
                                                                    @else
                                                                        <span><a class="btn btn-primary btn-sm pr-2 addtocart" href="#" wire:click.prevent="addToCart({{ $product->id }}, {{ $product->regular_price }}, {{ $product->sales_price }})"><i class="ion-bag"></i>Add to cart</a></span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <span><a class="btn btn-primary btn-sm pl-2 detailsbtn" href="#">Details</a></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-reviews d-flex justify-content-center mt-0">
                                                    <div class="show-rating">
                                                        @if ($product->average_ratting)
                                                            <star-rating :rating="{{ $product->average_ratting }}" :show-rating="false" :read-only="true" :increment="0.01"></star-rating>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Single Product End-->
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12 text-center pl-5 pr-5 productEmtpyMsgBack">
                                    <p class="mt-3 text-white">We can't find the products matching the selection</p>
                                </div>
                            @endif
                        </div>

                        <div class="row text-center p-5" wire:loading wire:target="loadProducts">
                            <div class="col-md-12">
                                <p class="text-white">Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ... (rest of the code) ... -->

            </div>
        </div>
        <!--Shop Product End-->

        <!--Pagination Start-->
        <div class="pagination-product d-md-flex justify-content-md-between align-items-center mb-3">
            <div class="paginationSection page-list shop-paginate">
                {{ $products->links() }}
            </div>
        </div>
        <!--Pagination End-->
    </div>

</div>
