<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/funcionarios/create','ControllerUsuario@registrarUsuario');
Route::post('/funcionarios/update','ControllerUsuario@alterarUsario');
Route::post('funcionarios/destroy','ControllerUsuario@excluirUsuario');
Route::get('/funcionarios/list','ControllerUsuario@getUsuariosGeral');
Route::get('/funcionarios/show/id','ControllerUsuario@getUsuarioID');
