@extends('layouts.app')

@section('content')
<div class="container mx-auto py-16 px-5">
    <h1 class="text-5xl font-bold tracking-tight mb-10 text-center">Viviendo con tu Mascota</h1>
    <p class="text-2xl mb-14 text-center text-muted">
        Consejos para una convivencia feliz y armoniosa con tu nuevo compañero
    </p>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-calendar-check display-5 text-info"></i>
                        <h2 class="text-2xl mb-0">Rutina diaria</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>Establece horarios regulares para comidas y paseos</li>
                        <li>Dedica tiempo diario para jugar y hacer ejercicio</li>
                        <li>Mantén consistencia en las reglas y límites</li>
                        <li>Crea un espacio tranquilo para el descanso de tu mascota</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-emoji-smile display-5 text-warning"></i>
                        <h2 class="text-2xl mb-0">Enriquecimiento</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>Proporciona juguetes apropiados para su especie</li>
                        <li>Rota los juguetes para mantener el interés</li>
                        <li>Considera puzles de comida para estimulación mental</li>
                        <li>Dedica tiempo a sesiones de entrenamiento y trucos</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-shield-lock display-5 text-danger"></i>
                        <h2 class="text-2xl mb-0">Seguridad en casa</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>Asegura ventanas y balcones para evitar caídas</li>
                        <li>Guarda productos tóxicos y medicamentos fuera de alcance</li>
                        <li>Cubre cables eléctricos y elimina plantas peligrosas</li>
                        <li>Mantén cerradas las puertas de electrodomésticos</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-book display-5 text-primary"></i>
                        <h2 class="text-2xl mb-0">Educación continua</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>Refuerza el entrenamiento básico regularmente</li>
                        <li>Socializa a tu mascota con personas y otros animales</li>
                        <li>Aprende sobre el lenguaje corporal de tu mascota</li>
                        <li>Considera clases de obediencia o deportes caninos</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-people display-5 text-success"></i>
                        <h2 class="text-2xl mb-0">Integración familiar</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>Involucra a todos los miembros en el cuidado</li>
                        <li>Establece reglas claras para la interacción con niños</li>
                        <li>Crea momentos de unión familiar con tu mascota</li>
                        <li>Respeta el espacio y tiempo de descanso de tu mascota</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="card h-100 shadow-lg">
            <div class="card-body text-start">
                <h2 class="text-3xl font-bold mb-3">Consejos adicionales</h2>
                <ul class="ps-4 text-xl fs-5">
                    <li>Mantén actualizadas las vacunas y revisiones veterinarias</li>
                    <li>Observa cambios en el comportamiento o salud de tu mascota</li>
                    <li>Adapta la dieta y ejercicio según la edad de tu mascota</li>
                    <li>Considera un seguro de mascotas para emergencias</li>
                    <li>Mantén la identificación y microchip actualizados</li>
                    <li>Prepara un plan para emergencias o viajes</li>
                    <li>Celebra los logros y momentos especiales con tu mascota</li>
                    <li>Toma fotos y crea recuerdos de tu vida juntos</li>
                    <li>Únete a grupos locales de dueños de mascotas para socializar</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <h2 class="text-4xl font-bold mb-8">Recuerda</h2>
        <p class="text-xl">
            Cada mascota es única y la convivencia puede tener sus desafíos.
            Con paciencia, amor y consistencia, construirás una relación duradera y gratificante con tu compañero peludo.
        </p>
    </div>
</div>
@endsection
