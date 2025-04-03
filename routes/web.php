<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\AboutController;

// Rotas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/recursos', [ResourceController::class, 'index'])->name('resources');
Route::get('/sobre', [AboutController::class, 'index'])->name('about');

// Rotas de autenticação (acessíveis apenas para visitantes)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    
    // Registro
    Route::get('/cadastro', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/cadastro', [RegisterController::class, 'register'])->name('register.submit');
});

// Rotas protegidas (acessíveis apenas para usuários autenticados)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});