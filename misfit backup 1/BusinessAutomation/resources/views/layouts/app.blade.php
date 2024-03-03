<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>



{{--        sidebar--}}
        <div class="container-fluid" style="border: 1px solid black">
            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="row" style="border: 1px solid rebeccapurple">
                    <div class="col-3" style="border: 1px solid darkblue">
                        @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->user_type_id == 1)
                            @include('includes.side-bar')
                        @elseif(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->user_type_id == 2)
                            @include('includes.teammate_side-bar')
                        @endif
                    </div>
                    <div class="col-9">
                        @if(\Illuminate\Support\Facades\Session::has('error'))
                            <span class="text-bg-danger text-white w-100 p-4 d-block">{{ \Illuminate\Support\Facades\Session::get('error') }}</span>
                        @endif
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <span class="text-bg-success text-white w-100 p-4 d-block">{{ \Illuminate\Support\Facades\Session::get('success') }}</span>
                        @endif
                        @yield('breadcrumb')
                        <main class="py-4">
                            @yield('content')
                        </main>
                    </div>
                </div>
            @else
                <main class="py-4">
                    @yield('content')
                </main>
            @endif
        </div>
    </div>
</body>
</html>
