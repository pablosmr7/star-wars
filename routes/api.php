<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\StarshipController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// ESTOS METODOS CONTACTAN CON LOS METODOS DEL API CONTROLER STARSHIP
// METODOS PARA MANEJO DE NAVES
Route::prefix('starship')->group(function () {
    Route::get('/',[ StarshipController::class, 'getShip']);
    Route::get('/{id}/pilots',[ StarshipController::class, 'getShipPilots']);
    Route::post('/',[ StarshipController::class, 'create']);
    Route::delete('/{id}',[ StarshipController::class, 'delete']);
    Route::get('/{id}',[ StarshipController::class, 'get']);
    Route::put('/{id}',[ StarshipController::class, 'update']);
});


//METODOS PARA MANEJO DE PILOTOS
Route::prefix('pilot')->group(function () {
    Route::get('/',[ StarshipController::class, 'getPilot']);
    Route::post('/',[ StarshipController::class, 'create']);
    Route::delete('/{id}',[ StarshipController::class, 'delete']);
});


//METODOS PARA MANEJO DE PILOTOS ASOCIADOS A NAVES
Route::prefix('pilotShip')->group(function () {
    Route::get('/',[ StarshipController::class, 'getPilotShip']);
    Route::post('/',[ StarshipController::class, 'createPilotShip']);
    Route::delete('/{id}',[ StarshipController::class, 'deletePilotShip']);
});
