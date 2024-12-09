<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    @stack('scripts')
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">

            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('imagenes/logo5.png') }}" height="50" alt="">
                    </a>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 nav-underline">
                        <li class="nav-item">
                            <a class="nav-link @if (request()->is('/')) active @endif" aria-current="page"
                                href="{{ route('home') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (request()->is('protectoras')) active @endif"
                               href="{{ route('protectoras') }}">Protectoras</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Aprende
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('aprende.adoptar') }}">Antes de adoptar</a></li>
                                <li><a class="dropdown-item" href="{{ route('aprende.cuidados') }}">Cuidados básicos</a></li>
                                <li><a class="dropdown-item" href="{{ route('aprende.viviendo') }}">Viviendo con tu mascota</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (request()->is('contacto')) active @endif"
                                href="{{ route('contacto') }}">Contacto</a>
                        </li>

                        @auth
                            @if (Auth::user()->rol_id == 1)
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->is('administracion')) active @endif" href="{{ route('administracion') }}">Administrador</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                    <ul class="navbar-nav ms-auto me-4">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->is('login')) active @endif" href="{{ route('login') }}">Iniciar sesión</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link @if (request()->is('register')) active @endif" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endif
                        @else
                            <div class="profile-bar__user d-flex align-items-center gap-2">
                                <a href="{{ route('perfil') }}"
                                   class="text-decoration-none d-flex align-items-center gap-2
                                   @if (request()->is('perfil')) active @endif">
                                    <span class="profile-bar__name">{{ Auth::user()->nombre }}</span>

                                    <div class="profile-bar__avatar rounded-circle d-flex align-items-center justify-content-center">
                                        @if (Auth::user()->foto)
                                            <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                                 alt="Foto de perfil"
                                                 class="img-fluid rounded-circle">
                                        @else
                                            <span class="profile-bar__initial">
                                                {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                                <a href="{{ route('logout') }}" class="profile-bar__logout btn btn-link p-0 ms-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-label="Logout">
                                    <i class="bi bi-box-arrow-right profile-bar__logout-icon"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

</html>
