@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table custom-table table-striped table-hover table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th class="col-id">
                        <a href="{{ route('opcionEntrega.create') }}" class="circle-btn">+</a>
                    </th>
                    <th class="col-nombre">Nombre</th>
                    <th class="col-acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($entregas as $opcionEntrega)
                    <tr>
                        <td>{{ $opcionEntrega->id }}</td>
                        <td>{{ $opcionEntrega->nombre }}</td>
                        <td class="acciones">
                            <a href="{{ route('opcionEntrega.edit', $opcionEntrega->id) }}" class="btn btn-warning btn-accion">Editar</a>
                            <form action="{{ route('opcionEntrega.destroy', $opcionEntrega->id) }}" method="POST" class="d-inline">
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
                        {{ $entregas->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
