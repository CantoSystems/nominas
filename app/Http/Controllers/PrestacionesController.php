<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
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
                    $aux1 = DB::connection('DB_Serverr')->table('prestaciones')->where('id',$indic)->first();
                    if($aux1!==""){
                        DB::connection('DB_Serverr')->table('prestaciones')->where('id',$request->indic)->update(['anio'=>$request->anio,'dias'=>$request->dias,'prima_vacacional'=>$request->prima_vacacional,'aguinaldo'=>$request->aguinaldo]);
                        $aux = DB::connection('DB_Serverr')->table('prestaciones')->get()->first();
                        $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')->get();
                        return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                    }
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
                case 'cancelar':
                    return redirect()->route('prestaciones.index');
                break;
                case 'buscar':
                    $criterio= $request->opcion;
                    if($criterio=='prestaciones'){
                        $aux = DB::connection('DB_Serverr')->table('prestaciones')->where('prestaciones',$request->busca)->first();
                    }
                    if($criterio=='clave'){
                        $aux = DB::connection('DB_Serverr')->table('prestaciones')->where('clave_prestaciones',$request->busca)->first();
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
        if($datos->anio === null){
            return redirect()->route('prestaciones.index');
        }
        $clv=Session::get('clave_empresa');
        $clave_pr= $this->generador();
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        DB::connection('DB_Serverr')->insert('insert into prestaciones (anio,dias,prima_vacacional,aguinaldo) values (?,?,?,?)',[$datos->anio,$datos->dias,$datos->prima_vacacional,$datos->aguinaldo]);
    }

   /**
      *Genera un numero random de digitos
      *Para la clave indicadora del banco
      * @version V1
      * @author Gustavo
      * @param void
      * @return $codigo | int
      */
    public function generador(){
        $raiz= '0123456789';
        $codigo='';
        for ($i=0; $i < 3; $i++) {
            $letra= $raiz[mt_rand(0, 4 - 1)];
            $codigo .=$letra;
        }
        return $codigo;
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

    public function eliminarprestacion($id){
        $clv=Session::get('clave_empresa');
        $clave_pr= $this->generador();
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux1 = DB::connection('DB_Serverr')->table('prestaciones')->where('id',$id)->delete();
        return redirect()->route('prestaciones.index');
    }
}
