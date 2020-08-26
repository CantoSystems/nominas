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

 public function agregarperiodos($datos){
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
    values (?,?,?,?)',[$cant,$datos->fecha_inicio,$datos->fecha_fin,$datos->fecha_pago]);
    //return redirect()->action('PeriodosController@index'); 
 }

    public function seleccionarperiodo(Request $request){
        Session::put('num_periodo',$request->periodo);
        return view('layouts.segunda');
    }

    public function acciones(Request $request){
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
                $aux = DB::connection('DB_Serverr')->table('periodos')->first();
                return view('periodos.crudperiodos',compact('aux'));
            break;

            case 'atras':
                $aux = DB::connection('DB_Serverr')->table('periodos')->where('id','<',$indic)->latest('id')->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('periodos')->get()->last();
                }
                return view('periodos.crudperiodos',compact('aux'));
            break;

            case 'siguiente':
                $aux = DB::connection('DB_Serverr')->table('periodos')->where('id','>',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('periodos')->first();
                }
                return view('periodos.crudperiodos',compact('aux'));
            break;

            case 'primero':
                $aux = DB::connection('DB_Serverr')->table('periodos')->first();
                return view('periodos.crudperiodos',compact('aux'));
            break;

            case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('periodos')->latest('id')->first();
                return view('periodos.crudperiodos',compact('aux')); 
            break;

            case 'registrar':
                $this->agregarperiodos($request);
                $aux = DB::connection('DB_Serverr')->table('periodos')->first();
                return view('periodos.crudperiodos',compact('aux'));
            break;

            case 'actualizar':
                $this->actualizarperiodos($request);
                $aux = DB::connection('DB_Serverr')->table('periodos')->get()->first();
                return view('periodos.crudperiodos',compact('aux'));
            break;

            case 'eliminar':

            break;



            case 'cancelar_periodos':
                return back();
            break;





            default:
                # code...
            break;
        }


        //return view('periodos.crudperiodos');
    }

    public function actualizarperiodos($datos){

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
    $fecha=$datos->fecha_inicio;

    $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('fecha_inicio',$fecha)->first();
    
        DB::connection('DB_Serverr')->table('periodos')->where('fecha_inicio',$datos->fecha_inicio)->update(['fecha_inicio'=>$datos->fecha_inicio,'fecha_fin'=>$datos->fecha_fin,'fecha_pago'=>$datos->fecha_pago,]);
        

    }

    public function eliminarperiodo($id){
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
    $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('id',$id)->delete();

    $aux = DB::connection('DB_Serverr')->table('periodos')->get()->first();
    return view('periodos.crudperiodos',compact('aux'));
    }


}
