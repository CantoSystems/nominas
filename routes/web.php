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

Route::get('home', 'HomeController@index');


Route::get('/segunda', function() {
    return view('home');
});

Route::delete('empresa/{id}', 'EmpresaController@destroy')->name('empresas.destroy');
Route::get('accciones', 'EmpresaController@acciones')->name('acciones');
Route::get('selecempresa','EmpresaController@seleccionarempresa')->name('seleccionarempresa');

Route::get('areas','AreasController@index')->name('areas.index');


//periodos
Route::get('periodos','PeriodosController@create')->name('periodos.create');



    
