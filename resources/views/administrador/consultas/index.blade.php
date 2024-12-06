@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="manage-consultas__title mb-5">Gestión de Consultas</h2>

    <table class="manage-consultas__table table table-striped table-hover">
        <thead class="manage-consultas__table-head table-dark">
            <tr class="manage-consultas__table-row">
                <th class="manage-consultas__table-header">#</th>
                <th class="manage-consultas__table-header">Nombre</th>
                <th class="manage-consultas__table-header">Email</th>
                <th class="manage-consultas__table-header">Opción Consulta</th>
                <th class="manage-consultas__table-header">Estado</th>
                <th class="manage-consultas__table-header">Acciones</th>
            </tr>
        </thead>
        <tbody class="manage-consultas__table-body">
            @php $index = 1; @endphp <!-- Inicializamos el contador -->

            <!-- CONSULTAS -->
            @foreach ($consultas as $consulta)
                <tr class="manage-consultas__table-row">
                    <td class="manage-consultas__table-cell">{{ $index++ }}</td>
                    <td class="manage-consultas__table-cell">{{ $consulta->nombre }} {{ $consulta->apellidos }}</td>
                    <td class="manage-consultas__table-cell">{{ $consulta->email }}</td>
                    <td class="manage-consultas__table-cell">{{ $consulta->opcionConsulta->nombre ?? 'Sin opción' }}</td>
                    <td class="manage-consultas__table-cell">
                        @if ($consulta->esLeido)
                            <span class="badge badge--approved bg-success">Leída</span>
                        @else
                            <span class="badge badge--pending bg-warning text-dark">Pendiente</span>
                        @endif
                    </td>
                    <td class="manage-consultas__table-cell">
                        <div class="manage-consultas__actions">
                            <button type="button" class="manage-consultas__btn manage-consultas__btn--view" data-bs-toggle="modal" data-bs-target="#modal-{{ $consulta->id }}" title="Ver">
                                <i class="bi bi-eye"></i>
                            </button>


                            @if (!$consulta->esLeido)
                            <form action="{{ route('administracion.consultas.leido', $consulta->id) }}" method="POST" class="manage-consultas__form">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="manage-consultas__btn manage-consultas__btn--approve" title="Aprobar">
                                    <i class="bi bi-check"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach

            @if ($consultas->isEmpty())
                <tr class="manage-consultas__table-row">
                    <td colspan="6" class="manage-consultas__table-cell text-center">No hay consultas registradas.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@foreach ($consultas as $consulta)
    <div class="modal fade" id="modal-{{ $consulta->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $consulta->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel-{{ $consulta->id }}">Detalles de la Consulta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" id="nombre" class="form-control" value="{{ $consulta->nombre }} {{ $consulta->apellidos }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" id="email" class="form-control" value="{{ $consulta->email }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="opcionConsulta" class="form-label fw-bold">Opción de Consulta</label>
                        <input type="text" id="opcionConsulta" class="form-control" value="{{ $consulta->opcionConsulta->nombre ?? 'Sin opción' }}" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="mensaje" class="form-label fw-bold">Mensaje</label>
                        <textarea id="mensaje" class="form-control" readonly>{{ $consulta->mensaje }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="fecha" class="form-label fw-bold">Fecha</label>
                        <input type="text" id="fecha" class="form-control" value="{{ $consulta->created_at->format('d/m/Y H:i') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
