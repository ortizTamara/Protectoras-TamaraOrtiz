@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <a href="{{ route('colorCreate') }}" class="btn btn-success mb-3">Crear Nuevo Color</a> --}}
        <table class="table custom-table table-striped table-hover table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th class="col-id">
                        <a href="{{ route('especie.create') }}" class="circle-btn">+</a>
                    </th>
                    <th class="col-nombre">Nombre</th>
                    <th class="col-acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($especies as $especie)
                    <tr>
                        <td>{{ $especie->id }}</td>
                        <td>{{ $especie->nombre }}</td>
                        <td class="acciones">
                            <a href="{{ route('especie.edit', $especie->id) }}" class="btn btn-warning btn-accion">Editar</a>
                            <form action="{{ route('especie.destroy', $especie->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-accion"
                                    onclick="return confirm('¿Estás seguro de eliminar esta especie?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        {{ $especies->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
