@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table custom-table table-striped table-hover table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th class="col-id">
                        <a href="{{ route('comportamiento.create') }}" class="circle-btn">+</a>
                    </th>
                    <th class="col-nombre">Nombre</th>
                    <th class="col-categoria">Categoria</th>
                    <th class="col-acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comportamientos as $comportamiento)
                    <tr>
                        <td>{{ $comportamiento->id }}</td>
                        <td>{{ $comportamiento->nombre }}</td>
                        <td>{{ $comportamiento->categoria }}</td>
                        <td class="acciones">
                            <a href="{{ route('comportamiento.edit', $comportamiento->id) }}" class="btn btn-warning btn-accion">
                                <i class="bi bi-pencil fs-4"></i>
                            </a>
                            <form action="{{ route('comportamiento.destroy', $comportamiento->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-accion"
                                    onclick="return confirm('¿Estás seguro de eliminar este comportamiento?')">
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
                        {{ $comportamientos->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
