@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5 mx-5">
        <div class="row g-5 w-100">
            <div class="col-md-2 filter-section">
                {{-- Buscador --}}
                {{-- Opciones --}}
                <div class="mb-4">
                    <h6>Categoría</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter1" checked>
                        <label class="form-check-label" for="filter1">Perros</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter2" checked>
                        <label class="form-check-label" for="filter2">Gatos</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter3" checked>
                        <label class="form-check-label" for="filter3">Otros</label>
                    </div>
                </div>
                {{-- Edad --}}
                <div class="mb-4">
                    <h6 class="fs-6">Edad</h6>
                    <input type="range" class="form-range" id="ageRange" min="1" max="20">
                    <div class="d-flex justify-content-between">
                        <span>1</span>
                        <span>20</span>
                    </div>
                </div>
                {{-- Color --}}
                <div class="mb-4">
                    <h6>Color</h6>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="colorDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Seleccionar
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="colorDropdown">
                            <li><a class="dropdown-item" href="#">Blanco</a></li>
                            <li><a class="dropdown-item" href="#">Negro</a></li>
                            <li><a class="dropdown-item" href="#">Naranja</a></li>
                            <li><a class="dropdown-item" href="#">Atigrado</a></li>
                            <li><a class="dropdown-item" href="#">Bicolor</a></li>
                            <li><a class="dropdown-item" href="#">Tricolor</a></li>
                            <li><a class="dropdown-item" href="#">Gris</a></li>
                            <li><a class="dropdown-item" href="#">Marrón</a></li>
                            <li><a class="dropdown-item" href="#">Crema</a></li>
                        </ul>
                    </div>
                </div>
                {{-- Tamaño --}}
                <div class="mb-4">
                    <h6>Tamaño</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter1" checked>
                        <label class="form-check-label" for="filter1">Pequeño (Menos de 5kg)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter2" checked>
                        <label class="form-check-label" for="filter2">Mediano (5-10kg)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="filter3" checked>
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
                <div class="row g-4">
                    @foreach ($animales as $animal)
                        <div class="col-2">
                            <div class="card">
                                {{-- <div class="ratio" style="--bs-aspect-ratio: 115%;"> --}}
                                <img src="{{ asset('imagenes/loki.jpg') }}" class="card-img-top img-fluid "
                                    alt="...">
                                {{-- </div> --}}
                                <div class="card-body">
                                    <h5 class="card-title">{{ $animal->nombre }}</h5>
                                    <p class="card-text">{{ $animal->descripcion }}</p>
                                    {{-- <p class="card-text">{{ $animal->especie->nombre }}</p>
                                    <p class="card-text">{{ $animal->raza->nombre }}</p> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="col-2"></div>
                    <div class="col-2"></div>
                    <div class="col-2"></div>
                    <div class="col-2"></div>
                    <div class="col-2">
                        <div class="card">
                            <div class="ratio" style="--bs-aspect-ratio: 115%;">
                            <img src="{{ asset('imagenes/loki.jpg') }}" class="card-img-top img-fluid " alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Lokito</h5>
                                <p class="card-text">Tamara</p>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-2">
                        <div class="card">
                            <div class="ratio" style="--bs-aspect-ratio: 115%;">
                                <img src="{{ asset('imagenes/mushi.jpg') }}" class="card-img-top img-fluid"
                                    alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Mushito</h5>
                                <p class="card-text">Tamara</p>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-2">
                        <div class="card ">
                            <div class="ratio" style="--bs-aspect-ratio: 115%;">
                                <img src="..." class="card-img-top img-small" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural lead-in
                                    to
                                    additional content.</p>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-2">
                        <div class="card ">
                            <div class="ratio" style="--bs-aspect-ratio: 115%;">
                                <img src="..." class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a longer card with supporting text below as a natural lead-in
                                    to
                                    additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
