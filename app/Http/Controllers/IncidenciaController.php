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
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->first();

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->get();

                $emp=DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('incidencias.incidencias',compact('incidencias2','incidencias','emp','conceptos'));
            break;
            case 'atras':
                $idIncidencia = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->first();
                
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->where('id_incidencia','<',$idIncidencia->id_incidencia)
                ->orderBy('id_incidencia','desc')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->first();

                if(is_null($incidencias)){
                    $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                    ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                    ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                    ->select('incidencias.*','empleados.*','conceptos.concepto')
                    ->get()
                    ->last();
                }

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->get();

                $emp=DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();
                
                return view('incidencias.incidencias',compact('incidencias2','incidencias','emp','conceptos'));
            break;
            case 'siguiente':
                $idIncidencia = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->first();
                
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->where('id_incidencia','>',$idIncidencia->id_incidencia)
                ->orderBy('id_incidencia','asc')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->first();

                if(is_null($incidencias)){
                    $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                    ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                    ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                    ->select('incidencias.*','empleados.*','conceptos.concepto')
                    ->first();
                }

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->get();

                $emp=DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();
                
                return view('incidencias.incidencias',compact('incidencias2','incidencias','emp','conceptos'));
            break;
            case 'primero':
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->first();

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->get();

                $emp=DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('incidencias.incidencias',compact('incidencias2','incidencias','emp','conceptos'));
            break;
            case 'ultimo':
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->get()
                ->last();

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->get();

                $emp=DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('incidencias.incidencias',compact('incidencias2','incidencias','emp','conceptos'));
            break;
            case 'registrar':
                $this->registrar($request);
                $aux = DB::connection('DB_Serverr')->table('incidencias')->first();

                $emp=DB::connection('DB_Serverr')->table('empleados')->get();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('incidencias.incidencias',compact('aux','emp','conceptos'));
            break;
            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('incidencias.index');
            break;
            case 'cancelar':
                return redirect()->route('incidencias.index');
            break;
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

        DB::connection('DB_Serverr')->insert('INSERT INTO incidencias (clave_concepto
                                                                      ,clave_empleado
                                                                      ,cantidad
                                                                      ,importe
                                                                      ,monto)
                                                                VALUES (?
                                                                       ,?
                                                                       ,?
                                                                       ,?
                                                                       ,?)',[$datos->concepto_clave
                                                                            ,$datos->clave_empledo
                                                                            ,$datos->cantidad
                                                                            ,$datos->importe
                                                                            ,$datos->monto]);
    }

    public function actualizar($datos){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
              'concepto_clave' => 'required',
              'clave_empledo' => 'required',
              'cantidad' => 'required',
              'importe' => 'required',
              'monto' => 'required',
        ]);

        DB::connection('DB_Serverr')->table('incidencias')->where('id_incidencia',$datos->idIncidencia)
        ->update(['clave_concepto'=>$datos->concepto_clave
                 ,'clave_empleado'=>$datos->clave_empledo
                 ,'cantidad'=>$datos->cantidad
                 ,'importe'=>$datos->importe
                 ,'monto'=>$datos->monto]);
    }
}