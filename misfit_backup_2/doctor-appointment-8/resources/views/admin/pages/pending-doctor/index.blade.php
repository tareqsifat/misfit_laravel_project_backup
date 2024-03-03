<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Chat With Doctor </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
{{--@dump(\Illuminate\Support\Facades\Session::all())--}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('status_error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 shadow py-3">
                <table class="table">
                    @if(count($doctors) > 0)
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $key => $doctor)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $doctor->name??'' }}</td>
                                    <td>
                                        <form action="{{ route('approve-doctor', $doctor->id) }}"
                                              method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-info text-white btn-sm">Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <tr>
                            <td class="text-center">There are no pending Doctor</td>
                        </tr>
                    @endif
                </table>

                <div class="d-flex justify-content-end">
                    <a href="{{ url('/dashboard') }}" class="btn btn-danger">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
