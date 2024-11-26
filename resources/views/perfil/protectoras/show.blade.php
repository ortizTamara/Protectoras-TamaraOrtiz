@extends('layouts.app')
@section('content')

<div class="container protectora">
    <div class="protectora__header d-flex justify-content-between align-items-center">
        <div class="protectora__info d-flex align-items-center">
            <div class="protectora__logo-container">
                <img src="{{ asset('storage/' . $protectora->logo) }}"
                     alt="Logo de {{ $protectora->nombre }}"
                     class="protectora__logo">
            </div>
            <div class="ms-3">
                <h1 class="protectora__name mb-0">{{ $protectora->nombre }}</h1>
                <p class="protectora__address mb-0">{{ $protectora->direccion }}</p>
            </div>
        </div>

        <div class="protectora__social d-flex align-items-center">
            <a href="{{ $protectora->instagram }}" class="protectora__social-icon">
                <i class="bi bi-instagram"></i>
            </a>

            <a href="{{ $protectora->facebook }}" class="protectora__social-icon">
                <i class="bi bi-facebook"></i>
            </a>

            <a href="{{ $protectora->twitter }}" class="protectora__social-icon">
                <i class="bi bi-twitter"></i>
            </a>

            <a href="{{ $protectora->web }}" class="protectora__social-icon">
                <i class="bi bi-globe"></i>
            </a>

            <a href="#" class="protectora__contact-btn">Contactar</a>

            <a href="{{ route('perfil-miProtectora.edit', $protectora->id) }}"
                class="btn btn-secondary protectora__edit-btn"
                @if(auth()->user() && (auth()->user()->rol_id == 1 || auth()->user()->protectora_id == $protectora->id))
                    style="display: inline-block;"
                @else
                    style="display: none;"
                @endif>
                <i class="bi bi-pencil-square me-2"></i> Editar página
            </a>
        </div>
    </div>

    <div class="protectora__stats mt-5">
        <div class="protectora__stat">
            <p class="protectora__stat-value">{{ $protectora->animales->count() }}</p>
            <p class="protectora__stat-label">Casos en adopción</p>
        </div>
        <div class="protectora__stat">
            <p class="protectora__stat-value">{{ $protectora->animales->where('estado', 'en adopción')->count() }}</p>
            <p class="protectora__stat-label">En adopción</p>
        </div>
        <div class="protectora__stat">
            <p class="protectora__stat-value">0</p>
            <p class="protectora__stat-label">Urgente</p>
        </div>
        <div class="protectora__stat">
            <p class="protectora__stat-value">0</p>
            <p class="protectora__stat-label">En acogida</p>
        </div>
    </div>

    <section class="protectora__history text-start mt-5">
        <h2 class="protectora__section-title">Nuestra historia</h2>
        <p class="protectora__history-text">{{ $protectora->nuestra_historia ?? 'No hay historia disponible.' }}</p>
    </section>

    <!-- TARJETAS DE ADOPCIÓN-->
    <section class="protectora__cases mt-5">
        <div class="d-flex align-items-center">
            <h2 class="protectora__section-title mb-0 me-2">Nuestros casos en adopción</h2>
        </div>
        <div class="protectora__cases-grid">
            @forelse ($protectora->animales as $animal)
                <div class="protectora__case">
                    <div class="protectora__case-card position-relative">
                        <img src="{{ $animal->imagen ? asset('storage/' . $animal->imagen) : '/images/placeholder.jpg' }}"
                             alt="{{ $animal->nombre }}" class="protectora__case-image">
                        <div class="protectora__case-body">
                            <h5 class="protectora__case-name">{{ $animal->nombre }}</h5>
                            <p class="card-text">Especie: {{ $animal->especie->nombre }}</p>
                            <p class="card-text">Peso: {{ $animal->peso }} kg</p>
                            <a href="{{ route('perfil-miProtectora.show', $animal->id) }}" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="protectora__no-cases">No hay casos en adopción actualmente.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
