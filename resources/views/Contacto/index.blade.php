@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="display-4 text-center mb-5">Contacto</h1>

        <div class="row g-4">
            <!-- Formulario de Consulta -->
            <div class="col-lg-6">
                <h2 class="h3 mb-4">Envíanos tu consulta</h2>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="firstName" placeholder="Nombre"
                                            required>
                                        <label for="firstName">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="lastName" placeholder="Apellidos"
                                            required>
                                        <label for="lastName">Apellidos</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="Email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="phone" placeholder="Teléfono">
                                <label for="phone">Teléfono</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="shelter" aria-label="Seleccione una opción" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="1">Opción 1</option>
                                    <option value="2">Opción 2</option>
                                    <option value="3">Opción 3</option>
                                </select>
                                <label for="shelter">Seleccione una opción</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="message" placeholder="Mensaje" rows="5" required></textarea>
                                <label for="message">Mensaje</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Enviar mensaje</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Información de Contacto -->
            <div class="col-lg-6">
                <h2 class="h3 mb-4">Información de contacto</h2>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="h5 mb-3">Tamara Ortiz Gómez</h3>
                        <div class="text-muted mb-4">
                            <p class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope me-2"></i>
                                <a href="mailto:juan.perez@example.com">example@example.com</a>
                            </p>
                            <p class="d-flex align-items-center mb-2">
                                <i class="bi bi-telephone me-2"></i>
                                <a href="tel:+34123456789">+34 123 456 789</a>
                            </p>
                            <p class="d-flex align-items-center mb-2">
                                <i class="bi bi-geo-alt me-2"></i>
                                Calle Ejemplo 123, 08001 Barcelona
                            </p>
                        </div>
                        <!-- Horarios de Atención -->
                        <div class="mb-4">
                            <h4 class="h6 mb-3">Horarios de Atención</h4>
                            <p class="text-muted mb-2">Lunes a Viernes: 9:00 - 18:00</p>
                            <p class="text-muted">Sábados: 10:00 - 14:00</p>
                        </div>
                        <!-- Redes Sociales -->
                        <div class="mb-4">
                            <h4 class="h6 mb-3">Síguenos en redes sociales</h4>
                            <div class="d-flex gap-2">
                                <a href="https://twitter.com/tuPerfil" class="btn btn-outline-primary" target="_blank">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://facebook.com/tuPerfil" class="btn btn-outline-primary" target="_blank">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://instagram.com/tuPerfil" class="btn btn-outline-primary" target="_blank">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="https://linkedin.com/in/tuPerfil" class="btn btn-outline-primary" target="_blank">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario para Voluntariado -->
        {{-- <div class="row mt-4">
            <div class="col-lg-12">
                <h2 class="h3 mb-4">Únete como Voluntario</h2>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="volunteerName" placeholder="Nombre completo"
                                    required>
                                <label for="volunteerName">Nombre completo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="volunteerEmail"
                                    placeholder="Correo electrónico" required>
                                <label for="volunteerEmail">Correo electrónico</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="volunteerPhone" placeholder="Teléfono">
                                <label for="volunteerPhone">Teléfono</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="volunteerMessage" placeholder="¿Por qué quieres ser voluntario?" rows="4"
                                    required></textarea>
                                <label for="volunteerMessage">¿Por qué quieres ser voluntario?</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Enviar solicitud</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
