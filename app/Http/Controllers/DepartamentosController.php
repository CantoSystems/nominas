<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;

class DepartamentosController extends Controller
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
        $clave_dep=$request->clave_departamento;
        $indic=$request->identificador;
           switch ($accion) {
               case '':
                $aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')->get()->last();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   $areas=DB::connection('DB_Serverr')->table('areas')->get();
                return view('departamentos.departamentos',compact('aux','departamentos','areas'));
              break;

			   case 'atras':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')
				->where('departamentos.id','<',$request->identificador)->first();
				   if($aux==""){
					$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')->get()->last();
				   }
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   $areas=DB::connection('DB_Serverr')->table('areas')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;

               case 'siguiente':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')
				->where('departamentos.id','>',$request->identificador)->first();
				   if($aux==""){
					$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')->first();
				   }
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   $areas=DB::connection('DB_Serverr')->table('areas')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;
               case 'primero':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')->first();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   $areas=DB::connection('DB_Serverr')->table('areas')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;
               case 'ultimo':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')->get()->last();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   $areas=DB::connection('DB_Serverr')->table('areas')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;
               case 'registrar':
                $this->registrar($request);
				$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')->get()->last();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   $areas=DB::connection('DB_Serverr')->table('areas')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;
               case 'eliminar':
				DB::connection('DB_Serverr')->table('departamentos')->where('clave_departamento',$request->clave_departamento)->delete();
				$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')->get()->last();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   $areas=DB::connection('DB_Serverr')->table('areas')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos','areas'));
			   break;
			   case 'actualizar':
				$this->actualizar($request);
				$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area')->get()->last();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   $areas=DB::connection('DB_Serverr')->table('areas')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;
               default:
                   # code...
                   break;
}     
	}

	public function registrar($datos){
		$clv=Session::get('clave_empresa');
		$clave_departamento= $this->generador();
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
		DB::connection('DB_Serverr')->insert('insert into departamentos (clave_departamento, departamento,clave_area)
		values (?,?,?)',[$clave_departamento,$datos->departamento,$datos->clave_area]);
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

	public function actualizar($datos){

        $empresa= Session::get('clave_empresa');
        $configDb = [
        'driver'      => 'mysql',
        'host'        => env('DB_HOST', 'localhost'),
        'port'        => env('DB_PORT', '3306'),
        'database'    => $empresa,
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
    $clv=$datos->clave_departamento;

    $aux1 = DB::connection('DB_Serverr')->table('departamentos')->where('clave_departamento',$clv)->first();
    
    DB::connection('DB_Serverr')->table('departamentos')->where('clave_departamento',$clv)->update(['departamento'=>$datos->departamento,'clave_area'=>$datos->clave_area]);
        

    }
}