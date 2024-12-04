@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/seleccionarEspecie.js', 'resources/js/validadorAnimal.js', 'resources/js/perfil.js'])
@endPushOnce

@section('content')
    <div class="create-animal container">
        <h1 class="create-animal__title text-center mb-5 fw-bold">Crear Nuevo Animal</h1>
        <form action="{{ route('animal-temporal.store') }}" method="POST" enctype="multipart/form-data" class="create-animal__form">
            @csrf
            <div class="create-animal__section text-start mb-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="estado_animal_id" class="create-animal__label fw-bold">Estado</label>
                        <select name="estado_animal_id" id="estado_animal_id" class="create-animal__select form-select" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                        <div id="estadoError" class="text-danger small mt-1"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre" class="create-animal__label fw-bold">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="create-animal__input form-control" required>
                        <div id="nombreError" class="text-danger small mt-1"></div>
                    </div>
                </div>
            </div>

            <div class="create-animal__section text-start mb-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="especie_id" class="create-animal__label fw-bold">Especie</label>
                        <select name="especie_id" id="especie_id" class="create-animal__select form-select" required>
                            <option value="" disabled selected>Selecciona una especie</option>
                            @foreach ($especies as $especie)
                                <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
                            @endforeach
                        </select>
                        <div id="especieError" class="text-danger small mt-1"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="raza_id" class="create-animal__label fw-bold">Raza</label>
                        <select name="raza_id" id="raza_id" class="create-animal__select form-select">
                            <option value="" disabled selected>Selecciona una raza</option>
                        </select>
                        <div id="razaError" class="text-danger small mt-1"></div>
                    </div>
                </div>
            </div>

            <div class="create-animal__section text-start mb-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="color_id" class="create-animal__label fw-bold">Color</label>
                        <select name="color_id" id="color_id" class="create-animal__select form-select" required>
                            <option value="" disabled selected>Selecciona un color</option>
                            @foreach ($colores as $color)
                                <option value="{{ $color->id }}">{{ $color->nombre }}</option>
                            @endforeach
                        </select>
                        <div id="colorError" class="text-danger small mt-1"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_nacimiento" class="create-animal__label fw-bold">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="create-animal__input form-control" required>
                        <div id="fechaNacimientoError" class="text-danger small mt-1"></div>
                    </div>
                </div>
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <label for="genero_animal_id" class="create-animal__label fw-bold">Sexo</label>
                        <select name="genero_animal_id" id="genero_animal_id" class="create-animal__select form-select" required>
                            <option value="" disabled selected>Selecciona el sexo</option>
                            @foreach ($generos as $genero)
                                <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                            @endforeach
                        </select>
                        <div id="generoError" class="text-danger small mt-1"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="peso" class="create-animal__label fw-bold">Peso (kg)</label>
                        <input type="number" name="peso" id="peso" class="form-control" step="0.01" placeholder="Indica el peso" required>
                        <div id="pesoError" class="text-danger small mt-1"></div>
                    </div>
                </div>
                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        <label for="nivel_actividad_id" class="create-animal__label fw-bold">Nivel de Actividad</label>
                        <select name="nivel_actividad_id" id="nivel_actividad_id" class="create-animal__select form-select" required>
                            <option value="" disabled selected>Selecciona el nivel de actividad</option>
                            @foreach ($nivelesActividad as $nivel)
                                <option value="{{ $nivel->id }}">{{ $nivel->nombre }}</option>
                            @endforeach
                        </select>
                        <div id="nivelActividadError" class="text-danger small mt-1"></div>
                    </div>
                </div>
            </div>

            <div class="create-animal__section text-start mb-4">
                <h5 class="create-animal__subtitle text-start fw-bold">Comportamientos</h5>
                <div id="comportamientosError" class="text-danger small mt-1"></div>
                <div class="accordion create-animal__accordion" id="comportamientosAccordion">
                    @foreach ($comportamientos->groupBy('categoria') as $categoria => $items)
                        <div class="accordion-item create-animal__accordion-item">
                            <h2 class="accordion-header create-animal__accordion-header" id="heading-{{ $loop->index }}">
                                <button class="accordion-button collapsed create-animal__accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false"
                                        aria-controls="collapse-{{ $loop->index }}">
                                    {{ $categoria }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $loop->index }}" class="accordion-collapse collapse create-animal__accordion-body"
                                 aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#comportamientosAccordion">
                                <div class="row row-cols-2 row-cols-md-3 g-2 mt-2">
                                    @foreach ($items as $comportamiento)
                                        <div class="col">
                                            <div class="form-check create-animal__check">
                                                <input type="checkbox" name="comportamientos[]" id="comportamiento_{{ $comportamiento->id }}"
                                                       value="{{ $comportamiento->id }}" class="form-check-input create-animal__checkbox">
                                                <label for="comportamiento_{{ $comportamiento->id }}" class="form-check-label create-animal__checkbox-label">
                                                    {{ $comportamiento->nombre }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="create-animal__section text-start mb-4">
                <h5 class="create-animal__subtitle text-start fw-bold">Cómo se entrega</h5>
                <div id="opcionesEntregaError" class="text-danger small mt-1"></div>
                <div class="row create-animal__delivery-row">
                    @foreach ($opcionesEntrega as $opcion)
                        <div class="col-4 create-animal__delivery-option">
                            <div class="form-check create-animal__check">
                                <input type="checkbox" name="opciones_entrega[]" id="opcion_{{ $opcion->id }}" value="{{ $opcion->id }}" class="form-check-input create-animal__checkbox">
                                <label for="opcion_{{ $opcion->id }}" class="form-check-label create-animal__checkbox-label">
                                    {{ $opcion->nombre }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="create-animal__section text-start mb-4">
                <h5 class="create-animal__subtitle fw-bold">Historia</h5>
                <textarea name="descripcion" id="descripcion" class="create-animal__textarea form-control" rows="3" placeholder="Cuéntanos la historia del animal"></textarea>
            </div>

            <div class="create-animal__section text-start mb-4">
                <h5 class="create-animal__subtitle fw-bold">Imagen</h5>
                <div class="create-animal__photo-upload-container">
                    <label for="imagen" class="create-animal__upload-label" role="button" tabindex="0">
                        <i class="bi bi-upload create-animal__icon"></i>
                        <p class="create-animal__text">Seleccionar imagen</p>
                    </label>
                    <input type="file" name="imagen" id="imagen" class="create-animal__input d-none" accept="image/jpeg,image/png,image/gif" required>
                    <div id="imagenError" class="create-animal__error"></div>
                    <div class="create-animal__preview">
                        <img id="imagen_preview" src="#" alt="Vista previa" class="d-none">
                    </div>
                    <div id="imagenName" class="create-animal__file-name"></div>
                </div>
            </div>

            <div class="create-animal__actions d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('animal.index') }}" class="btn btn-outline-secondary create-animal__cancel">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary create-animal__submit">
                    Publicar
                </button>
            </div>
        </form>
    </div>
@endsection
