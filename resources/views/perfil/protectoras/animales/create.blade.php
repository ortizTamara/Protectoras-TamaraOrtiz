@extends('layouts.app')

@section('content')
    <div class="create-animal container">
        <h1 class="create-animal__title text-center mb-5 fw-bold">Crear Nuevo Animal</h1>
        <form action="{{ route('animal.store') }}" method="POST" enctype="multipart/form-data" class="create-animal__form">
            @csrf
            <div class="create-animal__section text-start">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="estado_id" class="create-animal__label fw-bold">Estado</label>
                        <select name="estado_id" id="estado_id" class="create-animal__select form-select" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre" class="create-animal__label fw-bold">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="create-animal__input form-control" required>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="especie_id" class="create-animal__label fw-bold">Especie</label>
                        <select name="especie_id" id="especie_id" class="create-animal__select form-select" required>
                            <option value="" disabled selected>Selecciona una especie</option>
                            @foreach ($especies as $especie)
                                <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="raza_id" class="create-animal__label fw-bold">Raza</label>
                        <select name="raza_id" id="raza_id" class="create-animal__select form-select">
                            <option value="" disabled selected>Selecciona una raza</option>
                            @foreach ($razas as $raza)
                                <option value="{{ $raza->id }}">{{ $raza->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="create-animal__section mt-4 text-start">
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="fecha_nacimiento" class="create-animal__label fw-bold">Fecha de Nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="create-animal__input form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="sexo" class="create-animal__label fw-bold">Sexo</label>
                        <select name="sexo" id="sexo" class="create-animal__select form-select" required>
                            <option value="" disabled selected>Selecciona el sexo</option>
                            @foreach ($sexos as $sexo)
                                <option value="{{ $sexo }}">{{ $sexo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="peso" class="create-animal__label fw-bold">Peso (kg)</label>
                        <input type="number" name="peso" id="peso" class="create-animal__input form-control" step="0.1" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nivel_actividad" class="create-animal__label fw-bold">Nivel de Actividad</label>
                        <select name="nivel_actividad" id="nivel_actividad" class="create-animal__select form-select">
                            <option value="" disabled selected>Selecciona el nivel de actividad</option>
                            @foreach ($nivelesActividad as $nivel)
                                <option value="{{ $nivel }}">{{ $nivel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="create-animal__section mt-4">
                <h5 class="create-animal__subtitle text-start fw-bold">Comportamientos</h5>
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

            <div class="create-animal__section mt-4">
                <h5 class="create-animal__subtitle text-start fw-bold">Cómo se entrega</h5>
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

            <div class="create-animal__section mt-4 text-start">
                <h5 class="create-animal__subtitle fw-bold">Historia</h5>
                <textarea name="descripcion" id="descripcion" class="create-animal__textarea form-control" rows="3" placeholder="Cuéntanos la historia del animal"></textarea>
            </div>

            <div class="create-animal__section mt-4 text-start">
                <h5 class="create-animal__subtitle fw-bold">Foto</h5>
                <div class="create-animal__photo-upload-container d-flex flex-column align-items-center p-4 bg-light border border-dashed rounded">
                    <label for="foto_perfil" class="create-animal__upload-label d-flex flex-column align-items-center">
                        <i class="bi bi-upload fs-1 text-primary"></i>
                        <p class="mt-2 text-muted">Seleccionar imagen de perfil</p>
                    </label>
                    <input type="file" name="foto_perfil" id="foto_perfil" class="create-animal__input d-none" accept="image/*">
                    <div class="create-animal__preview mt-3">
                        <img id="foto_preview" src="#" alt="Vista previa" class="img-thumbnail d-none" style="max-width: 150px; max-height: 150px;">
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="create-animal__actions d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('animal.index') }}" class="btn btn-outline-secondary create-animal__cancel">Cancelar</a>
                <button type="submit" class="btn btn-primary create-animal__submit">Publicar</button>
            </div>
        </form>
    </div>
@endsection
