<!DOCTYPE html>
<html lang="en" dir="ltr">
    

<head>
    <meta charset="utf-8">
    <title>Doctor Profile</title>
    <!-- Include your CSS links and meta tags here -->
    <link href="{{ asset('/') }}assets/web/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Include other CSS files -->
    <link href="{{ asset('/') }}assets/web/css/style.min.css" class="theme-opt" rel="stylesheet" type="text/css">
    <!-- Include your favicon link -->
    <link rel="shortcut icon" href="{{ asset('/') }}uploads/content/favicon.png">
</head>

<body>
    <!-- Header -->
    <header id="topnav" class="navigation sticky">
        <div class="container">
            <!-- Your header content here -->
            <!-- For example, your logo and navigation menu -->
            <a class="logo" href="{{ route('index') }}">
                
                <span class="logo-light-mode">
                    <img src="{{ asset('/') }}uploads/content/logo.png" class="l-dark" height="22" alt="">
                    <img src="{{ asset('/') }}uploads/content/logo.png" class="l-light" height="22" alt="">
                </span>
                <img src="{{ asset('/') }}uploads/content/logo.png" height="22" class="logo-dark-mode" alt="">
            </a>
            
                    @yield('main-body')
                </div>
            </div>
            <div class="menu-extras">
                
                <!-- Your menu extras here -->
                @section('main-body')
                <section class="bg-hero">
                    <div class="container">
                        <div class="row mt-lg-5">
                            <div class="col-md-6 col-lg-4">
                                <div class="rounded shadow overflow-hidden sticky-bar">
                                    <div class="card border-0">
                                        <img src="{{ asset('assets/web/images/bg/bg-profile.jpg') }}" class="img-fluid" alt="">
                                    </div>

                                    <div class="text-center avatar-profile margin-nagative mt-n5 position-relative pb-4 border-bottom">
                                    @if ($doctor)
                                    <div class="card border-0">
                                        <div style="overflow: hidden;">
                                            <img src="{{ asset('uploads/doctors/' . $doctor->image) }}" class="text-center avatar-profile margin-nagative mt-n5 position-relative pb-4 border-bottom" alt="" style="width: 170px; height: 
                                            170px;margin-top:20px ; object-fit: cover;">                                        </div>
                                    </div>
                                    @else
    <!-- Handle the case when $doctor is null -->
    <p>No doctor data available</p>
@endif

                                        <h5 class="mt-3 mb-1">{{ $doctor->name }}</h5>
                                        <p class="text-muted mb-0">Blood Group : {{ $doctor->blood_group }}</p>
                                    </div>

                                    <div class="list-unstyled p-4">
                                        <div class="progress-box mb-4">
                                            <h6 class="title">Complete your profile</h6>
                                            <div class="progress">
                                                <div class="progress-bar position-relative bg-primary" style="width: 89%;">
                                                    <div class="progress-value d-block text-muted h6">89%</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end process box-->

                                        <div class="d-flex align-items-center mt-2">
                                            <i class="uil uil-user align-text-bottom text-primary h5 mb-0 me-2"></i>
                                            <h6 class="mb-0">{{ $doctor->name }}</h6>
                                            <p class="text-muted mb-0 ms-2"></p>
                                        </div>
                                        <div class="d-flex align-items-center mt-2">
                                            <i class="uil uil-user align-text-bottom text-primary h5 mb-0 me-2"></i>
                                            <h6 class="mb-0">{{ $doctor->email }}</h6>
                                            <p class="text-muted mb-0 ms-2"></p>
                                        </div>

                                        <div class="d-flex align-items-center mt-2">
                                            <i class="uil uil-envelope align-text-bottom text-primary h5 mb-0 me-2"></i>
                                            <h6 class="mb-0">{{ $doctor->birthday }}</h6>
                                            <p class="text-muted mb-0 ms-2"></p>
                                        </div>

                                        <div class="d-flex align-items-center mt-2">
                                            <i class="uil uil-book-open align-text-bottom text-primary h5 mb-0 me-2"></i>
                                            <h6 class="mb-0">{{ $doctor->phone }}</h6>
                                            <p class="text-muted mb-0 ms-2"></p>
                                        </div>

                                        <div class="d-flex align-items-center mt-2">
                                            <i class="uil uil-italic align-text-bottom text-primary h5 mb-0 me-2"></i>
                                            <h6 class="mb-0">{{ $doctor->address }}</h6>
                                            <p class="text-muted mb-0 ms-2"></p>
                                        </div>

                                        <div class="d-flex align-items-center mt-2">
                                            <i class="uil uil-medical-drip align-text-bottom text-primary h5 mb-0 me-2"></i>
                                            <h6 class="mb-0"></h6>
                                            <p class="text-muted mb-0 ms-2"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-8 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                                <div class="card border-0 shadow overflow-hidden">
                                    <ul class="nav nav-pills nav-justified flex-column flex-sm-row rounded-0 shadow overflow-hidden bg-light mb-0" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link rounded-0 active" id="overview-tab" data-bs-toggle="pill" href="#pills-overview" role="tab" aria-controls="pills-overview" aria-selected="true">
                                                <div class="text-center pt-1 pb-1">
                                                    <h4 class="title fw-normal mb-0">Profile</h4>
                                                </div>
                                            </a>
                                            <!--end nav link-->
                                        </li>
                                        <!--end nav item-->

                                        <li class="nav-item" role of="presentation">
                                            <a class="nav-link rounded-0" id="experience-tab" data-bs-toggle="pill" href="#pills-experience" role="tab" aria-controls="pills-experience" aria-selected="false" tabindex="-1">
                                                <div class="text-center pt-1 pb-1">
                                                    <h4 class="title fw-normal mb-0">Profile Settings</h4>
                                                </div>
                                            </a>
                                            <!--end nav link-->
                                        </li>
                                        <!--end nav item-->
                                    </ul>

                                    <div class="tab-content p-4" id="pills-tabContent">
                                        <div class="tab-pane fade active show" id="pills-overview" role="tabpanel" aria-labelledby="overview-tab">

                                        </div>

                                      
                                            <div class="col-lg-6 col-12 mt-4">
                                                <h5 style="color: white;"></h5>
                                            
                                                <!-- Add the "Dashboard" button -->
                                                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Dashboard</a>

                                        </div>
                                    </div>

                                    <h3></h3>

                                    <!--end row-->
                                </div>

                                <div class="tab-pane fade" id="pills-experience" role="tabpanel" aria-labelledby="experience-tab">
                                    <h5 class="mb-0">Personal Information :</h5>
                                    <!--end row-->
                                    <form class="mt-4" action="{{ route('doctor.update', ['id' => $doctor['id']]) }}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')


                                        @csrf
                                        <!-- Your form fields -->
                                        <div class="col-sm-12">




                                            <div class="row">
                                                <div class="col-lg-6 col-md-4">
                                                    <input type="file" name="image" data-default-file="{{ asset('') }}public/doctors/{{ $doctor->image }}" class="dropify" alt="">

                                                </div>
                                                <!--end col-->

                                                <div class="col-lg-6 col-md-12 text-center text-md-start mt-4 mt-sm-0">
                                                    <h6 class="">Upload your picture</h6>
                                                    <p class="text-muted mb-0">For best results, use an image at least
                                                        256px by 256px in either .jpg or .png format</p>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input name="name" id="name" type="text" class="form-control" placeholder="User Name :" value="{{ $doctor['name'] }}">
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Your Email</label>
                                                        <input name="email" id="email" type="email" class="form-control" placeholder="Your email :" value="{{ $doctor['email'] }}">
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone no.</label>
                                                        <input name="phone" id="number" type="text" class="form-control" placeholder="Phone no. :" value="{{ $doctor['phone'] }}">
                                                    </div>
                                                </div>
                                                <!--end col-->

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Address</label>
                                                        <input name="address" id="address" type="text" class="form-control" placeholder="User Address :" value="{{ $doctor['address'] }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">height</label>
                                                        <input name="height" id="height" type="text" class="form-control" placeholder="User height :" value="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">weight</label>
                                                        <input name="weight" id="weight" type="text" class="form-control" placeholder="User weight :" value="">
                                                    </div>
                                                </div>

                                            </div>
                                            <!--end row-->
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="submit" id="submit" name="send" class="btn btn-primary" value="Save changes">
                                        </div>
                                </div>
                                </form>
                                <!--end form-->

                            </div>
                        </div>
                    </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
        </div>
        <!--end container-->
        </section>
        @endsection
        </div>
        </div>
    </header>
    <!-- End Header -->

    @yield('main-body')

    <!-- Back to top button -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5 rounded-pill text-center bg-primary justify-content-center align-items-center">
        <i class="ri-arrow-up-line"></i>
    </a>
    <!-- End Back to top button -->

    <!-- Include your JavaScript files here -->
    <script src="{{ asset('') }}assets/admin/libs/jquery/jquery.min.js"></script>
    <!-- Include other JavaScript files -->
    <script>
        var topButton = document.getElementById("back-to-top");

        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                topButton.style.display = "block";
            } else {
                topButton.style display = "none";
            }
        };

        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('') }}assets/admin/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/node-waves/waves.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- apexcharts -->
    <script src="{{ asset('') }}assets/admin/libs/apexcharts/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <!-- dashboard init -->
    <script src="{{ asset('') }}assets/admin/js/pages/dashboard.init.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/tinymce/tinymce.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/lightgallery.umd.js" integrity="sha512-hTxPc7AKRjkXWaLJrpFNAaDg6k2dlcFr83GY/A6QCcG9frr2fLvZx/bc8rTnNkoOXTSQsW0EkFSb1KvHQMVksQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/thumbnail/lg-thumbnail.umd.min.js" integrity="sha512-hdzLQVAURjMzysJVkWaKWA2nD+V6CcBx6wH0aWytFnlmgIdTx/n5rDWoruSvK6ghnPaeIgwKuUESlpUhat2X+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/plugins/zoom/lg-zoom.umd.js" integrity="sha512-cG/6qcKX9JkbA8kJ7yZulIMXp3l2rQrwmr24BBLNo777SYcuDZUsIbkBNaCnoFr45hIPSfGXhwTn7bWyvNWmEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('') }}assets/admin/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('') }}assets/admin/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/jszip/jszip.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/jquery.repeater/jquery.repeater.min.js"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('') }}assets/admin/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}assets/admin/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="{{ asset('') }}assets/admin/js/pages/datatables.init.js"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('') }}assets/admin/libs/sweetalert2/sweetalert2.min.js"></script>

    <script src="{{ asset('') }}assets/admin/js/app.js"></script>


    @if ($massage = Session::get('success'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "{{ $massage }}",
            showConfirmButton: !1,
            timer: 3000
        })
        Swal();
    </script>
    @endif


    @if ($massage = Session::get('error'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "Error",
            title: "{{ $massage }}",
            showConfirmButton: !1,
            timer: 3000
        })
        Swal();
    </script>
    @endif





</body>

</html>