<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Schema;

class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;
        $clave_ar=$request->clave_area;
        $indic=$request->identificador;
           switch ($accion) {
               case '':
                $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
              break;

               case 'atras':
               $aux = DB::connection('DB_Serverr')->table('areas')->where('id','<',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('areas')->get()->last();
                }
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
                 break;


               case 'siguiente':
                $aux = DB::connection('DB_Serverr')->table('areas')->where('id','>',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                }
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
               break;
               case 'primero':
                $aux = DB::connection('DB_Serverr')->table('areas')->first();
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
               break;
               case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('areas')->get()->last();
               $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas')); 
               break;
               case 'registrar':
               $this->registrar($request);
               $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
               $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
               break;
               case 'actualizar':
                $aux1 = DB::connection('DB_Serverr')->table('areas')->where('clave_area',$clave_ar)->first();
                   if($aux1!==""){
                   DB::connection('DB_Serverr')->table('areas')->where('clave_area',$request->clave_area)->update(['area'=>$request->area]);
                   $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                   $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
                   }
               break;
               case 'eliminar':
                $aux1 = DB::connection('DB_Serverr')->table('areas')->where('clave_area',$clave_ar)->first();
                if($aux1!==""){
                DB::connection('DB_Serverr')->table('areas')->where('clave_area',$request->clave_area)->delete();
                $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
                }
               break;
               case 'cancelar':
                 return back();
                 break;
               default:
                   # code...
                   break;
}     
}

public function registrar($datos){
    $clv=Session::get('clave_empresa');
    $clave_area= $this->generador();
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
    DB::connection('DB_Serverr')->insert('insert into areas (area,clave_area)
    values (?,?)',[$datos->area,$clave_area]);
}
public function generador(){
	$raiz= '0123456789';
	$codigo='';
	for ($i=0; $i < 3; $i++) { 
		$letra= $raiz[mt_rand(0, 4 - 1)];
		$codigo .=$letra;
	}
	return $codigo;
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
