<header id="header" data-menu-padding="28" data-sticky-menu-padding="8">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="index.html" class="standard-logo"><img src="{{ asset('contents/website') }}/demos/medical/images/logo-medical.png" alt="Canvas Logo"></a>
                    <a href="index.html" class="retina-logo"><img src="{{ asset('contents/website') }}/demos/medical/images/logo-medical@2x.png" alt="Canvas Logo"></a>
                </div><!-- #logo end -->

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                </div>

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu style-3 menu-spacing-margin">

                    <ul class="menu-container">
                        <li class="menu-item {{ Request::is('/') ? 'current' : '' }}"><a class="menu-link" href="{{ route('website_index') }}"><div>Home</div></a></li>
                        <li class="menu-item {{ Request::is('about_us') ? 'current' : '' }}"><a class="menu-link" href="{{ route('website_about') }}"><div>About Us</div></a></li>
                        <li class="menu-item {{ Request::is('department') ? 'current' : '' }}"><a class="menu-link" href="{{ route('website_department') }}"><div>Departments</div></a></li>
                        <li class="menu-item {{ Request::is('appointment') ? 'current' : '' }}"><a class="menu-link" href="{{ route('website_appointment') }}"><div>Appointment</div></a></li>
                        <li class="menu-item {{ Request::is('doctor') || Request::is('doctorlist')  ? 'current' : '' }}"><a class="menu-link" href="{{ route('website_doctor') }}"><div>Doctors</div></a>
                            <ul class="sub-menu-container">
                                <li class="menu-item"><a class="menu-link" href="{{ route('website_doctor_list') }}"><div>Doctor List</div></a></li>
                            </ul>
                        </li>
                        <li class="menu-item {{ Request::is('blog') ? 'current' : '' }}"><a class="menu-link" href="{{ route('website_blog') }}"><div>Blog</div></a></li>
                        <li class="menu-item {{ Request::is('contact') ? 'current' : '' }}"><a class="menu-link" href="{{ route('website_contact') }}"><div>Contact</div></a></li>
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header>