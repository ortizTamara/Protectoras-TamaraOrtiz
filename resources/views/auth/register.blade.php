@extends('layouts.app')
{{-- @push('script')
    @vite('resources/js/registrarse.js')
@endpush --}}
@section('content')
    <div class="container min-vh-50 d-flex flex-column justify-content-center">
        <div class="card border rounded p-1">
            <div class="card-header card-header-transparent d-flex flex-column">
                <div class="d-flex justify-content-start">
                    <a href="{{ route('home') }}" class="btn p-1 text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <h4 class="text-center fw-semibold mb-0 register-title-style">Registro de Usuario</h4>
                        <button class="btn btn-link register-title-style" onclick="toggleShelterForm()">
                            <span id="shelterToggleText" class="fs-5">¿Eres una protectora?</span>
                        </button>
                    </div>
                </div>
            </div>
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
    <script>
        let isShelter = false;

        function toggleShelterForm() {
            isShelter = !isShelter;
            const shelterForm = document.getElementById('shelterForm');
            const shelterToggleText = document.getElementById('shelterToggleText');
            const submitBtn = document.getElementById('submitBtn');
            const userForm = document.getElementById('userForm');

            if (isShelter) {
                shelterForm.style.display = 'block';
                shelterToggleText.textContent = '¿Eres un usuario normal?';
                submitBtn.textContent = 'Registrar Protectora';

                // Cambiar userForm a col-md-6 cuando se muestre el formulario de protectora
                userForm.classList.remove('col-md-12');
                userForm.classList.add('col-md-6');
            } else {
                shelterForm.style.display = 'none';
                shelterToggleText.textContent = '¿Eres una protectora?';
                submitBtn.textContent = 'Registrarse como Usuario';

                // Volver a hacer el formulario de usuario ocupar el ancho completo
                userForm.classList.remove('col-md-6');
                userForm.classList.add('col-md-12');
            }
        }

        function handleSubmit(event) {
            event.preventDefault();
            // Lógica para enviar los datos
            console.log('Form submitted');
        }
    </script>
    {{-- <div class="container py-5">
    <div class="card mx-auto">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <a href="#" class="btn btn-link p-0">
            <i class="bi bi-arrow-left me-2"></i>Volver
          </a>
          <div class="d-flex align-items-center">
            <i class="bi bi-paw-fill text-primary me-2"></i>
            <h2 class="card-title m-0">PetAdopt</h2>
          </div>
        </div>
        <p class="card-text text-center mt-4 h4">
          Registro de Usuario
          <button id="toggleShelter" class="btn btn-link text-primary p-0">
            ¿Eres una protectora?
          </button>
        </p>
      </div>
      <form id="registerForm">
        <div class="card-body">
          <div class="row g-3">
            <!-- Información Personal -->
            <div class="col-md-6">
              <h3>Información personal</h3>
              <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="surname" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
              </div>
              <div class="mb-3">
                <label for="birthDate" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="birthDate" name="birthDate" required>
              </div>
              <div class="mb-3">
                <label for="sex" class="form-label">Sexo</label>
                <select class="form-select" id="sex" name="sex" required>
                  <option value="">Selecciona el sexo</option>
                  <option value="male">Masculino</option>
                  <option value="female">Femenino</option>
                  <option value="other">Otro</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Número de teléfono</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
              </div>
              <div class="mb-3">
                <label for="country" class="form-label">País</label>
                <select class="form-select" id="country" name="country" required>
                  <option value="">Selecciona un país</option>
                  <option value="es">España</option>
                  <option value="pt">Portugal</option>
                  <option value="fr">Francia</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="province" class="form-label">Provincia</label>
                <input type="text" class="form-control" id="province" name="province" required>
              </div>
              <div class="mb-3">
                <label for="postalCode" class="form-label">Código Postal</label>
                <input type="text" class="form-control" id="postalCode" name="postalCode" required>
              </div>
            </div>

            <!-- Información de la Protectora -->
            <div class="col-md-6 d-none" id="shelterFields">
              <h3>Información de la protectora</h3>
              <div class="mb-3">
                <label for="shelterName" class="form-label">Nombre de la protectora</label>
                <input type="text" class="form-control" id="shelterName" name="shelterName" required>
              </div>
              <div class="mb-3">
                <label for="registrationNumber" class="form-label">Número de registro oficial</label>
                <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" required>
              </div>
              <div class="mb-3">
                <label for="capacity" class="form-label">Capacidad de alojamiento</label>
                <input type="number" class="form-control" id="capacity" name="capacity" required>
              </div>
              <div class="mb-3">
                <label for="adoptionProcess" class="form-label">Proceso de adopción</label>
                <textarea class="form-control" id="adoptionProcess" name="adoptionProcess" required></textarea>
              </div>
              <div class="mb-3">
                <label for="autonomousCommunity" class="form-label">Comunidad Autónoma</label>
                <input type="text" class="form-control" id="autonomousCommunity" name="autonomousCommunity" required>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="address" name="address" required>
              </div>
              <div class="mb-3">
                <label for="instagram" class="form-label">Instagram (opcional)</label>
                <input type="text" class="form-control" id="instagram" name="instagram">
              </div>
              <div class="mb-3">
                <label for="twitter" class="form-label">Twitter (opcional)</label>
                <input type="text" class="form-control" id="twitter" name="twitter">
              </div>
              <div class="mb-3">
                <label for="facebook" class="form-label">Facebook (opcional)</label>
                <input type="text" class="form-control" id="facebook" name="facebook">
              </div>
              <div class="mb-3">
                <label for="website" class="form-label">Sitio web (opcional)</label>
                <input type="url" class="form-control" id="website" name="website">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <button type="submit" class="btn btn-primary w-100" id="submitButton">
            Registrarse como Usuario
          </button>
        </div>
      </form>
    </div>
  </div> --}}
@endsection
