@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Crear Nueva Especie</h1>

        <form action="{{ route('especie.store') }}" method="POST"
            class="table custom-table mx-auto p-4 border rounded shadow-sm">
            @csrf

            <div class="row mb-3 align-items-center">
                <label for="nombre" class="col-form-label col-sm-1">Nombre:</label>
                <div class="col-sm-11">
                    <input type="text" name="nombre" class="form-control " required>
                    @error('nombre')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2 custom-btn-guardar">Guardar</button>
                <a href="{{ route('especie.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
