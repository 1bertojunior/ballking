<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ChampionshipController;
use App\Http\Controllers\ChampionshipEditionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamEditionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('cities', CityController::class)->middleware('auth:sanctum');
Route::apiResource('states', StateController::class)->middleware('auth:sanctum');
Route::apiResource('addresses', AddressController::class)->middleware('auth:sanctum');
Route::apiResource('championships', ChampionshipController::class)->middleware('auth:sanctum');
Route::apiResource('championship-editions', ChampionshipEditionController::class)->middleware('auth:sanctum');
Route::apiResource('positions', PositionController::class)->middleware('auth:sanctum');
Route::apiResource('teams', TeamController::class)->middleware('auth:sanctum');
Route::apiResource('team-editions', TeamEditionController::class)->middleware('auth:sanctum');


require __DIR__.'/auth.php';