@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table custom-table table-striped table-hover table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th class="col-id">
                        <a href="{{ route('opcionConsulta.create') }}" class="circle-btn">+</a>
                    </th>
                    <th class="col-nombre">Nombre</th>
                    <th class="col-acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($opcionConsulta as $consulta)
                    <tr>
                        <td>{{ $consulta->id }}</td>
                        <td>{{ $consulta->nombre }}</td>
                        <td class="acciones">
                            <a href="{{ route('opcionConsulta.edit', $consulta->id) }}" class="btn btn-warning btn-accion">
                                <i class="bi bi-pencil fs-4"></i>
                            </a>
                            <form action="{{ route('opcionConsulta.destroy', $consulta->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-accion"
                                    onclick="return confirm('¿Estás seguro de eliminar esta consulta?')">
                                    <i class="bi bi-trash fs-4"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        {{ $opcionConsulta->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
