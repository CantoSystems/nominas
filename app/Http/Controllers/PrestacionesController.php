<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class PrestacionesController extends Controller{
    /**
    * Control de los botones siguiente | atras | delante | ultimo
    * Realiza el vaciado de los registros en la tabla así como en
    * el Datatable mediante las consultas
    * Consultas mediante Builder Query
    *  Conexion enviado a la función Conectr
    * Se envia la clave de la empresa
    * Envia el Request a los metodos actualizar | registar
    * Implementa un modal de busqueda
    * Elimina registro modal
    * @version V1
    * @author Gustavo
    * @param $request | Array
    * @return vista   | $prestacioness | array | $aux | array
    */
    public function index(Request $request){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;
        $clave_pr=$request->id;
        $indic=$request->identificador;
            switch ($accion) {
                case '':
                    $aux = DB::connection('DB_Serverr')->table('prestaciones')->get()->first();
                    $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
                    return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
                case 'atras':
                    $aux = DB::connection('DB_Serverr')->table('prestaciones')->where('id','<',$indic)->orderBy('id','desc')->first();
                    if($aux==""){
                        $aux = DB::connection('DB_Serverr')->table('prestaciones')->get()->last();
                    }
                    $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
                    return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                    break;
                case 'siguiente':
                    $aux = DB::connection('DB_Serverr')->table('prestaciones')->where('id','>',$indic)->first();
                    if($aux==""){
                        $aux = DB::connection('DB_Serverr')->table('prestaciones')->get()->first();
                    }
                    $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
                    return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
                case 'primero':
                    $aux = DB::connection('DB_Serverr')->table('prestaciones')->first();
                    $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
                    return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
                case 'ultimo':
                    $aux = DB::connection('DB_Serverr')->table('prestaciones')->get()->last();
                    $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
                    return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
                case 'registrar':
                    $this->registrar($request);
                    return redirect()->route('prestaciones.index');
                break;
                case 'actualizar':
                    $this->actualizarprestciones($request);
                    return redirect()->route('prestaciones.index');
                break;
                case 'eliminar':
                    $aux1 = DB::connection('DB_Serverr')->table('prestaciones')->where('id',$clave_pr)->first();
                    if($aux1!==""){
                        DB::connection('DB_Serverr')->table('prestaciones')->where('id',$request->clave_pr)->delete();
                        $aux = DB::connection('DB_Serverr')->table('prestaciones')->get()->first();
                        $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
                        return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                    }
                break;
                case 'cancelar_prestaciones':
                    return redirect()->route('prestaciones.index');
                break;
                case 'buscar':
                    $aux =  DB::connection('DB_Serverr')->table('prestaciones')->where('anio',$request->busca)->first();

                    if($aux==""){
                    return back()->with('busqueda','Coincidencia no encontrada');
                    }

                    $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
                    return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
                default:
                    # code...
                    break;
            }
    }

    /**
         *
        * Recibe el $request del metodo accciones $datos
        * Conexión $clv_Empresa
        * Builder Query insert
        * Valida el nombre del area no venga vacio
        * guarda el resultado del funcion generador
        * @version V1
        * @author Gustavo
        * @param void
        * @return void
    */
    public function registrar($datos){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
              'anio' => 'required',
              'dias' => 'required',
              'prima_vacacional' => 'required',
              'aguinaldo' => 'required'
        ]);

        $coincidencia = DB::connection('DB_Serverr')->table('prestaciones')
        ->where('anio','=',$datos->anio)
        ->get();

        if($coincidencia->count() == 0){
            $fecha_periodo = now()->toDateString();
            DB::connection('DB_Serverr')->insert('insert into prestaciones (anio,dias,prima_vacacional,aguinaldo,created_at,updated_at) values (?,?,?,?,?,?)',[$datos->anio,$datos->dias,$datos->prima_vacacional,$datos->aguinaldo,$fecha_periodo,$fecha_periodo]);
        }else{
            return back()->with('msj','Registro duplicado');
        }
    }

    public function actualizarprestciones($datos){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $clv2=$datos->identificador;
        $datos->validate([
              'anio' => 'required',
              'dias' => 'required',
              'prima_vacacional' => 'required',
              'aguinaldo' => 'required'
        ]);

        $aux1 = DB::connection('DB_Serverr')->table('prestaciones')->where('id',$clv2)->first();

        DB::connection('DB_Serverr')->table('prestaciones')->where('id',$clv2)->update(['anio'=>$datos->anio,'dias'=>$datos->dias,'prima_vacacional'=>$datos->prima_vacacional,'aguinaldo'=>$datos->aguinaldo]);
    }

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
    public function show($id){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux = DB::connection('DB_Serverr')->table('prestaciones')
            ->where('id',$id)
            ->first();
        $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
        return view('prestaciones.prestaciones',compact('aux','prestaciones'));


    }

    public function eliminarprestacion($id){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux1 = DB::connection('DB_Serverr')->table('prestaciones')->where('id',$id)->delete();
        return redirect()->route('prestaciones.index');
    }
}
