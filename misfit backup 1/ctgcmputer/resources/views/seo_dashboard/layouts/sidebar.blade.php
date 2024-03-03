<div class="page-sidebar custom-scrollbar">
    <div class="sidebar-user text-center">
        <div><img class="img-50 rounded-circle" src="/seo_dashboard/assets/1.jpg" alt="#"></div>
        <h6 class="mt-3 f-12">Admin</h6>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a aria-current="page" href="{{ route('seo_index') }}" class="router-link-active router-link-exact-active sidebar-header">
                <i class="icon-pie-chart"></i>
                <span>Analytics</span>
            </a>
        </li>
        <li>
            <a aria-current="page" href="{{ route('seo_website') }}" class="router-link-active router-link-exact-active sidebar-header">
                <i class="icon-pie-chart"></i>
                <span>Website SEO</span>
            </a>
        </li>
        <li>
            <a aria-current="page" href="{{ route('seo_ctegories') }}" class="router-link-active router-link-exact-active sidebar-header">
                <i class="icon-pie-chart"></i>
                <span>SEO Categories</span>
            </a>
        </li>
        <li>
            <a aria-current="page" href="{{ route('seo_products') }}" class="router-link-active router-link-exact-active sidebar-header">
                <i class="icon-pie-chart"></i>
                <span>SEO Products</span>
            </a>
        </li>
        <li>
            <a aria-current="page" href="{{ route('seo_tags') }}" class="router-link-active router-link-exact-active sidebar-header">
                <i class="icon-pie-chart"></i>
                <span>SEO Tags</span>
            </a>
        </li>
        <li>
            <a href="/logout" class="sidebar-header" onclick=" event.preventDefault(); return confirm('logout') && logout_form.submit();">
                <i class="icon-lock"></i>
                <span> Logout</span>
            </a>
            <form action="/seo-logout" method="POST" id="logout_form">
                @csrf
            </form>
        </li>
    </ul>
</div>
