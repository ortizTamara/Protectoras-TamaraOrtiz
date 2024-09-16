<?php

use App\Http\Controllers\AdminProtectoraController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ComportamientoController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\RazaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('administracion', [App\Http\Controllers\AdministradorController::class, 'index'])->name('administracion');
Route::get('contacto', [App\Http\Controllers\ContactoController::class, 'index'])->name('contacto');

Route::resource('/color', ColorController::class);
Route::resource('/especie', EspecieController::class);
Route::resource('/raza', RazaController::class);
Route::resource('/comportamiento', ComportamientoController::class);
Route::prefix('administracion')->name('administracion.')->group(function () {
    Route::resource('protectora', AdminProtectoraController::class);
});

Route::get('/provincias/{comunidad_id}', [RegisterController::class, 'getProvincias']);


// Route::get('color', [App\Http\Controllers\ColorController::class, 'index'])->name('color');
// Route::get('colorCreate', [App\Http\Controllers\ColorController::class, 'create'])->name('colorCreate');
// Route::get('colorEdit', [App\Http\Controllers\ColorController::class, 'edit'])->name('colorEdit');
// Route::get('colorDelete', [App\Http\Controllers\ColorController::class, 'destroy'])->name('colorDelete');
// Route::get('colorStore', [App\Http\Controllers\ColorController::class, 'store'])->name('colorStore');

Auth::routes();
