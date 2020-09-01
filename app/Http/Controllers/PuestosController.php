<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;


class PuestosController extends Controller
{
    
    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;
        $clave_p=$request->clave_area;
        $indic=$request->identificador;
           switch ($accion) {
               case '':
                $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
              break;

               case 'atras':
               $aux = DB::connection('DB_Serverr')->table('puestos')->where('id','<',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('puestos')->get()->last();
                }
                return view('puetos.puestos',compact('aux'));
                 break;


               case 'siguiente':
                $aux = DB::connection('DB_Serverr')->table('puestos')->where('id','>',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                }
                return view('puestos.puestos',compact('aux'));
               break;
               case 'primero':
                $aux = DB::connection('DB_Serverr')->table('puestos')->first();
                return view('puestos.puestos',compact('aux'));
               break;
               case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('puestos')->get()->last();
                return view('puestos.puestos',compact('aux')); 
               break;
               case 'registrar':
               $this->registrar($request);
               $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                return view('puestos.puestos',compact('aux'));
               break;
               case 'actualizar':
                $aux1 = DB::connection('DB_Serverr')->table('puestos')->where('clave_puesto',$clave_p)->first();
                   if($aux1!==""){
                   DB::connection('DB_Serverr')->table('puestos')->where('clave_puesto',$request->clave_puesto)->update(['area'=>$request->clave_puesto]);
                   $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                   return view('puestos.puestos',compact('aux'));
                   }
               break;
               case 'eliminar':
                $aux1 = DB::connection('DB_Serverr')->table('puestos')->where('clave_puesto',$clave_p)->first();
                if($aux1!==""){
                DB::connection('DB_Serverr')->table('puestos')->where('clave_area',$request->clave_puesto)->delete();
                $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                return view('puestos.puestos',compact('aux'));
                }
               break;
               default:
                   # code...
                   break;
}     
}

public function registrar($datos){
    $clv=Session::get('clave_empresa');
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

    \Config::set('database.connections.DB_Serverr', $configDb);
    DB::connection('DB_Serverr')->insert('insert into puestos (clave_puesto, puesto)
    values (?,?)',[$datos->clave_puesto,$datos->nombre_puesto]);
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
