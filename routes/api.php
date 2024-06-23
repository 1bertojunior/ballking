<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('cities', CityController::class)->middleware('auth:sanctum');
Route::apiResource('states', StateController::class)->middleware('auth:sanctum');
Route::apiResource('addresses', AddressController::class)->middleware('auth:sanctum');
Route::apiResource('addresses', AddressController::class)->middleware('auth:sanctum');


require __DIR__.'/auth.php';