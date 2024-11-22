@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/miProtectora.js'])
@endPushOnce

@section('content')

<div class="container protectora">
    <!-- Formulario de edición -->
    <form action="{{ route('perfil-miProtectora.update', $protectora->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Encabezado -->
        <div class="protectora__header">
            <div class="protectora__info d-flex justify-content-between align-items-center">
                <div class="protectora__logo-container d-flex align-items-center">
                    <label for="logo" class="protectora__logo-label">
                        <img id="logo-preview"
                            src="{{ $protectora->logo ? asset('storage/logos/' . $protectora->logo) : '/logo/placeholder.jpg' }}"
                            alt="Logo de {{ $protectora->nombre }}"
                            class="protectora__logo">
                        <input type="file" name="logo" id="logo" class="d-none" accept="image/*" onchange="previewLogo(event)">
                    </label>
                </div>
                <div class="protectora__details col-lg-10">
                    <h1 class="protectora__name mb-1">
                        <input type="text" name="nombre" value="{{ $protectora->nombre }}" class="form-control" required />
                    </h1>
                    <p class="protectora__location mb-0">
                        <input type="text" name="direccion" value="{{ $protectora->direccion }}" class="form-control" />
                    </p>
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

                <button type="submit" class="btn btn-secondary protectora__save-btn">
                    <i class="bi bi-save me-2"></i> Guardar Cambios
                </button>
            </div>
        </div>


        <section class="protectora__history text-start mt-5">
            <h2 class="protectora__section-title">Nuestra historia</h2>
            <textarea class="form-control" name="nuestra_historia" rows="4">{{ $protectora->nuestra_historia }}</textarea>
        </section>

        <section class="protectora__cases mt-5">
            <h2 class="protectora__section-title text-start">Nuestros casos en adopción</h2>
            <div class="protectora__cases-grid">
                @forelse ($protectora->animales as $animal)
                    <div class="protectora__case">
                        <div class="protectora__case-card">
                            <img src="{{ $animal->imagen ? asset('storage/' . $animal->imagen) : '/images/placeholder.jpg' }}"
                                 alt="{{ $animal->nombre }}" class="protectora__case-image">
                            <div class="protectora__case-body">
                                <p class="protectora__case-name">{{ $animal->nombre }}</p>
                                <p class="protectora__case-rating"><i class="bi bi-star-fill"></i> {{ $loop->index + 1 }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="protectora__no-cases">No hay casos en adopción actualmente.</p>
                @endforelse
            </div>
        </section>
    </form>
</div>

@endsection
