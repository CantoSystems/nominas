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

/**
    *Peticiones http Delete | Get
    *Eliminación de la empresa
    *Vaciado de ls empresas
    *Vaciado y control de las acciones de los registros CRUD | Botones 
    *@version V1
    *@return Controlador | Método
    *@author Elizabeth
    *@param id | función Destroy
*/
//empresas
Route::delete('empresa/{id}', 'EmpresaController@destroy')->name('empresas.destroy');
Route::get('accciones', 'EmpresaController@acciones')->name('nominas.empresas');
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


/**
    *Peticiones http Delete | Get
    *Eliminación de la bancos @eliminarbanco
    *Vaciado de los registros de bancos
    *Vaciado y control de las acciones de los registros CRUD | Botones 
    *@version V1
    *@return Controlador | Método
    *@author Gustavo | Elizabeth
    *@param id | función Destroy
*/
Route::get('bancos','BancosController@acciones')->name('bancos.acciones');
Route::delete('bancos/{id}','BancosController@eliminarbanco')->name('bancos.eliminar');

/**
    *Peticiones http Delete | Get
    *Eliminación de la bancos @destroy
    *Vaciado de los registros de bancos
    *Vaciado y control de las acciones de los registros CRUD | Botones 
    *@version V1
    *@return Controlador | Método
    *@author Elizabeth
    *@param id | función Destroy
*/
Route::get('/prestaciones','PrestacionesController@index')->name('prestaciones.index');
Route::delete('/prestaciones/{id}','PrestacionesController@eliminarprestacion')->name('prestaciones.destroy');

/**
    *Peticiones http Delete | Get
    *Eliminación de clasificacion
    *Vaciado de la clasicaciones
    *Vaciado y control de las acciones de los registros CRUD | Botones 
    *@version V1
    *@return Controlador | Método
    *@author Elizabeth | Gustavo
    *@param id | función Destroy
*/
Route::get('clasificacion','ClasificacionController@acciones')->name('clasificacion.acciones');
Route::delete('clasificacion/{id}','ClasificacionController@destroy')->name('clasificacion.eliminar');


//conceptos
Route::get('/conceptos','ConceptosController@index')->name('conceptos.index');
Route::delete('/conceptos/{id}','ConceptosController@eliminaconcepto')->name('conceptos.eliminaconcepto');

//Empleados
Route::get('/empleados', 'EmpleadosController@index')->name('empleados.index');
Route::delete('/empleados/{id_emp}','EmpleadosController@eliminaempleado')->name('empleados.eliminaempleado');
Route::patch('/empleados/{id_emp}','EmpleadosController@actualizar_empleado')->name('empleados.actualizarempleado');

//Usuarios
Route::get('/usuarios','UsersController@index')->name('usuarios.index');
Route::delete('/usuarios/{id}','UsersController@destroy')->name('usuarios.destroy');

//Retenciones
Route::get('/retenciones','RetencionesController@index')->name('retenciones.index');
Route::delete('/retenciones/{id}','RetencionesController@destroy')->name('retenciones.destroy');

//I.M.S.S
Route::get('imss','IMSSController@acciones')->name('imss.acciones');
Route::delete('imss/{id_imss}','IMSSController@eliminarimss')->name('imss.eliminarimss');

//Subsidios
Route::get('subsidios','SubsidioController@acciones')->name('subsidio.acciones');
Route::delete('subsidios/{id_subsidio}','SubsidioController@eliminarsubsidio')->name('subsidio.eliminarsubsidio');