<header class="header">
    <div class="container">
        <div class="row justify-content-between align-items-center">

            <!-- Header Logo Start -->
            <div class="col">
                <div class="header-logo">
                    <a href="{{ route('web.home')}}"><img src="{{asset('assets/web')}}/images/logo/eurostaff-logo.png" alt="Site Logo"></a>
                </div>
            </div><!-- Header Logo End -->

            <!-- Offcanvas Toggle Start -->
            <div class="col-auto d-lg-none d-flex align-items-center">
                <button class="offcanvas-toggle">
                    <span></span>
                </button>
            </div>
            <!-- Offcanvas Toggle End -->

            <!-- Header Links Start -->
            <div class="header-links col-auto order-lg-3">
                @if(Auth::guard('user_account')->check())
                    <p>{{Auth::guard('user_account')->user()->name}}</p>
                @else
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginSignupModal">Login</a>
                    <span>or</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginSignupModal" >Sign up</a>
                @endif
            </div><!-- Header Links End -->

            <!-- Header Menu Start -->
            <nav id="main-menu" class="main-menu col-lg-auto order-lg-2">
                @include('web.includes.menubar')
            </nav>
            <!-- Header Menu End -->

        </div>

    </div>
</header>