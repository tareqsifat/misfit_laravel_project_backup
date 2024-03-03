<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Stygen | Best online Gift Shop in Bangladesh</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}">
    <title>Chart Sample</title>
    {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css"> --}}
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom_style.css') }}">
</head>
<body>

    <body class="sidebar-mini" style="height: auto;">
        <div id="backend">
            <div  id="backend_master">
                <div  class="wrapper">
                    <div   id="admin_header">
                        <nav  class="main-header navbar navbar-expand navbar-white navbar-light">
                            <ul  class="navbar-nav">
                                <li  class="nav-item">
                                    <a  data-widget="pushmenu" href="#" class="nav-link"><i  class="fas fa-bars"></i></a>
                                </li>
                                <li  class="nav-item d-none d-sm-inline-block"><a  href="#" class="nav-link">Home</a></li>
                            </ul>
                            <ul  class="navbar-nav ml-auto"></ul>
                        </nav>
                    </div>
                    <div  id="admin_sidebar">
                        <aside class="main-sidebar sidebar-dark-primary elevation-4">
                            <a href="/admin/dashboard" class="brand-link text-center router-link-exact-active active" aria-current="page"><span class="brand-text font-weight-light">STYGEN</span></a>
                            <div class="sidebar">
                                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                    <div class="info"><a href="#" class="d-block">Admin</a></div>
                                </div>
                                <nav class="mt-2">
                                    <ul data-widget="treeview" role="menu" data-accordion="false" class="nav nav-pills nav-sidebar flex-column">
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/dashboard" class="nav-link router-link-exact-active active" aria-current="page">
                                                <i class="nav-icon fas fa-th"></i>
                                                <p data-v-b4ee2b22="">
                                                    Dashboard
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/seller-list" class="nav-link">
                                                <i class="nav-icon fas fa-users"></i>
                                                <p data-v-b4ee2b22="">
                                                    Sellers
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/orders" class="nav-link">
                                                <i class="nav-icon fab fa-bitbucket"></i>
                                                <p data-v-b4ee2b22="">
                                                    Orders
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/brands" class="nav-link">
                                                <i class="nav-icon fab fa-bootstrap"></i>
                                                <p data-v-b4ee2b22="">
                                                    Brands
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/categories" class="nav-link">
                                                <i class="nav-icon fas fa-align-justify"></i>
                                                <p data-v-b4ee2b22="">
                                                    Categories
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/products" class="nav-link">
                                                <i class="nav-icon fab fa-product-hunt"></i>
                                                <p data-v-b4ee2b22="">
                                                    Products
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/LowstockProduct" class="nav-link">
                                                <i class="fa fa-exclamation-circle"></i>
                                                <p data-v-b4ee2b22="">
                                                    Low stock Products
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/addonProducts" class="nav-link">
                                                <i class="nav-icon far fa-file-alt"></i>
                                                <p data-v-b4ee2b22="">
                                                    Add on Product
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/collection" class="nav-link">
                                                <i class="nav-icon far fa-file-alt"></i>
                                                <p data-v-b4ee2b22="">
                                                    Collection
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/occation-gifts" class="nav-link">
                                                <i class="nav-icon fas fa-gift"></i>
                                                <p data-v-b4ee2b22="">
                                                    Occasion Gifts
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/recipients" class="nav-link">
                                                <i class="nav-icon fas fa-gifts"></i>
                                                <p data-v-b4ee2b22="">
                                                    Recipients
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/sliders" class="nav-link">
                                                <i class="nav-icon fab fa-slideshare"></i>
                                                <p data-v-b4ee2b22="">
                                                    Sliders
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/attributes" class="nav-link">
                                                <i class="nav-icon fab fa-adn"></i>
                                                <p data-v-b4ee2b22="">
                                                    Attributes
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/shipping-charge" class="nav-link">
                                                <i class="nav-icon fas fa-truck"></i>
                                                <p data-v-b4ee2b22="">
                                                    Shipping Method
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/packagings" class="nav-link">
                                                <i class="nav-icon fas fa-box-open"></i>
                                                <p data-v-b4ee2b22="">
                                                    Packaging
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/greetings-cards" class="nav-link">
                                                <i class="nav-icon fas fa-hand-holding-heart"></i>
                                                <p data-v-b4ee2b22="">
                                                    Greetings Cards
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/coupons" class="nav-link">
                                                <i class="nav-icon fas fa-percentage"></i>
                                                <p data-v-b4ee2b22="">
                                                    Coupons
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/company-infos" class="nav-link">
                                                <i class="nav-icon fas fa-building"></i>
                                                <p data-v-b4ee2b22="">
                                                    Company Info
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/campaign-users" class="nav-link">
                                                <i class="nav-icon fas fa-user"></i>
                                                <p data-v-b4ee2b22="">
                                                    Users
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/blogs" class="nav-link">
                                                <i class="nav-icon fab fa-bootstrap"></i>
                                                <p data-v-b4ee2b22="">
                                                    Blog
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="/admin/subscribes" class="nav-link">
                                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                                <p data-v-b4ee2b22="">
                                                    Subscribes
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="https://stygen.gift/admin/junior_project_data" class="nav-link">
                                                <i class="nav-icon far fa-file-alt"></i>
                                                <p data-v-b4ee2b22="">
                                                    Junior Project Data
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item has-treeview menu-open">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                                <p data-v-b4ee2b22="">
                                                    Logout
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </aside>
                    </div>
                    <div id="admin_dashboard">
                        <div class="content-wrapper" style="min-height: 1019.31px;">
                            <div  class="content-header">
                                <div  class="container-fluid">
                                    <div class="row mb-2">
                                        <div class="col-sm-6"><h1  class="m-0 text-dark">Admin Dashboard</h1></div>
                                        <div class="col-sm-6">
                                            <ol  class="breadcrumb float-sm-right">
                                                <li  class="breadcrumb-item"><a  href="#">Home</a></li>
                                                <li  class="breadcrumb-item active">Dashboard</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="dropdown float-right mr-5">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  Filter
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{ route('admin.monthly_order') }}">Filter by month</a>
                                                    <a class="dropdown-item" href="{{ route('admin.daily_order') }}">Filter by day</a>
                                                    <a type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModal">
                                                        custom filter
                                                    </a>
                                                </div>
                                              </div>
                                        </div>
                                    </div>

                                    {{-- custom filter modal --}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Pick the dates</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.custom_order') }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                      <label for="recipient-name" class="col-form-label">Start Date:</label>
                                                      <input type="date" name="start_date" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="message-text" class="col-form-label">End Date:</label>
                                                      <input type="date" name="end_date" class="form-control" id="recipient-name">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                </form>
                                            </div>

                                          </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                {!! $chart->container() !!}
                                            </div>
                                        </div>
                                        <script src="{{ $chart->cdn() }}"></script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="admin_footer">
                        <footer  class="main-footer">
                            <strong >©2022 <a  href="#">STYGEN</a>.</strong>
                            All rights reserved.
                            <div  class="float-right d-none d-sm-inline-block"><b >Version</b> 1.0.0</div>
                        </footer>
                    </div>
                    <div id="sidebar-overlay"></div>
                </div>
            </div>
        </div>
        <script src="https://stygen.gift/assets/backend/js/jquery.min.js" type="text/javascript"></script>
        {{ $chart->script() }}


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>


</body>
</html>
