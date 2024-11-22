@extends('layouts.app')

@section('content')
<div class="protectora-page container my-5">
    <div class="protectora-page__search-bar mb-4 d-flex justify-content-center">
        <div class="input-group protectora-page__search-group">
            <input type="text" class="form-control protectora-page__search-input" placeholder="Buscar protectoras..." aria-label="Buscar protectoras">
            <button class="btn protectora-page__search-btn" type="button">
                <i class="bi bi-search"></i> Buscar
            </button>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 protectora-page__grid">
        @forelse ($protectoras as $protectora)
            <div class="col">
                <div class="card protectora-card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <!-- Imagen o logo -->
                        <div class="protectora-card__logo mb-3">
                            @if ($protectora->logo)
                                <img
                                    src="{{ asset('storage/logos/' . $protectora->logo) }}"
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
                            <i class="bi bi-people-fill me-1"></i>{{ $protectora->casos ?? 0 }} casos en adopción
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
