<div>
    <div id="cart">
        <!--Shopping Cart Area Strat-->
        <div class="Shopping-cart-area">
            <div class="container cart-page-main">
                <div class="row">
                    <div class="col-12">
                        <form action="#">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="picaboo-product-remove">remove</th>
                                        <th class="picaboo-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="picaboo-product-price">Unit Price</th>
                                        <th class="picaboo-product-quantity">Quantity</th>
                                        <th class="picaboo-product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr wire:key="{{ $cart['product']['id'] }}">
                                                <td class="picaboo-product-remove">
                                                    <a href="javascript:void(0)" wire:click="remove({{ $cart['product']['id'] }})"><i class="fa fa-times"></i></a>
                                                </td>
                                                <td class="picaboo-product-thumbnail">
                                                    <a href="javascript:void(0)">
                                                        @if ($cart['product']['featured_image'])
                                                            <img src="/assets/uploads/product/{{ $cart['product']['featured_image'] }}" width="100px" alt="{{ $cart['product']['product_name '] }}">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="picaboo-product-name">
                                                    <a href="#">{{ $cart['product']->product_name }}</a><br>
                                                    {{-- <span v-if="product.attributes.color"><small>Color: {{ product.attributes.color }}</small></span>
                                                    <span v-if="product.attributes.size"><small>, Size: {{ product.attributes.size }}</small></span>
                                                    <span v-if="product.attributes.weight"><small>, Weight: {{ product.attributes.weight }}</small></span> --}}
                                                </td>
                                                <td class="picaboo-product-price"><span class="amount">৳{{ $cart['price'] }}</span></td>
                                                <td class="picaboo-product-quantity">
                                                    <input min="1" type="number" wire:keyup.debounce.200ms="quantityChange($event.target.value, {{ $cart['product']['id'] }})" value="{{ $cart['qty'] }}">
                                                </td>
                                                <td class="product-subtotal"><span class="amount">৳ {{ $cart['price'] * $cart['qty'] }}</span></td>
                                            </tr>

                                            <div wire:loading wire:target="quantityChange({{ $cart['product']['id'] }})">
                                                <div class="cart_loader text-center">
                                                    <div class="spinner-border spinner-border-lg" role="status">
                                                      <span class="visually-hidden">updating cart...</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <!-- <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                        </div> -->
                                        <!--<div class="coupon2">
                                            <input class="button" name="update_cart" value="Update cart" type="submit">
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if (count($carts) > 0)
                                <div class="col-md-5 ms-auto">
                                    <div class="cart-page-total pt-0">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Subtotal <span>৳ {{ number_format($cart_total) }}</span></li>
                                            {{-- <li v-if="cart_products.discount > 0">Discount <span>৳ {{ cart_products.discount }}</span></li> --}}
                                            {{-- <li v-if="cart_products.vat > 0">Vat <span>৳ {{ cart_products.vat }}</span></li> --}}
                                            <li>Total <span>৳ {{ number_format($cart_total) }}</span></li>
                                        </ul>
                                        <!-- <router-link :to="{name: 'checkout'}">Proceed to checkout</router-link> -->
                                        <a href="/checkout">Proceed to checkout</a>
                                        <!--<router-link :to="{name: 'otpLogin'}">Proceed to checkout</router-link>-->
                                    </div>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Shopping Cart Area End-->
    </div>
</div>
