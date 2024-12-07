@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/perfil.js'])
@endPushOnce

@section('content')
<div class="container mt-5">
    <form action="{{ route('animal.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="animal-card__container mb-4 edit-mode">
            <div class="animal-card__body">
                <div class="row">
                    <div class="animal-card__image-section col-lg-4 col-md-6 mb-3 text-center">
                        <label for="imagen" class="change-image-label">
                            <img id="imagen-preview"
                                 src="{{ $animal->imagen ? asset('storage/'.$animal->imagen) : '/placeholder.svg' }}"
                                 alt="{{ $animal->nombre }}"
                                 class="animal-card__image img-fluid rounded-lg mb-3">
                        </label>
                        <input type="file" name="imagen" id="imagen" class="form-control d-none" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <div class="animal-card__info-section col-lg-8 col-md-6">
                        <div class="animal-card__header d-flex justify-content-between">
                            <div class="animal-card__title text-start">
                                <h1 class="animal-card__name mb-0 h3 d-flex align-items-center animal-card__name-container">
                                    <input type="text"
                                           id="nombre"
                                           name="nombre"
                                           class="p-0 animal-card__name-input"
                                           placeholder="Escribe un nombre..."
                                           title="Haz clic para editar el nombre"
                                           value="{{ old('nombre', $animal->nombre) }}"
                                           required>
                                        <select name="genero"
                                            class="border-0 bg-transparent animal-card__select-gender animal-card__select-gender-sm">
                                            <option value="M" @if($animal->genero == 'M') selected @endif>♂</option>
                                            <option value="F" @if($animal->genero == 'F') selected @endif>♀</option>
                                        </select>
                                </h1>

                                <p class="animal-card__location text-muted mb-2">
                                    @if ($animal->protectora && $animal->protectora->usuario)
                                        {{ $animal->protectora->usuario->pais->nombre . ', ' . $animal->protectora->usuario->comunidadAutonoma->nombre }}
                                    @else
                                        Ubicación no disponible
                                    @endif
                                </p>
                            </div>

                            <div class="animal-card__actions d-flex flex-column align-items-end gap-0 mb-5">
                                <div class="d-flex align-items-center animal-card__button-group mb-4">
                                    <button type="submit" class="btn btn-secondary animal-card__save-button">
                                        Guardar cambios
                                    </button>
                                    <a href="{{ route('animal.show', $animal->id) }}" class="btn btn-outline-secondary me-4">
                                        Cancelar
                                    </a>
                                </div>

                                {{-- <div class="animal-card__protectora-info d-flex gap-2 align-items-center mb-5">
                                    <a href="{{ route('perfil-miProtectora.show', $animal->protectora_id) }}" class="animal-card__protectora-link">
                                        <div class="d-flex align-items-center gap-3">
                                            <i class="fa-solid fa-paw animal-card__protectora-icon"></i>
                                            <div class="animal-card__protectora-text-wrapper">
                                                <span class="animal-card__protectora-name">{{ $animal->protectora->nombre }}</span>
                                                <p class="animal-card__protectora-text">Protectora</p>
                                            </div>
                                        </div>
                                    </a>

                                    <button class="animal-card__contact-button btn btn-secondary">
                                        <i class="bi bi-chat"></i> Contactar
                                    </button>
                                </div> --}}
                            </div>
                        </div>

                        <div class="animal-card__details-section grid sm:grid-cols-2 md:grid-cols-4 gap-0 mb-4 text-start">
                            <div class="animal-card__detail">
                                <h3 class="animal-card__detail-title text-muted">Especie</h3>
                                <select name="especie_id" id="especie_id"
                                        class="animal-card__detail-text  form-select form-select-sm border-0 bg-transparent p-0 animal-card__detail-select animal-card__select-especie">
                                    @foreach($especies as $especie)
                                        <option value="{{ $especie->id }}" @if($especie->id == $animal->especie_id) selected @endif>
                                            {{ $especie->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="animal-card__detail">
                                <h3 class="animal-card__detail-title text-muted">Raza</h3>
                                <select name="raza_id" id="raza_id"
                                        class="animal-card__detail-text form-select form-select-sm border-0 bg-transparent p-0 animal-card__detail-select animal-card__select-raza">
                                    @foreach($razas as $raza)
                                        <option value="{{ $raza->id }}" @if($raza->id == $animal->raza_id) selected @endif>
                                            {{ $raza->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="animal-card__detail ">
                                <h3 class="animal-card__detail-title text-muted">Fecha de Nacimiento</h3>
                                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                       class="animal-card__detail-text border-0 bg-transparent p-0 animal-card__detail-input animal-card__select-fecha"
                                       value="{{ old('fecha_nacimiento', $animal->fecha_nacimiento) }}" required>
                            </div>

                            <div class="animal-card__detail extra-gap mb-4">
                                <h3 class="animal-card__detail-title text-muted">Peso (kg)</h3>
                                <input type="number" name="peso"
                                       class="animal-card__detail-text border-0 bg-transparent p-0 animal-card__detail-input animal-card__select-peso"
                                       step="0.01"
                                       value="{{ old('peso', $animal->peso) }}" required>
                            </div>

                            <div class="animal-card__detail">
                                <h3 class="animal-card__detail-title text-muted">Color</h3>
                                <select name="color_id" id="color_id"
                                        class="animal-card__detail-text form-select form-select-sm border-0 bg-transparent p-0 animal-card__detail-select animal-card__select-color">
                                    @foreach($colores as $color)
                                        <option value="{{ $color->id }}" @if($color->id == $animal->color_id) selected @endif>
                                            {{ $color->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="animal-card__detail">
                                <h3 class="animal-card__detail-title text-muted">Nivel Actividad</h3>
                                <select name="nivel_actividad_id" id="nivel_actividad_id"
                                        class="animal-card__detail-text form-select form-select-sm border-0 bg-transparent p-0 animal-card__detail-select animal-card__select-actividad">
                                    @foreach($nivelesActividad as $nivel)
                                        <option value="{{ $nivel->id }}" @if($nivel->id == $animal->nivel_actividad_id) selected @endif>
                                            {{ $nivel->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="animal-card__detail">
                                <h3 class="animal-card__detail-title text-muted">Estado</h3>
                                <select name="estado_animal_id" id="estado_animal_id"
                                        class="animal-card__detail-text form-select form-select-sm border-0 bg-transparent p-0 animal-card__detail-select animal-card__select-estado">
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado->id }}" @if($estado->id == $animal->estado_animal_id) selected @endif>
                                            {{ $estado->nombre }}
                                        </option>
                                    @endforeach
                                </select>
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
                                                            <input type="checkbox"
                                                                   name="comportamientos[]"
                                                                   id="comportamiento_{{ $comportamiento->id }}"
                                                                   value="{{ $comportamiento->id }}"
                                                                   class="form-check-input create-animal__checkbox"
                                                                   @if($animal->comportamientos->contains($comportamiento->id)) checked @endif>
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

                        <div class="animal-card__opciones-entrega text-start mb-3">
                            <h3 class="animal-card__section-title font-semibold mb-0">Me entregan</h3>
                            <ul class="animal-card__opciones-lista">
                                @foreach($opcionesEntrega as $opcion)
                                    <li class="animal-card__opcion-item d-flex align-items-center mb-1">
                                        <input type="checkbox"
                                               name="opciones_entrega[]"
                                               id="opcion_{{ $opcion->id }}"
                                               value="{{ $opcion->id }}"
                                               @if($animal->opcionesEntrega->contains($opcion->id)) checked @endif>
                                        <label for="opcion_{{ $opcion->id }}" class="ms-2">{{ $opcion->nombre }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="animal-card__history text-start">
                            <h3 class="animal-card__section-title font-semibold mb-1">Mi historia</h3>
                            <textarea name="descripcion" class="form-control" rows="" required>{{ old('descripcion', $animal->descripcion) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
