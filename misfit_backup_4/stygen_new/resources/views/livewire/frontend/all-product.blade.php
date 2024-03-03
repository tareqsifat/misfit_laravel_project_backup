<div>
    <style>
        .container-slider {
            background: #cc99ff;
        }
        #sub_category_product {
            background: #cc99ff;
        }
        .addtocart {
            background-color: #5e2e87;
            font-size: 12px;
        }
        .addtocart i {
            margin-right: 5px;
            padding-left: 1px;
        }
        .detailsbtn {
            background-color: #5e2e87;
            color: white;
            font-size: 12px;
        }
        </style>
    
    <div class="container">
        <div class="breadcrumb-area">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <ul>
                            <li><a href="/">Home </a></li>
                            <li class="active">shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-topbar-wrapper mb-30 d-md-flex justify-content-md-between align-items-center mt-3">
            <div class="grid-list-option">
                <p class="show-product">Showing {{ $products->total() }} results</p>
            </div>
            <!--Toolbar Short Area Start-->
            <div class="toolbar-short-area d-md-flex align-items-center">
                <div class="toolbar-shorter">
                    <label>Sort By:</label>
                    <select class="productSorting" wire:change="applySort" wire:model="sort">
                        <option value="id-DESC">Default sorting</option>
                        <option value="id-DESC">Sort by latest</option>
                        <option value="regular_price-ASC">Sort by price: low to high</option>
                        <option value="regular_price-DESC">Sort by price: high to low</option>
                    </select>
                </div>
            </div>
            <!--Toolbar Short Area End-->
        </div>
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="shop-product">
                    <div id="myTabContent-2" class="tab-content">
                        <div id="grid" class="tab-pane fade show active">
                            <div class="product-grid-view">
                                <div class="row" wire:loading.remove wire:target="loadProducts">
                                    @if ($products->count() > 0)
                                        @foreach ($products as $product)
                                            <div class="col-12 col-lg-3 col-xl-3 col-md-3 mb-3">
                                                <!--Single Product Start-->
                                                <div class="single-product mb-3 shop-product-single">
                                                    <div class="product-img product-img-category">
                                                        <a href="{{ route('product_details', $product->pro_slug) }}" class="w-100">
                                                            @if ($product->featured_image)
                                                                <img class="first-img lazy"
                                                                    src="/assets/uploads/product/{{ $product->featured_image }}"
                                                                    alt="{{ $product->id }}" loading="lazy">
                                                            @else
                                                                <img class="first-img lazy"
                                                                   src="/assets/frontend/img/icon/empty_product.jpeg">
                                                            @endif
                                                        </a>
                                                        {{-- @if (discount_percentage($product->regular_price, $product->sales_price))
                                                                <span class="sticker">{{ discount_percentage($product->regular_price, $product->sales_price) }}</span>
                                                            @endif --}}

                                                    </div>
                                                    <div class="product-content">
                                                        <h4><a href="{{ route('product_details', $product->pro_slug) }}">{{ $product->product_name }}</a></h4>
                                                        <div class="product-price">
                                                            @if ($product->sales_price)
                                                                <span class="price"><del>৳{{ $product->regular_price }}</del> ৳{{ $product->sales_price }}</span>
                                                            @else
                                                                <span class="price">৳{{ $product->regular_price }}</span>
                                                            @endif
                                                            <div class="row mt-3">


                                                                @if ($product->purchase_stock_sum_qty - $product->sell_stock_sum_qty > 1 && $product->status == 1)
                                                                    <div class="col-md-6 col-sm-6 col-lg-6 col-6">
                                                                        @if ($product->product_variations && count($product->product_variations) > 0)
                                                                            <span><a class="btn btn-primary btn-sm ps-2 detailsbtn mb-2"
                                                                                    href="{{ route('product_details', $product->pro_slug) }}">select variant</a></span>
                                                                        @else

                                                                        @php
                                                                            $product_data = [];
                                                                            $product_data['product_id'] = $product->id;
                                                                            $product_data['product_name'] = $product->product_name;
                                                                            $product_data['sales_price'] = $product->sales_price;
                                                                            $product_data['regular_price'] = $product->regular_price;
                                                                            $product_data['slug'] = $product->pro_slug;
                                                                            $product_data = (object) $product_data;
                                                                            $product_data = json_encode($product_data);
                                                                        @endphp
                                                                        <span>
                                                                            <button type="button" class="btn btn-primary btn-sm pe-2 addtocart mb-2" href="javascript:void(0)" onclick="addToCart({{ $product_data }})"><i class="fas fa-shopping-bag"></i>
                                                                                Add to cart
                                                                            </button>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-lg-6 col-6">
                                                                        <span><a class="btn btn-primary btn-sm ps-2 detailsbtn"
                                                                                href="{{ route('product_details', $product->pro_slug) }}"><i class="fas fa-eye pe-2"></i>Details</a></span>
                                                                    </div>
                                                                @else
                                                                    <div class="col-12">
                                                                        <h4>Out of stock</h4>
                                                                    </div>
                                                                @endif


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
                <div class="mt-5 d-flex justify-content-center">
                    {{ $products->onEachSide(3)->links() }}
                </div>
            </div>
        </div>

        <!--Pagination Start-->
        <div class="pagination-product d-md-flex justify-content-md-between align-items-center">
            <div class="paginationSection page-list shop-paginate">

            </div>
        </div>
        <!--Pagination End-->
    </div>

    <!--Shop Product End-->
</div>
@push('gtag_data')
<script>
    let datas = @json($products);
    var google_product_data = [];
    var index = 0;
    
    let product_datas = datas.data.forEach(element => {
        index++;
        let product_discount = 0;
        let tempObj = {};
        let price = element.regular_price;
        tempObj.item_id = element.product_sku;
        tempObj.item_name = element.product_name;
        tempObj.affiliation = "Stygen online shop";
        if (element.sales_price != null) {
            product_discount = element.regular_price - element.sales_price;
            price = element.sales_price
        }
        tempObj.discount = product_discount;
        tempObj.index = index;
        tempObj.brand = element?.brand?.brand_name;
        tempObj.item_category = element?.category?.category_name;
        tempObj.item_list_id = "category_products";
        tempObj.item_list_name = "Category Products";
        tempObj.price = price;
        tempObj.quantity = 1;

        google_product_data.push(tempObj);
    });
    console.log(google_product_data);
    gtag("event", "view_item_list", {
        item_list_id: "category_products",
        item_list_name: "Category products",
        items: google_product_data
    });
</script>
@endpush