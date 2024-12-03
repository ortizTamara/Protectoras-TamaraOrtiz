@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Editar Opcion de Consulta</h1>

        <form action="{{ route('opcionConsulta.update', $opcionConsulta->id) }}" method="POST"
            class="table custom-table mx-auto p-4 border rounded shadow-sm">
            @csrf
            @method('PUT')
            <div class="row mb-3 align-items-center">
                <label for="nombre" class="col-form-label col-sm-1">Nombre:</label>
                <div class="col-sm-11">
                    <input type="text" name="nombre" class="form-control" value="{{ $opcionConsulta->nombre }}" required>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2 custom-btn-editar">Actualizar</button>
                <a href="{{ route('opcionConsulta.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
