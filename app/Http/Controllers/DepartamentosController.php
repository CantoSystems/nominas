<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;

class DepartamentosController extends Controller
{
    public function index(Request $request){
    	$empresa=Session::get('clave_empresa');

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
        $accion= $request->acciones;
        $indic=$request->identificador;
        switch ($accion) {
        	case '':
        		$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->first();
        		$areas=DB::connection('DB_Serverr')->table('areas')->get();
        		$deptos=DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id','departamentos.clave_depto','departamentos.depto','areas.id','areas.area')
        					->get();
        		return view('departamentos.cruddeptos', compact('aux','areas','deptos'));
        	break;

        	case 'atras':
        		$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->where('departamentos.id','<',$indic)
        					->latest('departamentos.id')
        					->first();
        		if($aux==""){
        			$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->get()->last();
        		}
        		$areas=DB::connection('DB_Serverr')->table('areas')->get();
        		$deptos=DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id','departamentos.clave_depto','departamentos.depto','areas.id','areas.area')
        					->get();
        		return view('departamentos.cruddeptos', compact('aux','areas','deptos'));
        	break;

        	case 'siguiente':
        		$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->where('departamentos.id','<',$indic)
        					->latest('departamentos.id')
        					->first();
        			


        		if(is_null($aux)){

        			$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->get()->last();
        		}
        				
        			
        		
        				$areas=DB::connection('DB_Serverr')->table('areas')->get();
        				$deptos=DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id','departamentos.clave_depto','departamentos.depto','areas.id','areas.area')
        					->get();
        		return view('departamentos.cruddeptos', compact('aux','areas','deptos'));
        	break;

        	case 'primero':
        		$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->first();
        		$areas=DB::connection('DB_Serverr')->table('areas')->get();
        		$deptos=DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id','departamentos.clave_depto','departamentos.depto','areas.id','areas.area')
        					->get();
        		return view('departamentos.cruddeptos', compact('aux','areas','deptos'));
        	break;

        	case 'ultimo':
        		$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->get()->last();
        		$areas=DB::connection('DB_Serverr')->table('areas')->get();
        		$deptos=DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id','departamentos.clave_depto','departamentos.depto','areas.id','areas.area')
        					->get();
        		return view('departamentos.cruddeptos', compact('aux','areas','deptos'));
        		
        	break;


        	case 'registrar':
        		$this->registrardeptos($request);
        		$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->first();
        		$areas=DB::connection('DB_Serverr')->table('areas')->get();
        		$deptos=DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id','departamentos.clave_depto','departamentos.depto','areas.id','areas.area')
        					->get();
        		return view('departamentos.cruddeptos', compact('aux','areas','deptos'));
        		
        	break;

        	case 'actualizar':
        		$this->actualizardeptos($request);
        		$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->first();
        		$areas=DB::connection('DB_Serverr')->table('areas')->get();
        		$deptos=DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id','departamentos.clave_depto','departamentos.depto','areas.id','areas.area')
        					->get();
        		return view('departamentos.cruddeptos', compact('aux','areas','deptos'));

        	break;



        	case 'cancelar_deptos':
        		$aux = DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id as dnidep','departamentos.clave_depto','departamentos.depto','areas.id as dniareas','areas.area')
        					->first();
        		$areas=DB::connection('DB_Serverr')->table('areas')->get();
        		$deptos=DB::connection('DB_Serverr')->table('departamentos')
        					->join('areas','areas.id','=','departamentos.areas_id')
        					->select('departamentos.id','departamentos.clave_depto','departamentos.depto','areas.id','areas.area')
        					->get();
        		return view('departamentos.cruddeptos', compact('aux','areas','deptos'));
        	break; 
        	
        	default:
        		# code...
        	break;
        }
        
    	//$areas=DB::connection('DB_Serverr')->table('areas')->get();
    	//return view('departamentos.cruddeptos', compact('areas'));

    }

    public function registrardeptos($datos){
    	
    	$empresa= Session::get('clave_empresa');
    	$sub = substr ($empresa , 0 ,3 );
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
    //$areas=DB::connection('DB_Serverr')->table('areas')->get();
    DB::connection('DB_Serverr')->insert('insert into departamentos (clave_depto,depto,areas_id)
    values (?,?,?)',[$sub.$datos->clave_depto,$datos->depto,$datos->areas_id]);
    }


    public function actualizardeptos($datos){
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
    $clavedeptos=$datos->clave_depto;
    $aux1 = DB::connection('DB_Serverr')->table('departamentos')->where('clave_depto',$clavedeptos)->first();
    DB::connection('DB_Serverr')->table('departamentos')->where('clave_depto',$datos->clave_depto)->update(['clave_depto'=>$datos->clave_depto,'depto'=>$datos->depto,'areas_id'=>$datos->areas_id]);
    

    }
}
