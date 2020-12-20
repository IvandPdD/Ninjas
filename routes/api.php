<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NinjaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MisionController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\UserController;

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

Route::prefix('ninjas')->group(function () {
	Route::post('/alta',[NinjaController::class,"altaNinja"]);
	Route::post('/baja/{id}',[NinjaController::class,"bajaNinja"]);
	Route::get('/ver/{id}/',[NinjaController::class,"verNinja"]);
	Route::get('/',[NinjaController::class,"listaNinjas"]);
	Route::get('/filtro',[NinjaController::class,"filtroNinja"]);
});

Route::prefix('clientes')->group(function () {
	Route::post('/alta',[ClienteController::class,"altaCliente"]);
	Route::post('/editar/{id}',[ClienteController::class,"editarCliente"]);
	Route::get('/ver/{id}',[ClienteController::class,"verCliente"]);
	Route::get('/',[ClienteController::class,"listaClientes"]);
});

Route::prefix('misiones')->group(function () {
	Route::post('/encargo/',[MisionController::class,"realizarEncargo"]);
	Route::post('/editar/{id}',[MisionController::class,"editarMision"]);
	Route::get('/',[MisionController::class,"listaMisiones"]);
	Route::get('/ver/{id}',[MisionController::class,"verMision"]);
	Route::get('/filtro',[MisionController::class,"filtroMision"]);
});

Route::prefix('asignar')->group(function () {
	Route::post('/',[AsignacionController::class,"asignar"]);
});

Route::prefix('usuarios')->group(function () {
	Route::post('/registrar',[UserController::class,"register"]);
	Route::post('/login',[UserController::class,"login"]);
});
