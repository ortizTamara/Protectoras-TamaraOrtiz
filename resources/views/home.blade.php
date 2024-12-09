@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/marcarFavorito.js', 'resources/js/seleccionarEspecie.js', 'resources/js/rangoEdad.js', 'resources/js/resetearBusqueda.js'])
@endPushOnce


@section('content')
    <div class="container-fluid px-5">
        {{-- Después del px-5 había un mx-5 --}}
        <div class="row g-5 w-100">
            <div class="col-md-2 filter-section">
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
                                min="{{ \Carbon\Carbon::now()->year - \Carbon\Carbon::parse($maxFechaNacimiento)->year }}"
                                max="{{ \Carbon\Carbon::now()->year - \Carbon\Carbon::parse($minFechaNacimiento)->year }}"
                                value="{{ request('edad') ?? '' }}">
                            <input type="hidden" id="selectedAge" name="edad" value="{{ request('edad') ?? '' }}">
                            <span id="rangeValue" class="position-absolute translate-middle d-none">20</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>{{ \Carbon\Carbon::now()->year - \Carbon\Carbon::parse($maxFechaNacimiento)->year }}</span>
                            <span>{{ \Carbon\Carbon::now()->year - \Carbon\Carbon::parse($minFechaNacimiento)->year }}</span>
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
                            <label class="form-check-label" for="filter2">Mediano (5-10kg)</label>
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
            <div class="col-md-10">
                <div class="d-flex justify-content-between mb-4">
                    <form class="d-flex w-25" role="search" method="GET" action="{{ route('home') }}">
                        <input
                            class="form-control me-2"
                            type="search"
                            name="buscar"
                            placeholder="Buscar por nombre"
                            value="{{ request('buscar') }}"
                            aria-label="Buscar"
                            oninput="resetSearch(event)">
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </form>
                    <div class="d-flex gap-2">
                        <a href="{{ route('home', array_merge(request()->all(), ['orden' => 'nuevo'])) }}" class="btn btn-secondary">Nuevo</a>
                        <a href="{{ route('home', array_merge(request()->all(), ['orden' => 'edad_asc'])) }}" class="btn btn-secondary">Edad Ascendente</a>
                        <a href="{{ route('home', array_merge(request()->all(), ['orden' => 'edad_desc'])) }}" class="btn btn-secondary">Edad Descendente</a>
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
                {{-- <div class="home__cards row row-cols-3 row-cols-sm-3 row-cols-md-5 g-4">
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
                                    <div class="favorite-icon-container">
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
                </div> --}}
        </div>
    </div>
@endsection


{{--
<script>
    function resetSearch(event) {
    const input = event.target;
    const form = input.closest('form');

    if (input.value === '') {
        form.submit();
    }
}
</script> --}}
