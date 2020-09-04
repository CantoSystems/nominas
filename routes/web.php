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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');


Route::delete('empresa/{id}', 'EmpresaController@destroy')->name('empresas.destroy');
Route::get('accciones', 'EmpresaController@acciones')->name('acciones');
Route::get('selecempresa','EmpresaController@seleccionarempresa')->name('seleccionarempresa');

//areas
Route::get('areas','AreasController@index')->name('areas.index');
Route::delete('areas/{id}', 'AreasController@eliminararea')->name('areas.eliminaarea');


//periodos
Route::get('/periodos','PeriodosController@index')->name('periodos.index');
Route::post('/agregarperiodos','PeriodosController@agregarperiodos')->name('agregarperiodos');
Route::get('/seleccionarperiodo','PeriodosController@seleccionarperiodo')->name('seleccionarperiodo');
Route::get('/periodos','PeriodosController@index')->name('periodos.index');
Route::get('/accionesperiodos','PeriodosController@acciones')->name('periodos.acciones');
Route::delete('accionesperiodos/{id}', 'PeriodosController@eliminarperiodo')->name('periodos.eliminarperiodo');


//puestos 
Route::get('puestos','PuestosController@index')->name('puestos.index');
Route::delete('puestos/{id}','PuestosController@eliminarpuestos')->name('puestos.eliminapuesto');

//departamentos
Route::get('/departamentos','DepartamentosController@index')->name('departamentos.index');
Route::delete('departamentos/{id}', 'DepartamentosController@eliminardepartamento')->name('departamentos.eliminadepartamento');


//Bancos

Route::get('bancos','BancosController@accionesban')->name('accionesban');