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
               $aux = DB::connection('DB_Serverr')->table('puestos')->where('id','<',$indic)->orderBy('id','desc')->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('puestos')->get()->last();
                }
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
                 break;


               case 'siguiente':
                $aux = DB::connection('DB_Serverr')->table('puestos')->where('id','>',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                }
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
               break;
               case 'primero':
                $aux = DB::connection('DB_Serverr')->table('puestos')->first();
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
               break;
               case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('puestos')->get()->last();
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos')); 
               break;
               case 'registrar':
                  $this->registrar($request);
                  return redirect()->route('puestos.index');
               break;
               case 'actualizar':
                $aux1 = DB::connection('DB_Serverr')->table('puestos')->where('clave_puesto',$clave_p)->first();
                   if($aux1!==""){
                   DB::connection('DB_Serverr')->table('puestos')->where('clave_puesto',$request->clave_puesto)->update(['nombre_puesto'=>$request->puesto]);
                   $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                   $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                   return view('puestos.puestos',compact('aux','puestos'));
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
               case 'cancelar':
                 $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
                 break;
               default:
                   # code...
                   break;
}     
}

public function registrar($datos){
    if ($datos->puesto === null) {
      return redirect()->route('puestos.index');
    }
    $clv=Session::get('clave_empresa');
    $clave_puesto= $this->generador();
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);
   
    DB::connection('DB_Serverr')->insert('insert into puestos (clave_puesto, nombre_puesto)
    values (?,?)',[$clave_puesto,$datos->puesto]);
}

public function generador(){
	$raiz= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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

  public function eliminarpuestos($id){
    $clv=Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);

    \Config::set('database.connections.DB_Serverr', $clv_empresa);
    
    $aux1 = DB::connection('DB_Serverr')->table('puestos')->where('id',$id)->delete();
    return redirect()->route('puestos.index');
  }
}
