<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Schema;

class ExtrasController extends Controller{
    public function index(Request $request){
        $clv=Session::get('clave_empresa');
        $identificador_periodo = Session::get('num_periodo');
        $clv_empresa=$this->conectar($clv);
        $indic=$request->id_tiempo;
         
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $accion= $request->acciones;

         switch ($accion) {
            case '':
                $extras_horas = DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->orderBy('id_tiempo')->first();

                $aux= DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->orderBy('id_tiempo')->get();

                return view('tiempo_extra.crudextras',compact('extras_horas','aux')); 
            break;
            case 'cancelar':
                return redirect()->route('horasextras.index');
            break;
            case 'primero':
                $extras_horas = DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->orderBy('id_tiempo')->first();

                $aux= DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->orderBy('id_tiempo')->get();

                return view('tiempo_extra.crudextras',compact('extras_horas','aux'));
            break;
            case 'ultimo':
               $extras_horas = DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->orderBy('id_tiempo')
                ->get()->last();

                 $aux= DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->orderBy('id_tiempo')->get();

                return view('tiempo_extra.crudextras',compact('extras_horas','aux'));
            break;
            case 'siguiente':
               $extras_horas = DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->where('id_tiempo','>',$indic)
                ->orderBy('id_tiempo')->first();

                if(is_null($extras_horas)){
                     $extras_horas = DB::connection('DB_Serverr')->table('tiempo_extra')
                    ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                    ->select('tiempo_extra.*','empleados.*')
                    ->orderBy('id_tiempo')->first();
                }

                $aux= DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->orderBy('id_tiempo')->get();

                return view('tiempo_extra.crudextras',compact('extras_horas','aux'));

                break;
            case 'atras':
                $extras_horas = DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->where('id_tiempo','<',$indic)
                ->orderBy('id_tiempo', 'DESC')->first();
     
                if(is_null($extras_horas)){
                     $extras_horas = DB::connection('DB_Serverr')->table('tiempo_extra')
                    ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                    ->select('tiempo_extra.*','empleados.*')
                    ->orderBy('id_tiempo')
                    ->get()->last();
                }

                 $aux= DB::connection('DB_Serverr')->table('tiempo_extra')
                ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                ->select('tiempo_extra.*','empleados.*')
                ->orderBy('id_tiempo')->get();

                return view('tiempo_extra.crudextras',compact('extras_horas','aux'));
            break;
            case 'actualizar':
                $this->actualizarextras($request);
                return redirect()->route('horasextras.index');
            break;
            case 'buscar':
                $criterio= $request->opcion;
                if($criterio == 'identificador'){
                    $extras_horas = DB::connection('DB_Serverr')->table('tiempo_extra')
                    ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                    ->select('tiempo_extra.*','empleados.*')
                    ->where('id_tiempo',$request->busca)
                    ->first();

                    if($extras_horas == ""){
                            return back()->with('busqueda','Coincidencia no encontrada');
                    }

                    $aux= DB::connection('DB_Serverr')->table('tiempo_extra')
                    ->join('empleados','empleados.clave_empleado','=','tiempo_extra.clave_empleado')
                    ->select('tiempo_extra.*','empleados.*')
                    ->orderBy('id_tiempo')->get();

                    return view('tiempo_extra.crudextras',compact('extras_horas','aux'));
                }

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

    public function registrarextras($datos){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
              'clave_empledo' => 'required',
              'cantidad_tiempo' => 'required',
              'fecha_extra' => 'required',
        ]);

        DB::connection('DB_Serverr')->insert('insert into tiempo_extra (
            periodo_id,
            clave_empleado,
            cantidad_tiempo,
            fecha_extra)
            values (?,?,?,?)',[ $datos->periodo_id,
                                    $datos->clave_empledo,
                                    $datos->cantidad_tiempo,
                                    $datos->fecha_extra,

                                ]);
    }

    public function actualizarextras($datos){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

         $datos->validate([
              'clave_empledo' => 'required',
              'cantidad_tiempo' => 'required',
              'fecha_extra' => 'required',
        ]);
         
        $aux1 = DB::connection('DB_Serverr')->table('tiempo_extra')->where('id_tiempo',$datos->id_tiempo)->first();

        DB::connection('DB_Serverr')->table('tiempo_extra')->where('id_tiempo',$datos->id_tiempo)->update(['clave_empleado'=>$datos->clave_empledo,
                    'cantidad_tiempo'=>$datos->cantidad_tiempo,
                    'fecha_extra'=>$datos->fecha_extra
                    ]);
    }

    public function elimina($id_tiempo){
         $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
         $aux1 = DB::connection('DB_Serverr')->table('tiempo_extra')->where('id_tiempo',$id_tiempo)->delete();

        return redirect()->route('horasextras.index');
    }
}