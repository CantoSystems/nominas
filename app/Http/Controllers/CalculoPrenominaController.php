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

       foreach($conceptos as $concep){
            if($concep->clave_concepto == "001P"){
                $resultaSueldo = $this->sueldo($request->info,$empleados->clave_empleado);
            }else if($concep->clave_concepto == "002P"){
                //$resultaHoraExtraDoble = $this->horaDoble($request->info);
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
                //$resultado_ausentismo= $this->comprobacíon_funciones($request->info);
            }
        }

        return response()->json($resultaFactor);
    }

    //Funciones compuestas
    public function aguinaldo($idEmp){
        $sd = $this->sueldo_horas($idEmp);
        $diasAguinaldo = $this->aguinaldo_vacaciones_prima($idEmp);

        $aguinaldo = $sd->sueldo_diario*$diasAguinaldo->aguinaldo;

        return $aguinaldo;
    }

    public function primaDominical($idEmp){
        $sd = $this->sueldo_horas($idEmp);

        $primaDominical = $sd->sueldo_diario * 0.25;

        return $primaDominical;
    }

    public function primaVacacional($idEmp){
        $sd = $this->sueldo_horas($idEmp);
        $dv = $this->aguinaldo_vacaciones_prima($idEmp);

        $primaVacacional = $sd->sueldo_diario * $dv->prima_vacacional/100;

        return $primaVacacional;
    }

    public function premioPunt($idEmp,$claveEmp){
        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);
        $diasAguinaldo = $this->aguinaldo_vacaciones_prima($idEmp);

        $premioPuntualidad = $sd->sueldo_diario*($diasTrabajados-$diasAguinaldo->aguinaldo)*0.1;

        return $premioPuntualidad;
    }

    public function fondoAhorro($idEmp){
        $uma = $this->uma();
        $sd = $this->sueldo_horas($idEmp);
        $rt = $this->ahorro_riesgo();
        $umaCond = $uma->porcentaje_uma*1.3;

        if($umaCond<$sd->sueldo_diario){
            $umaCond = $sd->sueldo_diario;
        }

        $umaFin = $umaCond*$rt->porcentajeAhorro;
        return $umaFin;
    }

    public function salarioBaseCotizacion($idEmp){
        $sd = $this->sueldo_horas($idEmp);
        $fi = $this->factorIntegracion($idEmp);

        $SBC = $sd->sueldo_diario*$fi;
        return $SBC;
    }

    public function factorIntegracion($idEmp){
        $dv = $this->aguinaldo_vacaciones_prima($idEmp);

        $FactorIntegracion = 1+intval((($dv->dias*$dv->prima_vacacional+$dv->aguinaldo)/365.4));
        return $FactorIntegracion;
    }

    public function sueldo($idEmp,$claveEmp){
        //Sueldo = SD * (JT-001D-002D)
        $sd = $this->sueldo_horas($idEmp);

        $jt = $this->dias_trabajados($claveEmp);
        
        $sueldoFinal = $sd->sueldo_diario * $jt;
        return $sueldoFinal;
    }

    public function comprobacíon_funciones($id_emp){
        //Jornada de trabajo, se accede con $jt->diasPeriodo
        $jt = $this->jornadaTrabajo();
        //Horas trabjaadas, acceder $ht->horas_trabajadas
        //Sueldo diario, accede $ht->sueldo_diario
        $ht = $this->sueldo_horas($id_emp);
         //Años trabajados se accede directamento con $at
        $at = $this->anios_trabajados($id_emp);
        //Dias de vacaciones, acceder $dv->dias
        //Aguinaldo, acceeder, $dv->aguinaldo
        //Prima vacacional, $dv->prima_vacacional
        $dv = $this->aguinaldo_vacaciones_prima($id_emp);
        //Salario minimo, $sm->importe
        $sm = $this->salario_minimo();

        //PrimaRiesgo $rt->prima_riesgo
        //Porcentaje ahorro $rt->porcentajeAhorro
        $rt = $this->ahorro_riesgo();

        //Ausentismo $acumulado_ausen->conteoDias
        $ausentismo = $this->ausentismo($claveEmp);
        return $rt;
    }

    //Funciones de consulta

    public function dias_trabajados($claveEmp){
        $jt = $this->jornadaTrabajo();
        $ausentismo = $this->ausentismo($claveEmp);
        
        $diasTrabajados = $jt->diasPeriodo - $ausentismo->conteoDias;
        return $diasTrabajados;
    }

    public function jornadaTrabajo(){
        $num_periodo = Session::get('num_periodo');

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $periodos = DB::connection('DB_Serverr')->table('periodos')
        ->select('diasPeriodo')
        ->where('numero','=',$num_periodo)
        ->first();

        // se retorna los días del periodo
        return $periodos;
    }

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

    public function salario_minimo(){
        $periodo_num = Session::get('num_periodo');

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);

        $zona = Empresa::select('region')
        ->where('clave','=',$clv)
        ->first();
        //$zona->region

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $period = DB::connection('DB_Serverr')->table('periodos')
        ->select('fecha_inicio')
        ->where('numero','=',$periodo_num)
        ->first();

        $salarioMinimo = SalarioMinimo::select('importe')
        ->where([
            ['fechaInicio','<',$period->fecha_inicio],
            ['fechafin','>',$period->fecha_inicio]
        ])
        ->where('region','=',$zona->region)
        ->first();

        //$salarioMinimo->importe
        return $salarioMinimo;
    }

    public function ahorro_riesgo(){
        $clv = Session::get('clave_empresa');

        $datos_empresa = Empresa::select('primaRiesgo','porcentajeAhorro')
        ->where('clave','=',$clv)
        ->first();

        return $datos_empresa;
    }

    public function ausentismo($claveEmp){
        $num_periodo = Session::get('num_periodo');

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $acumulado_ausen = DB::connection('DB_Serverr')->table('ausentismos')
        ->select(DB::raw('SUM(cantidad_ausentismo) as conteoDias'))
        ->where([
            ['clave_empleado','=',$claveEmp],
            ['ausentismo_periodo','=',$num_periodo]
        ])
        ->whereIn('clave_concepto',['001D','002D'])
        ->groupBy('cantidad_ausentismo')
        ->first();

        return $acumulado_ausen;
    }

    public function uma(){
        $uma = Umas::select('porcentaje_uma')
        ->orderBy('created_at','desc')
        ->first();

        return $uma;
    }
}