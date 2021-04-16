<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Empresa;
use Session;
use DataTables;
use Carbon\Carbon;
use App\SalarioMinimo;
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

    public function index(Request $request)
    {
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

    public function create(Request $request)
    {
        // $request->info;

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
                //$resultaSueldo = $this->sueldo($request->info);
            }else if($concep->clave_concepto == "002P"){
                //$resultaHoraExtraDoble = $this->horaDoble($request->info);
            }else if($concep->clave_concepto == "003P"){
                //$resultaHoraExtraTriple = $this->horaTriple($request->info);
            }else if($concep->clave_concepto == "001D"){
                $resultado_ausentismo= $this->comprobacíon_funciones($request->info);

            }
        }

        return response()->json($resultado_ausentismo);
    }

    public function comprobacíon_funciones($id_emp){
        //Jornada de trabajo, se accede con $jt->diasPeriodo
        $jt = $this->jornadaTrabajo();
        //Sueldo diario, se accede con $sd->sueldo_diario 
        $sd = $this->sueldoDiario($id_emp);
        //Años trabajados se accede directamento con $at
        $at = $this->anios_trabajados($idEmp);
        //Aguinaldo, se accede con $da->aguinaldo
        $da = $this->dias_aguinaldo($id_emp);
        //Dias de vacaciones, acceder $dv->dias
        $dv = $this->dias_vacaciones($id_emp);
        //Dias de vacaciones, acceder $pv->prima_vacacional
        $pv = $this->prima_vacacional($id_emp);
        //Horas trabjaadas, acceder $ht->horas_trabajadas
        $ht = $this->horas_trabajadas($id_emp);
        //Horas trabjaadas, acceder $sm->importe
        $sm = $this->salario_minimo();
        //PrimaRiesgo $rt->prima_riesgo
        $rt = $this->prima_riesgo();
        //Porcentaje ahorro $pfa->porcentajeAhorro
        $pfa = $this->fondo_ahorro();
        
        return $pfa;

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

     public function sueldoDiario($idEmp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $sueldo_diario = DB::connection('DB_Serverr')->table('empleados')
        ->select('sueldo_diario')
        ->where('id_emp','=',$idEmp)
        ->first();

        //Se retorna el suelto en $ del empleado
        return $sueldo_diario;
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

   public function dias_aguinaldo($idEmp){
        //Años trabajados se accede directamento con $at
        $at = $this->anios_trabajados($idEmp);

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $diasAguinaldo= DB::connection('DB_Serverr')->table('prestaciones')
        ->select('aguinaldo')
        ->where('anio','=',$at)
        ->first();

        //retornamos la cantidad de dias otorgados acceder
        // $diasAguinaldo->aguinaldo

        return  $diasAguinaldo;
   }

   public function dias_vacaciones($idEmp){
       //Tabla de Prestaciones de acuerdo con la antigüedad del Trabajador en Años
        $at = $this->anios_trabajados($idEmp);

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $diasVacaciones= DB::connection('DB_Serverr')->table('prestaciones')
        ->select('dias')
        ->where('anio','=',$at)
        ->first();
        //acceder $diasVacaciones->dias
        return $diasVacaciones;

   }

   public function prima_vacacional($idEmp){
       //Tabla de Prestaciones de acuerdo con la antigüedad del Trabajador en Años
        $at = $this->anios_trabajados($idEmp);

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $primaVacacional= DB::connection('DB_Serverr')->table('prestaciones')
        ->select('prima_vacacional')
        ->where('anio','=',$at)
        ->first();
        //acceder $primaVacacional->prima_vacacional
        return $primaVacacional;
   }

   public function horas_trabajadas($idEmp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $horasTrabajadas = DB::connection('DB_Serverr')->table('empleados')
        ->select('horas_diarias')
        ->where('id_emp','=',$idEmp)
        ->first();
        //horas diarias trabajadas $horasTrabajadas->horas_trabajadas
        return $horasTrabajadas;
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

   public function prima_riesgo(){
    $clv = Session::get('clave_empresa');
    $clv_empresa = $this->conectar($clv);

    $p_riesgo = Empresa::select('primaRiesgo')
    ->where('clave','=',$clv)
    ->first();

    return $p_riesgo;
   }

   public function fondo_ahorro(){
    $clv = Session::get('clave_empresa');
    $clv_empresa = $this->conectar($clv);

    $p_ahorro = Empresa::select('porcentajeAhorro')
    ->where('clave','=',$clv)
    ->first();

    return $p_ahorro;
   }

}
