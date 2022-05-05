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

//Rutas llamada API
Route::prefix('starship')->group(function () {
    Route::get('/',[ StarshipController::class, 'getAll']);
    Route::post('/',[ StarshipController::class, 'create']);
    Route::delete('/{id}',[ StarshipController::class, 'delete']);
    Route::get('/{id}',[ StarshipController::class, 'get']);
    Route::put('/{id}',[ StarshipController::class, 'update']);
});