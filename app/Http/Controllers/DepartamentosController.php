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
            	->join('areas', 'departamento.id_area', '=', 'areas.id')
            	->select('departamentos.*', 'areas.clave_area', 'areas.area')
				   ->fist();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
                return view('departamentos.departamentos',compact('aux','departamentos'));
              break;

			   case 'atras':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
            	->join('areas', 'departamento.clave_area', '=', 'areas.clave_area')
				->select('departamentos.*', 'areas.clave_area', 'areas.area')
				->where('id','<',$inidc)
           	    ->first();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos'));
               break;

               case 'siguiente':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
            	->join('areas', 'departamento.clave_area', '=', 'areas.clave_area')
				->select('departamentos.*', 'areas.clave_area', 'areas.area')
				->where('id','>',$inidc)
           	    ->first();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos'));
               break;
               case 'primero':
                $aux = DB::connection('DB_Serverr')->table('departamentos')
            	->join('areas', 'departamento.clave_area', '=', 'areas.clave_area')
            	->select('departamentos.*', 'areas.clave_area', 'areas.area')
           	    ->first();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos'));
               break;
               case 'ultimo':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
            	->join('areas', 'departamento.clave_area', '=', 'areas.clave_area')
            	->select('departamentos.*', 'areas.clave_area', 'areas.area')->get()
           	    ->last();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos'));
               break;
               case 'registrar':
                $this->registrar($request);
				$aux = DB::connection('DB_Serverr')->table('departamentos')
            	->join('areas', 'departamento.clave_area', '=', 'areas.clave_area')
            	->select('departamentos.*', 'areas.clave_area', 'areas.area')
           	    ->fist();
				   $departamentos = DB::connection('DB_Serverr')->table('departamentos')->get();
				   return view('departamentos.departamentos',compact('aux','departamentos'));
               break;
               case 'eliminar':
                
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
		DB::connection('DB_Serverr')->insert('insert into departamentos (clave_departamento, departamento,clv_area)
		values (?,?,?)',[$clave_departamento,$datos->departamento,$datos->clave_area]);
	}
}
