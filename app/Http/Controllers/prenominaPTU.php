<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Umas;
use App\Subsidio;
use App\Retenciones;
use App\Exports\AguinaldoExport;
use Session;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse; 
use Maatwebsites\Excel\Facades\Excel;

class prenominaPTU extends Controller{
    public function conectar($clv){
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

    public function index(Request $request){
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        
        $accion = $request->acciones;
        $empleados = DB::connection('DB_Serverr')->table('empleados')
                     ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                     ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                     ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                     ->select('empleados.*','departamentos.*','areas.*','puestos.*')
                     ->get();

        return view('ptuNomina.controlPTU', compact('empleados'));
    }

    public function create(Request $request){
        $PTUSin = Collect();
        $PTUCon = Collect();
        $ISRFinal = Collect();
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $time = strtotime('-1 year', time());
        $fechaInicio = date('Y-01-01', $time);
        $fechaFin = date('Y-12-31', $time);

        $empleados = DB::connection('DB_Serverr')->table('empleados')
                     ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                     ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                     ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                     ->select('empleados.*','areas.*','departamentos.*','puestos.*')
                     ->get();

        //Total de días de todos los empleados
        $totalDias = 0;
        foreach($empleados as $emp){
            $sumAusencias = DB::connection('DB_Serverr')->table('ausentismos')
                            ->select(DB::raw('CASE WHEN COUNT(cantidad_ausentismo) = " " THEN 0 ELSE SUM(cantidad_ausentismo) END as sumaAusencias'))
                            ->where([
                                ['clave_concepto','=','001D'],
                                ['clave_empleado','=',$emp->clave_empleado]
                            ])
                            ->whereBetween('fecha_ausentismo', [$fechaInicio,$fechaFin])
                            ->first();

            $totalDias = $totalDias + (365-$sumAusencias->sumaAusencias);
        }

        $totalDias = $totalDias + $request->diasLaborados;

        //Total de días por empleado
        $sumAusenciasEmp = DB::connection('DB_Serverr')->table('ausentismos')
                            ->select(DB::raw('CASE WHEN COUNT(cantidad_ausentismo) = " " THEN 0 ELSE 365 - SUM(cantidad_ausentismo) END as sumaAusenciasEmp'))
                            ->where([
                                ['clave_concepto','=','001D'],
                                ['clave_empleado','=',$request->clvEmp]
                            ])
                            ->whereBetween('fecha_ausentismo', [$fechaInicio,$fechaFin])
                            ->first();

        //Total de ingresos de los empleados
        $TotalIng = 0;
        foreach($empleados as $emp){
            $ingTotalEmps = DB::connection('DB_Serverr')->table('prenomina')
                            ->join('periodos','prenomina.noPrenomina','=','numero')
                            ->where([
                                ['prenomina.clave_empleado','=',$emp->clave_empleado],
                                ['prenomina.clave_concepto','=','001S'],
                                ['periodos.fecha_inicio','>=',$fechaInicio],
                                ['periodos.fecha_fin','<=',$fechaFin]
                                ])
                            ->sum('prenomina.monto');

            if($ingTotalEmps > $request->ingresosEmp){
                $IngNorm = $request->ingresosEmp*1.1;
            }else{
                $IngNorm = $ingTotalEmps;
            }

            $TotalIng = $TotalIng + $IngNorm;
        }

        $TotalIng = $TotalIng + $request->ingresosEmp;

        //Total de ingresos por empleado
        $ingTotalEmp = DB::connection('DB_Serverr')->table('prenomina')
                       ->join('periodos','prenomina.noPrenomina','=','numero')
                       ->where([
                           ['prenomina.clave_empleado','=',$request->clvEmp],
                           ['prenomina.clave_concepto','=','001S'],
                           ['periodos.fecha_inicio','>=',$fechaInicio],
                           ['periodos.fecha_fin','<=',$fechaFin]
                           ])
                       ->sum('prenomina.monto');

        if($sumAusenciasEmp->sumaAusenciasEmp == 0){
            $sumAuEmp = 365;
        }else{
            $sumAuEmp = $sumAusenciasEmp->sumaAusenciasEmp;
        }

        $factorDias = $sumAuEmp/$totalDias;

        if($ingTotalEmp > $request->ingresosEmp){
            $IngNorm = $request->ingresosEmp*1.1;
        }else{
            $IngNorm = $ingTotalEmp;
        }

        $FactIng = $IngNorm/$TotalIng;
        $PTUSueldo = ($request->totalPTU / 2) * $FactIng;
        $PTUDias = ($request->totalPTU / 2) * $factorDias;
        $TotalPTUEmp = $PTUDias + $PTUSueldo;

        $uma = $this->uma();
        $at = $this->anios_trabajados($request->clvEmp);
        $sd = $this->sueldo_horas($request->clvEmp);

        $PTUExcento = $uma->porcentaje_uma*15;
        if($PTUExcento < $TotalPTUEmp){
            $PTUGrav = $TotalPTUEmp - $PTUExcento;
        }else{
            $PTUGrav = 0;
        }

        if($request->calculoISR == "art86"){
            $end = new Carbon('last day of December');
            $lastDay = $end->format('2021-m-d');
            if($at >= 1){
                $acumladoGrav = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('periodos','prenomina.noPrenomina','=','numero')
                                ->where([
                                    ['prenomina.clave_empleado','=',$request->clvEmp],
                                    ['prenomina.clave_concepto','=','01OC'],
                                    ['periodos.fecha_inicio','>=',date('2021-01-01')],
                                    ['periodos.fecha_fin','<=',$lastDay]
                                    ])
                                ->sum('prenomina.monto');

                $acumuladoExce = DB::connection('DB_Serverr')->table('prenomina')
                                 ->join('periodos','prenomina.noPrenomina','=','numero')
                                 ->where([
                                     ['prenomina.clave_empleado','=',$request->clvEmp],
                                     ['prenomina.clave_concepto','=','02OC'],
                                     ['periodos.fecha_inicio','>=',date('Y-01-01')],
                                     ['periodos.fecha_fin','<=',$lastDay]
                                     ])
                                 ->sum('prenomina.monto');

            }else{
                $acumladoGrav = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('periodos','prenomina.noPrenomina','=','numero')
                                ->where([
                                    ['prenomina.clave_empleado','=',$request->clvEmp],
                                    ['prenomina.clave_concepto','=','01OC'],
                                    ['periodos.fecha_inicio','>=',$clave->fecha_alta],
                                    ['periodos.fecha_fin','<=',$lastDay]
                                    ])
                                ->sum('prenomina.monto');

                $acumuladoExce = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('periodos','prenomina.noPrenomina','=','numero')
                                ->where([
                                    ['prenomina.clave_empleado','=',$request->clvEmp],
                                    ['prenomina.clave_concepto','=','02OC'],
                                    ['periodos.fecha_inicio','>=',$clave->fecha_alta],
                                    ['periodos.fecha_fin','<=',$lastDay]
                                    ])
                                ->sum('prenomina.monto');

                $datework = Carbon::parse($clave->fecha_alta);
                $endDay = Carbon::parse('last day of December');
                $diff = $endDay->diff($datework);
            }

            $proporcionISR = ($acumuladoExce*100)/$acumladoGrav;
            $ISRRetener = ($PTUGrav * $proporcionISR)/100;
            $PTUFinal = $TotalPTUEmp - $ISRRetener;
        }else{
            $ISRRetener = $this->calcularImpuestos($PTUExcento,$PTUGrav);
            $PTUFinal = $TotalPTUEmp - $ISRRetener;
        }

        $clave = DB::connection('DB_Serverr')->table('empleados')
                 ->select('clave_empleado','nombre','apellido_paterno','apellido_materno','id_emp')
                 ->where('clave_empleado','=',$request->clvEmp)
                 ->first();

        $PTUSin->push(['clave_concepto'=>'016P','concepto'=>'P.T.U','monto'=>$TotalPTUEmp]);
        $PTUCon->push(['clave_concepto'=>'001S','concepto'=>'PAGO NETO','monto'=>$PTUFinal]);
        $ISRFinal->push(['clave_concepto'=>'001T','concepto'=>'ISR','monto'=>$ISRRetener]);

        return compact('empleados','PTUSin','PTUCon','ISRFinal','clave');
    }

    public function calcularImpuestos($percExc,$percGrav){
        $jt = $this->jornadaTrabajo();

        switch($jt->diasPeriodo){
            case 7: 
                $cadenaPeriodo = 'SEMANAL';
                break;
            case 15:
                $cadenaPeriodo = 'QUINCENAL';
                break;
            case 30:
                $cadenaPeriodo = 'MENSUAL';
                break;
        }

        $limites = Retenciones::select('limite_inferior','limite_superior','cuota_fija','porcentaje_excedente')
                   ->where([
                      ['limite_inferior','<',$percGrav],
                      ['periodo_retencion','=',$cadenaPeriodo]
                   ])
                   ->orderBy('id','desc')
                   ->first();

        $diferencia = $percGrav - $limites->limite_inferior;
        $impuestoMarginal = ($diferencia*$limites->porcentaje_excedente)/100;
        $isrCalculado = $impuestoMarginal+$limites->cuota_fija;

        $subsidio = Subsidio::select('ParaIngresos','hastaIngresos','cantidadSubsidio')
                    ->where([
                      ['ParaIngresos','<',$percGrav],
                      ['periodo_subsidio','=',$cadenaPeriodo]
                    ])
                    ->where('ParaIngresos','<',$percGrav)
                    ->orderBy('id_subsidio','desc')
                    ->first();
        
        $isrDeterminado = $isrCalculado - $subsidio->cantidadSubsidio;

        if($isrDeterminado < 0){
            $isrDeterminado = 0;
        }
        
        return $isrDeterminado;
    }

    public function jornadaTrabajo(){
        $num_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $periodos = DB::connection('DB_Serverr')->table('periodos')
                    ->select('diasPeriodo','fecha_inicio')
                    ->where('numero','=',$num_periodo)
                    ->first();

        return $periodos;
    }

    public function uma(){
        $jt = $this->jornadaTrabajo();
        $uma = Umas::select('porcentaje_uma')
                    ->where([
                        ['periodoinicio_uma','<=',$jt->fecha_inicio],
                        ['periodofin_uma','>',$jt->fecha_inicio]
                    ])
                    ->first();

        return $uma;
    }

    public function anios_trabajados($clvEmp){
        $num_p = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $fecha_inicial = DB::connection('DB_Serverr')->table('periodos')
                         ->select('fecha_inicio')
                         ->where('numero','=',$num_p)
                         ->first();

        $inicial = now()->parse($fecha_inicial->fecha_inicio);

        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
                           ->select('fecha_alta')
                           ->where('clave_empleado','=',$clvEmp)
                           ->first();

        $alta = now()->parse($alta_trabajador->fecha_alta);
        $diferencia = $inicial->DiffInYears($alta);

        return $diferencia;
    }

    public function sueldo_horas($clvEmp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos_empleado = DB::connection('DB_Serverr')->table('empleados')
                          ->select('sueldo_diario','horas_diarias')
                          ->where('clave_empleado','=',$clvEmp)
                          ->first();

        return $datos_empleado;
    }
}
