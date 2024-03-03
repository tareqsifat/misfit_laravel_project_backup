<header class="sidebar_area_header" style="background-color: unset; padding: unset;">
    <style>
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black overlay */
            z-index: 9990;
            /* Place the overlay beneath the sidebar */
        }

        .search-form-input {
            border: 2px solid #e7e7e7 !important;
            width: 320px;
        }

        .menu_area_all_content {
            position: relative;
            z-index: 9999;
        }

        .mobile_search_input {
            border-radius: 15px;
            height: 85%;
        }

        .mobile-search-btn{
            background-color: #573276;
            border-radius: 15px;
            color: #fff;
            margin-left: 5px;
        }



    </style>
    <div class="header_area" style="background-color: #e3e3ea; padding: 8px 0px;">
        <div class="container">
            <div class="sidebar_area_header_content">

                <!-- left_area start -->
                <div class="left_area">
                    <div id="overlay" class="d-none"></div>
                    <div class="menu_area_all_content">
                        <!-- menu_bar start -->
                        <a href="#" {{-- onclick="add_menu_list.classList.toggle('active_class')"  --}} class="menu_bar main_sidebar_class">
                            <i class="fa fa-bars"></i>
                        </a>
                        <!-- menu_bar end -->

                        <!-- menu_list_all area start -->
                        <div id="add_menu_list" class="menu_list_all">
                            <ul>
                                <li>
                                    <a href="/shop" class="product_name all_product_title">All Product</a>
                                </li>
                                @foreach ($categories as $category)
                                    @if ($category->subcategory->count() == 0)
                                        <li class="level d-flex align-items-center" data-id="{{ $category->id }}">
                                            <a href="{{ route('category_product', $category->cat_slug) }}"
                                                class="product_name">
                                                {{ $category->category_name }}
                                            </a>
                                        </li>
                                    @else
                                        @include('livewire.frontend.components.sidebar-component', [
                                            'category' => $category,
                                        ])
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- menu_area_all_content end -->


                    <!-- logo area start -->
                    <a href="/" class="logo_area">
                        <img src="{{ asset('assets/frontend/img/logo/logo.png') }}" alt="Stygen_logo">
                    </a>
                    <!--logo area end -->

                    <!-- search area start -->
                    {{-- <div class="search_area">
                        <form action="#">
                            <div class="search-form">
                                <input class="form-control mobile_search_input" type="search" v-model="keyword"
                                    @keyup="SearchProduct" placeholder="Search product...">
                                <button class="mobile-search-btn btn btn-primary" @click.prevent="SearchProduct"
                                    type="submit"><i class="ion-ios-search-strong"></i></button>
                            </div>
                        </form>
                    </div> --}}


                    <div class="search_area header-top-search">
                        <div class="search-categories">
                            <form action="#" wire:submit.prevent="submitSearchPage">
                                <div class="search-froms">
                                    <input type="text" wire:model.lazy="searchQuery" onkeyup="on_keyup_search()" placeholder="Search product...">
                                    <button class="top-search-btn btn btn-sm d-none" id="header_search_btn"
                                        type="submit"><i class="fas fa-search text-dark fa-xs"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>



                    <!--search  area end -->
                </div>
                <!-- left_area end -->

                <!-- right_area start -->
                <div class="right_area">

                    <!-- shopping_card_area start -->
                    <a href="#" class="shopping_card r_icon">
                        <a data-bs-toggle="offcanvas" href="#offcanvasRight" role="button"
                            aria-controls="offcanvasRight"><i class="fas fa-shopping-cart header-icon"><span
                                    class="cart-count">{{ $cart_count }}</span></i></a>
                    </a>
                    <!-- shopping_card_area end -->

                    <!-- user_area start -->
                    <a href="#" class="user_area r_icon">
                        <i class="fa fa-user-alt"></i>
                    </a>
                    <!-- user_area end -->

                    <!-- wishlist_area start -->
                    <a href="#" class="wishlist_area r_icon">
                        <i class="fas fa-heart"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="mobile_search_section">
        <div class="container">
            <div class="row">
                <form action="#" class="mt-2 mb-2" wire:submit.prevent="submitSearchPage">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="mobile_form_input flex-grow-1">
                            <input type="text" class="form-control mobile_search_input" onkeyup="on_keyup_search()" wire:model.lazy="searchQuery"
                            placeholder="Search product...">
                            {{-- <button type="submit" class="mobile-search-btn btn btn-primary"><i class=""></i></button> --}}
                        </div>
                        <div class="mobile_form_btn">
                            <button type="submit" class="mobile-search-btn btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Your Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <div id="cart_sidebar"></div>

        </div>
    </div>

    <div class="search_result" id="search_result">
        
    </div>
</header>

<script>
    function on_keyup_search(){
        console.log(event.target.value);
        let key = event.target.value;
        $.ajax({
            url: "/search_product/?key="+key,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#search_result').html(data.result);
            }
        });
        // fetch('/search_product/?key='+key)
        //     .then(res=>res.text())
        //     .then(res=>{
        //         console.log(res);
        //         document.getElementById('search_result').innerHTML = res;
        //     })
    }
    var isOpen = 0;
    // ="{{ route('category_product', $category->cat_slug) }}"
    function goToCategory(category_id, cat_slug) {
        // event.preventDefault();
        let redirect_url = '/product-category/' + cat_slug;

        if (isOpen == category_id) {

            location.href = redirect_url;
        }
        isOpen = category_id;
    }

    function goToSubCategory(category_id, cat_slug) {
        // console.log('hello', category_id, cat_slug);
        // event.preventDefault();
        let redirect_url = '/product-category/' + cat_slug;
        location.href = redirect_url;
        isOpen = category_id;
    }


    $(document).ready(function() {

        $('li.level').on('click', function(event) {
            if ($(window).width() <= 768) {
                length = $(this).children('li').length;
                bottom = length * 40 + "px";
                $(this).children().find('li').css("border-left", "5px solid purple");
                $(this).siblings().children().find('li').css("border-left", "0px");
                $(this).css("padding-bottom", bottom);
                $(this).siblings().css("padding-bottom", "0px");
            }
            // if (isOpen === $(this).attr("data-id")) {
            //     src = $(this).children('a').attr("data-src");
            //     // location.href = src;
            // } else {
            // event.preventDefault();
            $(this).siblings().children('ul').css("display", "none");
            var ulElement = $(this).closest('li').children('ul');
            if (ulElement.length) {
                ulElement.css("display", "block");
            }
            isOpen = $(this).attr("data-id");
            // }

        });

    });

    $(document).ready(function() {
        $('.main_sidebar_class').on('click', function(event) {
            event.preventDefault();
            $('#add_menu_list').toggleClass('active_class');
            $('#overlay').toggleClass('d-none');
            $('li.level').find('ul').css('display', 'none');
        });
    });

    $(document).on('ready', function() {
        $('#overlay').on('click', function() {
            console.log('overlay clicked');
            $('.menu_list_all').on('click', function(event) {
                event.stopPropagation();
            });

            $('#add_menu_list').toggleClass('active_class');
            $('#overlay').toggleClass('d-none');
        });
    });
</script>
