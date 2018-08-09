<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Museo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            .sub-title {
                font-size: 36px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            
                <div class="top-right links">
                    @auth
                        <!-- <a href="{{ url('/home') }}">Home</a> -->
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Cerrar sesión') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}">Iniciar sesión</a>
                        <!-- <a href="{{ route('register') }}">Register</a> -->
                    @endauth
                </div>

            <div class="content">
                <div class="title">
                    Hogar del Sitio
                </div>
                <div class="sub-title m-b-md">
                    <strong>Bienvenido</strong>
                </div>
                <div class="links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/index') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Inicio de Sesión</a>
                        <!-- <a href="{{ route('register') }}">Register</a> -->
                    @endauth
                @endif
                    <a href="{{ url('/entries') }}">Contenido</a>
                    <a href="#">Acerca de</a>
                    <a href="#">Ayuda</a>
                </div>
            </div>
        </div>
    </body>
</html>
