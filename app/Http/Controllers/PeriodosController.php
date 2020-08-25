<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class PeriodosController extends Controller
{
 public function index(){
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
$periodos=DB::connection('DB_Serverr')->table('periodos')->get();
$cant=DB::connection('DB_Serverr')->table('periodos')->count();
return view('periodos.periodos',compact('periodos','cant'));
 }

 public function agregarperiodos(Request $request){
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
    $cant=DB::connection('DB_Serverr')->table('periodos')->count();
    DB::connection('DB_Serverr')->insert('insert into periodos (numero,fecha_inicio,fecha_fin,fecha_pago)
    values (?,?,?,?)',[$cant,$request->fecha_inicio,$request->fecha_fin,$request->fecha_pago]);
    return redirect()->action('PeriodosController@index'); 
 }

 public function seleccionarperiodo(Request $request){
Session::put('num_periodo',$request->periodo);
return view('layouts.segunda');
 }
}
