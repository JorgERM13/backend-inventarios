<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//CRUD usuarios

Route::get('/usuario', [UsuarioController::class, 'funListar']);
Route::post('/usuario', [UsuarioController::class, 'funGuardar']);
Route::get('/usuario/{id}', [UsuarioController::class, 'funMostrar']);
Route::put('/usuario/{id}', [UsuarioController::class, 'funActualizar']);
Route::delete('/usuario/{id}', [UsuarioController::class, 'funEliminar']);
