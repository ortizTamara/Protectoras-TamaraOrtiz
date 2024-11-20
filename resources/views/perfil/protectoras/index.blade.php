@extends('layouts.app')
@section('content')

<div class="container-fluid d-flex flex-column">
    <div class="row flex-grow-9">
        <!-- BARRA LATERAL -->
        <div class="col-md-3 bg-white p-4 shadow-sm sidebar">
            <nav class="nav flex-column">
                {{-- Con Request verifico si la ruta actual es Perfil, si es así se le asigna btn-secundary, entonces se muestra resaltado, si no es la ruta actual, se le asigna btn-outline-secundary  --}}
                <a href="{{ route('perfil') }}" class="btn {{ Request::is('perfil') ? 'btn-secondary' : 'btn-outline-secondary' }} w-100 mb-2">Perfil</a>

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                {{-- Es lo mismo que en Perfil --}}
                    <a href="{{ route('perfil-protectora.index') }}" class="btn {{ Request::is('perfil-protectora') ? 'btn-secondary' : 'btn-outline-secondary' }} w-100 mb-2">Perfil Protectora</a>
                @endif
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis favoritos</a>
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis protectoras</a>
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis ayudantes</a>

                <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 mb-2" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">Cerrar sesión</a>
                <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>

@endsection
