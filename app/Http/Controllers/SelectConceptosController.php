<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class selectConceptosController extends Controller{
    public function index(Request $request){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $accion= $request->acciones;
        $indic=$request->identificador;

        switch ($accion) {
            case '':
                $conceptos = DB::connection('DB_Serverr')->table('conceptos')->get();
                return view('selectConceptos.selectconceptos',compact('conceptos'));
            break;
            case 'actualizarConcepto':
                $datos = $request->except('example1_length','acciones');
                $conteoBD = DB::connection('DB_Serverr')->table('conceptos')
                ->select('clave_concepto')
                ->count();

                if($datos==null){
                    DB::connection('DB_Serverr')->table('conceptos')
                    ->update(['seleccionado'=>0]);
                }else{
                    foreach($datos as $conceptosS){
                        DB::connection('DB_Serverr')->table('conceptos')->where('clave_concepto',$conceptosS)
                        ->update(['seleccionado'=>1]);
                    }

                    if(count($datos)!=$conteoBD){
                        DB::connection('DB_Serverr')->table('conceptos')->whereNotIn('clave_concepto',$datos)
                        ->update(['seleccionado'=>0]);
                    }
                }
                
                $conceptos = DB::connection('DB_Serverr')->table('conceptos')->get();
                return view('selectConceptos.selectconceptos',compact('conceptos'));
            break;
            default:
            break;
        }
    }

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
}