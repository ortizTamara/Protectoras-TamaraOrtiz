@extends('layouts.app')
@section('content')

<div class="container-fluid d-flex flex-column">
    <div class="row flex-grow-9">
        <!-- BARRA LATERAL -->
        <div class="col-md-3 bg-white p-4 shadow-sm sidebar">
            <nav class="nav flex-column">
                <a href="{{ route('perfil') }}" class="btn {{ Request::is('perfil') ? 'btn-secondary' : 'btn-outline-secondary' }} w-100 mb-2">Perfil</a>

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                    <a href="{{ route('perfil-protectora.index') }}" class="btn {{ Request::is('perfil-protectora') ? 'btn-secondary' : 'btn-outline-secondary' }} w-100 mb-2">Perfil protectora</a>
                @endif

                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis favoritos</a>

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                <a href="{{ route('perfil-miProtectora.index') }}" class="btn {{ Request::is('perfil/perfil-miProtectora') ? 'btn-secondary' : 'btn-outline-secondary' }} w-100 mb-2">Mis protectoras</a>
                @endif

                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis ayudantes</a>

                <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 mb-2" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">Cerrar sesión</a>
                <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>
        <div class="col-md-9">
            <div class="row g-4">
                @if($miProtectora)
                <div class="col-3">
                    <a href="{{ route('perfil-miProtectora.show', $miProtectora->id) }}" class="text-decoration-none">
                        <div class="protectora-card shadow-sm border border-secondary-subtle bg-light">
                            <i class="bi bi-star-fill text-warning protectora-card__star fs-3"></i>
                            <div class="protectora-card__image-container m-4 p-2 bg-white shadow-sm">
                                <img src="{{ asset('storage/' . $miProtectora->logo) }}"
                                     alt="{{ $miProtectora->nombre }}"
                                     class="protectora-card__image">
                            </div>

                            <div class="protectora-card__body text-center p-0">
                                <h5 class="protectora-card__title mb-3 fw-bold text-dark small me-2">{{ $miProtectora->nombre }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @else
                <p>No tienes una protectora asociada.</p>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
