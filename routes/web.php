<?php

use App\Http\Controllers\AdminProtectoraController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ComportamientoController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\perfilProtectoraController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Utilizo GET para solicitudes de lectura, POST para crear y enviar datos, RESOURCE para crear, leer, actualizar y eliminar, PREFIX y NAME para organizar las rutas

// Rutas publicas (puede acceder todo el mundo)
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('contacto', [App\Http\Controllers\ContactoController::class, 'index'])->name('contacto');


// Rutas de autenticación (login)
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de Registro (registrarse)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Ruta para verificar el email
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check-email');


// Ruta para controlar provincias
Route::get('/provincias/{comunidadAutonomaId}', [ProvinciaController::class, 'getProvincias']);

// Rutas de perfil de usuario (cuando ya hemos hecho login)
Route::get('perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');
Route::post('perfil/change-password', [PerfilController::class, 'changePassword'])->name('changePassword');

// Ruta de perfil de protectora (Solo se muestra cuando el usuario es una protectora)
Route::resource('/perfil-protectora', PerfilProtectoraController::class);

// Ruta administrador
Route::get('administracion', [App\Http\Controllers\AdministradorController::class, 'index'])->name('administracion');

// Rutas carpeta Administrador
Route::resource('/color', ColorController::class);
Route::resource('/especie', EspecieController::class);
Route::resource('/raza', RazaController::class);
Route::resource('/comportamiento', ComportamientoController::class);
Route::prefix('administracion')->name('administracion.')->group(function () {
    Route::resource('protectora', AdminProtectoraController::class);
});

// Ruta para gestión de usuario
Route::resource('/usuario', UsuarioController::class);








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
