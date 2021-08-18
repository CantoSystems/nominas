<?php
    use App\Exports\PrenominaExport;
    use Maatwebsites\Excel\Facades\Excel;
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

Route::get('/PDF-PRUEBA', function(){
    $pdf = App::make('dompdf.wrapper');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();
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

//Ajax-Insert-Multiple Incidencias
Route::get('/incidencias','IncidenciaController@index')->name('incidencias.index');
Route::post('/incidencias/enviodata', 'IncidenciaController@store')->name('incidencias.store');
Route::post('/incidencias/check', 'IncidenciaController@check')->name('incidencias.check');

//Incidencias
Route::get('/incid','IncidenController@index')->name('incid2.index');
Route::delete('/incid/delete/{id}', 'IncidenController@eliminar')->name('incid2.destroy');

//Ajax-Insert-Multiple Tiempo extra
Route::get('/tiempo','TiempoController@index')->name('tiempo.index');
Route::post('/tiempo/enviodata','TiempoController@store')->name('tiempo.store');

//Horas Extras
Route::get('/horas-extras','ExtrasController@index')->name('horasextras.index');
Route::delete('horas-extras/delete/{id_tiempo}', 'ExtrasController@elimina')->name('tiempo.destroy');

//Ajax-Insert-Multiple Ausentismo
Route::get('/ausencia','AusenciaController@index')->name('ausencia.index');
Route::post('/ausencia/enviamultiple','AusenciaController@store')->name('ausencia.store');

//ausentismo
Route::get('/ausentismo','AusentismoController@index')->name('ausentismo.index');
Route::post('/ausentismo/busqueda','AusentismoController@mostrarempleado')->name('ausentismo.mostrarempleado');
Route::post('/ausentismo/busquedaconcepto','AusentismoController@mostrarconcepto')->name('ausentismo.mostrarconcepto');
Route::delete('ausentismo/delete/{id}', 'AusentismoController@eliminar')->name('ausentismo.destroy');

// Reestructuración catalogos
Route::get('/empleado', 'EmpleaController@index')->name('emplea.index');
Route::get('/empleado/mostrar/{id_emp}','EmpleaController@show')->name('emplea.mostrar');
Route::delete('/empleados/{id_emp}','EmpleaController@destroy')->name('emplea.destroy');

//Salario Mínimo
Route::get('/salariominimo','SalarioMinimoController@acciones')->name('salariomin.acciones');
Route::get('/salariominimo/mostrar/{idSalarioMinimo}','SalarioMinimoController@show')->name('salariomin.mostrar');
Route::delete('/salariominimo/{idSalarioMinimo}','SalarioMinimoController@destroy')->name('salariomin.destroy');

//PDF Reporte nómina
Route::get('/nomina-normal', 'ReportNominaPDFController@index')->name('reportnomina.index');
Route::get('/nomina-normal/mostrar/{id_emp}', 'ReportNominaPDFController@visualizar')->name('reportnomina.mostrar');

//Pruebas cálculo tiempo
Route::get('/definir-tiempo','SeleccionTiempoExtraController@index')->name('selecciontiempo.index');
Route::get('/definir','SeleccionTiempoExtraController@create')->name('selecciontiempo.create');
Route::get('/define','SeleccionTiempoExtraController@store')->name('selecciontiempo.store');

//UMAS
Route::get('/umas', 'UmasController@index')->name('umas.index');
Route::delete('/umas/{id}','UmasController@destroy')->name('umas.destroy');

//Seleccionar Conceptos
Route::get('/selectConceptos','SelectConceptosController@index')->name('selectConceptos.index');

//Prenómina
Route::get('/prenomina-prueba/{id_emp}', 'CalculoPrenominaController@show')->name('prenomina.show');
Route::post('/prenomina-act/enviodata', 'CalculoPrenominaController@store')->name('prenomina.store');
Route::post('/prenominaISR', 'CalculoPrenominaController@calcularImpuestos')->name('prenomina.Impuestos');

//Días Festivos
Route::get('/descanso', 'DescansosController@index')->name('descansos.index');
Route::delete('/descanso/{id}','DescansosController@destroy')->name('descansos.destroy');

//nuevo control Prenomina
Route::get('/prenomina-normal', 'ControlPrenominaController@index')->name('control.index');
Route::get('/prenomina-normal/{id_emp}', 'ControlPrenominaController@create')->name('control.create');
Route::get('/prenomina-excel','ControlPrenominaController@excelPrenomina')->name('control.excel');
Route::get('/prenomina-excel3','ControlPrenominaController@exportExcel')->name('control.excel3');
Route::post('/prenomina-normal/enviocontrolprenomina', 'ControlPrenominaController@store')->name('control.store');
Route::post('/prenominaImpuestos', 'ControlPrenominaController@calcularImpuestos')->name('control.Impuestos');
Route::post('/prenominaIMSS', 'ControlPrenominaController@calcularIMSS')->name('control.IMSS');
Route::post('/prenominaPension', 'ControlPrenominaController@pensionAlimenticia')->name('control.pension');

//Aguinaldos
Route::get('/aguinaldos', 'AguinaldosController@index')->name('aguinaldos.index');
Route::get('/aguinaldosl/{id_emp}', 'AguinaldosController@create')->name('aguinaldos.show');

//Préstamos
Route::get('/prestamos', 'PrestamosController@index')->name('prestamos.index');
Route::get('/verPrestamos', 'PrestamosController@show')->name('prestamos.show');
Route::post('/prestamos/enviodata', 'PrestamosController@store')->name('prestamos.store');
Route::delete('/prestamos/delete/{id}', 'PrestamosController@eliminar')->name('prestamos.destroy');