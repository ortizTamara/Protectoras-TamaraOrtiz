@extends('layouts.app')

@section('content')
<div class="protectora-page container my-5">
    <div class="protectora-page__search-bar mb-4 d-flex justify-content-center">
        <form class="d-flex w-75" action="{{ route('protectoras') }}" method="GET" style="max-width: 800px;">
            <div class="input-group protectora-page__search-group" style="width: 100%;">
                <input
                    type="text"
                    name="search"
                    class="form-control protectora-page__search-input"
                    placeholder="Buscar protectora o por ciudad..."
                    aria-label="Buscar protectoras"
                    value="{{ request()->input('search') }}"
                    style="width:50%;"
                >
                <button
                    class="btn protectora-page__search-btn"
                    type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </form>
    </div>

     <div class="row g-5 mt-3 justify-content-center">
        @forelse ($protectoras as $protectora)
            <div class="col-12 col-md-4 col-lg-4 col-xl-3 d-flex justify-content-center">
                <div class="card protectora-card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="protectora-card__logo mb-3">
                            @if ($protectora->logo)
                                <img
                                    src="{{ asset('storage/' . $protectora->logo) }}"
                                    alt="Logo de la protectora"
                                    class="protectora-card__logo-img"
                                >
                            @else
                                <div class="protectora-card__logo-placeholder">
                                    <i class="bi bi-camera"></i>
                                </div>
                            @endif
                        </div>

                        <h5 class="protectora-card__title">{{ $protectora->nombre }}</h5>

                        <p class="protectora-card__location text-muted">
                            <i class="bi bi-geo-alt-fill me-1"></i>{{ $protectora->direccion }}
                        </p>

                        <p class="protectora-card__cases text-muted">
                            <i class="bi bi-people-fill me-1"></i>{{ $protectora->animales->count() }} casos en adopción
                        </p>
                    </div>

                    <div class="card-footer bg-light text-center">
                        <a href="{{ route('perfil-miProtectora.show', $protectora->id) }}" class="btn protectora-card__info-btn w-100">
                            <i class="bi bi-info-circle me-2"></i> Más información
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center text-muted">No se encontraron protectoras registradas.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
