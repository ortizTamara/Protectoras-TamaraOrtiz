@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table custom-table table-striped table-hover table-bordered mx-auto">
            <thead class="table-dark">
                <tr>
                    <th class="col-id">
                        <a href="{{ route('estadoAnimal.create') }}" class="circle-btn">+</a>
                    </th>
                    <th class="col-nombre">Nombre</th>
                    <th class="col-acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estados as $estadoAnimal)
                    <tr>
                        <td>{{ $estadoAnimal->id }}</td>
                        <td>{{ $estadoAnimal->nombre }}</td>
                        <td class="acciones">
                            <a href="{{ route('estadoAnimal.edit', $estadoAnimal->id) }}" class="btn btn-warning btn-accion">
                                <i class="bi bi-pencil fs-4"></i>
                            </a>
                            <form action="{{ route('estadoAnimal.destroy', $estadoAnimal->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-accion"
                                    onclick="return confirm('¿Estás seguro de eliminar este estado?')">
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
                        {{ $estados->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
