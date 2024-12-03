@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Editar Raza</h1>

        <form action="{{ route('raza.update', $raza->id) }}" method="POST"
            class="table custom-table mx-auto p-4 border rounded shadow-sm">
            @csrf
            @method('PUT')
            <div class="row mb-3 align-items-center">
                <label for="nombre" class="col-form-label col-sm-1">Nombre:</label>
                <div class="col-sm-11">
                    <input type="text" name="nombre" class="form-control" value="{{ $raza->nombre }}" required>
                </div>
            </div>
            <div class="row mb-3 align-items-center">
                <label for="especie_id" class="col-form-label col-sm-1">Especie:</label>
                <div class="col-sm-11">
                    <select name="especie_id" class="form-control" required>
                        @foreach ($especies as $especie)
                            <option value="{{ $especie->id }}" @selected($raza->especie_id === $especie->id)>
                                {{ $especie->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2 custom-btn-editar">Actualizar</button>
                <a href="{{ route('raza.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
