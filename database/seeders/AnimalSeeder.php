<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Color;
use App\Models\Especie;
use App\Models\EstadoAnimal;
use App\Models\GeneroAnimal;
use App\Models\NivelActividad;
use App\Models\Raza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Define IDs de las especies para perros y gatos
          $especiePerroId = Especie::where('nombre', 'Perro')->first()?->id;
          $especieGatoId = Especie::where('nombre', 'Gato')->first()?->id;

          if (!$especiePerroId || !$especieGatoId) {
              $this->command->error("Las especies 'Perro' y 'Gato' deben existir en la tabla de especies.");
              return;
          }

          // Configurar imágenes reales
          $imagenesPerros = [
              'animales-temporales/perro1.jpg',
              'animales-temporales/perro2.jpg',
              'animales-temporales/perro3.jpg',
              'animales-temporales/perro4.jpg',
              'animales-temporales/perro5.jpg',
          ];

          $imagenesGatos = [
              'animales-temporales/gato1.jpg',
              'animales-temporales/gato2.jpg',
              'animales-temporales/gato3.jpg',
              'animales-temporales/gato4.jpg',
              'animales-temporales/gato5.jpg',
          ];

          // Configurar Faker
          $faker = \Faker\Factory::create();

          // Crear 10 animales (5 perros y 5 gatos)
          for ($i = 0; $i < 10; $i++) {
              $isPerro = $i < 5; // Los primeros 5 serán perros
              $especieId = $isPerro ? $especiePerroId : $especieGatoId;
              $imagen = $isPerro ? $imagenesPerros[$i] : $imagenesGatos[$i - 5];

              // Obtener una raza aleatoria para la especie
              $razaId = Raza::where('especie_id', $especieId)->inRandomOrder()->first()?->id;

              // Obtener un color, género, nivel de actividad y estado aleatorio
              $colorId = Color::inRandomOrder()->first()?->id;
              $generoId = GeneroAnimal::inRandomOrder()->first()?->id;
              $nivelActividadId = NivelActividad::inRandomOrder()->first()?->id;
              $estadoAnimalId = EstadoAnimal::inRandomOrder()->first()?->id;

              // Crear un animal
              Animal::create([
                  'nombre' => $faker->firstName,
                  'descripcion' => $faker->text(200),
                  'fecha_nacimiento' => $faker->date('Y-m-d', '-2 years'),
                  'peso' => $faker->randomFloat(2, 2.0, 40.0), // Entre 2kg y 40kg
                  'imagen' => $imagen, // Usar la imagen real
                  'genero_animal_id' => $generoId,
                  'nivel_actividad_id' => $nivelActividadId,
                  'color_id' => $colorId,
                  'especie_id' => $especieId,
                  'raza_id' => $razaId,
                  'estado_animal_id' => $estadoAnimalId,
                  'protectora_id' => 1,
                  'marcado_para_eliminar' => false,
              ]);
          }

          $this->command->info('Se crearon 10 animales (5 perros y 5 gatos) con imágenes reales.');

    }
}
