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
          
        break;

        case 'siguiente':
          
        break;

        case 'primero':
          
        break;

        case 'ultimo':
          
        break;

        case 'registrar':
          
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
}
