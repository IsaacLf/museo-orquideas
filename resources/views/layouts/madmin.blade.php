<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous"> -->
    <link href="{{ asset('css/fa/css/all.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/fa/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fa/css/brands.css') }}" rel="stylesheet"> -->
    
</head>
<body>
    <div>
        <div class="wrapper">
            <!-- Sidebar -->
            <div class="sidebar" data-color="green" data-background-color="black">
                <div class="logo">
                    <a class="simple-text logo-normal" href="{{ url('/') }}">
                    <i class="fas fa-home"></i>
                    Hogar
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="nav-item {{ (Request::is('index') ? 'active' : '' ) }}">
                            <a class="nav-link" href="{{ url('/index') }}">
                                <i class="fas fa-newspaper"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <li class="nav-item {{ (Request::is('edit') ? 'active' : (Request::is('entries/create')) ? 'active' : (Request::is('entries/*/edit')) ? 'active' : '' ) }}">
                            <a class="nav-link" href="{{ url('/edit') }}">
                                <i class="fas fa-list-ol"></i>
                                <p>Catálogo</p>
                            </a>
                        </li>
                        <li class="nav-item  {{ (Request::is('upload') ? 'active' : '' ) }}">
                            <a class="nav-link" href="{{ url('/upload') }}">
                                <i class="fas fa-images"></i>
                                <p>Multimedia</p>
                            </a>
                        </li>
                        @if(Auth::user()->profile == 'administrator')
                            <li class="nav-item {{ (Request::is('users') ? 'active' : '' ) }}">
                            <a class="nav-link" href="{{ url('/users') }}">
                                <i class="fas fa-users"></i>
                                <p>Usuarios</p>
                            </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- End SideBar -->
            
            <!-- Page content -->
            <div class="main-panel ps-container ps-theme-default">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                    <div class="container-fluid">
                        <div class="navbar-wrapper"></div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                        </button>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="content mt-0">
                    <main class="container-fluid">
                        <div id="app">
                            @yield('content')
                        </div>
                    </main>
                </div>
            </div>

        </div>
    </div>
    <!-- Scripts -->
    <link href="{{ asset('css/fa/js/all.js') }}" rel="stylesheet">
    <script src="{{ asset('js/plupload.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/material-dasboard.js') }}"></script>
    @yield('scripts')
</body>
</html>
