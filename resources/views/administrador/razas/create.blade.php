@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Crear Nueva Raza</h1>

        <form action="{{ route('raza.store') }}" method="POST"
            class="table custom-table mx-auto p-4 border rounded shadow-sm">
            @csrf

            <div class="row mb-3 align-items-center">
                <label for="nombre" class="col-form-label col-sm-1">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" name="nombre" class="form-control " required>
                    @error('nombre')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label for="especie" class="col-form-label col-sm-1">Especie:</label>
                <div class="col-sm-10">
                    <select name="especie_id" class="form-control" required>
                        <option value="">Seleccione una especie</option>
                        @foreach ($especies as $especie)
                            <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">Guardar</button>
                <a href="{{ route('raza.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
