<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coaching management system</title>
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/icon/fontawesome-free-6.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="./assets/styles/style.css">

    <style>
        /* width */
        html::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        html::-webkit-scrollbar-track {
            box-shadow: inset 0 0 2px #7c7c7c;
            border-radius: 10px;
        }

        /* Handle */
        html::-webkit-scrollbar-thumb {
            background: #002147;
            border-radius: 10px;
        }
    </style>
    @livewireStyles
</head>

<body>

    @yield('content')

    @livewireScripts
</body>
</html>
