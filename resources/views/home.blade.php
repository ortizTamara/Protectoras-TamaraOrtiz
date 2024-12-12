@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/marcarFavorito.js', 'resources/js/seleccionarEspecie.js', 'resources/js/rangoEdad.js', 'resources/js/resetearBusqueda.js'])
@endPushOnce

@section('content')
    <div class="container-fluid px-5">
        <div class="row g-5 w-100">
            <!-- Filtros en escritorio -->
            <div class="col-md-2 d-none d-md-block filter-section">
               <form method="GET" action="{{ route('home') }}">
                    {{-- ESPECIE --}}
                    <div class="mb-4">
                        <h6>Tipo de animal</h6>
                        <select name="especie" id="especie_id" class="form-control">
                            <option value="">Todos</option>
                            @foreach ($especies as $especie)
                                <option value="{{ $especie->id }}" {{ request('especie') == $especie->id ? 'selected' : '' }}>
                                    {{ $especie->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- RAZA --}}
                    <div class="mb-4">
                        <h6>Raza</h6>
                        <select name="raza" id="raza_id" class="form-control" data-selected="{{ request('raza') }}">
                            <option value="">Todas</option>
                            @foreach ($razas as $raza)
                                <option value="{{ $raza->id }}" {{ request('raza') == $raza->id ? 'selected' : '' }}>
                                    {{ $raza->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- EDAD --}}
                    <div class="mb-4 position-relative">
                        <h6 class="fs-6">Edad</h6>
                        <div class="position-relative">
                            <input
                                type="range"
                                name="edad"
                                class="form-range"
                                id="ageRange"
                                min="{{ now()->year - \Carbon\Carbon::parse($maxFechaNacimiento)->year }}"
                                max="{{ now()->year - \Carbon\Carbon::parse($minFechaNacimiento)->year }}"
                                value="{{ $selectedEdad }}">
                            <input type="hidden" id="selectedAge" name="edad" value="{{ $selectedEdad }}">

                        </div>
                        <div class="d-flex justify-content-between">
                            <span>{{ now()->year - \Carbon\Carbon::parse($maxFechaNacimiento)->year }}</span>
                            <div class="d-flex justify-content-center">
                                <span id="rangeValue" class="fs-5 fw-bold">{{ $selectedEdad }}</span>
                            </div>
                            <span>{{ now()->year - \Carbon\Carbon::parse($minFechaNacimiento)->year }}</span>
                        </div>

                    </div>

                    {{-- COLOR --}}
                    <div class="mb-4">
                        <h6>Color</h6>
                        <select name="color" class="form-control">
                            <option value="">Todos</option>
                            @foreach ($colores as $color)
                                <option value="{{ $color->id }}" {{ request('color') == $color->id ? 'selected' : '' }}>
                                    {{ $color->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TAMAÑO --}}
                    <div class="mb-4">
                        <h6>Tamaño</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tamanio[]" value="pequeno" id="filter1" {{ in_array('pequeno', request('tamanio', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="filter1">Pequeño (Menos de 5kg)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tamanio[]" value="mediano" id="filter2" {{ in_array('mediano', request('tamanio', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="filter2">Mediano (5-20kg)</label>
                        </div>
                        <div class="form-check mb-5">
                            <input class="form-check-input" type="checkbox" name="tamanio[]" value="grande" id="filter3" {{ in_array('grande', request('tamanio', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="filter3">Grande (Más de 20kg)</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary w-100 mb-4">Aplicar filtros</button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">Resetear filtros</a>
                </form>
            </div>

            <!-- Contenido principal -->
            <div class="col-md-10">
                <!-- Barra de búsqueda y botones de ordenación -->
               <div class="d-flex flex-column flex-md-row justify-content-between mb-4">
                    <!-- Barra de búsqueda -->
                    <div class="d-flex flex-grow-1 align-items-center">
                        <form class="d-flex align-items-center flex-grow-1 me-0" role="search" method="GET" action="{{ route('home') }}">
                            <input
                                type="search"
                                name="buscar"
                                placeholder="Buscar por nombre"
                                value="{{ request('buscar') }}"
                                aria-label="Buscar"
                                class="form-control custom-width"
                                style="
                                    <!--padding: 0.4rem 1rem;-->
                                    font-size: 1rem;
                                    border: 0.1rem solid #ced4da;
                                    border-radius: 0.5rem;
                                    width: 100%;
                                    max-width: 20rem;
                                ">
                            <button class="btn btn-outline-success ms-2" type="submit">Buscar</button>
                            <button
                                class="btn btn-outline-secondary d-flex align-items-center justify-content-center d-md-none ms-2"
                                type="button"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#filterOffcanvas"
                                aria-controls="filterOffcanvas"
                                style="
                                    padding: 0.5rem;
                                    border: 0.1rem solid #ced4da;
                                    width: 2.5rem;
                                    height: 2.5rem;
                                ">
                                <i class="fas fa-sliders-h" style="font-size: 1.2rem;"></i>
                            </button>
                        </form>
                    </div>

                    <div class="d-flex gap-2 mt-3 mt-md-0">
                        <a href="{{ route('home', array_merge(request()->all(), ['orden' => 'nuevo'])) }}" class="btn btn-secondary">Nuevo</a>
                        <a href="{{ route('home', array_merge(request()->all(), ['orden' => 'edad_asc'])) }}" class="btn btn-secondary">Edad Ascendente</a>
                        <a href="{{ route('home', array_merge(request()->all(), ['orden' => 'edad_desc'])) }}" class="btn btn-secondary">Edad Descendente</a>
                    </div>
                </div>

                <div class="home__cards row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 justify-content-center">
                    @forelse ($animales as $animal)
                        @if ($animal->protectora && $animal->protectora->esValido)
                            <div class="col text-decoration-none">
                                <div class="protectora__case-card position-relative">
                                    <a href="{{ route('animal.show', $animal->id) }}" class="text-decoration-none">
                                        <img src="{{ asset($animal->imagen) }}" alt="{{ $animal->nombre }}" class="protectora__case-image">
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
                            <p class="text-center text-muted">No se encontraron animales registrados.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Offcanvas para filtros en móvil -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="filterOffcanvasLabel">Filtros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form method="GET" action="{{ route('home') }}">
                    {{-- ESPECIE --}}
                    <div class="mb-4">
                        <h6>Tipo de animal</h6>
                        <select name="especie" id="especie_id" class="form-control">
                            <option value="">Todos</option>
                            @foreach ($especies as $especie)
                                <option value="{{ $especie->id }}" {{ request('especie') == $especie->id ? 'selected' : '' }}>
                                    {{ $especie->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- RAZA --}}
                    <div class="mb-4">
                        <h6>Raza</h6>
                        <select name="raza" id="raza_id" class="form-control" data-selected="{{ request('raza') }}">
                            <option value="">Todas</option>
                            @foreach ($razas as $raza)
                                <option value="{{ $raza->id }}" {{ request('raza') == $raza->id ? 'selected' : '' }}>
                                    {{ $raza->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- EDAD --}}
                    <div class="mb-4 position-relative">
                        <h6 class="fs-6">Edad</h6>
                        <div class="position-relative">
                            <input
                                type="range"
                                name="edad"
                                class="form-range"
                                id="ageRange"
                                min="{{ now()->year - \Carbon\Carbon::parse($maxFechaNacimiento)->year }}"
                                max="{{ now()->year - \Carbon\Carbon::parse($minFechaNacimiento)->year }}"
                                value="{{ $selectedEdad }}">
                            <input type="hidden" id="selectedAge" name="edad" value="{{ $selectedEdad }}">

                        </div>
                        <div class="d-flex justify-content-between">
                            <span>{{ now()->year - \Carbon\Carbon::parse($maxFechaNacimiento)->year }}</span>
                            <div class="d-flex justify-content-center">
                                <span id="rangeValue" class="fs-5 fw-bold">{{ $selectedEdad }}</span>
                            </div>
                            <span>{{ now()->year - \Carbon\Carbon::parse($minFechaNacimiento)->year }}</span>
                        </div>

                    </div>

                    {{-- COLOR --}}
                    <div class="mb-4">
                        <h6>Color</h6>
                        <select name="color" class="form-control">
                            <option value="">Todos</option>
                            @foreach ($colores as $color)
                                <option value="{{ $color->id }}" {{ request('color') == $color->id ? 'selected' : '' }}>
                                    {{ $color->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TAMAÑO --}}
                    <div class="mb-4">
                        <h6>Tamaño</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tamanio[]" value="pequeno" id="filter1" {{ in_array('pequeno', request('tamanio', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="filter1">Pequeño (Menos de 5kg)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="tamanio[]" value="mediano" id="filter2" {{ in_array('mediano', request('tamanio', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="filter2">Mediano (5-20kg)</label>
                        </div>
                        <div class="form-check mb-5">
                            <input class="form-check-input" type="checkbox" name="tamanio[]" value="grande" id="filter3" {{ in_array('grande', request('tamanio', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="filter3">Grande (Más de 20kg)</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary w-100 mb-4">Aplicar filtros</button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">Resetear filtros</a>
                </form>
            </div>
        </div>
    </div>
@endsection
