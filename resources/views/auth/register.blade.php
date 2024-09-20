@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/registrarse.js'])
@endPushOnce

@section('content')
    <div class="container-sm min-vh-50 d-flex flex-column justify-content-center">
        <div class="card border rounded p-1">
            <div class="card-header card-header-transparent d-flex flex-column">
                <div class="d-flex justify-content-start">
                    <a href="{{ route('home') }}" class="btn p-1 text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <h4 class="text-center fw-semibold mb-0 register-title-style">Registro de Usuario</h4>
                        <button id="toggleButton" class="btn btn-link register-title-style">
                        {{-- <button class="btn btn-link register-title-style" onclick="toggleShelterForm()"> --}}
                            <span id="shelterToggleText" class="fs-5">¿Eres una protectora?</span>
                        </button>
                    </div>
                </div>
                <div class="full-width-line"></div>

            <div class="card-body text-start">
                <form id="registerForm" method="POST" action="{{ route('register') }}" onsubmit="handleSubmit(event)">
                    @csrf
                    <div id="formContainer" class="row">
                        <!-- FORMULARIO DE USUARIO -->
                        <div id="userForm" class="col-md-12 mb-3 p-3 border-end border-2 ">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input id="name" name="name" type="text" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="surname" class="form-label">Apellidos</label>
                                    <input id="surname" name="surname" type="text" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="birthDate" class="form-label">Fecha de nacimiento</label>
                                    <input id="birthDate" name="birthDate" type="date" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="sex" class="form-label">Sexo</label>
                                    <select id="sex" name="sex" class="form-select" required>
                                        <option value="">Selecciona el sexo</option>
                                        <option value="male">Masculino</option>
                                        <option value="female">Femenino</option>
                                        <option value="other">Otro</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" name="email" type="email" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" name="password" type="password" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
                                    <input id="confirmPassword" name="confirmPassword" type="password" class="form-control"
                                        required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="phone" class="form-label">Número de teléfono</label>
                                    <input id="phone" name="phone" type="tel" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="country" class="form-label">País</label>
                                    <select id="country" name="country" class="form-select" required>
                                        {{-- <option value="">Selecciona un país</option> --}}
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}" @selected($pais->pais_id === $pais->id)>
                                                {{ $pais->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="autonomousCommunity" class="form-label">Comunidad Autónoma</label>
                                    <select id="autonomousCommunity" name="autonomousCommunity" class="form-select"
                                        required>
                                        @foreach ($comunidades as $comunidad)
                                            <option value="{{ $comunidad->id }}">{{ $comunidad->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label for="postalCode" class="form-label">Código Postal</label>
                                    <input id="postalCode" name="postalCode" type="text" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>


                        <!-- FORMULARIO PROTECTORA-->
                        <div id="shelterForm" class="col-md-6 ">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="shelterName" class="form-label">Nombre de la protectora</label>
                                    <input id="shelterName" name="shelterName" type="text" class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="registrationNumber" class="form-label">Número de registro oficial</label>
                                    <input id="registrationNumber" name="registrationNumber" type="text"
                                        class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="capacity" class="form-label">Capacidad de alojamiento</label>
                                    <input id="capacity" name="capacity" type="number" class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="adoptionProcess" class="form-label">Proceso de adopción</label>
                                    <textarea id="adoptionProcess" name="adoptionProcess" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="province" class="form-label">Provincia</label>
                                    <select id="province" name="province" class="form-select" required>
                                        @foreach ($provincias as $provincia)
                                            <option value="{{ $provincia->id }}" @selected($provincia->provincia_id === $provincia->id)>
                                                {{ $provincia->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Dirección</label>
                                    <input id="address" name="address" type="text" class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Redes sociales (opcional)</label>
                                    <div class="form-group">
                                        <input id="instagram" name="instagram" type="text" class="form-control"
                                            placeholder="Instagram">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input id="twitter" name="twitter" type="text" class="form-control"
                                            placeholder="Twitter">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input id="facebook" name="facebook" type="text" class="form-control"
                                            placeholder="Facebook">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input id="website" name="website" type="text" class="form-control"
                                            placeholder="Web">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary w-100" id="submitBtn">Registrarse como
                            Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
