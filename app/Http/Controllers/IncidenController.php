<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class IncidenController extends Controller{
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
                ->where('incidencias.status_incidencias','!=',0)
                ->orderBy('id_incidencia')->first();

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('incidencias.status_incidencias','!=',0)
                ->orderBy('id_incidencia')->get();

                return view('incidencias.incidencias2',compact('incidencias2','incidencias'));
            break;
            case 'atras':
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('id_incidencia','<',$request->idIncidencia)
                ->where('incidencias.status_incidencias','!=',0)
                ->orderBy('id_incidencia', 'DESC')->first();

                if(is_null($incidencias)){
                    $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                        ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                        ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                        ->select('incidencias.*','empleados.*','conceptos.concepto')
                        ->where('incidencias.status_incidencias','!=',0)
                        ->orderBy('id_incidencia')
                        ->get()->last();
                }

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('incidencias.status_incidencias','!=',0)
                ->orderBy('id_incidencia')->get();

                return view('incidencias.incidencias2',compact('incidencias2','incidencias'));
            break;
            case 'siguiente':
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('id_incidencia','>',$request->idIncidencia)
                ->where('incidencias.status_incidencias','!=',0)
                ->orderBy('id_incidencia')->first();

                if(is_null($incidencias)){
                    $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                        ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                        ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                        ->select('incidencias.*','empleados.*','conceptos.concepto')
                        ->where('incidencias.status_incidencias','!=',0)
                        ->orderBy('id_incidencia')->first();

                }

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('incidencias.status_incidencias','!=',0)
                ->orderBy('id_incidencia')->get();

                return view('incidencias.incidencias2',compact('incidencias2','incidencias'));
            break;
            case 'primero':
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('incidencias.status_incidencias','!=',0)
                ->first();

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('incidencias.status_incidencias','!=',0)
                ->orderBy('id_incidencia')->get();


                return view('incidencias.incidencias2',compact('incidencias2','incidencias'));
            break;
            case 'ultimo':
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('incidencias.status_incidencias','!=',0)
                ->get()->last();

                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('incidencias.status_incidencias','!=',0)
                ->orderBy('id_incidencia')->get();

                return view('incidencias.incidencias2',compact('incidencias2','incidencias'));
            break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('incid2.index');
            break;
            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('incid2.index');
            break;
            case 'cancelar':
                return redirect()->route('incid2.index');
            break;
            case 'buscar':
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('id_incidencia',$request->idIncidenciaSearch)
                ->first();
                
                $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->get();


                if($incidencias == ""){
                    return back()->with('busqueda','Coincidencia no encontrada');
                }
                return view('incidencias.incidencias2',compact('incidencias','incidencias2'));
            break;
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
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
                'clave_empledo' => 'required',
                'concepto_clave' => 'required',
                'cantidad' => 'required',
                'importe' => 'required',
                'monto'  => 'required',
                'status_incidencias'  => 'required',
        ]);

        DB::connection('DB_Serverr')->insert('INSERT INTO incidencias (clave_concepto
                                                                      ,clave_empleado
                                                                      ,cantidad
                                                                      ,importe
                                                                      ,monto
                                                                      ,status_incidencias)
                                                                VALUES (?
                                                                       ,?
                                                                       ,?
                                                                       ,?
                                                                       ,?
                                                                       ,?)',[$datos->concepto_clave
                                                                            ,$datos->clave_empledo
                                                                            ,$datos->cantidad
                                                                            ,$datos->importe
                                                                            ,$datos->monto
                                                                            ,$datos->status_incidencias]);
    }

    public function actualizar($datos){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $datos->validate([
                'clave_empledo' => 'required',
                'concepto_clave' => 'required',
                'cantidad' => 'required',
                'importe' => 'required',
                'monto' => 'required',
                'status_incidencias'  => 'required',
        ]);

        DB::connection('DB_Serverr')->table('incidencias')
        ->where('id_incidencia',$datos->idIncidencia)
        ->update(['clave_concepto'=>$datos->concepto_clave
                    ,'clave_empleado'=>$datos->clave_empledo
                    ,'cantidad'=>$datos->cantidad
                    ,'importe'=>$datos->importe
                    ,'monto'=>$datos->monto
                    ,'status_incidencias'=>$datos->status_incidencias]);
    }

    public function show($id_incidencia){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->where('id_incidencia',$id_incidencia)
                ->first();

        $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                ->select('incidencias.*','empleados.*','conceptos.concepto')
                ->orderBy('id_incidencia')->get();

                return view('incidencias.incidencias2',compact('incidencias2','incidencias'));


    }

    public function eliminar($id){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        
        $aux1 = DB::connection('DB_Serverr')->table('incidencias')->where('id_incidencia',$id)->delete();
        
        return redirect()->route('incid2.index');
    }
}