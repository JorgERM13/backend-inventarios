<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




//Auth

Route::prefix('/v1/auth')->group(function(){

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function(){

        Route::get("/profile", [AuthController::class, "profile"]);
        Route::post("/logout", [AuthController::class, "logout"]);
    });
});

Route::middleware('auth:sanctum')->group(function(){


//CRUD usuarios

Route::get('/usuario', [UsuarioController::class, 'funListar']);
Route::post('/usuario', [UsuarioController::class, 'funGuardar']);
Route::get('/usuario/{id}', [UsuarioController::class, 'funMostrar']);
Route::put('/usuario/{id}', [UsuarioController::class, 'funActualizar']);
Route::delete('/usuario/{id}', [UsuarioController::class, 'funEliminar']);

});



