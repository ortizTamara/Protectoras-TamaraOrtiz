<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Color;
use App\Models\Especie;
use App\Models\Raza;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = Animal::query();

        // Filtrar solo animales con protectoras válidas
        $query->whereHas('protectora', function ($q) {
            $q->where('esValido', true);
        });

        // Filtrar por nombre
        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        }

        // Filtrar por especie
        if ($request->filled('especie')) {
            $query->where('especie_id', $request->input('especie'));
        }

        // Filtrar por raza
        if ($request->filled('raza')) {
            $query->where('raza_id', $request->input('raza'));
        }

        // Filtrar por color
        if ($request->filled('edad') && $request->input('edad') !== null) {
            $edad = (int) $request->input('edad');

            // Calcular las fechas de inicio y fin del año para la edad seleccionada
            $fechaInicio = now()->subYears($edad)->startOfYear();
            $fechaFin = now()->subYears($edad)->endOfYear();

            $query->whereBetween('fecha_nacimiento', [$fechaInicio, $fechaFin]);
        } else {
            // Si no se selecciona ninguna edad, incluir todos los registros
            $query->whereNotNull('fecha_nacimiento');
        }

        // if ($request->filled('edad') && $request->input('edad') !== null) {
        //     $edad = (int) $request->input('edad');

        //     // Calcular las fechas de inicio y fin del año para la edad seleccionada
        //     $fechaInicio = now()->subYears($edad)->startOfYear(); // Inicio del año correspondiente
        //     $fechaFin = now()->subYears($edad)->endOfYear();      // Fin del año correspondiente

        //     $query->whereBetween('fecha_nacimiento', [$fechaInicio, $fechaFin]);
        // }

        // if ($request->filled('edad') && $request->input('edad') !== '') {
        //     $edad = (int) $request->input('edad');

        //     // Calcular las fechas de inicio y fin del año para la edad seleccionada
        //     $fechaInicio = now()->subYears($edad)->startOfYear();
        //     $fechaFin = now()->subYears($edad)->endOfYear();

        //     $query->whereBetween('fecha_nacimiento', [$fechaInicio, $fechaFin]);
        // }

        // Obtener la fecha de nacimiento más reciente y más antigua
        $minFechaNacimiento = Animal::min('fecha_nacimiento');
        $maxFechaNacimiento = Animal::max('fecha_nacimiento');

        // Filtrar por tamaño
        if ($request->filled('tamanio')) {
            $tamanios = $request->input('tamanio');
            $query->where(function ($q) use ($tamanios) {
                if (in_array('pequeno', $tamanios)) {
                    $q->orWhere('peso', '<', 5);
                }
                if (in_array('mediano', $tamanios)) {
                    $q->orWhereBetween('peso', [5, 10]);
                }
                if (in_array('grande', $tamanios)) {
                    $q->orWhere('peso', '>', 20);
                }
            });
        }

        if ($request->filled('orden')) {
            switch ($request->input('orden')) {
                case 'nuevo':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'edad_asc':
                    $query->orderByRaw('YEAR(CURDATE()) - YEAR(fecha_nacimiento) ASC');
                    break;
                case 'edad_desc':
                    $query->orderByRaw('YEAR(CURDATE()) - YEAR(fecha_nacimiento) DESC');
                    break;
            }
        }


        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->input('buscar') . '%');
        }

        // Obtener los datos paginados
        $animales = $query->paginate(15);

        $animales = $query->get()->map(function ($animal) {
            $animal->imagen = $animal->imagen ? 'storage/' . $animal->imagen : 'imagenes/placeholder.jpg';
            return $animal;
        });

        $especies = Especie::all();
        $razas = Raza::all();
        $colores = Color::all();
        return view('home', compact('animales', 'especies', 'razas', 'colores', 'minFechaNacimiento', 'maxFechaNacimiento'));


    //     return view('home', [
    //         'animales' => $animales,
    //         'especies' => $especies,
    //         'razas' => $razas,
    //         'colores' => $colores,
    //     ]);
    }
}
