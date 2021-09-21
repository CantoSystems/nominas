<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Carbon\Carbon;

class DepartamentosController extends Controller{
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
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion = $request->acciones;
        $clave_dep = $request->clave_departamento;
        $indic = $request->identificador;

		switch ($accion) {
			case '':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area', 'departamentos.id as dni')->latest('departamentos.id')->first();
				
				$departamentos = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area', 'departamentos.id as dni')
				->get();

				$areas=DB::connection('DB_Serverr')->table('areas')->get();
				
				return view('departamentos.departamentos',compact('aux','departamentos','areas'));
			break;
			case 'atras':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area', 'departamentos.id as dni')
					->where('departamentos.id','<',$request->identificador)
					->latest('departamentos.id')->first();
				
				if(is_null($aux)){
					$aux = DB::connection('DB_Serverr')->table('departamentos')
						->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area', 'departamentos.id as dni')
						->get()->last();
				}
				
				$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area', 'departamentos.id as dni')->get();

				$areas=DB::connection('DB_Serverr')->table('areas')->get();

				return view('departamentos.departamentos',compact('aux','departamentos','areas'));
			break;
			case 'siguiente':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area', 'departamentos.id as dni')
					->where('departamentos.id','>',$request->identificador)->first();
				
				if(is_null($aux)){
					$aux = DB::connection('DB_Serverr')->table('departamentos')
						->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area', 'departamentos.id as dni')
						->first();
				}
				
				$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area', 'departamentos.id as dni')
					->get();
				
				$areas=DB::connection('DB_Serverr')->table('areas')->get();
				
				return view('departamentos.departamentos',compact('aux','departamentos','areas'));
			break;
			case 'primero':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area', 'departamentos.id as dni')
					->first();
				
				$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area', 'departamentos.id as dni')->get();
				
				$areas=DB::connection('DB_Serverr')->table('areas')->get();
				
				return view('departamentos.departamentos',compact('aux','departamentos','areas'));
			break;
			case 'ultimo':
				$aux = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area', 'departamentos.id as dni')
					->get()->last();
				
				$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area', 'departamentos.id as dni')
					->get();
				
				$areas=DB::connection('DB_Serverr')->table('areas')->get();
				
				return view('departamentos.departamentos',compact('aux','departamentos','areas'));
			break;
			case 'registrar':
				$this->registrar($request);
				return redirect()->route('departamentos.index');
			break;
			case 'actualizar':
				$this->actualizar($request);
				return redirect()->route('departamentos.index');
			break;
			case 'cancelar':
				return redirect()->route('departamentos.index');
			break;
			case 'buscar':
				$criterio= $request->opcion;

				if($criterio == 'clave_departamento'){
					$aux = DB::connection('DB_Serverr')->table('departamentos')
						->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area', 'departamentos.id as dni')
						->where('clave_departamento',$request->busca)
						->first();

					if(is_null($aux)){
						return back()->with('busqueda','Coincidencia no encontrada');
					}

					$departamentos = DB::connection('DB_Serverr')->table('departamentos')
						->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area', 'departamentos.id as dni')
						->get();

					$areas=DB::connection('DB_Serverr')->table('areas')->get();
					
					return view('departamentos.departamentos',compact('aux','departamentos','areas'));
				}else if($criterio == 'departamento'){
					$aux = DB::connection('DB_Serverr')->table('departamentos')
						->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area', 'departamentos.id as dni')
						->where('departamento',$request->busca)
						->first();

					if(is_null($aux)){
						return back()->with('busqueda','Coincidencia no encontrada');
					}

					$departamentos = DB::connection('DB_Serverr')->table('departamentos')
						->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area', 'departamentos.id as dni')
						->get();

					$areas=DB::connection('DB_Serverr')->table('areas')->get();
					
					return view('departamentos.departamentos',compact('aux','departamentos','areas'));
				}
				break;
			default:
				break;
		}
	}

	public function registrar($datos){
		$clv=Session::get('clave_empresa');
		$clv_empresa=$this->conectar($clv);

		\Config::set('database.connections.DB_Serverr', $clv_empresa);

		$datos->validate([
			'clave_departamento' => 'required',
			'departamento' => 'required',
			'clave_area' => 'required',
      	]);

      	$coincidencia = DB::connection('DB_Serverr')->table('departamentos')
        ->where('clave_departamento','=',$datos->clave_departamento)
        ->orWhere('departamento','=',$datos->departamento)
        ->get();

        if($coincidencia->count() == 0){
			$fecha_periodo = now()->toDateString();
			DB::connection('DB_Serverr')->insert('insert into departamentos (clave_departamento, departamento,clave_area,created_at,updated_at)
			values (?,?,?,?,?)',[$datos->clave_departamento,$datos->departamento,$datos->clave_area,$fecha_periodo,$fecha_periodo]);
		}else{
			return back()->with('msj','Registro duplicado');
		}
	}

	public function actualizar($datos){
		$clv= Session::get('clave_empresa');
		$clv_empresa=$this->conectar($clv);
		$fecha_actualiza = now()->toDateString();
		\Config::set('database.connections.DB_Serverr', $clv_empresa);

		$datos->validate([
              'clave_departamento' => 'required',
              'departamento' => 'required',
              'clave_area' => 'required',
      	]);

		$clv2=$datos->identificador;
		$aux1 = DB::connection('DB_Serverr')->table('departamentos')->where('id',$clv2)->first();
		DB::connection('DB_Serverr')->table('departamentos')->where('id',$clv2)
		->update(['departamento'=>$datos->departamento,
				 'clave_area'=>$datos->clave_area,
				'updated_at'=>$fecha_actualiza]);
    }

	public function show($id){
		$clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

		$aux = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area', 'departamentos.id as dni')
				->where('departamentos.id','=',$id)
				->latest('departamentos.id')->first();
				
		$departamentos = DB::connection('DB_Serverr')->table('departamentos')
				->join('areas','departamentos.clave_area','=','areas.clave_area')
				->select('departamentos.*','areas.area', 'departamentos.id as dni')
				->get();

		$areas=DB::connection('DB_Serverr')->table('areas')->get();
				
		return view('departamentos.departamentos',compact('aux','departamentos','areas'));

	}

    public function eliminardepartamento($id){
		$clv= Session::get('clave_empresa');
		$clv_empresa=$this->conectar($clv);
		\Config::set('database.connections.DB_Serverr', $clv_empresa);
		$aux1 = DB::connection('DB_Serverr')->table('departamentos')->where('id',$id)->delete();
		return redirect()->route('departamentos.index');
    }
}