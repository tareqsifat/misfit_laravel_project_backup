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
    {{-- <link rel="stylesheet" href="{{ asset('assets/backend/css/custom_style.css') }}"> --}}
</head>
<body>

    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div  class="content-header">
                        <div  class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6"><h1  class="m-0 text-dark">Daily Charts</h1></div>
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
                                            <a class="dropdown-item" href="{{ route('chart') }}">Filter by day</a>
                                            <a class="dropdown-item" href="{{ route('monthly_chart') }}">Filter by month</a>
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

                    <div id="admin_footer">
                        <footer  class="main-footer">
                            <strong >©2022 <a  href="#">STYGEN</a>.</strong>
                            All rights reserved.
                            <div  class="float-right d-none d-sm-inline-block"><b >Version</b> 1.0.0</div>
                        </footer>
                    </div>
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
