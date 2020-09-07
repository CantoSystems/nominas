<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ConceptosController extends Controller
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
            $aux = DB::connection('DB_Serverr')->table('conceptos')->first(); 
            return view('conceptos.conceptos',compact('aux'));
        break;

        case 'atras':
            $id=DB::connection('DB_Serverr')->table('conceptos')->
            where('clave_concepto',$request->clave_concepto)->first();
               $aux=DB::connection('DB_Serverr')->table('conceptos')->where('id','<',$id->id)
            ->orderBy('id','desc')
            ->first();
            if(is_null($aux)){
                $aux=DB::connection('DB_Serverr')->table('conceptos')->get()->last();
            }
            return view('conceptos.conceptos', compact('aux'));
        break;

        case 'siguiente':
          
        break;

        case 'primero':
          
        break;

        case 'ultimo':
          
        break;

        case 'registrar':
            $this->registar($request);
            $aux = DB::connection('DB_Serverr')->table('conceptos')->first(); 
            return view('conceptos.conceptos',compact('aux'));
        break;

        case 'actualizar':
          
        break;

        case 'cancelar':
            return back();
        break;

        default:
            
        break;

    }
   
 }
 public function registrar($datos){
    $clv=Session::get('clave_empresa');
    $clave_concepto= $this->generador();
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
    DB::connection('DB_Serverr')->insert('insert into conceptos (clave_concepto,concepto,formula,naturaleza,manejo
    ,cantidad,importe,monto,ispt,imss,infonavit,estatal)
    values (?,?,?,?,?,?,?,?,?,?,?,?)',[$clave_concepto,$datos->concepto,$datos->formula,$datos->naturaleza
    ,$datos->manejo,$datos->cantidad,$datos->importe,$datos->monto,$ispt,$imss,$infonavit,$estatal]);
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
}
