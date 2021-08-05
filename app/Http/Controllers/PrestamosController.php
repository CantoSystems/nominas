<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class PrestamosController extends Controller{
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
        $clv = Session::get('clave_empresa');
        $accion = $request->acciones;
        $clv_empresa = $this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        switch ($accion) {
            case '':
                $prestamos = DB::connection('DB_Serverr')->table('prestamos')
                             ->join('empleados','empleados.clave_empleado','=','prestamos.claveEmpleado')
                             ->select('empleados.*','prestamos.*')
                             ->get();

                $prestamos2 = DB::connection('DB_Serverr')->table('prestamos')
                             ->join('empleados','empleados.clave_empleado','=','prestamos.claveEmpleado')
                             ->select('empleados.*','prestamos.*')
                             ->first();

                return view('prestamos.prestamos',compact('prestamos','prestamos2'));
            break;
            default:
            break;
        }
    }

    public function show(){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $prestamos = DB::connection('DB_Serverr')->table('prestamos')
                        ->join('empleados','empleados.clave_empleado','=','prestamos.claveEmpleado')
                        ->select('empleados.*','prestamos.*')
                        ->get();

        return view('prestamos.mostrarPrestamos',compact('prestamos'));
    }
    
    public function store(Request $request){
        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach ($request->only('info') as $value) {
            $data = json_decode($value);
        }

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value){
            $fecha_periodo = now()->toDateString();
            $periodoPrestamo = Session::get('num_periodo');

            DB::connection('DB_Serverr')->insert('INSERT INTO prestamos (claveEmpleado
                                                                        ,cantidad
                                                                        ,importe
                                                                        ,monto
                                                                        ,periodoPrestamo
                                                                        ,statusPrestamo
                                                                        ,created_at
                                                                        ,updated_at)
                                                                  VALUES (?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?
                                                                         ,?)',[$value->empleado
                                                                             ,$value->cantidad
                                                                             ,$value->importe
                                                                             ,$value->monto
                                                                             ,$periodoPrestamo
                                                                             ,'0'
                                                                             ,$fecha_periodo
                                                                             ,$fecha_periodo]);
        }
    }
}