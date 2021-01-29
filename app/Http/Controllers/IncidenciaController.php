<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class IncidenciaController extends Controller{
    public function index(Request $request){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $accion= $request->acciones;
        $indic=$request->identificador;

        switch ($accion) {
            case '':
                $aux = DB::connection('DB_Serverr')->table('incidencias')->first();

                $emp=DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('incidencias.incidencias',compact('aux','emp','conceptos'));
            break;
            /*case 'atras':
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
                $id=DB::connection('DB_Serverr')->table('conceptos')->
                where('clave_concepto',$request->clave_concepto)->first();
                $aux=DB::connection('DB_Serverr')->table('conceptos')->where('id','>',$id->id)
                ->orderBy('id','asc')
                ->first();
                if(is_null($aux)){
                    $aux=DB::connection('DB_Serverr')->table('conceptos')->first();
                }
                return view('conceptos.conceptos', compact('aux'));
            break;
            case 'primero':
                $aux = DB::connection('DB_Serverr')->table('conceptos')->first();
                return view('conceptos.conceptos',compact('aux'));
            break;
            case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('conceptos')->get()->last();
                return view('conceptos.conceptos',compact('aux'));
            break;*/
            case 'registrar':
                $this->registrar($request);
                $aux = DB::connection('DB_Serverr')->table('incidencias')->first();

                $emp=DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('incidencias.incidencias',compact('aux','emp','conceptos'));
            break;
            /*case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('conceptos.index');
            break;
            case 'cancelar':
                return redirect()->route('conceptos.index');
            break;*/
            /*case 'buscar':
                $criterio= $request->opcion;
                if($criterio == 'clave_emp'){
                    $aux = DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$request->busca)->first();
                    if($aux == ""){
                        return back()->with('busqueda','Coincidencia no encontrada');
                    }
                    return view('incidencias.incidencias',compact('aux'));
                }else if($criterio == 'nombre_emp'){
                    $aux = DB::connection('DB_Serverr')->table('empleados')->where('nombre',$request->busca)->first();
                    if($aux == ""){
                        return back()->with('busqueda','Coincidencia no encontrada');
                    }
                    return view('incidencias.incidencias',compact('aux'));
                }
            break;*/
            default:
            break;
        }
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
    
    public function registrar($datos){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        /*$datos->validate([
              'clave_concepto' => 'required',
              'concepto' => 'required',
              'formula' => 'required',
              'naturaleza' => 'required',
              'manejo' => 'required',
        ]);*/

        DB::connection('DB_Serverr')->insert('INSERT INTO incidencias (clave_concepto
                                                                      ,clave_empleado
                                                                      ,cantidad
                                                                      ,importe
                                                                      ,monto)
                                                                VALUES (?
                                                                       ,?
                                                                       ,?
                                                                       ,?
                                                                       ,?)',[$datos->clave_concepto
                                                                            ,$datos->claveEmp
                                                                            ,$datos->cantidad
                                                                            ,$datos->importe
                                                                            ,$datos->monto]);
    }

    public function seleccionarempleado($clave_emp){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux = DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$clave_emp)->get()->first();
        $emp=DB::connection('DB_Serverr')->table('empleados')->get();
        $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();
        return view('incidencias.incidencias',compact('aux','emp','conceptos'));
    }

    public function seleccionarempleado2($clave_emp,$clave_con){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('clave_concepto',$clave_con)->get()->first();
        $aux = DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$clave_emp)->get()->first();
        $emp = DB::connection('DB_Serverr')->table('empleados')->get();
        $conceptos = DB::connection('DB_Serverr')->table('conceptos')->get();
        return view('incidencias.incidencias',compact('aux','emp','conceptos','aux1'));
    }

    public function seleccionarconcept($clave_con){
        $clv = Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('clave_concepto',$clave_con)->get()->first();
        $conceptos = DB::connection('DB_Serverr')->table('conceptos')->get();
        $emp = DB::connection('DB_Serverr')->table('empleados')->get();
        return view('incidencias.incidencias',compact('aux1','conceptos','emp'));
    }

    public function seleccionarconcept2($clave_con,$clave_emp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('clave_concepto',$clave_con)->get()->first();
        $aux = DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$clave_emp)->get()->first();
        $conceptos = DB::connection('DB_Serverr')->table('conceptos')->get();
        $emp = DB::connection('DB_Serverr')->table('empleados')->get();
        return view('incidencias.incidencias',compact('aux1','conceptos','emp','aux'));
    }
}