<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\StarshipController;
use App\Http\Controllers\API\PilotController;
use App\Http\Controllers\API\AuthController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// ESTOS METODOS CONTACTAN CON LOS METODOS DEL API CONTROLER STARSHIP

// METODOS PARA MANEJO DE NAVES
Route::prefix('starship')->group(function () {
    Route::get('/',[ StarshipController::class, 'getShip']);
    Route::get('/{id}/pilots',[ StarshipController::class, 'getShipPilots']);
    Route::post('/',[ StarshipController::class, 'create']);
    Route::delete('/{id}',[ StarshipController::class, 'delete']);
    Route::get('/{id}',[ StarshipController::class, 'get']);
    Route::put('/{id}',[ StarshipController::class, 'update']);
    
    Route::get('/{search_ship}',[ StarshipController::class, 'searchShip']);
});


//METODOS PARA MANEJO DE PILOTOS
Route::prefix('pilot')->group(function () {
    Route::get('/',[ PilotController::class, 'getPilot']);
    Route::post('/',[ PilotController::class, 'create']);
    Route::delete('/{id}',[ PilotController::class, 'delete']);
    Route::get('/{id}',[ PilotController::class, 'get']);
    Route::put('/{id}',[ PilotController::class, 'update']);
});


//METODOS PARA MANEJO DE PILOTOS ASOCIADOS A NAVES
Route::prefix('pilotShip')->group(function () {
    Route::get('/',[ StarshipController::class, 'getPilotShip']);
    Route::post('/',[ StarshipController::class, 'createPilotShip']);
    Route::delete('/{id}',[ StarshipController::class, 'deletePilotShip']);
});


Route::prefix('auth')->group(function () {
    Route::post('/login',[ AuthController::class, 'login']);
});