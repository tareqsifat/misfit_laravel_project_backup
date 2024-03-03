<nav id="active_nav_area" class="nav_area ">
    <div class="container">
        <div class="nav_area_content">
            <ul>
                <li>
                    <a class="nav_item {{ request()->routeIs('homepage') ? 'nav_link_active':'' }}" href="/"><i class="fas fa-home me-1"></i>home</a>
                </li>
                <li>
                    <a class="nav_item" href="#"><i class="fas fa-info-circle me-1"></i>about</a>
                </li>
                <li>
                    <a class="nav_item" href="#"><i class="fas fa-hands-helping me-1"></i>service</a>
                </li>
                <li>
                    <a class="nav_item {{ request()->routeIs('teacher_page') ? 'nav_link_active':'' }}" href="{{ route('teacher_page') }}"><i class="fas fa-chalkboard-teacher me-1"></i>teacher</a>
                </li>
                <li>
                    <a class="nav_item {{ request()->routeIs('news_event_page') ? 'nav_link_active':'' }}" href="{{ route('news_event_page') }}"><i class="fas fa-newspaper me-1"></i>news & event</a>
                </li>
                <li>
                    <a class="nav_item {{ request()->routeIs('notice_page') ? 'nav_link_active':'' }}" href="{{  route('notice_page') }}"><i class="fas fa-flag me-1"></i>notice</a>
                </li>
                <li>
                    <a class="nav_item {{ request()->routeIs('contact_page') ? 'nav_link_active':'' }}" href="{{  route('contact_page') }}"><i class="fa-solid fa-address-book me-1"></i>contact us</a>
                </li>
                <li>
                    
                    <a class="nav_item" href="/login"><i class="fa fa-unlock me-1"></i>Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
