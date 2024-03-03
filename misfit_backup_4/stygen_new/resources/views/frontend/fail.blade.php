<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Something went wrong!</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/favicon.png') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>


    <body>
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">Opps!</h1>
                <p class="fs-3"> <span class="text-warning">Something</span> went wrong.</p>
                @if(isset($errorMessage))
                    <p class="fw-bolder text-danger">{{ $errorMessage }}</p>
                @endif
                <a href="/shop" class="btn btn-primary">Go back to Home page</a>
            </div>
        </div>
    </body>


</html>
