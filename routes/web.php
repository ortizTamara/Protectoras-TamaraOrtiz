<?php

use App\Http\Controllers\ColorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('administracion', [App\Http\Controllers\AdministradorController::class, 'index'])->name('administracion');

Route::resource('/color', ColorController::class);
// Route::get('color', [App\Http\Controllers\ColorController::class, 'index'])->name('color');
// Route::get('colorCreate', [App\Http\Controllers\ColorController::class, 'create'])->name('colorCreate');
// Route::get('colorEdit', [App\Http\Controllers\ColorController::class, 'edit'])->name('colorEdit');
// Route::get('colorDelete', [App\Http\Controllers\ColorController::class, 'destroy'])->name('colorDelete');
// Route::get('colorStore', [App\Http\Controllers\ColorController::class, 'store'])->name('colorStore');

Auth::routes();
