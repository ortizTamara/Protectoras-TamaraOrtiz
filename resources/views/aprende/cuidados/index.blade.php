@extends('layouts.app')

@section('content')
<div class="container mx-auto py-16 px-5">
    <h1 class="text-5xl font-bold tracking-tight mb-10 text-center">Cuidados Básicos para tu Mascota</h1>
    <p class="text-2xl text-center mb-14 text-muted">
        Guía esencial para mantener a tu mascota feliz y saludable.
    </p>

    <div class="row row-cols-1 row-cols-md-2 g-5">
        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-basket2 display-5 text-primary"></i>
                        <h2 class="h4 mb-0">Alimentación</h2>
                    </div>
                    <ul class="list-disc ps-4 text-start fs-5">
                        <li>Proporciona alimento de calidad adecuado para su edad y especie.</li>
                        <li>Establece horarios regulares de alimentación.</li>
                        <li>Mantén siempre agua fresca y limpia disponible.</li>
                        <li>Evita darle alimentos humanos que puedan ser dañinos.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-heart-fill display-5 text-danger"></i>
                        <h2 class="h4 mb-0">Salud</h2>
                    </div>
                    <ul class="list-disc ps-4 text-start fs-5">
                        <li>Realiza chequeos veterinarios regulares.</li>
                        <li>Mantén al día las vacunas y desparasitaciones.</li>
                        <li>Observa cambios en el comportamiento o apetito.</li>
                        <li>Cepilla los dientes regularmente (si aplica).</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-scissors display-5 text-secondary"></i>
                        <h2 class="h4 mb-0">Cuidado del pelaje</h2>
                    </div>
                    <ul class="list-disc ps-4 text-start fs-5">
                        <li>Cepilla el pelaje regularmente para evitar nudos.</li>
                        <li>Baña a tu mascota cuando sea necesario.</li>
                        <li>Mantén las uñas recortadas a una longitud adecuada.</li>
                        <li>Limpia las orejas con cuidado para prevenir infecciones.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 shadow-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <i class="bi bi-droplet display-5 text-info"></i>
                        <h2 class="h4 mb-0">Higiene</h2>
                    </div>
                    <ul class="list-disc ps-4 text-start fs-5">
                        <li>Limpia regularmente los recipientes de comida y agua.</li>
                        <li>Mantén limpia el área de descanso de tu mascota.</li>
                        <li>Cambia con frecuencia la arena del gato o limpia el área de eliminación.</li>
                        <li>Lava las mantas y juguetes periódicamente.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Recuerda</h2>
        <p class="text-xl">
            Cada mascota es única y puede requerir cuidados específicos. Consulta siempre con un veterinario para obtener consejos personalizados para tu mascota.
        </p>
    </div>
</div>
@endsection
