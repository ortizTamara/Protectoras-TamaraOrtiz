<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Color;
use App\Models\Especie;
use App\Models\EstadoAnimal;
use App\Models\GeneroAnimal;
use App\Models\NivelActividad;
use App\Models\Protectora;
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

          $faker = \Faker\Factory::create();

        $protectora1 = Protectora::where('nombre', 'Refugio Felino')->first();
        $protectora2 = Protectora::where('nombre', 'La Bienvenida')->first();

        if (!$protectora1 || !$protectora2) {
            $this->command->error('Las protectoras no se encontraron.');
            return;
        }

        $edad = rand(1, 20);

          for ($i = 0; $i < 10; $i++) {
              $isPerro = $i < 5;
              $especieId = $isPerro ? $especiePerroId : $especieGatoId;
              $imagen = $isPerro ? $imagenesPerros[$i] : $imagenesGatos[$i - 5];

              $razaId = Raza::where('especie_id', $especieId)->inRandomOrder()->first()?->id;

              $colorId = Color::inRandomOrder()->first()?->id;
              $generoId = GeneroAnimal::inRandomOrder()->first()?->id;
              $nivelActividadId = NivelActividad::inRandomOrder()->first()?->id;
              $estadoAnimalId = EstadoAnimal::inRandomOrder()->first()?->id;
              $protectoraId = rand(1, 2) == 1 ? $protectora1->id : $protectora2->id;
              // Crear un animal
              Animal::create([
                  'nombre' => $faker->firstName,
                  'descripcion' => $faker->text(200),
                  'fecha_nacimiento' => $faker->date('Y-m-d', "-$edad years"),
                  'peso' => $faker->randomFloat(2, 2.0, 40.0),
                  'imagen' => $imagen,
                  'genero_animal_id' => $generoId,
                  'nivel_actividad_id' => $nivelActividadId,
                  'color_id' => $colorId,
                  'especie_id' => $especieId,
                  'raza_id' => $razaId,
                  'estado_animal_id' => $estadoAnimalId,
                  'protectora_id' => $protectoraId,
                  'marcado_para_eliminar' => false,
              ]);
          }

          $this->command->info('Se crearon 10 animales (5 perros y 5 gatos) con imágenes reales.');

    }
}
