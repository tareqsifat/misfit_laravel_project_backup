<div id="header_block">
    <header class="header_area">
        <div class="header_area_content custom-container">
            <!-- logo_area start -->
            <!-- <div class="col-2"> -->
            <div class="logo_area">
                <a href="/">
                    <img src="/{{$setting->header_logo}}" alt="logo">
                </a>
            </div>
            <!-- </div> -->
            <!-- logo_area end -->
            <!-- search_area start -->
            <div class="search_area">
                <!-- <div class="search_content"> -->
                <form class="w-100" onsubmit="event.preventDefault();">
                    <input class="form-control" onkeyup="on_keyup_search()" type="text" id="search" placeholder="Search Products" />
                    <button type="submit" class="search_icon">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
                <div class="search_result" id="search_result">

                </div>
            </div>
            <!-- search_area end-->
            <!-- item_area start-->
            <div class="item_area">
                <!--item_1 start -->
                {{-- <div class="item offers">
                    <span href="#">
                        <div class="icon">
                            <i class="fa fa-gift"></i>
                        </div>
                        <div class="title_and_discription">
                            <div class="title">
                                <h2>offers</h2>
                            </div>
                            <div class="discription">
                                <p>latest offers</p>
                            </div>
                        </div>
                    </span>
                </div> --}}
                <!--item_1 end -->

                <!--item_2 start -->
                {{-- <div class="item other">
                    <a href="#">
                        <div class="icon">
                            <i class="fa fa-bolt"></i>
                        </div>
                        <div class="title_and_discription">
                            <div class="title">
                                <h2>item 2</h2>
                            </div>
                            <div class="discription">
                                <p>latest item 2</p>
                            </div>
                        </div>
                    </a>
                </div> --}}
                <!--item_2 end -->

                <!--item_3 start -->
                <div class="item account">
                    <span href="#">
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="title_and_discription">
                            <div class="title">
                                <h2>account</h2>
                            </div>
                            <div class="discription">
                                <div class="register_and_login">
                                    @auth
                                    <p>
                                        <a href="/profile">Profile</a>
                                    </p>
                                    @else
                                    <p>
                                        <a href="/register" class="register">register</a>
                                        or
                                        <a href="/login" class="login">login</a>
                                    </p>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
                <div class="item account">
                    <span href="#">
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="title_and_discription">
                            <div class="title">
                                <a href="/cart">
                                    <h2>
                                        Carts
                                    </h2>
                                </a>
                            </div>
                            <div class="discription">
                                <div class="register_and_login">
                                    <p>
                                        (
                                            <b class="header_cart_count">
                                                @if(session()->has("carts"))
                                                    {{count(session()->get('carts'))}}
                                                @else
                                                    0
                                                @endif
                                            </b>
                                        )
                                    </p>
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
                <!--item_3 end -->
                <!-- button_area start -->
                <div class="button_area">
                    <a href="#">
                        PC Builder
                    </a>
                </div>
                <!-- button_area end-->
            </div>
            <!-- item_area end-->

            <!-- responsive_header_manu start -->
            <div class="responsive_header_manu">
                <!-- menu_bar start-->
                <a href="#" class="menu_bar" onclick="event.preventDefault() ;document.getElementById('navs').classList.toggle('active')">
                    <i class="fa fa-align-left"></i>
                </a>
                <!-- menu_bar end-->
                <!-- logo start-->
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('contents/frontend') }}/assets/images/logo.png" alt="logo">
                    </a>
                </div>
                <!-- logo end-->
                <!-- search_and_card start -->
                <div class="search_and_card">
                    {{-- <a href="jascript:void;" onclick="$('.search_area').toggleClass('active')" class="search_icon">
                        <i class="fa fa-search"></i>
                    </a> --}}

                    <a href="/cart" class="card_icon">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="count">
                            <span class="cart-count header_cart_count">
                                @if(session()->has("carts"))
                                    {{count(session()->get('carts'))}}
                                @else
                                    0
                                @endif
                            </span>
                        </span>
                    </a>
                </div>
                <!-- search_and_card end -->
            </div>
            <!--responsive_header_manu end -->
        </div>
    </header>

    <div class="responsive_header_bottom d-none">
        <div class="responsive_header_bottom_content">

            <a href="#" class="bottom_item gifi">
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="icon_title">
                    <p>Cart</p>
                </div>
            </a>

            @auth
            <a href="/profile" class="bottom_item user">
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <div class="icon_title">
                    <p>Account</p>
                </div>
            </a>
            @else
            <a href="/login" class="bottom_item user">
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <div class="icon_title">
                    <p>Account</p>
                </div>
            </a>
            @endauth
        </div>
    </div>
</div>
