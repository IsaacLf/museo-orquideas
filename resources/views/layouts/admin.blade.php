<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar">
                <a href="{{ url('/') }}" class="navbar-brand">
                    <i class="fas fa-home"></i>
                    <b>Hogar</b>
                </a>
                <ul class="list-unstyled components">
                    <li class="{{ (Request::is('home') ? 'active' : '' ) }}">
                        <a href="{{ url('/home') }}">Inicio</a>
                    </li>
                    <li class="{{ (Request::is('edit') ? 'active' : (Request::is('entries/create')) ? 'active' : '' ) }}">
                        <a href="{{ url('/edit') }}">Entradas</a>
                    </li>
                    <li class="{{ (Request::is('upload') ? 'active' : '' ) }}">
                        <a href="{{ url('/upload') }}">Medios</a>
                    </li>
                    @if(Auth::user()->profile == 'administrator')
                    <li class="{{ (Request::is('users') ? 'active' : '' ) }}">
                        <a href="{{ url('/users') }}">Usuarios</a>
                    </li>
                    @endif
                </ul>
            </nav>
            <!-- Page content -->
            <!-- <div id="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                    
                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button>
                        
                    </div>
                </nav>
            </div> -->
            <main id="main-tag" class="py-4">
                <div id="app" class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
