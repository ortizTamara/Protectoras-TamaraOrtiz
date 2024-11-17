@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex flex-column">
    <div class="row flex-grow-1">
        <!-- BARRA LATERAL -->
        <div class="col-md-3 bg-white p-4 shadow-sm sidebar">
            <nav class="nav flex-column">
                <a href="#" class="btn btn-secondary w-100 mb-2">Perfil</a>
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Perfil protectora</a>
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis favoritos</a>
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis protectoras</a>
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis ayudantes</a>
                <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 mb-2"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>
        <div class="col-md-9">
            <div class="card mx-auto profile-card">
                <div class="card-body">
                    <h1 class="profile-title mb-4">Mi Perfil</h1>

                    <!-- PERFIL -->
                    <div class="d-flex flex-column align-items-center mb-5 profile-image">
                        <div class="profile-pic-container">
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center profile-icon">
                                <i class="bi bi-camera"></i>
                            </div>
                        </div>
                        <button class="btn btn-secondary btn-sm mt-1">Actualizar foto</button>
                    </div>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" value="{{ auth()->user()->nombre }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" placeholder="Ingrese sus apellidos" value="{{ auth()->user()->apellidos }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha" value="{{ date('Y-m-d', strtotime(auth()->user()->fecha_nacimiento)) }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="genero" class="form-label">Género</label>
                                <input type="text" class="form-control" id="genero" value="{{ auth()->user()->genero['nombre'] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="correo@ejemplo.com" value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Número de Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" placeholder="+34 XXX XXX XXX" value="{{ auth()->user()->telefono }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="pais" class="form-label">País</label>
                                <input type="text" class="form-control" id="pais" value="{{ auth()->user()->pais['nombre'] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="comunidad" class="form-label">Comunidad Autónoma</label>
                                <input type="text" class="form-control" id="comunidad" value="{{ auth()->user()->comunidadAutonoma['nombre'] ?? '' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="codigo-postal" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="codigo-postal" placeholder="28XXX" value="{{ auth()->user()->codigo_postal }}" readonly>
                            </div>
                        </div>
                        {{-- VENTANA EMERGENTE PARA CAMBIAR CONTRASEÑA--}}
                        <div class="text-center mt-5">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal" class="text-primary">¿Quieres cambiar la contraseña?</a>
                        </div>
                        <div class="d-grid mt-1">
                            <button type="button" class="btn btn-primary" disabled>Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Cambiar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm" method="POST" action="{{ route('changePassword') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
