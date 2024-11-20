@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/perfil.js'])
@endPushOnce

@section('content')
<div class="container-fluid d-flex flex-column">
    <div class="row flex-grow-9">
        <!-- BARRA LATERAL -->
        <div class="col-md-3 bg-white p-4 shadow-sm sidebar">
            <nav class="nav flex-column">
                {{-- Con Request verifico si la ruta actual es Perfil, si es así se le asigna btn-secundary, entonces se muestra resaltado, si no es la ruta actual, se le asigna btn-outline-secundary  --}}
                <a href="{{ route('perfil') }}" class="btn {{ Request::is('perfil') ? 'btn-secondary' : 'btn-outline-secondary' }} w-100 mb-2">Perfil</a>

                @if(auth()->user()->protectora_id || auth()->user()->rol_id == 1)
                {{-- Es lo mismo que en Perfil --}}
                    <a href="{{ route('perfil-protectora.index') }}" class="btn {{ Request::is('perfil-protectora') ? 'btn-secondary' : 'btn-outline-secondary' }} w-100 mb-2">Perfil Protectora</a>
                @endif

                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis favoritos</a>
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis protectoras</a>
                <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis ayudantes</a>

                <a href="{{ route('logout') }}" class="btn btn-outline-danger w-100 mb-2" onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">Cerrar sesión</a>
                <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>

        <!-- CONTENIDO DE PERFIL PROTECTORA -->
        <div class="col-md-9">
            <div class="card mx-auto profile-card">
                <div class="card-body">
                    <h1 class="profile-title mb-4">Perfil de la Protectora</h1>
                    <!-- ICONO PROTECTORA -->
                    <div class="d-flex flex-column align-items-center mb-5 profile-image">
                        <div class="profile-pic-container mb-2">
                            @if ($protectora && $protectora->logo)
                                <!-- Logo de la protectora -->
                                <img src="{{ asset('storage/' . $protectora->logo) }}"
                                     alt="Logo de la protectora"
                                     class="profile-img">
                            @else
                                <!-- ICONO CÁMARA -->
                                <i class="bi bi-camera profile-icon"></i>
                            @endif
                        </div>
                         <!-- BOTÓN AÑADIR LOGO -->
                         <div class="d-flex">
                            <form action="{{ route('updateLogo') }}" method="POST" enctype="multipart/form-data" class="me-2">
                                @csrf
                                <input type="file" name="logo" id="logo" class="d-none" accept="image/*">
                                <button type="button" id="uploadButtonLogo" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-upload"></i> Actualizar logo
                                </button>
                            </form>
                            {{-- BOTÓN ELIMINAR LOGO--}}
                            @if ($protectora && $protectora->logo)
                                <form action="{{ route('deleteLogo') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Eliminar logo
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre de la Protectora</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre de la protectora" value="{{ optional($protectora)->nombre }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="numero_registro_oficial" class="form-label">Número de Registro Oficial</label>
                                <input type="text" class="form-control" id="numero_registro_oficial" placeholder="Registro oficial" value="{{ optional($protectora)->numero_registro_oficial }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="capacidad_alojamiento" class="form-label">Capacidad de Alojamiento</label>
                                <input type="text" class="form-control" id="capacidad_alojamiento" placeholder="Capacidad de alojamiento" value="{{ optional($protectora)->capacidad_alojamiento }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="proceso_adopcion" class="form-label">Proceso de Adopción</label>
                                <textarea class="form-control" id="proceso_adopcion" rows="1" readonly>{{ optional($protectora)->proceso_adopcion }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" placeholder="Dirección" value="{{ optional($protectora)->direccion }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono_contacto" class="form-label">Teléfono de Contacto</label>
                                <input type="tel" class="form-control" id="telefono_contacto" placeholder="Teléfono de contacto" value="{{ optional($protectora)->telefono_contacto }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" class="form-control" id="instagram" placeholder="Instagram" value="{{ optional($protectora)->instagram }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="twitter" placeholder="Twitter" value="{{ optional($protectora)->twitter }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="facebook" placeholder="Facebook" value="{{ optional($protectora)->facebook }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="web" class="form-label">Página Web</label>
                                <input type="text" class="form-control" id="web" placeholder="Página web" value="{{ optional($protectora)->web }}" readonly>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="button" class="btn btn-primary" disabled>Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
