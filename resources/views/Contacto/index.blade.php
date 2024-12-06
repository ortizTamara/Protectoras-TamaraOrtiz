@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/validador.js'])
@endPushOnce

@section('content')
    <div class="container py-5">
        <h1 class="display-4 text-center mb-5">Contacto</h1>

        <div class="row g-4">
           <!-- Formulario de Consulta -->
            <div class="col-lg-6">
                <h2 class="h3 mb-4">Envíanos tu consulta</h2>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('consulta.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ old('name') }}" required>
                                        <label for="name">Nombre</label>
                                        <div id="nameError" class="text-danger text-start"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Apellidos" value="{{ old('surname') }}" required>
                                        <label for="surname">Apellidos</label>
                                        <div id="surnameError" class="text-danger text-start"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                <label for="email">Email</label>
                                <div id="emailError" class="text-danger text-start"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Teléfono" value="{{ old('phone') }}">
                                <label for="phone">Teléfono</label>
                                <div id="phoneError" class="text-danger text-start"></div>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="opcion_consultas_id" id="opcion_consultas_id" aria-label="Seleccione una opción" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    @foreach ($opcionConsultas as $opcion)
                                        <option value="{{ $opcion->id }}" {{ old('opcion_consultas_id') == $opcion->id ? 'selected' : '' }}>{{ $opcion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="message" name="message" placeholder="Mensaje" rows="5" required>{{ old('message') }}</textarea>
                                <label for="message">Mensaje</label>
                                <div id="messageError" class="text-danger text-start"></div>
                            </div>
                            <button type="submit" class="btn btn-secondary w-100">Enviar mensaje</button>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Información de Contacto -->
            <div class="col-lg-6">
                <h2 class="h3 mb-4 text-center">Información de contacto</h2>
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="h5 mb-3">Tamara Ortiz Gómez</h3>
                        <div class="text-muted mb-4">
                            <p class="d-flex justify-content-center align-items-center mb-2">
                                <i class="bi bi-envelope me-2"></i>
                                <a href="mailto:tamara.ortiz@example.com" class="no-blue-link">example@example.com</a>
                            </p>
                            <p class="d-flex justify-content-center align-items-center mb-2">
                                <i class="bi bi-telephone me-2"></i>
                                <a href="tel:+34123456789" class="no-blue-link">+34 123 456 789</a>
                            </p>
                            <p class="d-flex justify-content-center align-items-center mb-2">
                                <i class="bi bi-geo-alt me-2"></i>
                                Calle Ejemplo 123, 08001 Barcelona
                            </p>
                        </div>
                        <div class="mb-3">
                            <h4 class="h6 mb-3">Horarios de Atención</h4>
                            <p class="text-muted mb-2">Lunes a Viernes: 9:00 - 18:00</p>
                            <p class="text-muted">Sábados: 10:00 - 14:00</p>
                        </div>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="https://twitter.com/tuPerfil" class="btn btn-secondary" target="_blank">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="https://facebook.com/tuPerfil" class="btn btn-secondary" target="_blank">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://instagram.com/tuPerfil" class="btn btn-secondary" target="_blank">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="https://linkedin.com/in/tuPerfil" class="btn btn-secondary" target="_blank">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                        <div class="mt-5 text-center">
                            <p class="text-muted mb-3">Recibe actualizaciones y noticias sobre nuestra protectora directamente en tu correo.</p>
                            <form class="d-inline-block w-100">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Ingresa tu correo" aria-label="Correo electrónico" required>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporalmente no disponible">
                                        Suscribirse
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
