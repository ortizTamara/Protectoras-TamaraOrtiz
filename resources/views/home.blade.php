@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/marcarFavorito.js', 'resources/js/seleccionarEspecie'])
@endPushOnce


@section('content')
    <div class="container-fluid px-5">
        {{-- Después del px-5 había un mx-5 --}}
        <div class="row g-5 w-100">
            <div class="col-md-2 filter-section">
                {{-- Buscador --}}

                {{-- ESPECIE --}}
                <div class="mb-4">
                    <h6>Tipo de animal</h6>
                    <select name="especie_id" id="especie_id" class="form-control">
                        <option value="">Todos</option>
                        @foreach ($especies as $especie)
                            <option value="{{ $especie->id }}" @selected($especie->especie_id === $especie->id)>
                                {{ $especie->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- RAZA --}}
                <div class="mb-4">
                    <h6>Raza</h6>
                    <select name="raza_id" id="raza_id" class="form-control">
                        <option value="" >Todas</option>
                        @foreach ($razas as $raza)
                            <option value="{{ $raza->id }}" @selected($raza->raza_id === $raza->id)>
                                {{ $raza->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- EDAD --}}
                <div class="mb-4">
                    <h6 class="fs-6">Edad</h6>
                    <input type="range" class="form-range" id="ageRange" min="1" max="20">
                    <div class="d-flex justify-content-between">
                        <span>1</span>
                        <span>20</span>
                    </div>
                </div>

                {{-- COLOR --}}
                <div class="mb-4">
                    <h6>Color</h6>
                    <select name="color_id" class="form-control">
                        <option value="">Todos</option>
                        @foreach ($colores as $color)
                            <option value="{{ $color->id }}" @selected($color->color_id === $color->id)>
                                {{ $color->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tamaño --}}
                <div class="mb-4">
                    <h6>Tamaño</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter1">
                        <label class="form-check-label" for="filter1">Pequeño (Menos de 5kg)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter2">
                        <label class="form-check-label" for="filter2">Mediano (5-10kg)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter3">
                        <label class="form-check-label" for="filter3">Grande (Más de 20kg)</label>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb-4">
                    <form class="d-flex w-25" role="search">
                        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary" data-filter="new">Nuevo</button>
                        <button type="button" class="btn btn-secondary" data-filter="age_asc">Edad
                            Ascendente</button>
                        <button type="button" class="btn btn-secondary" data-filter="age_desc">Edad
                            Descendente</button>
                    </div>
                </div>
                <div class="home__cards row row-cols-3 row-cols-sm-3 row-cols-md-5 g-4">
                    @forelse ($animales as $animal)
                        @if ($animal->protectora && $animal->protectora->esValido)
                            <div class="col-3 text-decoration-none">
                                <div class="protectora__case-card protectora__case-card--home position-relative">
                                    <a href="{{ route('animal.show', $animal->id) }}" class="text-decoration-none">
                                        <img src="{{ asset($animal->imagen) }}"
                                             alt="{{ $animal->nombre }}"
                                             class="protectora__case-image protectora__case-image--home">
                                    </a>
                                    <div class="protectora__case-body">
                                        <h5 class="protectora__case-name">{{ $animal->nombre }}</h5>
                                    </div>
                                    @auth
                                    <div class="favorite-icon-container position-absolute top-0 end-0 p-0">
                                        <form>
                                            <input type="hidden" name="animal_id" value="{{ $animal->id }}">
                                            <button class="favorite-icon-btn" type="button">
                                                <i class="favorite-icon {{ Auth::user()->favoritos->contains($animal->id) ? 'fas fa-heart selected text-danger' : 'fas fa-heart' }}"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @endauth
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-12">
                            <p class="protectora__no-cases text-center text-muted">No se encontraron animales registrados.</p>
                        </div>
                    @endforelse
                </div>
        </div>
    </div>
@endsection



