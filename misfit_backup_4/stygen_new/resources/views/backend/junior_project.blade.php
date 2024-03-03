<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Stygen | Best online Gift Shop in Bangladesh</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/backend.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom_style.css') }}">
</head>
<body class="sidebar-mini">

    <main role="main" class="container">
          <table class="table">
            <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded box-shadow">
                <div class="lh-100">
                <h6 class="mb-0 text-white lh-100">Junior Project Data</h6>
                <small>2021</small>
                </div>
            </div>
              <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">phone number</th>
                <th scope="col">address</th>
                <th scope="col">remarks</th>
              </tr>
            <tbody>
                @foreach ($junior_data as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone_number }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->remarks }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
          </table>


      </main>

    <script src="{{ asset('assets/backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/adminlte.js') }}"></script>
    <script src="{{ asset('js/backend.js') }}"></script>
</body>
</html>
