@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table custom-table table-striped table-hover table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th class="col-id">
                        <a href="{{ route('color.create') }}" class="circle-btn">+</a>
                    </th>
                    <th class="col-nombre">Nombre</th>
                    <th class="col-acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colores as $color)
                    <tr>
                        <td>{{ $color->id }}</td>
                        <td>{{ $color->nombre }}</td>
                        <td class="acciones">
                            <a href="{{ route('color.edit', $color->id) }}" class="btn btn-warning btn-accion">Editar</a>
                            <form action="{{ route('color.destroy', $color->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-accion"
                                    onclick="return confirm('¿Estás seguro de eliminar este color?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        {{ $colores->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
