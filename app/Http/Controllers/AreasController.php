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
                return view('Areas.area',compact('aux'));
                   break;

               case 'atras':
<<<<<<< HEAD
                $areas = DB::connection('DB_Serverr')->select('select * from Areas where id > :id',['id' => $clv]);
                
                    if($areas==""){
                        $areas = DB::connection('DB_Serverr')->select('select * from Areas');
                        $cont=count($areas);
                        $aux=$areas[$cont-1];
                        return view('Areas.area',compact('aux'));     
                    }
                    
                    elseif(empty($areas)) {
                        $areas = DB::connection('DB_Serverr')->select('select * from Areas');
                        $aux=$areas[0];
                        return view('Areas.area',compact('aux'));
                    }
                   
                    $aux=$areas[0];
                    return view('Areas.area',compact('aux'));
                break;
=======
                $aux = DB::connection('DB_Serverr')->table('areas')->where('id','<',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('areas')->get()->last();
                }
                return view('Areas.area',compact('aux'));
                 break;
>>>>>>> a8098cc622187acac6f0753420f88e70439e8cde

               case 'siguiente':
                $aux = DB::connection('DB_Serverr')->table('areas')->where('id','>',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                }
                return view('Areas.area',compact('aux'));
               break;
               case 'primero':
                $aux = DB::connection('DB_Serverr')->table('areas')->first();
                return view('Areas.area',compact('aux'));
               break;
               case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('areas')->get()->last();
                return view('Areas.area',compact('aux')); 
               break;
               case 'registrar':
               $this->registrar($request);
               $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                return view('Areas.area',compact('aux'));
               break;
               case 'actualizar':
                $aux1 = DB::connection('DB_Serverr')->table('areas')->where('clave_area',$clave_ar)->first();
                   if($aux1!==""){
                   DB::connection('DB_Serverr')->table('areas')->where('clave_area',$request->clave_area)->update(['area'=>$request->areas]);
                   $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                   return view('Areas.area',compact('aux'));
                   }
               break;
               case 'eliminar':
                $aux1 = DB::connection('DB_Serverr')->table('areas')->where('clave_area',$clave_ar)->first();
                if($aux1!==""){
                DB::connection('DB_Serverr')->table('areas')->where('clave_area',$request->clave_area)->delete();
                $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                return view('Areas.area',compact('aux'));
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
    DB::connection('DB_Serverr')->insert('insert into areas (clave_empresa, area,clave_area)
    values (?,?,?)',[$clv,$datos->areas,$datos->clave_area]);
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
