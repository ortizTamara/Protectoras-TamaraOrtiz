@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="manage-visitas__title mb-5">Gestión de Visitas</h2>

    <table class="manage-visitas__table table table-striped table-hover">
        <thead class="manage-visitas__table-head table-dark">
            <tr class="manage-visitas__table-row">
                <th class="manage-visitas__table-header">#</th>
                <th class="manage-visitas__table-header">Nombre de la Mascota</th>
                <th class="manage-visitas__table-header">Usuario</th>
                <th class="manage-visitas__table-header">Mensaje</th>
                <th class="manage-visitas__table-header">Estado</th>
                <th class="manage-visitas__table-header">Acciones</th>
            </tr>
        </thead>
        <tbody class="manage-visitas__table-body">
            @php $index = 1; @endphp

            @foreach ($visitas as $visita)
                <tr class="manage-visitas__table-row">
                    <td class="manage-visitas__table-cell">{{ $index++ }}</td>
                    <td class="manage-visitas__table-cell">{{ $visita->animal->nombre }}</td>
                    <td class="manage-visitas__table-cell">{{ $visita->usuario->nombre }}</td>
                    <td class="manage-visitas__table-cell">{{ $visita->mensaje }}</td>
                    <td class="manage-visitas__table-cell">
                        @if ($visita->estado == 'pendiente')
                            <span class="badge badge--pending bg-warning text-dark">Pendiente</span>
                        @elseif ($visita->estado == 'aceptada')
                            <span class="badge badge--approved bg-success">Aceptada</span>
                        @else
                            <span class="badge badge--rejected bg-danger">Rechazada</span>
                        @endif
                    </td>
                    <td class="manage-visitas__table-cell">
                        <div class="manage-visitas__actions">
                            <button type="button" class="manage-visitas__btn manage-visitas__btn--view" data-bs-toggle="modal" data-bs-target="#modal-{{ $visita->id }}" title="Ver">
                                <i class="bi bi-eye"></i>
                            </button>

                            @if ($visita->estado == 'pendiente')
                                <form action="{{ route('visitas.aceptar', $visita->id) }}" method="POST" class="manage-visitas__form">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="manage-visitas__btn manage-visitas__btn--approve" title="Aceptar">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </form>

                                <form action="{{ route('visitas.rechazar', $visita->id) }}" method="POST" class="manage-visitas__form">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="manage-visitas__btn manage-visitas__btn--reject" title="Rechazar">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach

            @if ($visitas->isEmpty())
                <tr class="manage-visitas__table-row">
                    <td colspan="6" class="manage-visitas__table-cell text-center">No hay visitas registradas.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

    <!-- VENTANA EMERGENTE PARA VISUALIZAR UNA VISITA -->
    @foreach ($visitas as $visita)
    <div class="modal fade" id="modal-{{ $visita->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $visita->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel-{{ $visita->id }}">Detalles de la Visita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre de la Mascota</label>
                        <input type="text" id="nombre" class="form-control" value="{{ $visita->animal->nombre }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="usuario" class="form-label fw-bold">Usuario</label>
                        <input type="text" id="usuario" class="form-control" value="{{ $visita->usuario->nombre }}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="usuario" class="form-label fw-bold">Email</label>
                        <input type="text" id="usuario" class="form-control" value="{{ $visita->usuario->email }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="mensaje" class="form-label fw-bold">Mensaje</label>
                        <textarea id="mensaje" class="form-control" rows="4" readonly>{{ $visita->mensaje }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha" class="form-label fw-bold">Fecha</label>
                        <input type="text" id="fecha" class="form-control" value="{{ $visita->created_at->format('d/m/Y H:i') }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="estado" class="form-label fw-bold">Estado</label>
                        <input type="text" id="estado" class="form-control" value="{{ ucfirst($visita->estado) }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection
