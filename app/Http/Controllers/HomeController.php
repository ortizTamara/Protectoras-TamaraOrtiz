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

        $query->whereHas('protectora', function ($q) {
            $q->where('esValido', true);
        });

        // Filtración por nombre
        $query->when($request->filled('nombre'), function ($query) use ($request) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        });

        // Filtración por especie
        $query->when($request->filled('especie'), function ($query) use ($request) {
            $query->whereIn('especie_id', $request->input('especie'));
        });

        // Filtración por raza
        $query->when($request->filled('raza'), function ($query) use ($request) {
            $query->where('raza_id', $request->input('raza'));
        });

        // Filtración por color
        $query->when($request->filled('color'), function ($query) use ($request) {
            $query->where('color_id', $request->input('color'));
        });

        $query->when($request->filled('tamanio'), function ($query) use ($request) {
            $sizes = $request->input('tamanio');
            if (in_array('small', $sizes)) {
                $query->where('peso', '<', 5);
            }
            if (in_array('medium', $sizes)) {
                $query->whereBetween('peso', [5, 10]);
            }
            if (in_array('large', $sizes)) {
                $query->where('peso', '>', 10);
            }
        });

        $query->when($request->filled('edad'), function ($query) use ($request) {
            $age = $request->input('edad');
            $query->whereYear('fecha_nacimiento', '>=', now()->subYears($age)->year);
        });

        if ($request->has('sort_age')) {
            $query->orderBy('fecha_nacimiento', $request->input('sort_age') == 'age_asc' ? 'asc' : 'desc');
        }

        $animales = $query->paginate(15);

        // Animal::whereHas('especie', function (Builder $query) {
        //     $query->where('nombre', 'Gato');
        // })->whereBetween('peso', [3, 10])->get()

        $animales = $query->get()->map(function ($animal) {
            $animal->imagen = $animal->imagen ? 'storage/' . $animal->imagen : 'imagenes/placeholder.jpg';
            return $animal;
        });

        $especies = Especie::all();
        $razas = Raza::all();
        $colores = Color::all();


        return view('home', [
            'animales' => $animales,
            'especies' => $especies,
            'razas' => $razas,
            'colores' => $colores,
        ]);
    }
}
