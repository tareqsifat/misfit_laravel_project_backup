<header class="sidebar_area_header">
    <style>
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            z-index: 9990; /* Place the overlay beneath the sidebar */
        }
        .menu_area_all_content{
            position: relative;
            z-index: 9999;
        }
    </style>
    <div class="container">
        <div class="sidebar_area_header_content">

            <!-- left_area start -->
            <div class="left_area">
                <div id="overlay" class="d-none"></div>
                <div class="menu_area_all_content">
                    <!-- menu_bar start -->
                    <a href="#"
                    {{-- onclick="add_menu_list.classList.toggle('active_class')"  --}}
                    class="menu_bar main_sidebar_class">
                        <i class="fa fa-bars"></i>
                    </a>
                    <!-- menu_bar end -->

                    <!-- menu_list_all area start -->
                    <div id="add_menu_list" class="menu_list_all">
                        <ul>
                            <li>
                                <a href="#" class="product_name all_product_title">All Product</a>
                            </li>
                            @foreach ($categories as $category)
                                @if($category->subcategory->count() == 0)
                                    <li class="level" data-id="{{$category->id}}">
                                        <a href="{{ route('category_product', $category->cat_slug) }}" class="product_name">
                                            {{$category->category_name}}
                                        </a>
                                    </li>
                                @else
                                    @include('livewire.frontend.components.sidebar-component',[
                                        'category'=> $category,
                                    ])
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- menu_list_all area end -->
                </div>

                <!-- menu_area_all_content end -->


                <!-- logo area start -->
                <a href="#" class="logo_area">
                    <img src="{{ asset('assets/frontend/img/logo/logo.png') }}" alt="Stygen_logo">
                </a>
                <!--logo area end -->

                <!-- search area start -->
                <div class="search_area">
                    <form action="#">
                        <input type="text" placeholder="Search product ...">
                        <button class="search_icon">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                <!--search  area end -->
            </div>
            <!-- left_area end -->

            <!-- right_area start -->
            <div class="right_area">

                <!-- shopping_card_area start -->
                <a href="#" class="shopping_card r_icon">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="card_count_area">
                        <p class="count_text">0</p>
                    </div>
                </a>
                <!-- shopping_card_area end -->

                <!-- user_area start -->
                <a href="#" class="user_area r_icon">
                    <i class="fa fa-user-alt"></i>
                </a>
                <!-- user_area end -->
                @foreach($search_products as $item)
                    <a href="{{ route('product_details', $item->pro_slug) }}" class="list-group-item list-group-item-action">
                        <img src="/assets/uploads/product/{{ $item->featured_image }}" width="80" height="80" alt="Image-Ctgcomputer">
                        {{ $item->product_name }}
                    </a>
                @endforeach
                <!-- wishlist_area start -->
                <a href="#" class="wishlist_area r_icon">
                    <i class="fas fa-heart"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    var isOpen = 0;
    $(document).ready(function() {

        $('li.level').on('click', function(event) {
            if($(window).width() <= 768){
                length = $(this).children('li').length;
                bottom = length * 40 + "px";
                $(this).children().find('li').css("border-left","5px solid purple");
                $(this).siblings().children().find('li').css("border-left","0px");
                $(this).css("padding-bottom", bottom);
                $(this).siblings().css("padding-bottom", "0px");
            }
            if(isOpen === $(this).attr("data-id")){
                src = $(this).children('a').attr("data-src");
                location.href = src;
            } else{
                event.preventDefault();
                $(this).siblings().children('ul').css("display","none");
                var ulElement = $(this).closest('li').children('ul');
                if (ulElement.length) {
                    ulElement.css("display","block");
                }
                isOpen = $(this).attr("data-id");
            }

        });

    });

    $(document).ready(function() {
        $('.main_sidebar_class').on('click', function(event) {
            event.preventDefault();
            $('#add_menu_list').toggleClass('active_class');
            $('#overlay').toggleClass('d-none');
            $('li.level').find('ul').css('display','none');
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



