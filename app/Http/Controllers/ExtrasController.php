<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Schema;

class ExtrasController extends Controller
{
   
    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        $periodo= Session::get('num_periodo');
        $indic=$request->id;

        //dd($periodo);
         
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
         $accion= $request->acciones;

         switch ($accion) {
             case '':
               /* $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('numero','=',$periodo)
                ->first();
                dd($ptrabajo);


                $hora = DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->select('ausentismos.*','empleados.*')
                ->orderBy('id')->first();*/

                return view('tiempo_extra.crudextras');
                    //compact('periodo','ptrabajo'));
                 break;
             
             default:
                 # code...
                 break;
         }
    }

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

}
