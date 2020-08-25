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
        $fecha=$request->fecha_inicio;
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
                $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('fecha_inicio',$fecha)->first();
                    if($aux1!==""){
                        DB::connection('DB_Serverr')->table('periodos')->where('fecha_inicio',$request->fecha_inicio)->update(['fecha_inicio'=>$request->fecha_inicio,'fecha_fin'=>$request->fecha_fin,'fecha_pago'=>$request->fecha_pago,]);
                        $aux = DB::connection('DB_Serverr')->table('periodos')->get()->first();
                        return view('periodos.crudperiodos',compact('aux'));
                   }

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

}
