<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialeController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CiudadeController;
use App\Http\Controllers\ParametroDetalleController;
use App\Http\Controllers\AsociacioneController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'guest'], function () {
    Route::apiResource('materiales', MaterialeController::class);
    Route::get('getSelectParametro/{parametro_id}', [ParametroDetalleController::class, 'getSelectParametro']);
    Route::apiResource('proyectos', ProyectoController::class);
    Route::get('getSelectCiudad/{departamento_id}', [CiudadeController::class, 'getSelectCiudad']);
    Route::get('getAsociacionesByProyecto/{proyecto_id}', [AsociacioneController::class, 'getAsociacionesByProyecto']);
    Route::get('getSelectMaterial/{proyecto_id}', [MaterialeController::class, 'getSelectMaterial']);
    Route::apiResource('asociaciones', AsociacioneController::class);

});
