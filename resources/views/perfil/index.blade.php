@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/perfil.js', 'resources/js/validador.js'])
@endPushOnce

@section('content')
<div class="container-fluid  d-flex flex-column">
    <div class="row flex-grow-9">
        <!-- BARRA LATERAL -->
        <div class="col-md-3 bg-white p-4 shadow-sm sidebar">
            <nav class="nav flex-column">
                <a href="#" class="btn btn-secondary w-100 mb-2">Perfil</a>

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                    <a href="{{ route('perfil-protectora.index') }}" class="btn btn-outline-secondary w-100 mb-2">Perfil protectora</a>
                @endif

                <a href="{{ route('favoritos') }}" class="btn btn-outline-secondary w-100 mb-2">Mis favoritos</a>

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                <a href="{{ route('perfil-miProtectora.index') }}" class="btn btn-outline-secondary w-100 mb-2">Mis protectoras</a>
                @endif

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis ayudantes</a>
                @endif

                <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 mb-2" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">Cerrar sesión</a>
                <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>
        <div class="col-md-9">
            <div class="card mx-auto profile-card">
                <div class="card-body">
                    <h1 class="profile-title mb-4">Mi Perfil</h1>

                    <div class="d-flex flex-column align-items-center mb-5 profile-image">
                        <div class="profile-pic-container mb-2">
                            @if (auth()->user()->foto)
                                <img id="profilePreview"
                                     src="{{ asset('storage/' . auth()->user()->foto) }}"
                                     alt="Foto de perfil"
                                     class="profile-img">
                            @else
                                <i class="bi bi-camera profile-icon"></i>
                            @endif
                        </div>
                        <div class="d-flex">
                            <form action="{{ route('updateFoto') }}" method="POST" enctype="multipart/form-data" class="me-2">
                                @csrf
                                <input type="file" name="foto" id="foto" class="d-none" accept="image/*">
                                <button type="button" id="uploadButton" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-upload"></i> Actualizar foto
                                </button>
                            </form>
                            @if (auth()->user()->foto)
                                <form id="deleteFotoForm" action="{{ route('deleteFoto') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary btn-sm btn-el">
                                        <i class="bi bi-trash"></i> Eliminar foto
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <form id="perfilForm" method="POST" action="{{ route('usuario.update', auth()->id()) }}">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese su nombre" value="{{ auth()->user()->nombre }}">
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Ingrese sus apellidos" value="{{ auth()->user()->apellidos }}">
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" value="{{ date('Y-m-d', strtotime(auth()->user()->fecha_nacimiento)) }}" readonly
                                       data-bs-toggle="tooltip" title="Este campo no puede ser editado.">
                            </div>
                            <div class="col-md-6">
                                <label for="genero" class="form-label">Género</label>
                                <input type="text" class="form-control" id="genero" value="{{ auth()->user()->genero['nombre'] ?? '' }}" readonly
                                       data-bs-toggle="tooltip" title="Este campo no puede ser editado.">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="correo@ejemplo.com" value="{{ auth()->user()->email }}" readonly
                                       data-bs-toggle="tooltip" title="Este campo no puede ser editado.">
                            </div>
                            <div class="col-md-6">
                                <label for="numero_telefono" class="form-label">Número de Teléfono</label>
                                <input type="tel" name="numero_telefono" class="form-control" id="numero_telefono" placeholder="+34 XXX XXX XXX" value="{{ auth()->user()->numero_telefono }}">
                            </div>
                            <div class="col-md-6">
                                <label for="pais" class="form-label">País</label>
                                <input type="text" class="form-control" id="pais" value="{{ auth()->user()->pais['nombre'] ?? '' }}" readonly
                                       data-bs-toggle="tooltip" title="Este campo no puede ser editado.">
                            </div>
                            <div class="col-md-6">
                                <label for="comunidad" class="form-label">Comunidad Autónoma</label>
                                <input type="text" class="form-control" id="comunidad" value="{{ auth()->user()->comunidadAutonoma['nombre'] ?? '' }}" readonly
                                       data-bs-toggle="tooltip" title="Este campo no puede ser editado.">
                            </div>
                            <div class="col-md-6">
                                <label for="provincia" class="form-label">Provincia</label>
                                <input type="text" class="form-control" id="provincia"placeholder="Provincia"  value="{{  auth()->user()->provincia['nombre'] ?? '' }}" readonly
                                       data-bs-toggle="tooltip" title="Este campo no puede ser editado.">
                            </div>
                            <div class="col-md-6">
                                <label for="codigo-postal" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="codigo-postal" placeholder="28XXX" value="{{ auth()->user()->codigo_postal }}" readonly
                                       data-bs-toggle="tooltip" title="Este campo no puede ser editado.">
                            </div>
                        </div>
                        {{-- VENTANA EMERGENTE PARA CAMBIAR CONTRASEÑA--}}
                        <div class="text-center mt-5">
                            <a href="#" class="text-muted" onclick="return false;" title="Esta funcionalidad está deshabilitada temporalmente.">¿Quieres cambiar la contraseña?</a>
                        </div>
                        <div class="d-grid mt-1">
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
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
