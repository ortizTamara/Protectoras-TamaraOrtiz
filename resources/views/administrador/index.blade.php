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
                            <i class="bi icon-lg"></i>
                            Colores
                        </h5>
                    </div>
                </a>
            </div>

            <!-- Tarjeta de Razas -->
            <div class="col-md-3 mb-3">
                <a href="{{ route('raza.index') }}"
                    class="card card-custom shadow-sm rounded text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">
                            <i class="bi icon-lg"></i>
                            Razas
                        </h5>
                    </div>
                </a>
            </div>

            <!-- Tarjeta de Especies -->
            <div class="col-md-3 mb-3">
                <a href="{{ route('especie.index') }}"
                    class="card card-custom shadow-sm rounded text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">
                            <i class="bi icon-lg"></i>
                            Especies
                        </h5>
                    </div>
                </a>
            </div>

            <!-- Tarjeta de Comportamientos -->
            <div class="col-md-3 mb-3">
                <a href="{{ route('comportamiento.index') }}"
                    class="card card-custom shadow-sm rounded text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">
                            <i class="bi icon-lg"></i>
                            Comportamientos
                        </h5>
                    </div>
                </a>
            </div>


            <!-- Tarjeta de Protectoras -->
            <div class="col-md-3 mb-3">
                <a href="{{ route('administracion.protectora.index') }}"
                    class="card card-custom shadow-sm rounded text-decoration-none text-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">
                            <i class="bi icon-lg"></i>
                            Protectoras
                        </h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
