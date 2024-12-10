<?php

use App\Http\Controllers\AdminConsultaController;
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
use App\Http\Controllers\UsuarioAnimalFavoritoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VisitaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Utilizo GET para solicitudes de lectura, POST para crear y enviar datos, RESOURCE para crear, leer, actualizar y eliminar, PREFIX y NAME para organizar las rutas

// Rutas publicas (puede acceder todo el mundo)
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('contacto', [ConsultaController::class, 'index'])->name('contacto');


Route::resource('/consulta', ConsultaController::class)->parameters([
    'consulta' => 'consulta'
]);


// Rutas de autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de Registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Ruta para verificar el email
Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check-email');


// Ruta para controlar provincias
Route::get('/provincias/{comunidadAutonomaId}', [ProvinciaController::class, 'getProvincias']);

// Rutas de perfil de usuario (cuando ya hemos hecho login)
Route::get('perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');
Route::post('perfil/change-password', [PerfilController::class, 'changePassword'])->name('changePassword');

// Hacemos un grupo de rutas relacionaas con Perfil Protectora, Mis Protectoras y Mis favoritos para organizar
Route::prefix('perfil')->group(function () {
    // CREAR ANIMAL
    Route::get('protectoras/animales/create/{protectora_id}', [AnimalController::class, 'create'])->name('animal.create');
    Route::post('protectoras/animales', [AnimalController::class, 'store'])->name('animal.store');
    Route::get('protectoras/animales', [AnimalController::class, 'index'])->name('animal.index');
    Route::delete('protectoras/animales/{animal}', [AnimalController::class, 'destroy'])->name('animal.destroy');
    Route::get('protectoras/animales/{id}', [AnimalController::class, 'show'])->name('animal.show');
    Route::get('protectoras/animales/{animal}/edit', [AnimalController::class, 'edit'])->name('animal.edit');
    Route::put('protectoras/animales/{animal}', [AnimalController::class, 'update'])->name('animal.update');

    // PERFIL PROTECTORA
    Route::resource('perfil-protectora', PerfilProtectoraController::class);

    // MIS PROTECTORAS
    Route::resource('perfil-miProtectora', MiProtectoraController::class);

    Route::resource('animal-temporal', AnimalTemporalController::class);

    // FAVORITOS
    Route::get('/favoritos', [UsuarioAnimalFavoritoController::class, 'index'])->name('favoritos');
});
Route::post('/favoritos/{animal}', [UsuarioAnimalFavoritoController::class, 'store'])->name('favoritos.store');
Route::delete('/favoritos/{animal}', [UsuarioAnimalFavoritoController::class, 'destroy'])->name('favoritos.destroy');


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
    // Route::get('/consultas', [AdminConsultaController::class, 'index'])->name('consultasAdmin.index');
    Route::get('/consultas', [AdminConsultaController::class, 'index'])->name('consultas.index');
    Route::patch('/consultas/{id}/leido', [AdminConsultaController::class, 'leido'])->name('consultas.leido');

});

// Ruta para gestión de usuario
Route::resource('/usuario', UsuarioController::class);

// Dos formas de hacerlo para la ruta ProtectoraController
Route::get('/protectoras', [ProtectoraController::class, 'index'])->name('protectoras');

// Ruta para poder obtener las razas
Route::get('/especies/{especie}/razas', [RazaController::class, 'getRazasPorEspecie']);
Route::get('/razas/{especieId?}', [RazaController::class, 'getRazas']);

Route::get('/aprende/adoptar', function () {
    return view('aprende.adoptar.index');
})->name('aprende.adoptar');

Route::get('/aprende/cuidados', function () {
    return view('aprende.cuidados.index');
})->name('aprende.cuidados');

Route::get('/aprende/viviendo', function () {
    return view('aprende.viviendo.index');
})->name('aprende.viviendo');

Route::post('/visitas', [VisitaController::class, 'store'])->name('visitas.store');
Route::get('/visitas', [VisitaController::class, 'index'])->name('visitas.index');
Route::patch('/visitas/{id}/aceptar', [VisitaController::class, 'aceptar'])->name('visitas.aceptar');
Route::patch('/visitas/{id}/rechazar', [VisitaController::class, 'rechazar'])->name('visitas.rechazar');

Auth::routes();
// Rutas para recuperar contraseñas
Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
