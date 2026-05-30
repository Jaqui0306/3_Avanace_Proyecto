<?php

use App\Http\Controllers\EmocionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FraseFavoritaController;

Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('sesion')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/emociones', [EmocionController::class, 'index']);
    Route::post('/emociones', [EmocionController::class, 'store']);
    Route::delete('/emociones/{id}', [EmocionController::class, 'destroy'])->name('emociones.destroy');
    Route::get('/frases-favoritas', [FraseFavoritaController::class, 'index']);
    Route::post('/frases-favoritas', [FraseFavoritaController::class, 'store']);
    Route::delete('/frases-favoritas/{id}', [FraseFavoritaController::class, 'destroy']);
    Route::put('/perfil/actualizar', [PerfilController::class, 'actualizar'])->name('perfil.actualizar');
});