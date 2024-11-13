@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 bg-light d-flex">
    <!-- Sidebar -->
    <div class="col-md-3 bg-white p-4 shadow-sm">
        <nav class="nav flex-column">
            <a href="#" class="btn btn-secondary w-100 mb-2">Perfil</a>
            <a href="#" class="btn btn-outline-secondary w-100 mb-2">Perfil protectora</a>
            <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis favoritos</a>
            <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis protectoras</a>
            <a href="#" class="btn btn-outline-secondary w-100 mb-2">Mis ayudantes</a>
            <a href="#" class="btn btn-outline-danger w-100 mb-2">Cerrar sesión</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="col-md-9 p-4">
        <div class="card mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h1 class="card-title mb-4 text-center">Mi Perfil</h1>

                <!-- Profile Image -->
                <div class="d-flex justify-content-center mb-4">
                    <div class="position-relative">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="height: 100px; width: 100px;">
                            <i class="bi bi-person-circle" style="font-size: 2.5rem; color: #6c757d;"></i>
                        </div>
                        <button class="btn btn-secondary btn-sm position-absolute bottom-0 end-0">Actualizar foto</button>
                    </div>
                </div>

                <!-- Form -->
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" placeholder="Ingrese sus apellidos">
                        </div>
                        <div class="col-md-6">
                            <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha">
                        </div>
                        <div class="col-md-6">
                            <label for="genero" class="form-label">Género</label>
                            <select class="form-select" id="genero">
                                <option selected>Seleccione género</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="correo@ejemplo.com">
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Número de Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" placeholder="+34 XXX XXX XXX">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                        <div class="col-md-6">
                            <label for="pais" class="form-label">País</label>
                            <select class="form-select" id="pais">
                                <option selected>Seleccione país</option>
                                <option value="españa">España</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="comunidad" class="form-label">Comunidad Autónoma</label>
                            <select class="form-select" id="comunidad">
                                <option selected>Seleccione comunidad</option>
                                <option value="madrid">Madrid</option>
                                <option value="cataluña">Cataluña</option>
                                <option value="andalucia">Andalucía</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="codigo-postal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" id="codigo-postal" placeholder="28XXX">
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
