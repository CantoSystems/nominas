<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
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
        
        $da = $this->dias_aguinaldo($id_emp);
        return $da;

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
        ->select('dias')
        ->where('anio','=',$at)
        ->first();

        //retornamos la cantidad 

        return  $diasAguinaldo;
   }


}
