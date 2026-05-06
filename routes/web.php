<?php

use App\Http\Controllers\EmocionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;

Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/emociones', [EmocionController::class, 'index']);
Route::post('/emociones', [EmocionController::class, 'store']);
Route::delete('/emociones/{id}', [EmocionController::class, 'destroy'])->name('emociones.destroy');

Route::put('/perfil/actualizar', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');