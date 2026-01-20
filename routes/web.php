<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AuthController; // ¡Importante importar esto!

// --- RUTAS PÚBLICAS (Cualquiera entra) ---
Route::get('/', function () { return view('welcome'); })->name('inicio');

// Rutas de Autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTAS PRIVADAS (Solo usuarios logueados) ---
// El 'middleware' actúa como un guardia de seguridad
Route::middleware(['auth'])->group(function () {
    
    // Aquí dentro va todo lo que quieres proteger
    Route::resource('tareas', TareaController::class);
    Route::resource('categorias', CategoriaController::class);

});