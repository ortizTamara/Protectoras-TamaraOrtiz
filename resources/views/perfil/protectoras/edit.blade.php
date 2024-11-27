@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/miProtectora.js'])
@endPushOnce

@section('content')

<div class="container protectora">
    <form action="{{ route('perfil-miProtectora.update', $protectora->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="protectora__header">
            <div class="protectora__info d-flex justify-content-between align-items-center">
                <div class="protectora__logo-container d-flex align-items-center">
                    <label for="logo" class="protectora__logo-label">
                        <img id="logo-preview"
                             src="{{ asset('storage/' . $protectora->logo) }}"
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
                <a href="{{ route('perfil-miProtectora.show', $protectora->id) }}" class="btn btn-secondary protectora__discard-btn">
                    Cancelar
                </a>
            </div>
        </div>

        <section class="protectora__history text-start mt-5">
            <h2 class="protectora__section-title">Nuestra historia</h2>
            <textarea class="form-control" name="nuestra_historia" rows="4">{{ $protectora->nuestra_historia }}</textarea>
        </section>
    </form>

    <section class="protectora__cases mt-5">
        <div class="d-flex align-items-center">
            <h2 class="protectora__section-title mb-0 me-2">Nuestros casos en adopción</h2>
            <a href="{{ route('animal.create', ['protectora_id' => $protectora->id]) }}"
               class="btn btn-circle btn-dark d-flex justify-content-center align-items-center">
                <i class="bi bi-plus-lg text-white"></i>
            </a>
        </div>
        <div class="protectora__cases-grid">
            @forelse ($protectora->animales as $animal)
                <div class="protectora__case">
                    <div class="protectora__case-card position-relative">
                        <img src="{{ $animal->imagen ? asset('storage/' . $animal->imagen) : '/images/placeholder.jpg' }}"
                             alt="{{ $animal->nombre }}" class="protectora__case-image">
                        <div class="protectora__case-body">
                            <h5 class="protectora__case-name">{{ $animal->nombre }}</h5>
                        </div>
                        <!-- Formulario de eliminación separado -->
                        <form action="{{ route('animal.destroy', ['animal' => $animal->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm border-0 d-flex align-items-center justify-content-center protectora__delete-btn">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="protectora__no-cases">No hay casos en adopción actualmente.</p>
            @endforelse
        </div>
    </section>

</div>

@endsection
