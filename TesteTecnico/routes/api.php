<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    
    Route::post('/funcionarios/create','ControllerUsuario@registrarUsuario');
    Route::post('/funcionarios/update','ControllerUsuario@alterarUsario');
    Route::post('funcionarios/destroy','ControllerUsuario@excluirUsuario');
    Route::get('/funcionarios/list','ControllerUsuario@getUsuariosGeral');
    Route::get('/funcionarios/show/id','ControllerUsuario@getUsuarioID');
});
