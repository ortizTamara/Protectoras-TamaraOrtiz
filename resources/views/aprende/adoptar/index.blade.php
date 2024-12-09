@extends('layouts.app')

@section('content')
<div class="container mx-auto py-16 px-5">
    <h1 class="text-5xl font-bold tracking-tight mb-10 text-center">Antes de Adoptar una Mascota</h1>
    <p class="text-2xl mb-14 text-center text-muted">
        Consideraciones importantes antes de dar el paso de adoptar un nuevo miembro de la familia.
    </p>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <i class="bi bi-clock display-5 text-info"></i>
                        <h2 class="text-2xl mb-0">Tiempo y compromiso</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>¿Tienes tiempo para cuidar a una mascota diariamente?</li>
                        <li>¿Puedes comprometerte por toda la vida de la mascota?</li>
                        <li>¿Tu horario permite paseos regulares y tiempo de juego?</li>
                        <li>¿Quién cuidará de la mascota cuando estés de viaje?</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <i class="bi bi-currency-dollar display-5 text-success"></i>
                        <h2 class="text-2xl mb-0">Costos financieros</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>Alimento y suministros regulares.</li>
                        <li>Cuidados veterinarios y vacunas.</li>
                        <li>Posibles emergencias médicas.</li>
                        <li>Gastos de peluquería y cuidado dental.</li>
                        <li>Juguetes, camas y otros accesorios.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <i class="bi bi-house-door display-5 text-secondary"></i>
                        <h2 class="text-2xl mb-0">Espacio y entorno</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>¿Tu hogar tiene espacio suficiente?</li>
                        <li>¿Tienes un patio o acceso fácil a áreas de paseo?</li>
                        <li>¿Tu contrato de alquiler permite mascotas?</li>
                        <li>¿Necesitas hacer tu hogar a prueba de mascotas?</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <i class="bi bi-heart-fill display-5 text-danger"></i>
                        <h2 class="text-2xl mb-0">Compatibilidad</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>¿Qué tipo de mascota se adapta mejor a tu estilo de vida?</li>
                        <li>¿Tienes otras mascotas? ¿Cómo se llevarán?</li>
                        <li>¿Alguien en tu familia tiene alergias?</li>
                        <li>¿La personalidad de la mascota coincide con la tuya?</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body text-start">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <i class="bi bi-exclamation-triangle-fill display-5 text-warning"></i>
                        <h2 class="text-2xl mb-0">Responsabilidades</h2>
                    </div>
                    <ul class="ps-4 text-xl fs-5">
                        <li>Entrenamiento y socialización.</li>
                        <li>Ejercicio regular y estimulación mental.</li>
                        <li>Limpieza y mantenimiento del hogar.</li>
                        <li>Cumplimiento de leyes locales sobre mascotas.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="card h-100 shadow-lg">
            <div class="card-body text-start">
                <h2 class="text-3xl font-bold mb-4">Preguntas finales de reflexión</h2>
                <ul class="ps-4 text-xl fs-5">
                    <li class="mb-3">¿Estás preparado para los cambios en tu estilo de vida?</li>
                    <li class="mb-3">¿Has investigado sobre las necesidades específicas de la especie que quieres adoptar?</li>
                    <li class="mb-3">¿Has considerado adoptar de un refugio en lugar de comprar?</li>
                    <li class="mb-3">¿Toda tu familia está de acuerdo con la decisión de adoptar?</li>
                    <li>¿Estás listo para el compromiso a largo plazo que implica tener una mascota?</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <h2 class="text-4xl font-bold mb-8">Recuerda</h2>
        <p class="text-xl">
            Adoptar una mascota es una decisión importante que afectará tu vida durante muchos años.
            Tómate el tiempo necesario para reflexionar y asegurarte de que estás preparado para este compromiso.
        </p>
    </div>
</div>
@endsection
