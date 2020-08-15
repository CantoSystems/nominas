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

Route::resource('empresas', 'EmpresaController');
Route::get('accciones', 'EmpresaController@acciones')->name('acciones');

//ejemlo
Route::get('/ejemplo', function() {
    return view('empresas.ejemplo');
});