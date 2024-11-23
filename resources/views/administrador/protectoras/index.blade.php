@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="manage-protectoras__title mb-5">Gestión de Protectoras</h2>

    <table class="manage-protectoras__table table table-striped table-hover">
        <thead class="manage-protectoras__table-head table-dark">
            <tr class="manage-protectoras__table-row">
                <th class="manage-protectoras__table-header">#</th>
                <th class="manage-protectoras__table-header">Nombre</th>
                <th class="manage-protectoras__table-header">Número Registro</th>
                <th class="manage-protectoras__table-header">Email</th>
                <th class="manage-protectoras__table-header">Estado</th>
                <th class="manage-protectoras__table-header">Acciones</th>
            </tr>
        </thead>
        <tbody class="manage-protectoras__table-body">
            @php $index = 1; @endphp <!-- Inicializamos el contador -->

            <!-- PROTECTORAS VALIDADAS / PENDIENTE -->
            @foreach ($protectoras as $protectora)
                <tr class="manage-protectoras__table-row">
                    <td class="manage-protectoras__table-cell">{{ $index++ }}</td>
                    <td class="manage-protectoras__table-cell">{{ $protectora->nombre }}</td>
                    <td class="manage-protectoras__table-cell">{{ $protectora->numero_registro_oficial }}</td>
                    <td class="manage-protectoras__table-cell">{{ $protectora->usuario->email ?? 'No asignado' }}</td>
                    <td class="manage-protectoras__table-cell">
                        @if ($protectora->esValido)
                            <span class="badge badge--approved bg-success">Aprobada</span>
                        @else
                            <span class="badge badge--pending bg-warning text-dark">Pendiente</span>
                        @endif
                    </td>
                    <td class="manage-protectoras__table-cell">
                        <div class="manage-protectoras__actions">
                            <button type="button" class="manage-protectoras__btn manage-protectoras__btn--view" data-bs-toggle="modal" data-bs-target="#modal-{{ $protectora->id }}" title="Ver">
                                <i class="bi bi-eye"></i>
                            </button>

                            @if (!$protectora->esValido)
                                <form action="{{ route('administracion.protectora.validar', $protectora->id) }}" method="POST" class="manage-protectoras__form">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="manage-protectoras__btn manage-protectoras__btn--approve" title="Aprobar">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </form>

                                <!-- RECHAZAR -->
                                <button type="button" class="manage-protectoras__btn manage-protectoras__btn--reject"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalRechazar-{{ $protectora->id }}"
                                    title="Rechazar">
                                    <i class="bi bi-x"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach

            <!-- LAS PROTECTORAS RECHAZADAS -->
            @foreach ($rechazadas as $rechazada)
            <tr class="manage-protectoras__table-row">
                <td class="manage-protectoras__table-cell">{{ $index++ }}</td>
                <td class="manage-protectoras__table-cell">{{ $rechazada->nombre }}</td>
                <td class="manage-protectoras__table-cell">{{ $rechazada->numero_registro_oficial }}</td>
                <td class="manage-protectoras__table-cell">No disponible</td>
                <td class="manage-protectoras__table-cell">
                    <span class="badge badge--rejected bg-danger">Rechazada</span>
                </td>
                <td class="manage-protectoras__table-cell">
                    <div class="manage-protectoras__actions">
                        <button type="button" class="manage-protectoras__btn manage-protectoras__btn--view"
                                data-bs-toggle="modal"
                                data-bs-target="#modalRechazada-{{ $rechazada->id }}"
                                title="Ver">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach

            @if ($protectoras->isEmpty() && $rechazadas->isEmpty())
                <tr class="manage-protectoras__table-row">
                    <td colspan="6" class="manage-protectoras__table-cell text-center">No hay protectoras registradas.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

    <!-- VENTANA EMERGENTE PARA VISUALIZAR A LA PROTECTORA -->
    @foreach ($protectoras as $protectora)
    <div class="modal fade" id="modal-{{ $protectora->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $protectora->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel-{{ $protectora->id }}">Detalles de la Protectora</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" id="nombre" class="form-control" value="{{ $protectora->nombre }}" readonly>
                    </div>


                    <div class="form-group mb-3">
                        <label for="registro" class="form-label fw-bold">Registro</label>
                        <input type="text" id="registro" class="form-control" value="{{ $protectora->numero_registro_oficial }}" readonly>
                    </div>


                    <div class="form-group mb-3">
                        <label for="direccion" class="form-label fw-bold">Dirección</label>
                        <input type="text" id="direccion" class="form-control" value="{{ $protectora->direccion }}" readonly>
                    </div>


                    <div class="form-group mb-3">
                        <label for="telefono" class="form-label fw-bold">Teléfono</label>
                        <input type="text" id="telefono" class="form-control" value="{{ $protectora->telefono_contacto }}" readonly>
                    </div>


                    <div class="form-group mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" id="email" class="form-control" value="{{ $protectora->usuario->email ?? 'No asignado' }}" readonly>
                    </div>


                    <div class="form-group mb-3">
                        <label for="web" class="form-label fw-bold">Web</label>
                        <input type="text" id="web" class="form-control" value="{{ $protectora->web }}" readonly>
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Redes Sociales</label>
                        <div class="d-flex gap-3">
                            @if ($protectora->instagram || $protectora->twitter || $protectora->facebook)
                                @if ($protectora->instagram)
                                    <a href="{{ $protectora->instagram }}" target="_blank" class="btn btn-outline-secondary">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                @endif
                                @if ($protectora->twitter)
                                    <a href="{{ $protectora->twitter }}" target="_blank" class="btn btn-outline-secondary">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                @endif
                                @if ($protectora->facebook)
                                    <a href="{{ $protectora->facebook }}" target="_blank" class="btn btn-outline-secondary">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                @endif
                            @else
                                <p class="text-muted mb-0">No hay redes sociales disponibles.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- VENTANA EMERGENTE PARA RECHAZAR LA PROTECTORA-->
    @foreach ($protectoras as $protectora)
        <div class="modal fade" id="modalRechazar-{{ $protectora->id }}" tabindex="-1" aria-labelledby="modalLabelRechazar-{{ $protectora->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('administracion.protectora.destroy', $protectora->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelRechazar-{{ $protectora->id }}">Rechazar Protectora</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Por favor, ingresa el motivo del rechazo:</p>
                            <div class="form-group">
                                <textarea name="motivo_rechazo" class="form-control" rows="4" placeholder="Escribe el motivo del rechazo..." required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Rechazar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($rechazadas as $rechazada)
    <div class="modal fade" id="modalRechazada-{{ $rechazada->id }}" tabindex="-1" aria-labelledby="modalLabelRechazada-{{ $rechazada->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelRechazada-{{ $rechazada->id }}">Detalles de la Protectora - Rechazada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" id="nombre" class="form-control" value="{{ $rechazada->nombre }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="registro" class="form-label fw-bold">Registro</label>
                        <input type="text" id="registro" class="form-control" value="{{ $rechazada->numero_registro_oficial }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="direccion" class="form-label fw-bold">Dirección</label>
                        <input type="text" id="direccion" class="form-control" value="{{ $rechazada->direccion }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telefono" class="form-label fw-bold">Teléfono</label>
                        <input type="text" id="telefono" class="form-control" value="{{ $rechazada->telefono_contacto }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="web" class="form-label fw-bold">Web</label>
                        <input type="text" id="web" class="form-control" value="{{ $rechazada->web }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Redes Sociales</label>
                        <div class="d-flex gap-3">
                            @if ($rechazada->instagram || $rechazada->twitter || $rechazada->facebook)
                                @if ($rechazada->instagram)
                                    <a href="{{ $rechazada->instagram }}" target="_blank" class="btn btn-outline-secondary">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                @endif
                                @if ($rechazada->twitter)
                                    <a href="{{ $rechazada->twitter }}" target="_blank" class="btn btn-outline-secondary">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                @endif
                                @if ($rechazada->facebook)
                                    <a href="{{ $rechazada->facebook }}" target="_blank" class="btn btn-outline-secondary">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                @endif
                            @else
                                <p class="text-muted mb-0">No hay redes sociales disponibles.</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="motivo" class="form-label fw-bold">Motivo de Rechazo</label>
                        <textarea id="motivo" class="form-control" rows="3" readonly>{{ $rechazada->motivo_rechazo }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection
