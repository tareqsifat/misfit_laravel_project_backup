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

            <!-- Header Links Start -->
            <div class="header-links col-auto order-lg-3">
                @if(Auth::guard('user_account')->check())
{{--                    <p>{{Auth::guard('user_account')->user()->name ? Auth::guard('user_account')->user()->name : Auth::guard('user_account')->user()->email}}</p>--}}
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #000b182e; border-radius: 30px;">
                            {{Auth::guard('user_account')->user()->name ? Auth::guard('user_account')->user()->name : Auth::guard('user_account')->user()->email}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="{{ route('auth_user') }}">My Account</a>
                            </li>
                            <li>
                                <form action="{{route('auth_logout')}}" method="post">
                                    @csrf
                                    <button type="submit" style="border: 0px;background-color: #fff;
                                            font-weight: 600;padding-left: 17px;">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @elseif(Auth::guard('employer')->check())
                    <p>{{Auth::guard('employer')->user()->full_name}}</p>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <span>or</span>
                    <a href="{{ route('register') }}">Sign up</a>
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