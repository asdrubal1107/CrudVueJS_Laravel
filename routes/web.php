<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratistasController;

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

Route::get('/', function () {
    return view('contratistas');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contratistas', [ContratistasController::class, 'index']); //Retorna la lista
Route::post('/contratistas/registrar', [ContratistasController::class, 'store']); //Buscamos el metodo store para insertar los datos
Route::put('/contratistas/actualizar',  [ContratistasController::class, 'update']); //Actualizamos los datos