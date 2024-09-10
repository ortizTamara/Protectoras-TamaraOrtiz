@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <a href="{{ route('colorCreate') }}" class="btn btn-success mb-3">Crear Nuevo Color</a> --}}
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
                    <td colspan="3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-0 custom-text">
                                    Mostrando
                                    <span class="highlight">{{ $colores->firstItem() }}</span> a
                                    <span class="highlight">{{ $colores->lastItem() }}</span> de
                                    <span class="highlight">{{ $colores->total() }}</span> resultado
                                </p>
                            </div>
                            <div>
                                {{ $colores->links() }}
                            </div>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        {{-- {{ $colores->links() }} --}}
    </div>
@endsection
