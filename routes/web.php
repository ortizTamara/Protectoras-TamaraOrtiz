<?php

use App\Http\Controllers\AdminProtectoraController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalTemporalController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ComportamientoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\EstadoAnimalController;
use App\Http\Controllers\MiProtectoraController;
use App\Http\Controllers\OpcionConsultaController;
use App\Http\Controllers\OpcionEntregaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PerfilProtectoraController;
use App\Http\Controllers\ProtectoraController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\RazaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Utilizo GET para solicitudes de lectura, POST para crear y enviar datos, RESOURCE para crear, leer, actualizar y eliminar, PREFIX y NAME para organizar las rutas

// Rutas publicas (puede acceder todo el mundo)
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('contacto', [App\Http\Controllers\ContactoController::class, 'index'])->name('contacto');


// Route::resource('consulta', ConsultaController::class);
Route::resource('/consulta', ConsultaController::class)->parameters([
    'consulta' => 'consulta'
]);


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

// Hacemos un grupo de rutas relacionaas con Perfil Protectora y Mis Protectoras para organizar
Route::prefix('perfil')->group(function () {
    // CREAR ANIMAL
    Route::get('protectoras/animales/create/{protectora_id}', [AnimalController::class, 'create'])->name('animal.create');
    Route::post('protectoras/animales', [AnimalController::class, 'store'])->name('animal.store');
    Route::get('protectoras/animales', [AnimalController::class, 'index'])->name('animal.index');
    Route::delete('protectoras/animales/{animal}', [AnimalController::class, 'destroy'])->name('animal.destroy');
    Route::get('protectoras/animales/{id}', [AnimalController::class, 'show'])->name('animal.show');

    // PERFIL PROTECTORA
    Route::resource('perfil-protectora', PerfilProtectoraController::class);

    // MIS PROTECTORAS
    Route::resource('perfil-miProtectora', MiProtectoraController::class);

    Route::resource('animal-temporal', AnimalTemporalController::class);

});






// // Ruta de perfil de protectora (Solo se muestra cuando el usuario es una protectora)
// Route::resource('/perfil-protectora', PerfilProtectoraController::class);
// // Mis protectoras (solo se muestra si el usuario es una protectora)
// Route::resource('/perfil-miProtectora', MiProtectoraController::class);

// Para la foto de perfil
Route::post('/updateFoto', [UsuarioController::class, 'updateFoto'])->name('updateFoto');
Route::delete('/deleteFoto', [UsuarioController::class, 'deleteFoto'])->name('deleteFoto');
// y logo de protectora
Route::post('/updateLogo', [PerfilProtectoraController::class, 'updateLogo'])->name('updateLogo');
Route::delete('/deleteLogo', [PerfilProtectoraController::class, 'deleteLogo'])->name('deleteLogo');

// Ruta administrador
Route::get('administracion', [App\Http\Controllers\AdministradorController::class, 'index'])->name('administracion');

// Rutas carpeta Administrador
Route::resource('/color', ColorController::class);
Route::resource('/especie', EspecieController::class);
Route::resource('/raza', RazaController::class);
Route::resource('/comportamiento', ComportamientoController::class);
Route::resource('/estadoAnimal', EstadoAnimalController::class);
Route::resource('/opcionEntrega', OpcionEntregaController::class);
Route::resource('/opcionConsulta', OpcionConsultaController::class)->parameters([
    'opcionConsulta' => 'opcionConsulta'
]); // php artisan route:list, se me guardo opcionConsulta como opcionConsultum, hacemos que sea opcionConsulta
Route::prefix('administracion')->name('administracion.')->group(function () {
    Route::resource('protectora', AdminProtectoraController::class);
    Route::patch('protectora/{id}/validar', [AdminProtectoraController::class, 'validar'])->name('protectora.validar');
});

// Ruta para gestión de usuario
Route::resource('/usuario', UsuarioController::class);

// Dos formas de hacerlo para la ruta ProtectoraController
Route::get('/protectoras', [ProtectoraController::class, 'index'])->name('protectoras');
// Route::get('protectoras', [App\Http\Controllers\ProtectoraController::class, 'index'])->name('protectoras');

// Ruta para poder obtener las razas
Route::get('/especies/{especie}/razas', [RazaController::class, 'getRazasPorEspecie']);


Auth::routes();
