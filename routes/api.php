<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => ['api', 'cors'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'actions'
], function ($router) {
    Route::post('subirImagen', 'App\Http\Controllers\subirImagenController@imagen');
    Route::post('getDocumento', 'App\Http\Controllers\DocumentoController@descargarDocumentoMaestro');
    Route::post('descargarDocumento', 'App\Http\Controllers\DocumentoController@descargarDocumento');
    Route::post('imagenPerfil', 'App\Http\Controllers\ImagenPerfilController@subir');
});