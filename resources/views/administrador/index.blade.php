@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Panel de Administración</h1>
        <div class="row">
            <!-- Tarjeta de Colores -->
            <div class="col-md-3 mb-3">
                <a href="{{ route('color.index') }}"
                    class="card card-custom shadow-sm rounded text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-palette icon-lg"></i>
                            Colores
                        </h5>
                    </div>
                </a>
            </div>

            <!-- Tarjeta de Razas -->
            <div class="col-md-3 mb-3">
                <a href="#" class="card card-custom shadow-sm rounded text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-egg icon-lg"></i>
                            Razas
                        </h5>
                    </div>
                </a>
            </div>

            <!-- Tarjeta de Especies -->
            <div class="col-md-3 mb-3">
                <a href="#" class="card card-custom shadow-sm rounded text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-paw icon-lg"></i>
                            Especies
                        </h5>
                    </div>
                </a>
            </div>

            <!-- Tarjeta de Comportamientos -->
            <div class="col-md-3 mb-3">
                <a href="#" class="card card-custom shadow-sm rounded text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">
                            <i class="bi bi-braces icon-lg"></i>
                            Comportamientos
                        </h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
