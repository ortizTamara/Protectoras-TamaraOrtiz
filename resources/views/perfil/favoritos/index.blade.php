@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/perfil.js', 'resources/js/marcarFavorito.js', 'resources/js/ocultarFavorito.js'])
@endPushOnce

@section('content')
<div class="container-fluid d-flex flex-column">
    <div class="row flex-grow-9">
        <!-- BARRA LATERAL -->
        <div class="col-md-3 bg-white p-4 shadow-sm sidebar">
            <nav class="nav flex-column">
                <a href="#" class="btn btn-secondary w-100 mb-2">Perfil</a>

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                    <a href="{{ route('perfil-protectora.index') }}" class="btn btn-outline-secondary w-100 mb-2">Perfil protectora</a>
                @endif

                <a href="{{ route('favoritos') }}" class="btn btn-outline-secondary w-100 mb-2">Mis favoritos</a>

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                    <a href="{{ route('perfil-miProtectora.index') }}" class="btn btn-outline-secondary w-100 mb-2">Mis protectoras</a>
                @endif

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                    <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis ayudantes</a>
                @endif

                <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 mb-2" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">Cerrar sesión</a>
                <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>

        <div class="col-md-9">
            <div class="home__cards row row-cols-3 row-cols-sm-3 row-cols-md-5 g-4">
                @forelse ($favoritos as $animal)
                    <div id="animal-{{ $animal->id }}" class="col-3 text-decoration-none">
                        <div class="protectora__case-card protectora__case-card--home position-relative">
                            <a href="{{ route('animal.show', $animal->id) }}" class="text-decoration-none">
                                <img src="{{ Storage::url($animal->imagen) }}" alt="{{ $animal->nombre }}" class="protectora__case-image protectora__case-image--home">
                            </a>
                            <div class="protectora__case-body">
                                <h5 class="protectora__case-name">{{ $animal->nombre }}</h5>
                            </div>
                            @auth
                            <div class="favorite-icon-container">
                                <form>
                                    <input type="hidden" name="animal_id" value="{{ $animal->id }}">
                                    <button class="favorite-icon-btn" type="button">
                                        <i class="favorite-icon fas fa-heart selected text-danger"></i>
                                    </button>
                                </form>
                            </div>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="protectora__no-cases text-center text-muted">No tienes animales marcados como favoritos.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
