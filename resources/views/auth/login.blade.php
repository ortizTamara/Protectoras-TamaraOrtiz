@extends('layouts.app')

@section('content')
    <div class="login-container d-flex align-items-center justify-content-center py-5">
        <div class="card login-card shadow-sm">
            <div class="card-header card-header-transparent d-flex flex-column">
                <div class="d-flex justify-content-start">
                    <a href="{{ route('home') }}" class="btn p-1 text-decoration-none">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center">
                <div class="d-flex align-items-center justify-content-center mb-4">
                    <h4 class="text-center fw-semibold mb-0">Iniciar Sesión</h4>
                </div>
            </div>
            <div class="full-width-line"></div>

            <form method="POST" action="{{ route('login') }}" class="p-4">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-primary">¿Olvidaste tu contraseña?</a>
                </div>
                <button type="submit" class="btn btn-secondary w-100">Iniciar Sesión</button>
            </form>
        </div>
    </div>
@endsection
