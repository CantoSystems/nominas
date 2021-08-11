<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AreasController extends Controller
{
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
    * @return vista   | $areas | array | $aux | array
    */
    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;
        $clave_ar=$request->clave_area;
        $indic=$request->identificador;
           switch ($accion) {
              case '':
                $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
              break;
              case 'atras':
                $aux = DB::connection('DB_Serverr')->table('areas')->where('id','<',$indic)->orderBy('id','desc')->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('areas')->get()->last();
                }
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
                break;
              case 'siguiente':
                $aux = DB::connection('DB_Serverr')->table('areas')->where('id','>',$indic)->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                }
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
               break;
               case 'primero':
                $aux = DB::connection('DB_Serverr')->table('areas')->first();
                $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
               break;
               case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('areas')->get()->last();
               $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
               break;
               case 'registrar':
               $this->registrar($request);
               return redirect()->route('areas.index');
               break;
               case 'actualizar':
                $aux1 = DB::connection('DB_Serverr')->table('areas')->where('id',$indic)->first();
                   if($aux1!==""){

                  $request->validate([
                  'area' => 'required',
                  'clave_area' => 'required',
                  ]);

                   DB::connection('DB_Serverr')->table('areas')->where('id',$indic)->update([
                              'area'=>$request->area, 
                              'clave_area'=>$request->clave_area,
                            ]);
                   $aux = DB::connection('DB_Serverr')->table('areas')->get()->first();
                   $areas = DB::connection('DB_Serverr')->table('areas')->get();
                return view('Areas.area',compact('aux','areas'));
                   }
               break;
               case 'cancelar':
                 return redirect()->route('areas.index');
                 break;

                case 'buscar':
                  $criterio= $request->opcion;
                  
                  if($criterio == 'clave_area'){
                      $aux = DB::connection('DB_Serverr')->table('areas')->where('clave_area',$request->busca)->first();

                      if ($aux == "")
                      {
                        return back()->with('busqueda','Coincidencia no encontrada');
                      }

                       $areas = DB::connection('DB_Serverr')->table('areas')->get();
                       return view('Areas.area',compact('aux','areas'));
                      
                  }else if($criterio == 'area'){

                      $aux = DB::connection('DB_Serverr')->table('areas')->where('area',$request->busca)->first();

                      if ($aux == "") {
                        return back()->with('busqueda','Coincidencia no encontrada');
                      }
                      
                       $areas = DB::connection('DB_Serverr')->table('areas')->get();
                      return view('Areas.area',compact('aux','areas'));
                  }
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
              'area' => 'required',
              'clave_area' => 'required',
      ]);

      $coincidencia = DB::connection('DB_Serverr')->table('areas')
        ->where('area','=',$datos->area)
        ->orwhere('clave_area','=',$datos->clave_area)    
        ->get();

        if($coincidencia->count() == 0){
          $fecha_periodo = now()->toDateString();
          DB::connection('DB_Serverr')->insert('insert into areas (area,clave_area,created_at,updated_at)
            values (?,?,?,?)',[$datos->area,$datos->clave_area,$fecha_periodo,$fecha_periodo]);
        }else{
          return back()->with('msj','Registro duplicado');
        }
    }

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

  public function eliminararea($id){
    $clv=Session::get('clave_empresa');
    $clave_area= $this->generador();
    $clv_empresa=$this->conectar($clv);


    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $aux1 = DB::connection('DB_Serverr')->table('areas')->where('id',$id)->delete();
    return redirect()->route('areas.index');
  }
}
