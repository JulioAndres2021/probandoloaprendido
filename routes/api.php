<?php

use App\Http\Controllers\Api\V1\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

    Route::prefix('v1')->group(function () {

    // Esto genera automáticamente todas las URLs anteriores con el prefijo /api/categorias
    Route::apiResource('categorias', CategoriaController::class)->middleware('throttle:6,1');

});