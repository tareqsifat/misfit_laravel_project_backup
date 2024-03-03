
<div>
    <section class="header_top">
        <div class="container">
            <div class="header_top_content">
                <div class="row">
                    <!-- contact_and_email area start -->
                    <div class=" col-sm-8 col-md-9">
                        <div class="contact_and_email">
                            <!-- contact_area start -->
                            <a href="#" class="contact_area">
                                <span class="logo">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                                <span class="title contact_title">
                                    call us
                                </span>
                                <span class="colon_area">
                                    :
                                </span>
                                <span class="value contact_number">
                                    {{ $mobile_number->value }}
                                </span>
                            </a>
                            <!-- contact_area end -->
    
                            <!-- email_area start -->
                            <a href="#" class="email_area">
                                <span class="logo">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <span class="title contact_title">
                                    email
                                </span>
                                <span class="colon_area">
                                    :
                                </span>
                                <span class="value email_address">
                                    {{ $site_email->value }}
                                </span>
                            </a>
                            <!-- email_area end -->
                        </div>
                    </div>
                    <!-- contact_and_email area end -->
                    <!-- login_and_apply_area start -->
                    <div class=" col-sm-4 col-md-3">
                        <div class="login_and_apply_area">
                            <!-- login_area start -->
                            <a href="/login" class="login_area">
                                <span class="logo">
                                    <i class="fas fa-unlock-alt"></i>
                                </span>
                                <span class="title login_title">
                                    login
                                </span>
                            </a>
                            <!-- login_area end -->
                            <!-- apply_area start -->
                            {{-- <a href="#" class="apply_area">
                                <span class="title apply_title">
                                    apply now
                                </span>
                            </a> --}}
                            <!-- apply_area end -->
                        </div>
                    </div>
                    <!-- login_and_apply_area end -->
                </div>
    
    
            </div>
        </div>
    </section>
    <section id="nav_section">
        <section class="header_area_buttom">
            <div class="container">
                <div class="header_area_buttom_content">
                    <div class="row">
                        <!-- logo area start -->
                        <div class="col-xs-6 col-md-3">
                            <div class="logo_area">
                                <a href="/"><img src="/{{ $logo->value }}" alt="logo"></a>
                            </div>
                        </div>
                        <!-- logo area end -->
                        <!-- search_area start -->
                        <div class="col-xs-6 col-md-9">
                            <div class="search_area_content">
                                <form method="#" action="#" class="search_area">
                                    <input type="text" placeholder="Search...">
                                    <button class="button_area">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
    
                                </form>
                            </div>
                        </div>
                        <!-- search_area end -->
                    </div>
    
                    <!-- humberger_menu start -->
                    <section onclick="document.getElementById('active_nav_area').classList.toggle('active_class') "
                        class="humberger_menu">
                        <i class="fa-solid fa-bars"></i>
                    </section>
                    <!-- humberger_menu end -->
                </div>
            </div>
        </section>

        @livewire('components.navbar')
    </section>
    <script>
        window.onscroll = function() {myFunction()};
        
        var navbar = document.getElementById("nav_section");
        var sticky = navbar.offsetTop;
        
        function myFunction() {
          if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
            navbar.classList.add("box_shadow_menu");
          } else {
            navbar.classList.remove("sticky");
            navbar.classList.remove("box_shadow_menu");

          }
        }
    </script>
</div>

