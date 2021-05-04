<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Empresa;
use App\Umas;
use App\SalarioMinimo;
use Session;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse;

class CalculoPrenominaController extends Controller{
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
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $empleados = DB::connection('DB_Serverr')->table('empleados')
        ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
        ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
        ->join('areas','areas.clave_area', '=','departamentos.clave_area')
        ->select('empleados.*','areas.*','departamentos.*','puestos.*')
        ->get();

         $conceptos = DB::connection('DB_Serverr')->table('conceptos')   
            ->where('seleccionado','=',1)
            ->get();

        return  view('prenomina.prenomina', compact('empleados','conceptos'));
    }

    public function create(Request $request){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

         $empleados = DB::connection('DB_Serverr')->table('empleados')
        ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
        ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
        ->join('areas','areas.clave_area', '=','departamentos.clave_area')
        ->select('empleados.*','areas.*','departamentos.*','puestos.*')
        ->where('id_emp','=',$request->info)
        ->first();
        
         $conceptos = DB::connection('DB_Serverr')->table('conceptos')
            ->select('clave_concepto')   
            ->where('seleccionado','=',1)
            ->get();
        
            //$comprobacion = $this->criterio_horas($request->info,$empleados->clave_empleado);

       foreach($conceptos as $concep){
            if($concep->clave_concepto == "001P"){
                $resultaSueldo = $this->sueldo($request->info,$empleados->clave_empleado);
            }else if($concep->clave_concepto == "002P"){
                //$resultaHoraExtraDoble = $this->criterio_horas($request->info,$empleados->clave_empleado);
            }else if($concep->clave_concepto == "003P"){
                //$resultaHoraExtraTriple = $this->horaTriple($request->info);
            }else if($concep->clave_concepto == "004P"){
                $resultaFondoAhorro = $this->fondoAhorro($request->info);
            }else if($concep->clave_concepto == "005P"){
                $resultaPremioPunt = $this->premioPunt($request->info,$empleados->clave_empleado);
            }else if($concep->clave_concepto == "006P"){
                $resultaPremioAsis = $this->premioPunt($request->info,$empleados->clave_empleado);
            }else if($concep->clave_concepto == "007P"){
                $resultaPrimaVacacional = $this->primaVacacional($request->info);
            }else if($concep->clave_concepto == "008P"){
                $resultaPrimaDominical = $this->primaDominical($request->info);
            }else if($concep->clave_concepto == "009P"){

            }else if($concep->clave_concepto == "010P"){

            }else if($concep->clave_concepto == "011P"){

            }else if($concep->clave_concepto == "012P"){
            
            }else if($concep->clave_concepto == "013P"){
                $Vacaciones = $this->sueldo_horas($request->info);
                $resultaVacaciones = $Vacaciones->sueldo_diario;
            }else if($concep->clave_concepto == "014P"){
                $aguinaldos = $this->aguinaldo($request->info);
            }else if($concep->clave_concepto == "015P"){

            }else if($concep->clave_concepto == "016P"){

            }else if($concep->clave_concepto == "017P"){

            }else if($concep->clave_concepto == "018P"){

            }else if($concep->clave_concepto == "019P"){

            }else if($concep->clave_concepto == "020P"){

            }else if($concep->clave_concepto == "021P"){

            }else if($concep->clave_concepto == "022P"){

            }else if($concep->clave_concepto == "023P"){
                
            }else if($concep->clave_concepto == "001D"){
                $resultaAusentismoDed = $this->ausentismoIncapacidadDeduccion($request->info,$empleados->clave_empleado);
            }else if($concep->clave_concepto == "002D"){
                $resultaIncapacidadDed = $this->ausentismoIncapacidadDeduccion($request->info,$empleados->clave_empleado);
            }else if($concep->clave_concepto == "003D"){
                 $resultaFondoAhorroTrabajador = $this->fondoAhorro($request->info);
            }else if($concep->clave_concepto == "004D"){
                //$resultaDeduccionFondo = $this->deduccionAhorro($request->info);
            }else if($concep->clave_concepto == "005D"){
                
            }else if($concep->clave_concepto == "006D"){
                
            }else if($concep->clave_concepto == "007D"){

            }else if($concep->clave_concepto == "008D"){
                
            }else if($concep->clave_concepto == "009D"){
                
            }else if($concep->clave_concepto == "010D"){
                
            }else if($concep->clave_concepto == "011D"){
                
            }else if($concep->clave_concepto == "012D"){
                
            }else if($concep->clave_concepto == "013D"){
                
            }else if($concep->clave_concepto == "014D"){
                
            }else if($concep->clave_concepto == "015D"){
                
            }else if($concep->clave_concepto == "016D"){
                
            }else if($concep->clave_concepto == "017D"){
                
            }
        }

        $collection = collect([
            ["concepto" => "001P", 'resultado' => $resultaSueldo ?? 0],
            ["004P" => $resultaFondoAhorro ?? 0],
            ["005P" => $resultaPremioPunt ?? 0],
            ["006P" => $resultaPremioAsis ?? 0],
            ["007P" => $resultaPrimaVacacional ?? 0],
            ["008P" => $resultaPrimaDominical ?? 0],
            ["013P" => $resultaVacaciones ?? 0],
            ["014P" => $aguinaldos ?? 0],
            ["001D" => $resultaAusentismoDed ?? 0],
            ["002D" => $resultaIncapacidadDed ?? 0],
            ["003D" => $resultaFondoAhorroTrabajador]
        ]);
        
        $totales = $collection->flatMap(function ($values) {
            return array_map('strtoupper', $values);
        });
        
        $totales->all();   

        return response()->json($totales);
        //(json_encode($totales),200)->header('Content-type','text/plain');
        //return "Hola";
    }

    /**
     * Funciones variable general
     */
    public function sueldo_horas($idEmp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos_empleado = DB::connection('DB_Serverr')->table('empleados')
        ->select('sueldo_diario','horas_diarias')
        ->where('id_emp','=',$idEmp)
        ->first();

        //Se retorna el sueldo en $ del empleado y las horas trabajadas
        return $datos_empleado;
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

        // se retorna los días del periodo
        return $periodos;
    }

    public function anios_trabajados($idEmp){
        //Fecha Inicial del Periodo de Nómina - Fecha de Alta del Trabajador
        $num_p = Session::get('num_periodo');

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $fecha_inicial = DB::connection('DB_Serverr')->table('periodos')
        ->select('fecha_inicio')
        ->where('numero','=',$num_p)
        ->first();

        //Accedemos a la fecha $fecha_inicial->fecha_inicio
        //Parseando la fecha
        $inicial = now()->parse($fecha_inicial->fecha_inicio);
    
        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
        ->select('fecha_alta')
        ->where('id_emp','=',$idEmp)
        ->first();

        //Accedemos a la fecha alta del trabajador $alta_trabajador->fecha_alta
        //Parseando la fecha
        $alta = now()->parse($alta_trabajador->fecha_alta);

        $diferencia = $inicial->DiffInYears($alta); 
        return $diferencia;
    }

    public function ausentismo($claveEmp){
        $num_periodo = Session::get('num_periodo');

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $acumulado_ausen = DB::connection('DB_Serverr')->table('ausentismos')
        ->select(DB::raw('CASE WHEN COUNT(`cantidad_ausentismo`) = "" THEN 0 ELSE SUM(`cantidad_ausentismo`) END as conteoDias'))
        ->where([
            ['clave_empleado','=',$claveEmp],
            ['ausentismo_periodo','=',$num_periodo]
        ])
        ->whereIn('clave_concepto',['001D','002D'])
        ->first();

        return $acumulado_ausen;
    }

    public function dias_trabajados($claveEmp){
        $jt = $this->jornadaTrabajo();
        $ausentismo = $this->ausentismo($claveEmp);
        
        $diasTrabajados = $jt->diasPeriodo - $ausentismo->conteoDias;
        return $diasTrabajados;
    }

    public function uma(){
        
        $jt = $this->jornadaTrabajo();
        $uma = Umas::select('porcentaje_uma')
                    ->where([
                    ['periodoinicio_uma','<',$jt->fecha_inicio],
                    ['periodofin_uma','>',$jt->fecha_inicio]
                    ])
                    ->first();

        return $uma;

       /* $uma = Umas::select('porcentaje_uma')
        ->orderBy('created_at','desc')
        ->first();

        return $uma;*/
    }

    public function cantidad_dias($idEmp){
        //Fecha Inicial del Periodo de Nómina - Fecha de Alta del Trabajador
        $num_p = Session::get('num_periodo');
    
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
    
        $fecha_inicial = DB::connection('DB_Serverr')->table('periodos')
        ->select('fecha_inicio')
        ->where('numero','=',$num_p)
        ->first();
    
        //Accedemos a la fecha $fecha_inicial->fecha_inicio
        //Parseando la fecha
        $inicial = now()->parse($fecha_inicial->fecha_inicio);
    
        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
        ->select('fecha_alta')
        ->where('id_emp','=',$idEmp)
        ->first();
    
        //Accedemos a la fecha alta del trabajador $alta_trabajador->fecha_alta
        //Parseando la fecha
        $alta = now()->parse($alta_trabajador->fecha_alta);
    
        $diferencia = $inicial->diffInDays($alta); 
        return $diferencia;
    }

    public function ahorro_riesgo(){
        $clv = Session::get('clave_empresa');

        $datos_empresa = Empresa::select('primaRiesgo','porcentajeAhorro')
        ->where('clave','=',$clv)
        ->first();

        return $datos_empresa;
    }

    public function aguinaldo_vacaciones_prima($idEmp){
        //Años trabajados se accede directamento con $at
        $at = $this->anios_trabajados($idEmp);

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
            $datos_prestaciones= DB::connection('DB_Serverr')->table('prestaciones')
                                    ->select('aguinaldo','dias','prima_vacacional')
                                    ->where('anio','=',$at)
                                    ->first();
                                    //retornamos la cantidad de dias otorgados acceder
                                    // $diasAguinaldo->aguinaldo
            return  $datos_prestaciones;
    }

  /*  public function diasTrabajadosAguinaldo($idEmp,$claveEmp){
        
        $diasAguinaldo = $this->aguinaldo_vacaciones_prima($idEmp);
        //Cambiar la evaluacion si se requiere para premio de puntualidad
        if(is_null($diasAguinaldo)){
            $diasTotales = $diasTrabajados-0;
            return $diasTotales;
        }

        $diasTotales = $diasTrabajados-$diasAguinaldo->aguinaldo;

        return $diasTotales;
    }*/


     /**
     * Funciones conceptos
     */

    public function sueldo($idEmp,$claveEmp){
        //Sueldo = SD * (JT-001D-002D)
        $sd = $this->sueldo_horas($idEmp);

        $jt = $this->dias_trabajados($claveEmp);
        
        $sueldoFinal = $sd->sueldo_diario * $jt;
        return $sueldoFinal;
    }

   public function fondoAhorro($idEmp){
       /* //Formula SI(UMA*1.3>SD, UMA*1.3,SD)*PFA
        $uma = $this->uma();
        //$uma->porcentaje_uma
        $sd = $this->sueldo_horas($idEmp);
        //$sd->sueldo_diario
        $rt = $this->ahorro_riesgo();
        //rt->porcentajeAhorro

        $umaCond = $uma->porcentaje_uma*1.3;

        if($umaCond<$sd->sueldo_diario){
            $fondo = $umaCond * $rt->porcentajeAhorro;
            return round($fondo,2);
        }
        $umaFin = $sd->sueldo_diario*$rt->porcentajeAhorro;
        return round($umaCond,2);*/
       
        $uma = $this->uma();
        $sd = $this->sueldo_horas($idEmp);
        $rt = $this->ahorro_riesgo();
        $porcentaje_ahorro = $rt->porcentajeAhorro/100;
        $umaCond = $uma->porcentaje_uma*1.3;
        


        if($umaCond<$sd->sueldo_diario){
            $umaCond = $sd->sueldo_diario;
        }

        $umaFin = $umaCond*$porcentaje_ahorro;
        return $umaFin;
    }

    public function premioPunt($idEmp,$claveEmp){
        //SD*(DT)*.1
        
        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);
        $premioPuntualidad = $sd->sueldo_diario*($diasTrabajados)*0.1;

        return $premioPuntualidad;
    }

    public function primaVacacional($idEmp){
        $sd = $this->sueldo_horas($idEmp);
        $dv = $this->aguinaldo_vacaciones_prima($idEmp);
        if(is_null($dv)){
            return $primaVacacional = 0;
        }

        $primaVacacional = $sd->sueldo_diario * $dv->prima_vacacional/100;

        return $primaVacacional;
    }

    public function primaDominical($idEmp){
        $sd = $this->sueldo_horas($idEmp);

        $primaDominical = $sd->sueldo_diario * 0.25 ;

        return $primaDominical;
    }

    public function aguinaldo($idEmp){
        $sd = $this->sueldo_horas($idEmp);
        $diasAguinaldo = $this->aguinaldo_vacaciones_prima($idEmp);

        if(is_null($diasAguinaldo)){
            //Retorna la cantidad de días 
            $dias =$this->cantidad_dias($idEmp);
            $total_aguinaldo = ($sd->sueldo_diario * 15)/365;
            $aguinaldo_proporcional = $total_aguinaldo * $dias;
            return round($aguinaldo_proporcional,2);

            //$resultad = collect(['aguinaldo'=> $dias]);
            //$sd->sueldo_diario * $resultad['aguinaldo'];
        }

        $aguinaldo = $sd->sueldo_diario * $diasAguinaldo->aguinaldo;

        return $aguinaldo;
    }

    public function ausentismoIncapacidadDeduccion($idEmp,$claveEmp){
        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);


        $ausentismoIncapacidad = $sd->sueldo_diario * $diasTrabajados;

        return $ausentismoIncapacidad;
    }

    public function deduccionAhorro($idEmp){
        $fondoAhorroEmpresa = $this->fondoAhorro($idEmp);

        return 1;
    } 
}