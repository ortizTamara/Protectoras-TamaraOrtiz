@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <a href="{{ route('colorCreate') }}" class="btn btn-success mb-3">Crear Nuevo Color</a> --}}
        <table class="table custom-table table-striped table-hover table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th class="col-id">
                        <a href="{{ route('raza.create') }}" class="circle-btn">+</a>
                    </th>
                    <th class="col-nombre">Nombre</th>
                    <th class="col-especie">Especie</th>
                    <th class="col-acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($razas as $raza)
                    <tr>
                        <td>{{ $raza->id }}</td>
                        <td>{{ $raza->nombre }}</td>
                        <td>{{ $raza->especie->nombre }}</td>
                        <td class="acciones">
                            <a href="{{ route('raza.edit', $raza->id) }}" class="btn btn-warning btn-accion">
                                <i class="bi bi-pencil fs-4"></i>
                            </a>
                            <form action="{{ route('raza.destroy', $raza->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-accion"
                                    onclick="return confirm('¿Estás seguro de eliminar esta raza?')">
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
                        {{ $razas->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
