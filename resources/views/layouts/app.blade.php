<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bodeguita 3000') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Menu -->
    @auth
        @if(auth()->user()->habilitado)
        <script src="{{ asset('js/menu.js') }}" defer></script>
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet">
        @endif
    @endauth

    <!-- Bootstrap & jQuery -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/r-2.2.2/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/b-flash-1.5.4/b-html5-1.5.4/r-2.2.2/datatables.min.js"></script>

    <!-- Icons -->
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        @guest
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel menu-superior">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Bodeguita 3000') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Acceder') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endguest
        @auth
            @if(auth()->user()->habilitado)
                @include('layouts.menu.menu')
            @endif
        @endauth
        <main class="py-4 contenido">
            @yield('content')
        </main>
    </div>
    @yield('script')
</body>
</html>
