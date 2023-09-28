<?php
    use App\Exports\PrenominaExport;
    use Maatwebsites\Excel\Facades\Excel;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/prueba-fechas','RegimenFiscalController@fechas')->middleware('auth');
Route::get('home', 'HomeController@index')->name('home');

Route::delete('empresa/{id}', 'EmpresaController@destroy')->name('empresas.destroy')->middleware('auth');
Route::get('accciones', 'EmpresaController@acciones')->name('nominas.empresas')->middleware('auth');
Route::get('selecempresa','EmpresaController@seleccionarempresa')->name('seleccionarempresa')->middleware('auth');
Route::get('/empresa/nomina/{id}','EmpresaController@show')->name('mostrar.empresas')->middleware('auth');
Route::get('valores', 'EmpresaController@fechaFin')->name('nominas.fechaFin')->middleware('auth');

//areas
Route::get('areas','AreasController@index')->name('areas.index')->middleware('auth');
Route::get('/areas/mostrar/{id}','AreasController@show')->name('areas.mostrar')->middleware('auth');
Route::delete('areas/{id}', 'AreasController@eliminararea')->name('areas.eliminaarea')->middleware('auth');

//periodos
Route::get('/periodos','PeriodosController@index')->name('periodos.index')->middleware('auth');
Route::post('/agregarperiodos','PeriodosController@agregarperiodos')->name('agregarperiodos')->middleware('auth');
Route::get('/seleccionarperiodo','PeriodosController@seleccionarperiodo')->name('seleccionarperiodo')->middleware('auth');
Route::get('/periodos','PeriodosController@index')->name('periodos.index')->middleware('auth');
Route::get('/accionesperiodos','PeriodosController@acciones')->name('periodos.acciones')->middleware('auth');
Route::delete('accionesperiodos/{id}', 'PeriodosController@eliminarperiodo')->name('periodos.eliminarperiodo')->middleware('auth');
Route::get('/generar-periodo','PeriodosController@generarPeriodo')->name('periodos.generar')->middleware('auth');
Route::get('/desactivar-periodo','PeriodosController@desactivarPrenomina')->name('periodos.desactivar')->middleware('auth');
Route::get('/mostrarPeriodo/{id}','PeriodosController@show')->name('periodos.mostrar')->middleware('auth');
Route::get('/calcularperiodo','PeriodosController@calcularFechaFin')->name('periodos.calcularFin')->middleware('auth');
Route::get('/obtener-diasPeriodo','PeriodosController@rangoPeriodo')->name('periodos.obtenerRango')->middleware('auth');
Route::get('/obtener-fechaInicio','PeriodosController@sugerenciaFechaInicio')->name('periodos.sugerenciaFechaInicio')->middleware('auth');

//puestos 
Route::get('puestos','PuestosController@index')->name('puestos.index')->middleware('auth');
Route::get('/puestos/mostrar/{id}','PuestosController@show')->name('puestos.mostrar')->middleware('auth');
Route::delete('puestos/{id}','PuestosController@eliminarpuestos')->name('puestos.eliminapuesto')->middleware('auth');

//departamentos
Route::get('/departamentos','DepartamentosController@index')->name('departamentos.index')->middleware('auth');
Route::get('/departamentos/mostrar/{id}','DepartamentosController@show')->name('departamentos.mostrar')->middleware('auth');
Route::delete('departamentos/{id}', 'DepartamentosController@eliminardepartamento')->name('departamentos.eliminadepartamento')->middleware('auth');

//bancos
Route::get('bancos','BancosController@acciones')->name('bancos.acciones')->middleware('auth');
Route::get('/bancos/visualizar/{id}','BancosController@show')->name('bancos.mostrar')->middleware('auth');
Route::delete('bancos/{id}','BancosController@eliminarbanco')->name('bancos.eliminar')->middleware('auth');

//prestaciones
Route::get('/prestaciones','PrestacionesController@index')->name('prestaciones.index')->middleware('auth');
Route::get('/prestaciones/mostrar/{id}','PrestacionesController@show')->name('prestaciones.show')->middleware('auth');
Route::delete('/prestaciones/{id}','PrestacionesController@eliminarprestacion')->name('prestaciones.destroy')->middleware('auth');

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
Route::get('clasificacion','ClasificacionController@acciones')->name('clasificacion.acciones')->middleware('auth');
Route::delete('clasificacion/{id}','ClasificacionController@destroy')->name('clasificacion.eliminar')->middleware('auth');

//conceptos
Route::get('/conceptos','ConceptosController@index')->name('conceptos.index')->middleware('auth');
Route::get('/conceptos/mostrar/{id}','ConceptosController@show')->name('conceptos.mostrar')->middleware('auth');
Route::delete('/conceptos/{id}','ConceptosController@eliminaconcepto')->name('conceptos.eliminaconcepto')->middleware('auth');

//Usuarios
Route::get('/usuarios','UsersController@index')->name('usuarios.index')->middleware('auth');
Route::get('/usuarios/visualizar/{id}','UsersController@show')->name('usuarios.mostrar')->middleware('auth');
Route::delete('/usuarios/{id}','UsersController@destroy')->name('usuarios.destroy')->middleware('auth');

//Retenciones
Route::get('/retenciones','RetencionesController@index')->name('retenciones.index')->middleware('auth');
Route::get('/retenciones/visualizar/{id}','RetencionesController@show')->name('retenciones.mostrar')->middleware('auth');
Route::delete('/retenciones/{id}','RetencionesController@destroy')->name('retenciones.destroy')->middleware('auth');

//I.M.S.S
Route::get('imss','IMSSController@acciones')->name('imss.acciones')->middleware('auth');
Route::get('/imss/visualizar/{id_imss}','IMSSController@show')->name('imss.mostrar')->middleware('auth');
Route::delete('imss/{id_imss}','IMSSController@eliminarimss')->name('imss.eliminarimss')->middleware('auth');

//Subsidios
Route::get('subsidios','SubsidioController@acciones')->name('subsidio.acciones')->middleware('auth');
Route::get('/subsidios/visualizar/{id_subsidio}','SubsidioController@show')->name('subsidios.mostrar')->middleware('auth');
Route::delete('subsidios/{id_subsidio}','SubsidioController@eliminarsubsidio')->name('subsidio.eliminarsubsidio')->middleware('auth');

//Ajax-Insert-Multiple Incidencias
Route::get('/incidencias','IncidenciaController@index')->name('incidencias.index')->middleware('auth');
Route::post('/incidencias/enviodata', 'IncidenciaController@store')->name('incidencias.store')->middleware('auth');
Route::post('/incidencias/check', 'IncidenciaController@check')->name('incidencias.check')->middleware('auth');

//Incidencias
Route::get('/incid','IncidenController@index')->name('incid2.index')->middleware('auth');
Route::get('/incid2/show/{id_incidencia}','IncidenController@show')->name('incid2.show')->middleware('auth');
Route::delete('/incid/delete/{id}', 'IncidenController@eliminar')->name('incid2.destroy')->middleware('auth');

//Ajax-Insert-Multiple Tiempo extra
Route::get('/tiempo','TiempoController@index')->name('tiempo.index')->middleware('auth');
Route::post('/tiempo/enviodata','TiempoController@store')->name('tiempo.store')->middleware('auth');

//Horas Extras
Route::get('/horas-extras','ExtrasController@index')->name('horasextras.index')->middleware('auth');
Route::get('/horas-extras/mostrar/{id_tiempo}','ExtrasController@show')->name('horasextras.show')->middleware('auth');
Route::delete('horas-extras/delete/{id_tiempo}', 'ExtrasController@elimina')->name('tiempo.destroy')->middleware('auth');

//Ajax-Insert-Multiple Ausentismo
Route::get('/ausencia','AusenciaController@index')->name('ausencia.index')->middleware('auth');
Route::post('/ausencia/enviamultiple','AusenciaController@store')->name('ausencia.store')->middleware('auth');

//ausentismo - Crud
Route::get('/ausentismo','AusentismoController@index')->name('ausentismo.index')->middleware('auth');
Route::get('/ausentismo/visualizar/{id}','AusentismoController@show')->name('ausentismo.visualizar');
Route::post('/ausentismo/busqueda','AusentismoController@mostrarempleado')->name('ausentismo.mostrarempleado')->middleware('auth');
Route::post('/ausentismo/busquedaconcepto','AusentismoController@mostrarconcepto')->name('ausentismo.mostrarconcepto')->middleware('auth');
Route::delete('ausentismo/delete/{id}', 'AusentismoController@eliminar')->name('ausentismo.destroy')->middleware('auth');

// Reestructuración catalogos
Route::get('/empleado', 'EmpleaController@index')->name('emplea.index')->middleware('auth');
Route::get('/empleado/mostrar/{id_emp}','EmpleaController@show')->name('emplea.mostrar')->middleware('auth');
Route::delete('/empleados/{id_emp}','EmpleaController@destroy')->name('emplea.destroy')->middleware('auth');

//Salario Mínimo
Route::get('/salariominimo','SalarioMinimoController@acciones')->name('salariomin.acciones')->middleware('auth');
Route::get('/salariominimo/mostrar/{idSalarioMinimo}','SalarioMinimoController@show')->name('salariomin.mostrar')->middleware('auth');
Route::delete('/salariominimo/{idSalarioMinimo}','SalarioMinimoController@destroy')->name('salariomin.destroy')->middleware('auth');

//PDF Reporte nómina
Route::get('/nomina-normal', 'ReportNominaPDFController@index')->name('reportnomina.index')->middleware('auth');
Route::get('/nomina-normal/mostrar/{id_emp}', 'ReportNominaPDFController@visualizar')->name('reportnomina.mostrar')->middleware('auth');

//Pruebas cálculo tiempo
Route::get('/definir-tiempo','SeleccionTiempoExtraController@index')->name('selecciontiempo.index')->middleware('auth');
Route::get('/definir','SeleccionTiempoExtraController@create')->name('selecciontiempo.create')->middleware('auth');
Route::get('/define','SeleccionTiempoExtraController@store')->name('selecciontiempo.store')->middleware('auth');

//UMAS
Route::get('/umas', 'UmasController@index')->name('umas.index')->middleware('auth');
Route::get('/umas/visualizar/{id}','UmasController@show')->name('umas.mostrar')->middleware('auth');
Route::delete('/umas/{id}','UmasController@destroy')->name('umas.destroy')->middleware('auth');

//Seleccionar Conceptos
Route::get('/selectConceptos','SelectConceptosController@index')->name('selectConceptos.index')->middleware('auth');

//Prenómina
Route::get('/prenomina-prueba/{id_emp}', 'CalculoPrenominaController@show')->name('prenomina.show')->middleware('auth');
Route::post('/prenomina-act/enviodata', 'CalculoPrenominaController@store')->name('prenomina.store')->middleware('auth');
Route::post('/prenominaISR', 'CalculoPrenominaController@calcularImpuestos')->name('prenomina.Impuestos')->middleware('auth');

//Días Festivos
Route::get('/descanso', 'DescansosController@index')->name('descansos.index')->middleware('auth');
Route::get('/descanso/mostrar/{id}','DescansosController@show')->name('descansos.mostrar')->middleware('auth');
Route::delete('/descanso/{id}','DescansosController@destroy')->name('descansos.destroy')->middleware('auth');

//nuevo control Prenomina
Route::get('/prenomina-normal', 'ControlPrenominaController@index')->name('control.index')->middleware('auth');
Route::get('/prenomina-normal/{id_emp}', 'ControlPrenominaController@create')->name('control.create')->middleware('auth');
Route::get('/prenomina-excel3','ControlPrenominaController@exportExcel')->name('control.excel3')->middleware('auth');
Route::post('/prenomina-normal/enviocontrolprenomina', 'ControlPrenominaController@store')->name('control.store')->middleware('auth');
Route::post('/prenominaImpuestos', 'ControlPrenominaController@calcularImpuestos')->name('control.Impuestos')->middleware('auth');
Route::post('/prenominaIMSS', 'ControlPrenominaController@calcularIMSS')->name('control.IMSS')->middleware('auth');
Route::post('/prenominaPension', 'ControlPrenominaController@pensionAlimenticia')->name('control.pension')->middleware('auth');
Route::post('/prenominaPatron', 'ControlPrenominaController@impuestosPatron')->name('control.impPatron')->middleware('auth');

//Préstamos
Route::get('/prestamos', 'PrestamosController@index')->name('prestamos.index')->middleware('auth');
Route::get('/verPrestamos', 'PrestamosController@show')->name('prestamos.show')->middleware('auth');
Route::post('/prestamos/enviodata', 'PrestamosController@store')->name('prestamos.store')->middleware('auth');
Route::get('/prestamos/mostrar/{idPrestamo}','PrestamosController@create')->name('prestamos.mostrar')->middleware('auth');
Route::delete('/prestamos/delete/{id}', 'PrestamosController@eliminar')->name('prestamos.destroy')->middleware('auth');

//CRUD regimen Fiscal
Route::post('/regimen/busqueda','RegimenFiscalController@muestraregimen')->name('regimen.autocomplete')->middleware('auth');
Route::get('/fiscal','FiscalController@index')->name('fiscal')->middleware('auth');
Route::get('/fiscal/{id}','FiscalController@show')->name('fiscal.show')->middleware('auth');
Route::get('/fiscalbusqueda/{id}','FiscalController@create')->name('fical.create')->middleware('auth');
Route::delete('/fical-eliminar/{id}','FiscalController@destroy')->name('fiscal.destroy')->middleware('auth');

//Aguinaldos
Route::get('/aguinaldos', 'prenominaAguinaldo@index')->name('aguinaldosP.index')->middleware('auth');
Route::get('/aguinaldos-excel3','prenominaAguinaldo@exportExcel')->name('aguinaldos.excel3')->middleware('auth');
Route::post('/aguinaldos', 'prenominaAguinaldo@create')->name('aguinaldosP.create')->middleware('auth');
Route::post('/aguinaldos/enviocontrolaguinaldo', 'prenominaAguinaldo@store')->name('aguinaldosP.store')->middleware('auth');

//PTU
Route::get('/ptu', 'prenominaPTU@index')->name('ptu.index')->middleware('auth');
Route::post('/ptu', 'prenominaPTU@create')->name('ptu.create')->middleware('auth');

Route::get('/f','EjemploController@index')->middleware('auth');
Route::post('/fe','EjemploController@store')->name('f.data')->middleware('auth');

//Infonavit UMI
Route::get('/infonavit','InfonavitController@acciones')->name('infonavit.acciones')->middleware('auth');
Route::get('/infonavit/mostrar/{id}','InfonavitController@show')->name('infonavit.mostrar')->middleware('auth');
Route::delete('infonavit/{id}','InfonavitController@delete')->name('infonavit.eliminar')->middleware('auth');