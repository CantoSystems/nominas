<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Empresa;
use App\Umas;
use App\Subsidio;
use App\SubsidiosTemp;
use App\Retenciones;
use App\RetencionesTemp;
use App\SalarioMinimo;
use App\IMSS;
use App\BaseVejez;
use App\Exports\PrenominaExport;
use Session;
use DataTables;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse;
use Maatwebsites\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Date;

class ControlPrenominaController extends Controller
{
    public function conectar($clv)
    {
        $configDb = [
            'driver'      => 'mysql',
            'host'        => env('DB_HOST', 'localhost'),
            'port'        => env('DB_PORT', '3306'),
            'database'    => $clv,
            'username'    => env('DB_USERNAME', 'root'),
            'password'    => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset'     => 'utf8',
            'collation'   => 'utf8_unicode_ci',
            'prefix'      => '',
            'strict'      => true,
            'engine'      => null,
        ];
        return $configDb;
    }

    public function index(Request $request)
    {
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $accion = $request->acciones;
        $empleados = DB::connection('DB_Serverr')->table('empleados')
            ->join('departamentos', 'departamentos.clave_departamento', '=', 'empleados.clave_departamento')
            ->join('puestos', 'puestos.clave_puesto', '=', 'empleados.clave_puesto')
            ->join('areas', 'areas.clave_area', '=', 'departamentos.clave_area')
            ->select('empleados.*', 'departamentos.*', 'areas.*', 'puestos.*')
            ->get();

        return view('prenomina.controlPrenomina', compact('empleados'));
    }

    public function store(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach ($request->only('info') as $value) {
            $data = json_decode($value);
        }

        $periodo = Session::get('num_periodo');
        $fecha_periodo = now();

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value) {
            DB::connection('DB_Serverr')->insert('INSERT INTO prenomina (noPrenomina, clave_empleado, clave_concepto, monto, status_prenomina, created_at, updated_at)
                                                VALUES(?,?,?,?,?,?,?)', [$periodo, $value->clvEmp, $value->concepto, $value->monto, 1, $fecha_periodo, $fecha_periodo]);
        }

        DB::connection('DB_Serverr')->insert('INSERT INTO prenomina (noPrenomina, clave_empleado, clave_concepto, monto, status_prenomina, created_at, updated_at)
                                            VALUES(?,?,?,?,?,?,?)', [$periodo, $request->clvEmp, '01OC', $request->totalGrav, 1, $fecha_periodo, $fecha_periodo]);

        DB::connection('DB_Serverr')->insert('INSERT INTO prenomina (noPrenomina, clave_empleado, clave_concepto, monto, status_prenomina, created_at, updated_at)
                                            VALUES(?,?,?,?,?,?,?)', [$periodo, $request->clvEmp, '02OC', $request->totalExc, 1, $fecha_periodo, $fecha_periodo]);
    }

    public function calcularImpuestos(Request $request)
    {
        $percGrav = $request->totalPercepcionesGrav;
        $percNoGrav = $request->totalPercepcionesNoGrav;
        $claveEmpleado = $request->empclave;

        $jt = $this->jornadaTrabajo();

        switch ($jt->diasPeriodo) {
            case 7:
            case 10:
                $cadenaPeriodo = 'SEMANAL';
                break;
            case 15:
                $cadenaPeriodo = 'QUINCENAL';
                break;
            case 30:
                $cadenaPeriodo = 'MENSUAL';
                break;
        }

        $isrN = $this->isrN($cadenaPeriodo, $percGrav);

        $isrTemp = $this->isrTemp($claveEmpleado, $percGrav);

        if (($isrTemp - $isrN['AcumISR']) > 0) {
            $isrDeterminado = ($isrTemp - $isrN['AcumISR']) * (-1);
        } else {
            $isrDeterminado = $isrN['ISR'];
        }

        return $collection = collect(['001T', 'ISR', $isrDeterminado, $claveEmpleado]);
    }

    public function isrN($cadenaPeriodo, $percGrav)
    {
        $limites = Retenciones::select('limite_inferior', 'limite_superior', 'cuota_fija', 'porcentaje_excedente')
            ->where([
                ['limite_inferior', '<=', $percGrav],
                ['periodo_retencion', '=', $cadenaPeriodo]
            ])
            ->orderBy('id', 'desc')
            ->first();

        $diferencia = $percGrav - $limites->limite_inferior;
        $impuestoMarginal = ($diferencia * $limites->porcentaje_excedente) / 100;
        $isrCalculado = $impuestoMarginal + $limites->cuota_fija;

        $subsidio = Subsidio::select('cantidadSubsidio')
            ->where([
                ['ParaIngresos', '<', $percGrav],
                ['periodo_subsidio', '=', $cadenaPeriodo]
            ])
            ->orderBy('id_subsidio', 'desc')
            ->first();

        $isrCalculado = $isrCalculado - $subsidio->cantidadSubsidio;

        $fechaInicioAnio = date('Y-m-d', strtotime('2023-01-01'));
        //$fechaInicioAnio = now()->parse(date('Y-01-01'))->format('Y-m-d');
        $fechasPeriodoActual = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_inicio', 'fecha_fin')
            ->where('status_periodo', '=', 1)
            ->first();

        $AcumISR = DB::connection('DB_Serverr')->table('prenomina')
            ->join('periodos', 'periodos.id', '=', 'prenomina.noPrenomina')
            ->select(DB::raw('SUM(monto) AS total'))
            ->whereBetween('periodos.fecha_inicio', [$fechaInicioAnio, $fechasPeriodoActual->fecha_inicio])
            ->whereBetween('periodos.fecha_fin', [$fechaInicioAnio, $fechasPeriodoActual->fecha_fin])
            ->where('prenomina.clave_concepto', '=', '001T')
            ->first();

        if ($AcumISR->total == null) {
            $AcumISR->total = 0;
        }

        $isrTotal = $AcumISR->total + $isrCalculado;

        $infoISR = array('AcumISR' => $isrTotal, 'ISR' => $isrCalculado);

        return $infoISR;
    }

    public function isrTemp($empclave, $percGrav)
    {
        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
            ->select('fecha_alta')
            ->where('clave_empleado', '=', $empclave)
            ->first();

        $fechaInicioAnio = date('Y-m-d', strtotime('2023-01-01'));
        //$fechaInicioAnio = now()->parse(date('Y-01-01'))->format('Y-m-d');
        $fechaAlta = now()->parse($alta_trabajador->fecha_alta)->format('Y-m-d');
        $fecha_actual = date('Y-m-d', strtotime('2023-12-01'));
        //$fecha_actual = now()->toDateString();
        $fechasPeriodoActual = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_inicio', 'fecha_fin')
            ->where('status_periodo', '=', 1)
            ->first();

        if ($fechaAlta < $fechaInicioAnio) {
            $diffMeses = bcdiv(Carbon::parse($fechaInicioAnio)->floatDiffInMonths($fecha_actual), '1', 1);
        } else {
            $diffMeses = bcdiv(Carbon::parse($fechaAlta)->floatDiffInMonths($fecha_actual), '1', 1);
        }

        $decimal = floor($diffMeses);
        if (date('d', strtotime($fecha_actual)) > 15) {
            $diffMeses = $decimal + 1;
        } else {
            $diffMeses = $decimal + 0.5;
        }

        $AcumPercGrav = DB::connection('DB_Serverr')->table('prenomina')
            ->join('periodos', 'periodos.id', '=', 'prenomina.noPrenomina')
            ->select(DB::raw('SUM(monto) AS total'))
            ->whereBetween('periodos.fecha_inicio', [$fechaInicioAnio, $fechasPeriodoActual->fecha_inicio])
            ->whereBetween('periodos.fecha_fin', [$fechaInicioAnio, $fechasPeriodoActual->fecha_fin])
            ->where('prenomina.clave_concepto', '=', '01OC')
            ->first();

        $AcumPercGrav = $AcumPercGrav->total + $percGrav;

        $limites = Retenciones::select('limite_inferior', 'limite_superior', 'cuota_fija', 'porcentaje_excedente')
            ->where([
                ['periodo_retencion', '=', 'MENSUAL']
            ])
            ->orderBy('id', 'asc')
            ->get();

        RetencionesTemp::truncate();
        foreach ($limites as $lim) {
            $limTemp = new RetencionesTemp;
            $limTemp->limite_inferior = bcdiv(($lim->limite_inferior * $diffMeses) - .1, '1', 4);
            $limTemp->limite_superior = bcdiv($lim->limite_superior * $diffMeses, '1', 4);
            $limTemp->cuota_fija = bcdiv($lim->cuota_fija * $diffMeses, '1', 4);
            $limTemp->porcentaje_excedente = $lim->porcentaje_excedente;
            $limTemp->save();
        }

        $limites = RetencionesTemp::select('limite_inferior', 'limite_superior', 'cuota_fija', 'porcentaje_excedente')
            ->where([
                ['limite_inferior', '<=', $AcumPercGrav]
            ])
            ->orderBy('id', 'desc')
            ->first();

        $diferencia = $AcumPercGrav - $limites->limite_inferior;
        $impuestoMarginal = ($diferencia * $limites->porcentaje_excedente) / 100;
        $isrTempCalculado = $impuestoMarginal + $limites->cuota_fija;

        $subsidio = Subsidio::select('ParaIngresos', 'hastaIngresos', 'cantidadSubsidio')
            ->where([
                ['periodo_subsidio', '=', 'MENSUAL']
            ])
            ->orderBy('id_subsidio', 'asc')
            ->get();

        SubsidiosTemp::truncate();
        foreach ($subsidio as $sub) {
            $subTemp = new SubsidiosTemp;
            $subTemp->ParaIngresos = bcdiv(($sub->ParaIngresos * $diffMeses) - .1, '1', 4);
            $subTemp->hastaIngresos = bcdiv($sub->hastaIngresos * $diffMeses, '1', 4);
            $subTemp->cantidadSubsidio = bcdiv($sub->cantidadSubsidio * $diffMeses, '1', 4);
            $subTemp->save();
        }

        $subsidio = SubsidiosTemp::select('cantidadSubsidio')
            ->where([
                ['ParaIngresos', '<', $AcumPercGrav]
            ])
            ->orderBy('id_subsidio', 'desc')
            ->first();

        return $isrTempCalculado - $subsidio->cantidadSubsidio;
    }

    public function pensionAlimenticia(Request $request)
    {
        $periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $empleadoClave = $request->empclave;;
        $pension = DB::connection('DB_Serverr')->table('incidencias')
            ->where([
                ['clave_empleado', '=', $request->clvEmp],
                ['periodo_incidencia', '=', $periodo]
            ])
            ->whereIn('clave_concepto', ['018D', '020D'])
            ->count();

        if ($pension != 0) {
            $pension = DB::connection('DB_Serverr')->table('incidencias')
                ->join('conceptos', 'conceptos.clave_concepto', '=', 'incidencias.clave_concepto')
                ->select('incidencias.monto', 'conceptos.concepto', 'incidencias.clave_empleado', 'conceptos.clave_concepto')
                ->where([
                    ['clave_empleado', '=', $request->clvEmp],
                    ['periodo_incidencia', '=', $periodo]
                ])
                ->whereIn('incidencias.clave_concepto', ['018D', '020D'])
                ->first();

            if ($pension->clave_concepto == '018D') {
                $descuentoPension = ($pension->monto * $request->totalSueldo) / 100;
                $sueldoTotal = $request->totalSueldo - $descuentoPension;
            } else {
                $descuentoPension = $pension->monto;
                $sueldoTotal = $request->totalSueldo - $descuentoPension;
            }

            return $collection = collect([$pension->clave_concepto, $pension->concepto, round($sueldoTotal, 2), $descuentoPension, $pension->clave_empleado, $empleadoClave]);
        } else {
            $sueldoTotal = $request->totalSueldo;

            return $collection = collect(['', '', round($sueldoTotal, 2), '', '', $empleadoClave]);
        }
    }

    public function calcularIMSS(Request $request)
    {
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $valorClvEmpleado = $request->empclave;

        $empleados = DB::connection('DB_Serverr')->table('empleados')
            ->select('id_emp', 'sueldo_diario', 'dias', 'tipo_jornada')
            ->where('clave_empleado', '=', $valorClvEmpleado)
            ->first();

        $region = $this->ahorro_riesgo();

        $importeRegion = SalarioMinimo::select('importe')
            ->where('region', $region->region)
            ->first();

        if ($empleados->sueldo_diario <= $importeRegion->importe) {
            return $collection = collect(['003T', 'IMSS TRABAJADOR', 0, $valorClvEmpleado]);
        } else if ($empleados->sueldo_diario > $importeRegion->importe) {
            $at = $this->anios_trabajados($empleados->id_emp);

            $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')
                ->select('dias')
                ->where('anio', '=', $at)
                ->first();

            $SBC = $this->SBC($prestaciones->dias, $empleados->sueldo_diario, $empleados->id_emp);

            $uma = $this->uma();
            if (is_null($uma->porcentaje_uma)) {
                return $collection = collect(['003T', 'IMSS TRABAJADOR', '', $valorClvEmpleado]);
            }

            $diasTrabajados = $this->dias_trabajados($request->clvEmp);

            $ims = IMSS::select('cuotatrabajador', 'id_imss', 'base', 'claveImss')
                ->where('cuotatrabajador', '!=', 0)
                ->get();

            $totalIMSS = 0;
            foreach ($ims as $cuotasIMSS) {
                if ($cuotasIMSS->claveImss == 'IEM2') {
                    $diferenciaSueldo = $SBC - ($uma->porcentaje_uma * 3);
                    $sumaIMSS = ($cuotasIMSS->cuotatrabajador * $diasTrabajados * $diferenciaSueldo) / 100;
                    $totalIMSS = $totalIMSS + $sumaIMSS;
                } else {
                    $sumaIMSS = ($cuotasIMSS->cuotatrabajador * $diasTrabajados * $SBC) / 100;
                    $totalIMSS = $totalIMSS + $sumaIMSS;
                }
            }

            return $collection = collect(['003T', 'IMSS TRABAJADOR', $totalIMSS, $valorClvEmpleado]);
        }
    }

    public function impuestosPatron(Request $request)
    {
        $CollectionPatron = collect();
        $empleadoporClave = $request->empclave;

        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        //Impuesto Estatal
        $impuestoEstatal = ($request->percepciones * 3) / 100;
        $CollectionPatron->push(["clave_concepto" => "004I", "concepto" => "IMPUESTO ESTATAL", "monto" => number_format($impuestoEstatal, 2), "clave_empleado" => $empleadoporClave]);

        //IMSS Patronal
        $empleados = DB::connection('DB_Serverr')->table('empleados')
            ->select('id_emp', 'sueldo_diario', 'dias')
            ->where('clave_empleado', '=', $request->clvEmp)
            ->first();

        $at = $this->anios_trabajados($empleados->id_emp);

        $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')
            ->select('dias')
            ->where('anio', '=', $at)
            ->first();

        $SBC = $this->SBC($prestaciones->dias, $empleados->sueldo_diario, $empleados->id_emp);
        $uma = $this->uma();
        $diasTrabajados = $this->dias_trabajados($request->clvEmp);
        $ims = IMSS::select('cuotapatron', 'id_imss', 'base', 'claveImss')->get();
        $primaRiesgo = $this->ahorro_riesgo();

        $totalIMSS = 0;
        foreach ($ims as $cuotasIMSS) {
            switch ($cuotasIMSS->claveImss) {
                    //Riesgo de Trabajo
                case 'IRT1':
                    $sumaIMSS = ($primaRiesgo->primaRiesgo * $diasTrabajados * $SBC) / 100;
                    $totalIMSS = $totalIMSS + $sumaIMSS;
                    break;
                case 'IEM1':
                    $sumaIMSS = ($cuotasIMSS->cuotapatron * $diasTrabajados * $uma->porcentaje_uma) / 100;
                    $totalIMSS = $totalIMSS + $sumaIMSS;
                    break;
                case 'IEM2':
                    $diferenciaSueldo = $SBC - ($uma->porcentaje_uma * 3);
                    if ($diferenciaSueldo > 0) {
                        $sumaIMSS = ($cuotasIMSS->cuotapatron * $diasTrabajados * $diferenciaSueldo) / 100;
                    } else {
                        $sumaIMSS = 0;
                    }
                    $totalIMSS = $totalIMSS + $sumaIMSS;
                    break;
                    //Cesantía
                case 'IRC2':
                    $imssPatron = $SBC / $uma->porcentaje_uma;
                    $porcentajePatron = BaseVejez::select('cuotapatronal_vejez')
                        ->where([
                            ['de_salariocotizacion_vejez', '<', $imssPatron],
                            ['hasta_salariocotizacion_vejez', '>', $imssPatron]
                        ])
                        ->first();
                    $cesantia = ($porcentajePatron->cuotapatronal_vejez * $diasTrabajados * $SBC) / 100;
                    $CollectionPatron->push(["clave_concepto" => "008I", "concepto" => "CESANTÍA", "monto" => number_format($cesantia, 2), "clave_empleado" => $empleadoporClave]);
                    break;
                    //Fondo Retiro
                case 'IRC1':
                    $retiro = ($cuotasIMSS->cuotapatron * $diasTrabajados * $SBC) / 100;
                    $CollectionPatron->push(["clave_concepto" => "007I", "concepto" => "FONDO RETIRO", "monto" => number_format($retiro, 2), "clave_empleado" => $empleadoporClave]);
                    break;
                    //Infonavit Patrón
                case 'IIN1':
                    $infonavitEmpresa = ($cuotasIMSS->cuotapatron * $diasTrabajados * $SBC) / 100;
                    $CollectionPatron->push(["clave_concepto" => "006I", "concepto" => "INFONAVIT EMPRESA", "monto" => number_format($infonavitEmpresa, 2), "clave_empleado" => $empleadoporClave]);
                    break;
                default:
                    $sumaIMSS = ($cuotasIMSS->cuotapatron * $diasTrabajados * $SBC) / 100;
                    $totalIMSS = $totalIMSS + $sumaIMSS;
                    break;
            }
        }

        $CollectionPatron->push(["clave_concepto" => "005I", "concepto" => "IMSS PATRÓN", "monto" => number_format($totalIMSS, 2), "clave_empleado" => $empleadoporClave]);
        return $CollectionPatron;
    }

    public function SBC($diasVacaciones, $sueldoDiario, $idEmp)
    {
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $datosPrestaciones = $this->aguinaldo_vacaciones_prima($idEmp);

        $primaAguinaldo = $datosPrestaciones->aguinaldo / 365;
        $primaVacaciones = (($diasVacaciones * $datosPrestaciones->prima_vacacional) / 365) / 100;
        $FactorIntegracion = $primaAguinaldo + $primaVacaciones + 1;
        $SBC = $sueldoDiario * $FactorIntegracion;

        DB::connection('DB_Serverr')->table('empleados')
            ->where('id_emp', $idEmp)
            ->update(['sueldo_integrado' => number_format($SBC, 4)]);

        return $SBC;
    }

    public function create($id_emp)
    {
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $empleados = DB::connection('DB_Serverr')->table('empleados')
            ->join('departamentos', 'departamentos.clave_departamento', '=', 'empleados.clave_departamento')
            ->join('puestos', 'puestos.clave_puesto', '=', 'empleados.clave_puesto')
            ->join('areas', 'areas.clave_area', '=', 'departamentos.clave_area')
            ->select('empleados.*', 'areas.*', 'departamentos.*', 'puestos.*')
            ->get();

        $conceptos = DB::connection('DB_Serverr')->table('conceptos')
            ->select('clave_concepto', 'isr', 'isr_uma', 'isr_porcentaje')
            ->where('seleccionado', '=', 1)
            ->get();

        $percepcionesImss = Collect();
        $ControlPrenomina = collect();
        foreach ($empleados as $emp) {
            foreach ($conceptos as $concep) {
                if ($concep->clave_concepto == "001P") {
                    $resultaSueldo = $this->sueldo($emp->id_emp, $emp->clave_empleado);
                    if ($resultaSueldo != 0) {
                        $Gravado = $resultaSueldo;
                        $Excento = 0;
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }

                    $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "001P", "concepto" => "SUELDO", "monto" => $resultaSueldo, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                    $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "SUELDO", "total" => $Gravado]);
                } else if ($concep->clave_concepto == "002P") {
                    $resultaHoraExtraDoble = $this->criterio_horas($emp->id_emp, $emp->clave_empleado);
                    if ($resultaHoraExtraDoble != 0) {
                        $calculosISR = $this->calcularGravado($concep, $resultaHoraExtraDoble['horasDoblesGenerales']);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "002P", "concepto" => "HORAS EXTRAS DOBLES", "monto" => $resultaHoraExtraDoble["horasDoblesGenerales"], "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "003P") {
                    $resultaHoraExtraTriple = $this->criterio_horas($emp->id_emp, $emp->clave_empleado);
                    if ($resultaHoraExtraTriple != 0) {
                        $Gravado = $resultaHoraExtraTriple['horasTriplesGenerales'];
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "003P", "concepto" => "HORAS EXTRAS TRIPLES", "monto" => $resultaHoraExtraTriple["horasTriplesGenerales"], "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "HORAS EXTRAS TRIPLES", "total" => $resultaHoraExtraTriple["horasTriplesGenerales"]]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "004P") {
                    $resultaFondoAhorro = $this->fondoAhorro($resultaSueldo);
                    if ($resultaFondoAhorro != 0) {
                        $Gravado = 0;
                        $Excento = $resultaFondoAhorro;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "004P", "concepto" => "FONDO DE AHORRO EMPRESA", "monto" => $resultaFondoAhorro, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                    }
                } else if ($concep->clave_concepto == "005P") {
                    $resultaPremioPunt = $this->premioPunt($emp->id_emp, $emp->clave_empleado);
                    if ($resultaPremioPunt != 0) {
                        $Gravado = $resultaPremioPunt;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "005P", "concepto" => "PREMIO DE PUNTUALIDAD", "monto" => $resultaPremioPunt, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "006P") {
                    $resultaPremioAsis = $this->premioPunt($emp->id_emp, $emp->clave_empleado);
                    if ($resultaPremioAsis != 0) {
                        $Gravado = $resultaPremioAsis;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "006P", "concepto" => "PREMIO DE ASISTENCIA", "monto" => $resultaPremioAsis, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "007P") {
                    $resultaPrimaVacacional = $this->primaVacacional($emp->id_emp, $emp->clave_empleado);
                    if ($resultaPrimaVacacional != 0) {
                        $uma = $this->uma();
                        if (is_null($uma)) {
                            return back()->with('uma', 'El valor de "uma" no ha sido actualizado');
                        }

                        $limite = $uma->porcentaje_uma * 15;
                        if ($resultaPrimaVacacional < $limite) {
                            $Gravado = 0;
                            $Excento = $resultaPrimaVacacional;
                        } else {
                            $Gravado = $resultaPrimaVacacional - $limite;
                            $Excento = $limite;
                        }

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "007P", "concepto" => "PRIMA VACACIONAL", "monto" => $resultaPrimaVacacional, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "008P") {
                    $resultaPrimaDominical = $this->primaDominical($emp->id_emp);
                    if ($resultaPrimaDominical != 0) {
                        $calculosISR = $this->calcularGravado($concep, $resultaPrimaDominical);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "008P", "concepto" => "PRIMA DOMINICAL", "monto" => $resultaPrimaDominical, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "PRIMA DOMINICAL", "total" => $resultaPrimaDominical]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "009P") {
                    $montoCompensacion = $this->adicionales($emp->clave_empleado, '009P');
                    if ($montoCompensacion != 0) {
                        $calculosISR = $this->calcularGravado($concep, $montoCompensacion);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "009P", "concepto" => "COMPENSACION", "monto" => $montoCompensacion, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "COMPENSACION", "total" => $montoCompensacion]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "010P") {
                    $montoDiferencia = $this->adicionales($emp->clave_empleado, '010P');
                    if ($montoDiferencia != 0) {
                        $calculosISR = $this->calcularGravado($concep, $montoDiferencia);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "009P", "concepto" => "DIFERENCIA DE SUELDO", "monto" => $montoDiferencia, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "DIFERENCIA DE SUELDO", "total" => $montoDiferencia]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "011P") {
                } else if ($concep->clave_concepto == "012P") {
                } else if ($concep->clave_concepto == "013P") {
                    $Vacaciones = $this->pagoVacaciones($emp->id_emp, $emp->clave_empleado);
                    if ($Vacaciones != 0) {
                        $Gravado = $Vacaciones;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "013P", "concepto" => "VACACIONES", "monto" => $Vacaciones, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "VACACIONES", "total" => $Vacaciones]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "015P") {
                    $montoComisiones = $this->adicionales($emp->clave_empleado, '015P');
                    if ($montoComisiones != 0) {
                        $calculosISR = $this->calcularGravado($concep, $montoComisiones);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "015P", "concepto" => "COMISIONES", "monto" => $montoComisiones, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "COMISIONES", "total" => $montoComisiones]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "016P") {
                } else if ($concep->clave_concepto == "017P") {
                    $montoComisiones = $this->adicionales($emp->clave_empleado, '017P');
                    if ($montoComisiones != 0) {
                        $calculosISR = $this->calcularGravado($concep, $montoComisiones);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "017P", "concepto" => "BONO DE PRODUCTIVIDAD", "monto" => $montoComisiones, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "P"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "BONO DE PRODUCTIVIDAD", "total" => $montoComisiones]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "018P") {
                } else if ($concep->clave_concepto == "019P") {
                    $montoRetroactivo = DB::connection('DB_Serverr')->table('conceptos')
                        ->select('monto')
                        ->where('clave_concepto', '019P')
                        ->first();

                    $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "SUELDO RETROACTIVO", "total" => $montoRetroactivo->monto]);
                } else if ($concep->clave_concepto == "020P") {
                } else if ($concep->clave_concepto == "021P") {
                } else if ($concep->clave_concepto == "022P") {
                } else if ($concep->clave_concepto == "023P") {
                } else if ($concep->clave_concepto == "024P") {
                    $resultaSueldo = $this->sueldo($emp->id_emp, $emp->clave_empleado);
                    $montoDescanso = $resultaSueldo * 2;

                    $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "TRABAJO EN DIAS DE DESCANSO", "total" => $montoDescanso]);
                } else if ($concep->clave_concepto == "001D") {
                    $resultaAusentismoDed = $this->ausentismoIncapacidadDeduccion($emp->id_emp, $emp->clave_empleado);
                    if ($resultaAusentismoDed != 0) {
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "001D", "concepto" => "AUSENTISMO", "monto" => $resultaAusentismoDed, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                    }
                } else if ($concep->clave_concepto == "002D") {
                    $resultaIncapacidadDed = $this->ausentismoIncapacidadDeduccion($emp->id_emp, $emp->clave_empleado);
                    $Gravado = 0;
                    $Excento = 0;

                    $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "002D", "concepto" => "INCAPACIDAD", "monto" => $resultaIncapacidadDed, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                } else if ($concep->clave_concepto == "003D") {
                    $resultaFondoAhorroTrabajador = $this->fondoAhorro($resultaSueldo);
                    if ($resultaFondoAhorroTrabajador != 0) {
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "003D", "concepto" => "FONDO DE AHORRO TRABAJADOR", "monto" => $resultaFondoAhorroTrabajador, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                    }
                } else if ($concep->clave_concepto == "004D") {
                    $resultaDeduccionFondo = $this->fondoAhorro($resultaSueldo);
                    if ($resultaDeduccionFondo != 0) {
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "004D", "concepto" => "DEDUCCION FONDO DE AHORRO EMPRESA", "monto" => $resultaDeduccionFondo, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                    }
                } else if ($concep->clave_concepto == "005D") {
                } else if ($concep->clave_concepto == "006D") {
                } else if ($concep->clave_concepto == "007D") {
                    $resultadoInfonavit = $this->creditoInfonavit($emp->id_emp, $emp->clave_empleado, '007D');
                    if ($resultadoInfonavit != 0) {
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "007D", "concepto" => "CREDITO INFONAVIT CANTIDAD", "monto" => $resultadoInfonavit, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                    }
                } else if ($concep->clave_concepto == "008D") {
                } else if ($concep->clave_concepto == "009D") {
                } else if ($concep->clave_concepto == "010D") {
                } else if ($concep->clave_concepto == "011D") {
                    $montoUniformes = $this->adicionales($emp->clave_empleado, '011D');
                    if ($montoUniformes != 0) {
                        $calculosISR = $this->calcularGravado($concep, $montoUniformes);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "012D", "concepto" => "UNIFORMES", "monto" => $montoUniformes, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "UNIFORMES", "total" => $montoUniformes]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "012D") {
                    $montoPrestamos = $this->adicionales($emp->clave_empleado, '012D');
                    if ($montoPrestamos != 0) {
                        $calculosISR = $this->calcularGravado($concep, $montoPrestamos);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "012D", "concepto" => "PRESTAMOS", "monto" => $montoPrestamos, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "PRESTAMOS", "total" => $montoPrestamos]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "013D") {
                    $montoLentes = $this->adicionales($emp->clave_empleado, '013D');
                    if ($montoLentes != 0) {
                        $calculosISR = $this->calcularGravado($concep, $montoLentes);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "013D", "concepto" => "DESCUENTO DE LENTES", "monto" => $montoLentes, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                        $percepcionesImss->push(["clave_empleado" => $emp->clave_empleado, "concepto" => "DESCUENTO DE LENTES", "total" => $montoLentes]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "014D") {
                } else if ($concep->clave_concepto == "015D") {
                } else if ($concep->clave_concepto == "016D") {
                } else if ($concep->clave_concepto == "017D") {
                } else if ($concep->clave_concepto == "018D") {
                } else if ($concep->clave_concepto == "019D") {
                    $montoRetardo = $this->adicionales($emp->clave_empleado, '019D');
                    if ($montoRetardo != 0) {
                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "019D", "concepto" => "RETARDO", "monto" => $montoRetardo, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                    } else {
                        $Gravado = 0;
                        $Excento = 0;
                    }
                } else if ($concep->clave_concepto == "021D") {
                    $resultadoInfonavit = $this->creditoInfonavit($emp->id_emp, $emp->clave_empleado, '021D');
                    if ($resultadoInfonavit != 0) {
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "021D", "concepto" => "CREDITO INFONAVIT CANTIDAD", "monto" => $resultadoInfonavit, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                    }
                } else if ($concep->clave_concepto == "022D") {
                    $resultadoSeguroInfonavit = $this->adicionales($emp->clave_empleado, '022D');
                    if ($resultadoSeguroInfonavit != 0) {
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "022D", "concepto" => "SEGURO DE VIVIENDA INFONAVIT", "monto" => $resultadoSeguroInfonavit, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                    }
                } else if ($concep->clave_concepto == "023D") {
                    $resultadoInfonavitUMI = $this->creditoInfonavit($emp->id_emp, $emp->clave_empleado, '023D');
                    if ($resultadoInfonavitUMI != 0) {
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado" => $emp->clave_empleado, "clave_concepto" => "023D", "concepto" => "CREDITO INFONAVIT VSM", "monto" => $resultadoInfonavitUMI, "gravable" => $Gravado, "excento" => $Excento, "tipo" => "D"]);
                    }
                }
            }
        }

        $clave = DB::connection('DB_Serverr')->table('empleados')
            ->select('clave_empleado', 'nombre', 'apellido_paterno', 'apellido_materno', 'id_emp')
            ->where('id_emp', '=', $id_emp)
            ->first();

        $sumaImss = $percepcionesImss->where('clave_empleado', $clave->clave_empleado)->sum('total');

        $calculospercepciones = $ControlPrenomina->where('clave_empleado', $clave->clave_empleado);
        $portipopercepciones = $calculospercepciones->where('tipo', 'P');

        $calculosdeducciones = $ControlPrenomina->where('clave_empleado', $clave->clave_empleado);
        $portipodeducciones = $calculosdeducciones->where('tipo', 'D');

        return view('prenomina.controlPrenomina', compact('empleados', 'portipopercepciones', 'portipodeducciones', 'ControlPrenomina', 'sumaImss', 'clave'));
    }

    public function exportExcel()
    {
        return (new PrenominaExport)->download('prenomina.xlsx');
    }

    public function pagoVacaciones($idEmp, $claveEmp)
    {
        $sd = $this->sueldo_horas($idEmp);
        $diasTomadosPeriodo = $this->vacacionesEmpleadoPeriodo($claveEmp);

        $diasVacaciones = $diasTomadosPeriodo->cantidad * $sd->sueldo_diario;

        return $diasVacaciones;
    }

    public function vacacionesEmpleado($idEmp, $claveEmp)
    {
        $at = $this->anios_trabajados($idEmp);

        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
            ->select('fecha_alta')
            ->where('id_emp', '=', $idEmp)
            ->first();

        $fecha_actual = now()->toDateString();
        if ($at == 0) {
            $fechaInicio = $alta_trabajador->fecha_alta;
        } else {
            $fechaInicio = date('Y-m-d', strtotime($alta_trabajador->fecha_alta . "+" . $at . " years"));
        }

        $periodos = DB::connection('DB_Serverr')->table('periodos')
            ->select('numero')
            ->where([
                ['fecha_inicio', '>', $fechaInicio],
                ['fecha_fin', '<', $fecha_actual],
                ['status_periodo', '=', 1]
            ])
            ->get();

        $arrayPeriodos = $periodos->pluck('numero')->toArray();
        $diasVacacionesTom = DB::connection('DB_Serverr')->table('incidencias')
            ->select(DB::raw('CASE WHEN COUNT(`cantidad`) = " " THEN 0 ELSE SUM(`cantidad`) END as cantidad'))
            ->where([
                ['clave_concepto', '=', '013P'],
                ['clave_empleado', '=', $claveEmp]
            ])
            ->whereIn('periodo_incidencia', $arrayPeriodos)
            ->first();

        return $diasVacacionesTom;
    }

    public function vacacionesEmpleadoPeriodo($claveEmp)
    {
        $num_periodo = Session::get('num_periodo');
        $diasVacacionesTom = DB::connection('DB_Serverr')->table('incidencias')
            ->select(DB::raw('CASE WHEN COUNT(`cantidad`) = " " THEN 0 ELSE SUM(`cantidad`) END as cantidad'))
            ->where([
                ['clave_concepto', '=', '013P'],
                ['clave_empleado', '=', $claveEmp],
                ['periodo_incidencia', '=', $num_periodo]
            ])
            ->first();

        return $diasVacacionesTom;
    }

    /* Funciones variable general */
    public function sueldo_horas($idEmp)
    {
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos_empleado = DB::connection('DB_Serverr')->table('empleados')
            ->select('sueldo_diario', 'horas_diarias')
            ->where('id_emp', '=', $idEmp)
            ->first();

        return $datos_empleado;
    }

    public function jornadaTrabajo()
    {
        $num_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $periodos = DB::connection('DB_Serverr')->table('periodos')
            ->select('diasPeriodo', 'fecha_inicio', 'fecha_fin')
            ->where([
                ['numero', '=', $num_periodo],
                ['status_periodo', '=', 1]
            ])
            ->first();

        return $periodos;
    }

    public function anios_trabajados($idEmp)
    {
        $num_p = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $fecha_inicial = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_inicio')
            ->where([
                ['numero', '=', $num_p],
                ['status_periodo', '=', 1]
            ])
            ->first();

        $inicial = now()->parse($fecha_inicial->fecha_inicio);

        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
            ->select('fecha_alta')
            ->where('id_emp', '=', $idEmp)
            ->first();

        $alta = now()->parse($alta_trabajador->fecha_alta);
        $diferencia = $inicial->DiffInYears($alta);

        if ($diferencia == 0) {
            $diferencia = 1;
        }

        return $diferencia;
    }

    public function ausentismo($claveEmp)
    {
        $num_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $acumulado_ausen = DB::connection('DB_Serverr')->table('ausentismos')
            ->select(DB::raw('CASE WHEN COUNT(`cantidad_ausentismo`) = "" THEN 0 ELSE SUM(`cantidad_ausentismo`) END as conteoDias'))
            ->where([
                ['clave_empleado', '=', $claveEmp],
                ['ausentismo_periodo', '=', $num_periodo]
            ])
            ->whereIn('clave_concepto', ['001D', '002D'])
            ->first();

        return $acumulado_ausen;
    }

    public function dias_trabajados($claveEmp)
    {
        $jt = $this->jornadaTrabajo();
        $ausentismo = $this->ausentismo($claveEmp);
        $diasTrabajados = $jt->diasPeriodo - $ausentismo->conteoDias;

        return $diasTrabajados;
    }

    public function obtenerUMI()
    {
        $umi = DB::table('umiinfonavit')
            ->select('valorInfonavit')
            ->orderBy('anio', 'DESC')
            ->first();

        return $umi;
    }

    public function uma()
    {
        $jt = $this->jornadaTrabajo();
        $uma = Umas::select('porcentaje_uma')
            ->where([
                ['periodoinicio_uma', '<=', $jt->fecha_inicio],
                ['periodofin_uma', '>', $jt->fecha_fin]
            ])
            ->first();

        return $uma;
    }

    public function ahorro_riesgo()
    {
        $clv = Session::get('clave_empresa');
        $datos_empresa = Empresa::select('primaRiesgo', 'porcentajeAhorro', 'region')
            ->where('clave', '=', $clv)
            ->first();

        return $datos_empresa;
    }

    public function aguinaldo_vacaciones_prima($idEmp)
    {
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $at = $this->anios_trabajados($idEmp);
        $datos_prestaciones = DB::connection('DB_Serverr')->table('prestaciones')
            ->select('aguinaldo', 'dias', 'prima_vacacional')
            ->where('anio', '=', $at)
            ->first();

        if (is_null($datos_prestaciones)) {
            $datos_prestaciones = DB::connection('DB_Serverr')->table('prestaciones')
                ->select('aguinaldo', 'dias', 'prima_vacacional')
                ->where('anio', '=', 1)
                ->first();
        }

        return $datos_prestaciones;
    }

    public function sueldoBruto($idEmp, $claveEmp)
    {
        $identificador_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $sd = $this->sueldo_horas($idEmp);
        $diasPeriodo = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_inicio', 'fecha_fin', 'diasPeriodo')
            ->where([
                ['numero', '=', $identificador_periodo],
                ['status_periodo', '=', 1]
            ])
            ->first();

        $diasTotalesTrabajados = $sd->sueldo_diario * $diasPeriodo->diasPeriodo;

        return $diasTotalesTrabajados;
    }

    public function sueldo($idEmp, $claveEmp)
    {
        $sd = $this->sueldo_horas($idEmp);
        $jt = $this->dias_trabajados($claveEmp);
        $tiempo = $this->vacacionesEmpleado($idEmp, $claveEmp);

        $diasTotalesVacaciones = $this->aguinaldo_vacaciones_prima($idEmp);
        $diasTomadosPeriodo = $this->vacacionesEmpleadoPeriodo($claveEmp);

        $diasTotalesTrabajados = 0;
        if ($diasTotalesVacaciones->dias >= $tiempo->cantidad) {
            $diasTotalesTrabajados = ($jt - $diasTomadosPeriodo->cantidad) * $sd->sueldo_diario;
        } else {
            $diasTotalesTrabajados = $sd->sueldo_diario * $jt;
        }

        return $diasTotalesTrabajados;
    }

    public function fondoAhorro($sueldoBruto)
    {
        $region = $this->ahorro_riesgo();
        $totalFondo = ($region->porcentajeAhorro * $sueldoBruto) / 100;

        $importeRegion = SalarioMinimo::select('importe')
            ->where('region', $region->region)
            ->first();

        if ($totalFondo > $importeRegion->importe * 15) {
            $totalFondo = $importeRegion->importe * 15;
        }

        return $totalFondo;
    }

    public function premioPunt($idEmp, $claveEmp)
    {
        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);

        $premioPuntualidad = $sd->sueldo_diario * ($diasTrabajados) * 0.1;

        return $premioPuntualidad;
    }

    public function primaVacacional($idEmp, $claveEmp)
    {
        $sd = $this->sueldo_horas($idEmp);
        $dv = $this->aguinaldo_vacaciones_prima($idEmp);
        $diasTomadosPeriodo = $this->vacacionesEmpleadoPeriodo($claveEmp);

        $primaVacacional = (($sd->sueldo_diario * $diasTomadosPeriodo->cantidad) * $dv->prima_vacacional) / 100;

        return $primaVacacional;
    }

    public function primaDominical($idEmp)
    {
        $sd = $this->sueldo_horas($idEmp);
        $primaDominical = $sd->sueldo_diario * 0.25;

        return $primaDominical;
    }

    public function ausentismoIncapacidadDeduccion($idEmp, $claveEmp)
    {
        $identificador_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $manipulacion_fechas = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_inicio', 'fecha_fin', 'diasPeriodo')
            ->where([
                ['numero', '=', $identificador_periodo],
                ['status_periodo', '=', 1]
            ])
            ->first();

        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);

        $diasTotales = $manipulacion_fechas->diasPeriodo - $diasTrabajados;
        $ausentismoIncapacidad = $sd->sueldo_diario * $diasTotales;

        return $ausentismoIncapacidad;
    }

    public function criterio_horas($idEmp, $claveEmp)
    {
        $identificador_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $manipulacion_fechas = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_inicio', 'fecha_fin', 'diasPeriodo')
            ->where([
                ['numero', '=', $identificador_periodo],
                ['status_periodo', '=', 1]
            ])
            ->first();

        $conteohoras = DB::connection('DB_Serverr')->table('tiempo_extra')
            ->select(DB::raw('CASE WHEN COUNT(`cantidad_tiempo`) = "" THEN 0 ELSE SUM(`cantidad_tiempo`) END as cantidad_tiempo'))
            ->where('periodo_extra', '=', $identificador_periodo)
            ->where('clave_empleado', '=', $claveEmp)
            ->first();

        if ($conteohoras->cantidad_tiempo != 0) {
            $horasExtras = DB::connection('DB_Serverr')->table('tiempo_extra')
                ->select('fecha_extra', DB::raw('SUM(cantidad_tiempo) as cantidad_tiempo'))
                ->where('periodo_extra', '=', $identificador_periodo)
                ->where('clave_empleado', '=', $claveEmp)
                ->whereBetween('fecha_extra', array($manipulacion_fechas->fecha_inicio, $manipulacion_fechas->fecha_fin))
                > groupBy('fecha_extra')
                ->get();

            $inicio_semana1 = $manipulacion_fechas->fecha_inicio;
            $horasTriples = 0;
            $horasTriplesGenerales = 0;
            $horasDobles = 0;
            $horasDoblesGenerales = 0;
            $k = 0; // dias semana

            if ($manipulacion_fechas->diasPeriodo < 8) {
                foreach ($horasExtras as $horas) {
                    if ($horas->fecha_extra < date('Y-m-d', strtotime($inicio_semana1 . "+ 7 days"))) {
                        if ($k < 3) {
                            if ($horas->cantidad_tiempo > 3) {
                                $horasTriples = $horas->cantidad_tiempo - 3;
                                $horasDobles = 3;
                            } else {
                                $horasDobles = $horas->cantidad_tiempo;
                                $horasTriples = 0;
                            }
                            $k++;
                        } else {
                            $horasDobles = 0;
                            $horasTriples = $horas->cantidad_tiempo;
                        }
                        $horasDoblesGenerales = $horasDoblesGenerales + $horasDobles;
                        $horasTriplesGenerales = $horasTriplesGenerales + $horasTriples;
                        //echo $horasDobles.'|'.$horasTriples.'|'.$horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                    }
                }

                //echo $horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                $sd = $this->sueldo_horas($idEmp);
                $precioHoraExtra = $sd->sueldo_diario / $sd->horas_diarias;
                $horasDoblesGenerales = $horasDoblesGenerales * ($precioHoraExtra * 2);
                $horasTriplesGenerales = $horasTriplesGenerales * ($precioHoraExtra * 3);
                //echo $horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                return compact('horasDoblesGenerales', 'horasTriplesGenerales');
            } else {
                foreach ($horasExtras as $horas) {
                    if ($horas->fecha_extra < date('Y-m-d', strtotime($inicio_semana1 . "+ 7 days"))) {
                        if ($k < 3) {
                            if ($horas->cantidad_tiempo > 3) {
                                $horasTriples = $horas->cantidad_tiempo - 3;
                                $horasDobles = 3;
                            } else {
                                $horasDobles = $horas->cantidad_tiempo;
                                $horasTriples = 0;
                            }
                            $k++;
                        } else {
                            $horasDobles = 0;
                            $horasTriples = $horas->cantidad_tiempo;
                        }
                        $horasDoblesGenerales = $horasDoblesGenerales + $horasDobles;
                        $horasTriplesGenerales = $horasTriplesGenerales + $horasTriples;
                        //echo $horasDobles.'|'.$horasTriples.'|'.$horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                    } else {
                        $k = 1;
                        $horasDobles = 0;
                        $horasTriples = 0;

                        if ($horas->cantidad_tiempo > 3) {
                            $horasTriples = $horas->cantidad_tiempo - 3;
                            $horasDobles = 3;
                        } else {
                            $horasDobles = $horas->cantidad_tiempo;
                            $horasTriples = 0;
                        }
                        $horasDoblesGenerales = $horasDoblesGenerales + $horasDobles;
                        $horasTriplesGenerales = $horasTriplesGenerales + $horasTriples;

                        if (date('Y-m-d', strtotime($inicio_semana1 . "+ 7 days")) < $manipulacion_fechas->fecha_fin) {
                            $inicio_semana1 = date('Y-m-d', strtotime($inicio_semana1 . "+ 7 days"));
                        }
                        //echo $horasDobles.'|'.$horasTriples.'|'.$horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                    }
                }
                //echo $horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                $sd = $this->sueldo_horas($idEmp);
                $precioHoraExtra = $sd->sueldo_diario / $sd->horas_diarias;
                $horasDoblesGenerales = $horasDoblesGenerales * ($precioHoraExtra * 2);
                $horasTriplesGenerales = $horasTriplesGenerales * ($precioHoraExtra * 3);
                //echo "1.".$horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                return compact('horasDoblesGenerales', 'horasTriplesGenerales');
            }
        } else {
            $horasDoblesGenerales = 0;
            $horasTriplesGenerales = 0;
            return compact('horasDoblesGenerales', 'horasTriplesGenerales');
        }
    }

    public function calcularGravado($datosPercepcion, $totalPercepcion)
    {
        $UMAExcentas = $datosPercepcion->isr_uma * 89;
        $exceso = $totalPercepcion - $UMAExcentas;
        $percepcionGravable = (($UMAExcentas * $datosPercepcion->isr_porcentaje) / 100) + $exceso;
        $percepcionExcenta = ($UMAExcentas * $datosPercepcion->isr_porcentaje) / 100;

        return compact('percepcionGravable', 'percepcionExcenta');
    }

    public function adicionales($claveEmp, $claveConcepto)
    {
        $nperiodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $totalAdicional = DB::connection('DB_Serverr')->table('incidencias')
            ->select(DB::raw('CASE WHEN COUNT(importe) = " " THEN 0 ELSE SUM(importe) END as monto'))
            ->where([
                ['clave_concepto', '=', $claveConcepto],
                ['clave_empleado', '=', $claveEmp],
                ['periodo_incidencia', '=', $nperiodo]
            ])->first();

        return $totalAdicional->monto;
    }

    public function creditoInfonavit($idEmp, $claveEmp, $claveConcepto)
    {
        $periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $conteoInfonavit = DB::connection('DB_Serverr')->table('incidencias')
            ->where([
                ['clave_empleado', '=', $claveEmp],
                ['periodo_incidencia', '=', $periodo]
            ])
            ->whereIn('clave_concepto', ['007D', '021D', '023D'])
            ->count();

        if ($conteoInfonavit != 0) {
            $infonavit = DB::connection('DB_Serverr')->table('incidencias')
                ->select('monto', 'clave_concepto', 'cantidad')
                ->where([
                    ['clave_empleado', '=', $claveEmp],
                    ['periodo_incidencia', '=', $periodo],
                    ['clave_concepto', '=', $claveConcepto]
                ])->first();

            if ($infonavit) {
                if ($infonavit->clave_concepto == '007D') {
                    $infonavitTotal = $infonavit->monto;
                    return $infonavitTotal;
                } else if ($infonavit->clave_concepto == '021D') {
                    $porcentajeInfonavit = $infonavit->monto;
                    $sueldo = $this->sueldo($idEmp, $claveEmp);
                    $calculoInfonavit = ($sueldo * $porcentajeInfonavit) / 100;
                    return $calculoInfonavit;
                } else if ($infonavit->clave_concepto == '023D') {
                    $umi = $this->obtenerUMI();
                    $calculoUMI = $umi->valorInfonavit * $infonavit->cantidad;
                    return $calculoUMI;
                }
            }
        }
    }
}