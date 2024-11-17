<?php

use App\Http\Controllers\AdminProtectoraController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ComportamientoController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\UsuarioController;
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
Route::resource('/usuario', UsuarioController::class);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');
Route::post('perfil/change-password', [PerfilController::class, 'changePassword'])->name('changePassword');





// PARA VERIFICAR SI SE HA CREADO CORRECTAMENTE
// Route::get('/verificar-admin', function () {
//     $admin = App\Models\Usuario::where('email', 'admin@example.com')->first();
//     if ($admin) {
//         return response()->json([
//             'nombre' => $admin->nombre,
//             'rol_id' => $admin->rol_id,
//             'email' => $admin->email
//         ]);
//     } else {
//         return "No se encontró el usuario administrador.";
//     }
// });
// Route::get('color', [App\Http\Controllers\ColorController::class, 'index'])->name('color');
// Route::get('colorCreate', [App\Http\Controllers\ColorController::class, 'create'])->name('colorCreate');
// Route::get('colorEdit', [App\Http\Controllers\ColorController::class, 'edit'])->name('colorEdit');
// Route::get('colorDelete', [App\Http\Controllers\ColorController::class, 'destroy'])->name('colorDelete');
// Route::get('colorStore', [App\Http\Controllers\ColorController::class, 'store'])->name('colorStore');

Auth::routes();
