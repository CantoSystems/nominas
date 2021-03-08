<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class IncidenciaController extends Controller{

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
        $accion= $request->acciones;
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        switch ($accion) {
            case '':
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->first();

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->get();

                $emp = DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos = DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('incidencias.incidencias',compact('incidencias2','incidencias','emp','conceptos'));
            break;
            default:
            break;
        }
    }

    public function store(Request $request){
        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach ($request->only('info') as $value) {
            $data = json_decode($value);
        }

        /*
            Primer opción aunque envia  todos los valores de jalón
        */
        /*foreach ($data as $value) {
            foreach ($value as $value1) {
                echo $value1.PHP_EOL;
            }
        }*/

        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value) {
            DB::connection('DB_Serverr')->insert('INSERT INTO incidencias (clave_concepto
                                                                          ,clave_empleado
                                                                          ,cantidad
                                                                          ,importe
                                                                          ,monto)
                                                                  VALUES (?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?)',[$value->concepto
                                                                             ,$value->empleado
                                                                             ,$value->cantidad
                                                                             ,$value->importe
                                                                             ,$value->monto]);
        }
    }
}