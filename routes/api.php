<?php

use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('cities', CityController::class)->middleware('auth:sanctum');


require __DIR__.'/auth.php';