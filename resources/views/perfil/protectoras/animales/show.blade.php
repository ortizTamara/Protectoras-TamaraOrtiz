@extends('layouts.app')

@pushOnce('scripts')
    @vite(['resources/js/calcularEdadTamanio.js', 'resources/js/marcarFavorito.js'])
@endPushOnce

@section('content')
<div class="container mt-5">
  <div class="animal-card__container mb-4">
    <div class="animal-card__body">
      <div class="row">
        <div class="animal-card__image-section col-lg-4 col-md-6 mb-3">
          <img src="{{ $animal->imagen ? asset('storage/'.$animal->imagen) : '/placeholder.svg' }}" alt="{{ $animal->nombre }}" class="animal-card__image img-fluid rounded-lg mb-3">
        </div>

        <div class="animal-card__info-section col-lg-8 col-md-6">
          <div class="animal-card__header d-flex justify-content-between">
            <div class="animal-card__title text-start">
              <h1 class="animal-card__name mb-0 h3">{{ $animal->nombre }} {{ $animal->genero == 'F' ? '♀' : '♂' }}</h1>
              <p class="animal-card__location text-muted">
                @if ($animal->protectora && $animal->protectora->usuario)
                    {{ $animal->protectora->usuario->pais->nombre . ', ' . $animal->protectora->usuario->comunidadAutonoma->nombre }}
                @else
                    Ubicación no disponible
                @endif
            </p>
            </div>
            <div class="animal-card__actions d-flex flex-column align-items-end gap-0 mb-0">
                <div class="d-flex align-items-center big-gap mb-2">
                    @if(auth()->check() && (auth()->user()->rol_id == 1 || auth()->user()->protectora_id == $animal->protectora_id))
                    <a href="{{ route('animal.edit', $animal->id) }}" class="btn btn-secondary">
                        <i class="bi bi-pencil"></i> Editar animal
                    </a>
                @endif
                @auth
                    <form>
                        <input type="hidden" name="animal_id" value="{{ $animal->id }}">
                        <button class="favorite-icon-btn" type="button">
                            <i class="favorite-icon {{ Auth::user()->favoritos->contains($animal->id) ? 'fas fa-heart selected text-danger' : 'fas fa-heart' }}"></i>
                        </button>
                    </form>
                @endauth
                </div>

                <div class="animal-card__protectora-info d-flex gap-2 align-items-center mb-5">
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
                </div>
            </div>
        </div>

          <div class="animal-card__details-section grid sm:grid-cols-2 md:grid-cols-5 gap-0 mb-4 text-start">
            <div class="animal-card__detail">
                <h3 class="animal-card__detail-title text-muted">Especie</h3>
                <p class="animal-card__detail-text">{{ $animal->especie->nombre }}</p>
            </div>
            <div class="animal-card__detail">
                <h3 class="animal-card__detail-title text-muted">Raza</h3>
                <p class="animal-card__detail-text">{{ $animal->raza->nombre }}</p>
            </div>
            <div class="animal-card__detail">
                <h3 class="animal-card__detail-title text-muted">Edad</h3>
                <p id="fecha_nacimiento" class="animal-card__detail-text">{{ $animal->fecha_nacimiento }}</p>
            </div>
            <div class="animal-card__detail mb-4">
                <h3 class="animal-card__detail-title text-muted">Tamaño</h3>
                <p  id="animal-size" class="animal-card__detail-text">{{ $animal->peso }} kg</p>
            </div>

            <div class="animal-card__detail ">
                <h3 class="animal-card__detail-title text-muted">Color</h3>
                <p  id="animal-color" class="animal-card__detail-text">{{ $animal->color->nombre}}</p>
            </div>

            <div class="animal-card__detail">
                <h3 class="animal-card__detail-title text-muted">Nivel Actividad</h3>
                <p  id="animal-actividad" class="animal-card__detail-text">{{ $animal->nivelActividad->nombre}}</p>
            </div>
            <div class="animal-card__detail">
                <h3 class="animal-card__detail-title text-muted">Estado</h3>
                <p id="animal-estado" class="animal-card__detail-text">{{ $animal->estado->nombre}}</p>
            </div>
        </div>

          <div class="animal-card__comportamientos text-start mb-4">
            <h3 class="animal-card__section-title font-semibold mb-2">¿Cómo soy?</h3>
            <div class="animal-card__badges d-flex flex-wrap gap-2">
                @foreach($animal->comportamientos as $comportamiento)
                    <span class="animal-card__badge badge badge-pill badge-secondary p-2">{{ $comportamiento->nombre }}</span>
                @endforeach
            </div>
        </div>

        <div class="animal-card__opciones-entrega text-start mb-3">
            <h3 class="animal-card__section-title font-semibold mb-0">Me entregan</h3>
            <ul class="animal-card__opciones-lista">
                @foreach($animal->opcionesEntrega as $entrega)
                <li class="animal-card__opcion-item">
                    <i class="bi bi-check animal-card__check-icon "></i> {{ $entrega->nombre }}
                </li>
                @endforeach
            </ul>
        </div>

        <div class="animal-card__history text-start">
            <h3 class="animal-card__section-title font-semibold mb-1">Mi historia</h3>
            <p class="animal-card__history-text">{{ $animal->descripcion }}</p>
        </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
