<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
class EmpleadosController extends Controller
{
    public function conectar($clv)
{

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
        $accion= $request->acciones;
    switch ($accion) {
        case '':
            $empleados=DB::connection('DB_Serverr')->table('empleados')->get();
            return view('empleados.empleados',compact('empleados'));
            break;
        case 'registrar':
            $this->registrar_empleado($request);
            return view('empleados.empleados',compact('empleados'));
        break;
        default:
            # code...
            break;
    }
    }

    public function registrar_empleado($datos){
    $clv_empleado= $this->generador($datos->rfc);
    
    }
    public function generador($rfc){
        $rest = substr($rfc,5); 
        return $rest;
    }
}
