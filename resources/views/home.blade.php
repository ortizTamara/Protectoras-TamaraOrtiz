@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5">
        {{-- Después del px-5 había un mx-5 --}}
        <div class="row g-5 w-100">
            <div class="col-md-2 filter-section">
                {{-- Buscador --}}

                {{-- ESPECIE --}}
                <div class="mb-4">
                    <h6>Tipo de animal</h6>
                    <select name="especie_id" class="form-control">
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
                    <select name="raza_id" class="form-control">
                        <option value="">Todas</option>
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
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary" data-filter="new">Nuevo</button>
                        <button type="button" class="btn btn-primary" data-filter="age_asc">Edad
                            Ascendente</button>
                        <button type="button" class="btn btn-primary" data-filter="age_desc">Edad
                            Descendent</button>
                    </div>
                </div>
                <div class="home__cards  row row-cols-1 row-cols-sm-2 row-cols-md-5 g-0">
                    @forelse ($animales as $animal)
                        @if ($animal->protectora && $animal->protectora->esValido)
                            <a href="" class="col-3 text-decoration-none">
                                <div class="protectora__case-card protectora__case-card--home position-relative">
                                    <img src="{{ asset($animal->imagen) }}"
                                         alt="{{ $animal->nombre }}"
                                         class="protectora__case-image protectora__case-image--home">
                                    <div class="protectora__case-body">
                                        <h5 class="protectora__case-name">{{ $animal->nombre }}</h5>
                                        <p class="text-muted">{{ Str::limit($animal->descripcion, 50, '...') }}</p>
                                    </div>
                                </div>
                            </a>
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
