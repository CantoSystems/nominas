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
					->select('departamentos.*','areas.area')->latest('id')->first();
					$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area')->get();

					$areas=DB::connection('DB_Serverr')->table('areas')->get();
                return view('departamentos.departamentos',compact('aux','departamentos','areas'));
              	break;
			   case 'atras':
					$aux = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area')
					->where('departamentos.id','<',$request->identificador)->latest('id')->first();
					if($aux==""){
						$aux = DB::connection('DB_Serverr')->table('departamentos')
						->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area')->get()->last();
					}
					$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area')->get();
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
					$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area')->get();
					$areas=DB::connection('DB_Serverr')->table('areas')->get();
					return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;
               case 'primero':
					$aux = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area')->first();
					$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area')->get();
					$areas=DB::connection('DB_Serverr')->table('areas')->get();
					return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;
               case 'ultimo':
					$aux = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area')->get()->last();
					$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area')->get();
					$areas=DB::connection('DB_Serverr')->table('areas')->get();
					return view('departamentos.departamentos',compact('aux','departamentos','areas'));
               break;
               case 'registrar':
					$this->registrar($request);
					return redirect()->route('departamentos.index');
               break;
               case 'eliminar':
					//DB::connection('DB_Serverr')->table('departamentos')->where('clave_departamento',$request->clave_departamento)->delete();
					$aux = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
					->select('departamentos.*','areas.area')->get()->last();
					$departamentos = DB::connection('DB_Serverr')->table('departamentos')
					->join('areas','departamentos.clave_area','=','areas.clave_area')
						->select('departamentos.*','areas.area')->get();
					$areas=DB::connection('DB_Serverr')->table('areas')->get();
					return view('departamentos.departamentos',compact('aux','departamentos','areas'));
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
							->select('departamentos.*','areas.area')
							->where('clave_departamento',$request->busca)
							->first();

						if($aux == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }

						$departamentos = DB::connection('DB_Serverr')->table('departamentos')
							->join('areas','departamentos.clave_area','=','areas.clave_area')
							->select('departamentos.*','areas.area')->get();

						$areas=DB::connection('DB_Serverr')->table('areas')->get();
						return view('departamentos.departamentos',compact('aux','departamentos','areas'));

               		}else if($criterio == 'departamento'){
               			$aux = DB::connection('DB_Serverr')->table('departamentos')
							->join('areas','departamentos.clave_area','=','areas.clave_area')
							->select('departamentos.*','areas.area')
							->where('departamento',$request->busca)
							->first();

						if($aux == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }

						$departamentos = DB::connection('DB_Serverr')->table('departamentos')
							->join('areas','departamentos.clave_area','=','areas.clave_area')
							->select('departamentos.*','areas.area')->get();

						$areas=DB::connection('DB_Serverr')->table('areas')->get();
						return view('departamentos.departamentos',compact('aux','departamentos','areas'));

               		}
               		break;
               		
               default:
                   # code...
                   break;
}
	}

	public function registrar($datos){

		/*if ($datos->departamento === null || $datos->clave_area === null) {
			return redirect()->route('departamentos.index');
		}*/

		$clv=Session::get('clave_empresa');
		//$clave_departamento= $this->generador();
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
		DB::connection('DB_Serverr')->insert('insert into departamentos (clave_departamento, departamento,clave_area)
		values (?,?,?)',[$datos->clave_departamento,$datos->departamento,$datos->clave_area]);
		}else{
			return back()->with('msj','Registro duplicado');
		}
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
		$clv= Session::get('clave_empresa');
		$clv_empresa=$this->conectar($clv);
		\Config::set('database.connections.DB_Serverr', $clv_empresa);

		$datos->validate([
              'clave_departamento' => 'required',
              'departamento' => 'required',
              'clave_area' => 'required',

      	]);

		$clv2=$datos->identificador;
		$aux1 = DB::connection('DB_Serverr')->table('departamentos')->where('id',$clv2)->first();
		DB::connection('DB_Serverr')->table('departamentos')->where('id',$clv2)->update(['clave_departamento'=>$datos->clave_departamento,'departamento'=>$datos->departamento,'clave_area'=>$datos->clave_area]);
    }

    public function eliminardepartamento($id){
		$clv= Session::get('clave_empresa');
		$clv_empresa=$this->conectar($clv);
		\Config::set('database.connections.DB_Serverr', $clv_empresa);
		$aux1 = DB::connection('DB_Serverr')->table('departamentos')->where('id',$id)->delete();
		return redirect()->route('departamentos.index');
    }
}
