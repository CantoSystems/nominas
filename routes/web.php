<?php
    use App\Exports\PrenominaExport;
    use Maatwebsites\Excel\Facades\Excel;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/prueba-fechas','RegimenFiscalController@fechas');
Route::get('home', 'HomeController@index')->name('home');

Route::delete('empresa/{id}', 'EmpresaController@destroy')->name('empresas.destroy');
Route::get('accciones', 'EmpresaController@acciones')->name('nominas.empresas');
Route::get('selecempresa','EmpresaController@seleccionarempresa')->name('seleccionarempresa');
Route::get('/empresa/nomina/{id}','EmpresaController@show')->name('mostrar.empresas');
Route::get('valores', 'EmpresaController@fechaFin')->name('nominas.fechaFin');

//areas
Route::get('areas','AreasController@index')->name('areas.index');
Route::get('/areas/mostrar/{id}','AreasController@show')->name('areas.mostrar');
Route::delete('areas/{id}', 'AreasController@eliminararea')->name('areas.eliminaarea');

//periodos
Route::get('/periodos','PeriodosController@index')->name('periodos.index');
Route::post('/agregarperiodos','PeriodosController@agregarperiodos')->name('agregarperiodos');
Route::get('/seleccionarperiodo','PeriodosController@seleccionarperiodo')->name('seleccionarperiodo');
Route::get('/periodos','PeriodosController@index')->name('periodos.index');
Route::get('/accionesperiodos','PeriodosController@acciones')->name('periodos.acciones');
Route::delete('accionesperiodos/{id}', 'PeriodosController@eliminarperiodo')->name('periodos.eliminarperiodo');
Route::get('/generar-periodo','PeriodosController@generarPeriodo')->name('periodos.generar');
Route::get('/desactivar-periodo','PeriodosController@desactivarPrenomina')->name('periodos.desactivar');
Route::get('/mostrarPeriodo/{id}','PeriodosController@show')->name('periodos.mostrar');
Route::get('/calcularperiodo','PeriodosController@calcularFechaFin')->name('periodos.calcularFin');
Route::get('/obtener-diasPeriodo','PeriodosController@rangoPeriodo')->name('periodos.obtenerRango');
Route::get('/obtener-fechaInicio','PeriodosController@sugerenciaFechaInicio')->name('periodos.sugerenciaFechaInicio');

//puestos 
Route::get('puestos','PuestosController@index')->name('puestos.index');
Route::get('/puestos/mostrar/{id}','PuestosController@show')->name('puestos.mostrar');
Route::delete('puestos/{id}','PuestosController@eliminarpuestos')->name('puestos.eliminapuesto');

//departamentos
Route::get('/departamentos','DepartamentosController@index')->name('departamentos.index');
Route::get('/departamentos/mostrar/{id}','DepartamentosController@show')->name('departamentos.mostrar');
Route::delete('departamentos/{id}', 'DepartamentosController@eliminardepartamento')->name('departamentos.eliminadepartamento');

//bancos
Route::get('bancos','BancosController@acciones')->name('bancos.acciones');
Route::get('/bancos/visualizar/{id}','BancosController@show')->name('bancos.mostrar');
Route::delete('bancos/{id}','BancosController@eliminarbanco')->name('bancos.eliminar');

//prestaciones
Route::get('/prestaciones','PrestacionesController@index')->name('prestaciones.index');
Route::get('/prestaciones/mostrar/{id}','PrestacionesController@show')->name('prestaciones.show');
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
Route::get('/conceptos/mostrar/{id}','ConceptosController@show')->name('conceptos.mostrar');
Route::delete('/conceptos/{id}','ConceptosController@eliminaconcepto')->name('conceptos.eliminaconcepto');

//Usuarios
Route::get('/usuarios','UsersController@index')->name('usuarios.index');
Route::get('/usuarios/visualizar/{id}','UsersController@show')->name('usuarios.mostrar');
Route::delete('/usuarios/{id}','UsersController@destroy')->name('usuarios.destroy');

//Retenciones
Route::get('/retenciones','RetencionesController@index')->name('retenciones.index');
Route::get('/retenciones/visualizar/{id}','RetencionesController@show')->name('retenciones.mostrar');
Route::delete('/retenciones/{id}','RetencionesController@destroy')->name('retenciones.destroy');

//I.M.S.S
Route::get('imss','IMSSController@acciones')->name('imss.acciones');
Route::get('/imss/visualizar/{id_imss}','IMSSController@show')->name('imss.mostrar');
Route::delete('imss/{id_imss}','IMSSController@eliminarimss')->name('imss.eliminarimss');

//Subsidios
Route::get('subsidios','SubsidioController@acciones')->name('subsidio.acciones');
Route::get('/subsidios/visualizar/{id_subsidio}','SubsidioController@show')->name('subsidios.mostrar');
Route::delete('subsidios/{id_subsidio}','SubsidioController@eliminarsubsidio')->name('subsidio.eliminarsubsidio');

//Ajax-Insert-Multiple Incidencias
Route::get('/incidencias','IncidenciaController@index')->name('incidencias.index');
Route::post('/incidencias/enviodata', 'IncidenciaController@store')->name('incidencias.store');
Route::post('/incidencias/check', 'IncidenciaController@check')->name('incidencias.check');

//Incidencias
Route::get('/incid','IncidenController@index')->name('incid2.index');
Route::get('/incid2/show/{id_incidencia}','IncidenController@show')->name('incid2.show');
Route::delete('/incid/delete/{id}', 'IncidenController@eliminar')->name('incid2.destroy');

//Ajax-Insert-Multiple Tiempo extra
Route::get('/tiempo','TiempoController@index')->name('tiempo.index');
Route::post('/tiempo/enviodata','TiempoController@store')->name('tiempo.store');

//Horas Extras
Route::get('/horas-extras','ExtrasController@index')->name('horasextras.index');
Route::get('/horas-extras/mostrar/{id_tiempo}','ExtrasController@show')->name('horasextras.show');
Route::delete('horas-extras/delete/{id_tiempo}', 'ExtrasController@elimina')->name('tiempo.destroy');

//Ajax-Insert-Multiple Ausentismo
Route::get('/ausencia','AusenciaController@index')->name('ausencia.index');
Route::post('/ausencia/enviamultiple','AusenciaController@store')->name('ausencia.store');

//ausentismo - Crud
Route::get('/ausentismo','AusentismoController@index')->name('ausentismo.index');
Route::get('/ausentismo/visualizar/{id}','AusentismoController@show')->name('ausentismo.visualizar');
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
Route::get('/umas/visualizar/{id}','UmasController@show')->name('umas.mostrar');
Route::delete('/umas/{id}','UmasController@destroy')->name('umas.destroy');

//Seleccionar Conceptos
Route::get('/selectConceptos','SelectConceptosController@index')->name('selectConceptos.index');

//Prenómina
Route::get('/prenomina-prueba/{id_emp}', 'CalculoPrenominaController@show')->name('prenomina.show');
Route::post('/prenomina-act/enviodata', 'CalculoPrenominaController@store')->name('prenomina.store');
Route::post('/prenominaISR', 'CalculoPrenominaController@calcularImpuestos')->name('prenomina.Impuestos');

//Días Festivos
Route::get('/descanso', 'DescansosController@index')->name('descansos.index');
Route::get('/descanso/mostrar/{id}','DescansosController@show')->name('descansos.mostrar');
Route::delete('/descanso/{id}','DescansosController@destroy')->name('descansos.destroy');

//nuevo control Prenomina
Route::get('/prenomina-normal', 'ControlPrenominaController@index')->name('control.index');
Route::get('/prenomina-normal/{id_emp}', 'ControlPrenominaController@create')->name('control.create');
Route::get('/prenomina-excel3','ControlPrenominaController@exportExcel')->name('control.excel3');
Route::post('/prenomina-normal/enviocontrolprenomina', 'ControlPrenominaController@store')->name('control.store');
Route::post('/prenominaImpuestos', 'ControlPrenominaController@calcularImpuestos')->name('control.Impuestos');
Route::post('/prenominaIMSS', 'ControlPrenominaController@calcularIMSS')->name('control.IMSS');
Route::post('/prenominaPension', 'ControlPrenominaController@pensionAlimenticia')->name('control.pension');
Route::post('/prenominaPatron', 'ControlPrenominaController@impuestosPatron')->name('control.impPatron');

//Préstamos
Route::get('/prestamos', 'PrestamosController@index')->name('prestamos.index');
Route::get('/verPrestamos', 'PrestamosController@show')->name('prestamos.show');
Route::post('/prestamos/enviodata', 'PrestamosController@store')->name('prestamos.store');
Route::get('/prestamos/mostrar/{idPrestamo}','PrestamosController@create')->name('prestamos.mostrar');
Route::delete('/prestamos/delete/{id}', 'PrestamosController@eliminar')->name('prestamos.destroy');

//CRUD regimen Fiscal
Route::post('/regimen/busqueda','RegimenFiscalController@muestraregimen')->name('regimen.autocomplete');
Route::get('/fiscal','FiscalController@index')->name('fiscal');
Route::get('/fiscal/{id}','FiscalController@show')->name('fiscal.show');
Route::get('/fiscalbusqueda/{id}','FiscalController@create')->name('fical.create');
Route::delete('/fical-eliminar/{id}','FiscalController@destroy')->name('fiscal.destroy');


//Aguinaldos
Route::get('/aguinaldos', 'prenominaAguinaldo@index')->name('aguinaldosP.index');
Route::get('/aguinaldos-excel3','prenominaAguinaldo@exportExcel')->name('aguinaldos.excel3');
Route::post('/aguinaldos', 'prenominaAguinaldo@create')->name('aguinaldosP.create');
Route::post('/aguinaldos/enviocontrolaguinaldo', 'prenominaAguinaldo@store')->name('aguinaldosP.store');

//PTU
Route::get('/ptu', 'prenominaPTU@index')->name('ptu.index');
Route::post('/ptu', 'prenominaPTU@create')->name('ptu.create');

Route::get('/f','EjemploController@index');
Route::post('/fe','EjemploController@store')->name('f.data');

//Infonavit UMI
Route::get('/infonavit','InfonavitController@acciones')->name('infonavit.acciones');
Route::get('/infonavit/mostrar/{id}','InfonavitController@show')->name('infonavit.mostrar');
Route::delete('infonavit/{id}','InfonavitController@delete')->name('infonavit.eliminar');