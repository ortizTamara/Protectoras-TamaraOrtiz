@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Crear Nuevo Comportamiento</h1>

        <form action="{{ route('comportamiento.store') }}" method="POST"
            class="table custom-table mx-auto p-4 border rounded shadow-sm">
            @csrf

            <div class="row mb-3 align-items-center">
                <label for="categoria" class="col-form-label col-sm-2">Categoría:</label>
                <div class="col-sm-10">
                    <input type="text" name="categoria" class="form-control" required>
                    @error('categoria')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label for="Comportamiento" class="col-form-label col-sm-2">Comportamiento:</label>
                <div class="col-sm-10">
                    <input type="text" name="nombre" class="form-control " required>
                    @error('nombre')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2 custom-btn-guardar">Guardar</button>
                <a href="{{ route('comportamiento.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
