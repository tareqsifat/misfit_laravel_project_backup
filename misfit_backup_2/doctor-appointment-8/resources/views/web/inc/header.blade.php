<header id="topnav" class="navigation sticky">
    <div class="container">
        <!-- Logo container-->
        <div>
            <a class="logo" href="{{ route('index') }}">
                <span class="logo-light-mode">
                    <img src="{{ asset('/') }}uploads/content/{{ $content->website_logo }}" class="l-dark" height="22"
                      alt="">
                    <img src="{{ asset('/') }}uploads/content/{{ $content->website_logo }}" class="l-light" height="22"
                      alt="">
                </span>
                <img src="{{ asset('/') }}uploads/content/{{ $content->website_logo }}" height="22"
                  class="logo-dark-mode" alt="">
            </a>
        </div>
        <!-- End Logo container-->

        <!-- Start Mobile Toggle -->
        <div class="menu-extras">
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>
        <!-- End Mobile Toggle -->

        <!-- Start Dropdown -->
        <ul class="dropdowns list-inline mb-0">

            <li class="list-inline-item mb-0 ms-1">
                <div class="dropdown dropdown-primary">
                    <button type="button" class="btn btn-pills btn-soft-primary dropdown-toggle p-0"
                      data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('/') }}assets/web//01.png" class="avatar avatar-ex-small rounded-circle"
                          alt="">
                    </button>
                    <div class="dropdown-menu dd-menu dropdown-menu-end shadow border-0 mt-3 py-3"
                      style="min-width: 200px;">
                        @auth
                        <a class="dropdown-item d-flex align-items-center text-dark" href="doctor-profile.html">
                            <img src="{{ asset('/') }}assets/web//01.png"
                              class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                            <div class="flex-1 ms-2">
                                <span class="d-block mb-1">{{ Auth::user()->name }}</span>
                                <small class="text-muted">Orthopedic</small>
                            </div>
                            <a class="dropdown-item text-dark" href="{{ route('patient.dashboard') }}">
                    <span class="mb-0 d-inline-block me-1"><i
                            class="uil uil-dashboard align-middle h6"></i></span> Dashboard
                </a>
                        </a>
                        <a class="dropdown-item text-dark" href="{{route('dashboard.index')}}">
                            <span class="mb-0 d-inline-block me-1"><i
                                  class="uil uil-dashboard align-middle h6"></i></span> Profile
                        </a>

                        <div class="dropdown-divider border-top"></div>
                        <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="mb-0 d-inline-block me-1"><i
                                  class="uil uil-sign-out-alt align-middle h6"></i></span> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        @else
                        <a class="dropdown-item text-dark" href="{{ route('login') }}">
                            <span class="mb-0 d-inline-block me-1"><i
                                  class="uil uil-sign-in-alt align-middle h6"></i></span> Login
                        </a>
                        <a class="dropdown-item text-dark" href="{{ route('register') }}">
                            <span class="mb-0 d-inline-block me-1"><i
                                  class="uil uil-user-plus align-middle h6"></i></span> Register
                        </a>
                        @endauth
                    </div>
                </div>
            </li>



        </ul>
        <!-- Start Dropdown -->

        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu nav-left nav-light">
                <li><a href="{{ route('index') }}" class="sub-menu-item">Home</a></li>
                @if(Route::is('index'))
                <li><a href="#appointment" class="text-foot">Appointment</a></li>
                <li><a href="#about" class="text-foot">About</a></li>
                <li><a href="#service" class="text-foot">Service</a></li>
                <li><a href="#portfolio" class="text-foot">Portfolio</a></li>
                <li><a href="#news" class="text-foot">News & Blogs</a></li>
                <li><a href="#availability" class="text-foot">Availability</a></li>
                @else
                <li><a href="{{ route('index') }}#appointment" class="text-foot">Appointment</a></li>

                <li><a href="{{ route('index') }}/#about" class="text-foot">About</a></li>
                <li><a href="{{ route('index') }}/#service" class="text-foot"> Service</a></li>
                <li><a href="{{ route('index') }}/#portfolio" class="text-foot">Portfolio</a></li>
                <li><a href="{{ route('index') }}/#news" class="text-foot">News & Blogs</a></li>
                <li><a href="{{ route('index') }}/#availability" class="text-foot">Availability</a></li>

                @endif
            </ul>
            <!--end navigation menu-->
        </div>
        <!--end navigation-->
    </div>
    <!--end container-->
</header>