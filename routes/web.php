<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/tareas', [TodosController::class, 'index'])->name('todos');

// AQUI ESPECIFICAMOS NUESTRA RUTA QUE CONTROLADOR VA A TENER Y QUE METODO VA A USAR
// ESTO LO DEBEMOS PONER DENTRO DE [] Y INDICAR PRIMERO EL CONTROLLER Y LUEGO LA ACTION
// ADEMAS ESTA RUTA ES DE TIPO POST POR LO QUE SERA UNA PETICION
Route::post('/tareas', [TodosController::class, 'store'])->name('enviar');

//RUTA PARA ACTUALIZAR UN TODO
Route::get('/tareas/{id}', [TodosController::class, 'show'])->name('todos-show');

Route::patch('/tareas/{id}', [TodosController::class, 'update'])->name('todos-update');

//RUTA PARA ELIMINAR UN TODO
Route::delete('/tareas/{id}', [TodosController::class, 'destroy'])->name('todos-destroy');

Route::resource('categories', CategoriesController::class);
