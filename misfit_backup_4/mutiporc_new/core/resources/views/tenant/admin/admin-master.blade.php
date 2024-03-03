@include('tenant.admin.partials.header')

<header id="page-topbar">
    <div class="triggerHeading">
        <div class="menu-trigger">
            <img class="cross" src="{{ global_asset('assets/landlord/admin/images/menu.svg') }}">
            <img class="icon-trigger" src="{{ global_asset('assets/landlord/admin/images/cross.svg') }}">
        </div>
        <div class="pageTitle">
            <img  src="{{ global_asset('assets/landlord/admin/images/shopify-icon.svg') }}">
            <img  src="{{ global_asset('assets/landlord/admin/images/shopify.svg') }}">
        </div>
    </div>
    <div class="col-sm-5 col-lg-5 addressWrapper">
        <input type="text" name="address" id="pac-input" class=" pac-input form-control" placeholder="Search">
    </div>
    <div class="navbar-header">
        <div class="top-bar-sets">
            <div class="btn-group">
                <div class="top-bar-notification dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ global_asset('assets/landlord/admin/images/notification.svg') }}">
                    <div class="notify-number">5</div>
                </div>
                <ul class="dropdown-menu dropdown-menu-notification">
                    <li>
                        <a class="dropdown-item dropdown-item-notify" href="#!">
                            <span class="notifyTitle">Lorem ipsum dolor sit amet</span>
                            <span class="notifyDesc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                        </a>
                    </li>
                    <hr class="dropdown-divider">
                    <li>
                        <a class="dropdown-item dropdown-item-notify" href="#!">
                            <span class="notifyTitle">Lorem ipsum dolor sit amet</span>
                            <span class="notifyDesc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                        </a>
                    </li>
                    <hr class="dropdown-divider">
                    <li>
                        <a class="dropdown-item dropdown-item-notify" href="#!">
                            <span class="notifyTitle">Lorem ipsum dolor sit amet</span>
                            <span class="notifyDesc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                        </a>
                    </li>
                    <hr class="dropdown-divider">
                    <li>
                        <a class="dropdown-item dropdown-item-notify" href="#!">
                            <span class="notifyTitle">Lorem ipsum dolor sit amet</span>
                            <span class="notifyDesc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                        </a>
                    </li>
                    <div class="seeAllNotify">
                        <a href="#">See All</a>
                    </div>
                </ul>
            </div>
            <div class="btn-group">
                <div class="top-bar-avatar dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ global_asset('assets/landlord/admin/images/avatar.png') }}"></div>
                    <ul class="dropdown-menu dropdown-menu-avatar">
                        <li><a class="dropdown-item" href="#">Admin</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#!">Logout</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>


