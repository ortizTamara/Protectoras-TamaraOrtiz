@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mis Favoritos</h1>
        <div class="row">
            @forelse ($favoritos as $animal)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ asset($animal->imagen) }}" class="card-img-top" alt="{{ $animal->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $animal->nombre }}</h5>
                            <p class="card-text">{{ $animal->descripcion }}</p>
                            <a href="{{ route('animal.show', $animal->id) }}" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>No tienes animales favoritos todavía.</p>
            @endforelse
        </div>
    </div>
@endsection
