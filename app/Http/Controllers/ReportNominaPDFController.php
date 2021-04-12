<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Schema;

class ReportNominaPDFController extends Controller{
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

    public function visualizar($id_emp){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        
        $persona = DB::connection('DB_Serverr')->table('empleados')
        ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
        ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
        ->join('areas','areas.clave_area', '=','departamentos.clave_area')
        ->select('empleados.*','areas.*','departamentos.*','puestos.*')
        ->where('id_emp','=',$id_emp)
        ->first();

        $deducciones = DB::connection('DB_Serverr')->table('ausentismos')
        ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
        ->join('conceptos','conceptos.clave_concepto','=','ausentismos.clave_concepto')
        ->where('id_emp','=',$id_emp)
        ->get();

        $nombre_empresa=Session::get('empresa');
        $num_periodo = Session::get('num_periodo');
        $periodo_act = DB::connection('DB_Serverr')->table('periodos')
        ->where('numero','=',$num_periodo)
        ->first();

        $pdf = PDF::loadView('NominaPDF.report-nomina',compact('persona','nombre_empresa','periodo_act','deducciones'));

        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

                $empleados = DB::connection('DB_Serverr')->table('empleados')
                ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                ->select('empleados.*','areas.*','departamentos.*','puestos.*')
                ->get();

        return view('NominaPDF.nominanormal',compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}