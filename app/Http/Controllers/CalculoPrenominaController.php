<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use Session;
use DataTables;
use App\Empresa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Arr;

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

        //return $conceptos;
        //$encuentraconcepto = Arr::has($conceptos, 'concepto.SUELDO');
        //dd($encuentraconcepto);

        return view('prenomina.prenomina', compact('empleados','conceptos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        // $request->info;

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

         $empleados = DB::connection('DB_Serverr')->table('empleados')
        ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
        ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
        ->join('areas','areas.clave_area', '=','departamentos.clave_area')
        ->select('empleados.*','areas.*','departamentos.*','puestos.*')
        ->where('id_emp','=',$request->info)
        ->first();

        $conceptos = DB::connection('DB_Serverr')->table('conceptos')
        ->select('clave_concepto','naturaleza')
        ->where('seleccionado','=',1)
        ->get();

        foreach($conceptos as $concep){
            if($concep->clave_concepto == "001P"){
                $resultaSueldo = $this->sueldo($request->info,$empleados->clave_empleado);
            }else if($concep->clave_concepto == "002P"){
                $resultaHoraExtraDoble = $this->horaDoble($request->info);
            }else if($concep->clave_concepto == "003P"){
                $resultaHoraExtraTriple = $this->horaTriple($request->info);
            }
        }

        //return response()->json($empleados);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, $id_emp){
        /*$data = Session::put('id_empledo',$empleado_prenomina);
        return $data;
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $conceptos = DB::connection('DB_Serverr')->table('conceptos')
        ->where('seleccionado','=',1)
        ->get();
        //return "hola*/    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
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

        echo $periodos;
        //return response()->json($periodos);
    }

    public function sueldoDiario($idEmp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $empleados = DB::connection('DB_Serverr')->table('empleados')
        ->select('sueldo_diario')
        ->where('id_emp','=',$idEmp)
        ->get();

        return response()->json($empleados);
    }

    public function sueldo($idEmp,$claveEmp){
        //SD*DT
        $num_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $resultaSueldoDiario = $this->sueldoDiario($idEmp);
        //echo $resultaSueldoDiario;

        $resultaJornadaTrabajo = $this->jornadaTrabajo();
        //echo $resultaJornadaTrabajo;

        /*$ausentismo = DB::connection('DB_Serverr')->table('ausentismos')
        ->select(DB::raw('SUM(cantidad_ausentismo) as conteoDias'))
        ->where([
            ['clave_empleado','=',$claveEmp],
            ['ausentismo_periodo','=',$num_periodo]
        ])
        ->whereIn('clave_concepto',['001D','002D'])
        ->groupBy('cantidad_ausentismo')
        ->get();

        $diasLaborales = $resultaJornadaTrabajo - $ausentismo->conteoDias;
        $sueldo = $resultaSueldoDiario * $diasLaborales;
        echo $sueldo;*/
        //return response()->json($ausentismo);
    }
}
