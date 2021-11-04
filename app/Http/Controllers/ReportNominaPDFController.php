<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Session;
use DataTables;
use App\Empresa;
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
        $num_periodo = Session::get('num_periodo');
        //$pre=Session::get('prenomina_empleado');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        
        $persona = DB::connection('DB_Serverr')->table('empleados')
        ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
        ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
        ->join('areas','areas.clave_area', '=','departamentos.clave_area')
        ->select('empleados.*','areas.*','departamentos.*','puestos.*')
        ->where('id_emp','=',$id_emp)
        ->first();

        $empresa = Empresa::where('clave','=',$clv)->first();
        $periodo_act = DB::connection('DB_Serverr')->table('periodos')
        ->where('numero','=',$num_periodo)
        ->first();

        $prenominaPercepciones = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                                ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                                ->select('prenomina.id_prenomina', 'empleados.clave_empleado','prenomina.clave_concepto','conceptos.concepto','prenomina.monto')
                                ->where([
                                    ['noPrenomina','=',$num_periodo],
                                    ['status_prenomina','=','1'],
                                    ['prenomina.clave_empleado','=',$persona->clave_empleado],
                                    ['conceptos.naturaleza','=','P']
                                ])
                                ->get();
        
        $prenominaDeducciones =  DB::connection('DB_Serverr')->table('prenomina')
                            ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                            ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                            ->select('prenomina.id_prenomina', 'empleados.clave_empleado','prenomina.clave_concepto','conceptos.concepto','prenomina.monto')
                            ->where([
                                    ['noPrenomina','=',$num_periodo],
                                    ['status_prenomina','=','1'],
                                    ['prenomina.clave_empleado','=',$persona->clave_empleado],
                                    ['conceptos.naturaleza','=','D']
                                    ])
                            ->get();

        $totalpercepciones = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                                ->select( DB::raw('SUM(prenomina.monto) as total_percepciones'))
                                ->where([
                                    ['noPrenomina','=',$num_periodo],
                                    ['status_prenomina','=','1'],
                                    ['prenomina.clave_empleado','=',$persona->clave_empleado],
                                    ['conceptos.naturaleza','=','P']
                                    ])
                            ->first();

        $totaldeducciones = DB::connection('DB_Serverr')->table('prenomina')
                            ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                            ->select( DB::raw('SUM(prenomina.monto) as total_deducciones'))
                            ->where([
                                ['noPrenomina','=',$num_periodo],
                                ['status_prenomina','=','1'],
                                ['prenomina.clave_empleado','=',$persona->clave_empleado],
                                ['conceptos.naturaleza','=','D']
                                ])
                        ->first();


        $pdf = PDF::loadView('NominaPDF.report-nomina',compact('persona','empresa','periodo_act','prenominaPercepciones','prenominaDeducciones','totalpercepciones','totaldeducciones'));

        return $pdf->stream();
    }

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

}