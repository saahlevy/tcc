<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DescriptionController;

// Rotas de usuários
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Rotas de produtos
Route::get('/produto', [ProductController::class, 'index'])->name('products.index');
Route::get('/produto/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/produto/create', [ProductController::class, 'create'])->name('products.create'); // Mantém /produto/create
Route::post('/produto', [ProductController::class, 'store'])->name('products.store');
Route::get('/produto/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/produto/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/produto/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Rotas de descrições
Route::get('/descriptions', [DescriptionController::class, 'index'])->name('descriptions.index');
Route::get('/descriptions/{description}', [DescriptionController::class, 'show'])->name('descriptions.show');
Route::get('/descriptions/create', [DescriptionController::class, 'create'])->name('descriptions.create');
Route::post('/descriptions', [DescriptionController::class, 'store'])->name('descriptions.store');
Route::get('/descriptions/{description}/edit', [DescriptionController::class, 'edit'])->name('descriptions.edit');
Route::put('/descriptions/{description}', [DescriptionController::class, 'update'])->name('descriptions.update');
Route::delete('/descriptions/{description}', [DescriptionController::class, 'destroy'])->name('descriptions.destroy');
