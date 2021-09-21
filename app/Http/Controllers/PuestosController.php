<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;


class PuestosController extends Controller
{

    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;
        $clave_p=$request->clave_area;
        $indic=$request->identificador;
           switch ($accion) {

              case '':
                $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
              break;

              case 'atras':
                $aux = DB::connection('DB_Serverr')->table('puestos')->where('id','<',$indic)->orderBy('id','desc')->first();
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('puestos')->get()->last();
                }
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
              break;

              case 'siguiente':
                  $aux = DB::connection('DB_Serverr')->table('puestos')->where('id','>',$indic)->first();
                  if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                  }
                  $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                  return view('puestos.puestos',compact('aux','puestos'));
              break;

              case 'primero':
                $aux = DB::connection('DB_Serverr')->table('puestos')->first();
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
              break;

              case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('puestos')->get()->last();
                $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                return view('puestos.puestos',compact('aux','puestos'));
              break;

              case 'registrar':
                  $this->registrar($request);
                  return redirect()->route('puestos.index');
              break;

              case 'actualizar':
                 $aux1 = DB::connection('DB_Serverr')->table('puestos')->where('id',$indic)->first();
                   if($aux1!==""){

                    $request->validate([
                    'clave_puesto' => 'required',
                    'puesto' => 'required',
                    ]);
                    
                   DB::connection('DB_Serverr')->table('puestos')->where('id',$indic)->update([
                              'nombre_puesto'=>$request->puesto,
                              'updated_at'=>$request->clave_puesto,
                            ]);
                   $aux = DB::connection('DB_Serverr')->table('puestos')->get()->first();
                   $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
                   return view('puestos.puestos',compact('aux','puestos'));
                   }
              break;
              case 'cancelar':
                 return redirect()->route('puestos.index');
              break;

              case 'buscar':
                  $criterio= $request->opcion;

                  if($criterio == 'clave_puesto'){
                      
                      $aux = DB::connection('DB_Serverr')->table('puestos')->where('clave_puesto',$request->busca)->first();

                        if($aux == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }

                      $puestos = DB::connection('DB_Serverr')->table('puestos')->get();
                      return view('puestos.puestos',compact('aux','puestos'));
                  }else if($criterio == 'nombre_puesto')
                  {
                    $aux = DB::connection('DB_Serverr')->table('puestos')->where('nombre_puesto',$request->busca)->first();

                        if($aux == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }

                    $puestos = DB::connection('DB_Serverr')->table('puestos')->get();
                    return view('puestos.puestos',compact('aux','puestos'));
                  }

              break;
              default:
                   # code...
              break;
}
}

    public function registrar($datos){
      $clv=Session::get('clave_empresa');
      $clv_empresa=$this->conectar($clv);
      \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $datos->validate([
              'clave_puesto' => 'required',
              'puesto' => 'required',
        ]);

        $coincidencia = DB::connection('DB_Serverr')->table('puestos')
        ->where('clave_puesto','=',$datos->clave_puesto)
        ->orwhere('nombre_puesto','=',$datos->puesto)    
        ->get();

        if($coincidencia->count() == 0){
              DB::connection('DB_Serverr')->insert('insert into puestos (clave_puesto, nombre_puesto)
                values (?,?)',[$datos->clave_puesto,$datos->puesto]);
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

  public function show($id){
    $clv=Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);

    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $aux = DB::connection('DB_Serverr')->table('puestos')
      ->where('id','=',$id)
      ->first();
    $puestos= DB::connection('DB_Serverr')->table('puestos')->get();
    return view('puestos.puestos',compact('aux','puestos'));


  }

  public function eliminarpuestos($id){
    $clv=Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $aux1 = DB::connection('DB_Serverr')->table('puestos')->where('id',$id)->delete();
    return redirect()->route('puestos.index');
  }
}
