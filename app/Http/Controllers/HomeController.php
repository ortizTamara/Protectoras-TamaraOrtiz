<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

        $query->when($request->filled('nombre'), function ($query) use ($request) {
            $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
        });
        // $query->when($request->filled('especie'), function ($query) use ($request) {
        //     $query->whereIn('especie_id', $request->input('especie'));
        // });

        $animales = $query->paginate(15);

        // Animal::whereHas('especie', function (Builder $query) {
        //     $query->where('nombre', 'Gato');
        // })->whereBetween('peso', [3, 10])->get()

        return view('home', [
            'animales' => $animales
        ]);
    }
}
