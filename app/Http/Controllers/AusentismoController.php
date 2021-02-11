<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Schema;

class AusentismoController extends Controller
{
    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        $periodo= Session::get('num_periodo');
        $indic=$request->id;
         
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
         $accion= $request->acciones;


         switch ($accion) {
             case '':
                $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('numero','=',$periodo)
                ->first();

                $empleado=DB::connection('DB_Serverr')->table('empleados')
                        ->get();

                $ausentismo= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->select('ausentismos.*','empleados.*')
                ->orderBy('id')->first();
                //dd($ausentismo);

                $aux= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','ausentismos.clave_concepto')
                ->join('periodos','periodos.id','=','ausentismos.identificador_periodo')
                ->select('ausentismos.*','empleados.*','conceptos.*','periodos.*')
                ->get();
                
                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo','aux'));
            break;

            case 'cancelar':
                 return redirect()->route('ausentismo.index');
            break;

            case 'registrar':
                $this->registrar($request);
                return redirect()->route('ausentismo.index');
            break;

            case 'atras':
            //return 1;
                $ausentismo= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->select('ausentismos.*','empleados.*')
                ->where('ausentismos.id','<',$indic)
                ->latest('id')->first();
                if($ausentismo == ""){
                $ausentismo= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->select('ausentismos.*','empleados.*')
                ->get()
                ->last();
                }

                $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('id','=',$periodo)
                ->first();

                $empleado=DB::connection('DB_Serverr')->table('empleados')
                        ->get();

                $aux= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','ausentismos.clave_concepto')
                ->join('periodos','periodos.id','=','ausentismos.identificador_periodo')
                ->select('ausentismos.*','empleados.*','conceptos.*','periodos.*')
                ->get();
                
                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo','aux'));   
            break;

            case 'siguiente':
            //return 2;
                $ausentismo= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->select('ausentismos.*','empleados.*')
                ->where('ausentismos.id','>',$request->id)
                ->orderBy('id')->first();

                if(is_null($ausentismo))
                {
                    $ausentismo= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->select('ausentismos.*','empleados.*')
                ->orderBy('id')
                ->first();
                }

                $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('id','=',$periodo)
                ->first();

                $empleado=DB::connection('DB_Serverr')->table('empleados')
                        ->get();

                $aux= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','ausentismos.clave_concepto')
                ->join('periodos','periodos.id','=','ausentismos.identificador_periodo')
                ->select('ausentismos.*','empleados.*','conceptos.*','periodos.*')
                ->get();
                
                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo','aux'));
            break;

            case 'primero':
                $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('id','=',$periodo)
                ->first();

                $empleado=DB::connection('DB_Serverr')->table('empleados')
                        ->get();

                $ausentismo= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->select('ausentismos.*','empleados.*')
                ->orderBy('id')->first();

                //dd($ausentismo);

                $aux= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','ausentismos.clave_concepto')
                ->join('periodos','periodos.id','=','ausentismos.identificador_periodo')
                ->select('ausentismos.*','empleados.*','conceptos.*','periodos.*')
                ->get();
                
                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo','aux'));
            break;

            case 'ultimo':

            $ausentismo= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->select('ausentismos.*','empleados.*')
                ->get()
                ->last();
            $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('id','=',$periodo)
                ->first();

            $empleado=DB::connection('DB_Serverr')->table('empleados')
                        ->get();

            $aux= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','ausentismos.clave_concepto')
                ->join('periodos','periodos.id','=','ausentismos.identificador_periodo')
                ->select('ausentismos.*','empleados.*','conceptos.*','periodos.*')
                ->get();
                
                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo','aux'));
            break;

            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('ausentismo.index');
            break;

            case 'buscar':
                $criterio= $request->opcion;
                //dd($criterio);

                if($criterio == 'identificador')
                {
                    $ausentismo = DB::connection('DB_Serverr')->table('ausentismos')
                        ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                        ->select('ausentismos.*','empleados.*')
                        ->where('ausentismos.id',$request->busca)->first();

                        if($ausentismo == ""){
                             return back()->with('busqueda','Coincidencia no encontrada');
                        }


                $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('id','=',$periodo)
                ->first();

                $empleado=DB::connection('DB_Serverr')->table('empleados')
                        ->get();

                $aux= DB::connection('DB_Serverr')->table('ausentismos')
                ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                ->join('conceptos','conceptos.clave_concepto','=','ausentismos.clave_concepto')
                ->join('periodos','periodos.id','=','ausentismos.identificador_periodo')
                ->select('ausentismos.*','empleados.*','conceptos.*','periodos.*')
                ->get();
                
                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo','aux'));

                    
                }else if($criterio == 'incapacidad'){
                    $ausentismo = DB::connection('DB_Serverr')->table('ausentismos')
                        ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                        ->select('ausentismos.*','empleados.*')
                        ->where('incapacidad',$request->busca)->first();

                                if($ausentismo == "")
                                {
                                return back()->with('busqueda','Coincidencia no encontrada');
                                }


                        $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                        ->where('id','=',$periodo)
                        ->first();

                        $empleado=DB::connection('DB_Serverr')->table('empleados')
                        ->get();

                        $aux= DB::connection('DB_Serverr')->table('ausentismos')
                        ->join('empleados','empleados.clave_empleado','=','ausentismos.clave_empleado')
                        ->join('conceptos','conceptos.clave_concepto','=','ausentismos.clave_concepto')
                        ->join('periodos','periodos.id','=','ausentismos.identificador_periodo')
                        ->select('ausentismos.*','empleados.*','conceptos.*','periodos.*')
                        ->get();
                
                        $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                        return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo','aux'));

                }


                break;

             
             default:
                 # code...
                 break;
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

    public function mostrarempleado(Request $request)
    {

        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::connection('DB_Serverr')->table('empleados')
                ->where('clave_empleado','LIKE','%'.$query.'%')
                ->orWhere('nombre','LIKE','%'.$query.'%')
                ->orWhere('apellido_paterno','LIKE','%'.$query.'%')
                ->orWhere('apellido_materno','LIKE','%'.$query.'%')
                ->get();
    
            $output = '<ul  class="dropdpwn-menu"
                            aria-labelledby="dropdownMenuLink"
                            style="display:block;
                            position:relative;">';
                        foreach($data as $row)
                            {
                                $output .= '<li id="empleado" style="list-style:none"><a class="dropdown-item" href="#">'.$row->clave_empleado.'&nbsp;'.$row->nombre.'&nbsp;'.$row->apellido_paterno.'&nbsp;'.$row->apellido_materno.'</a></li>';
                            }
            $output .= '</ul>';
        }
            return  $output;
    }

    public function mostrarconcepto(Request $request)
    {

        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        if($request->get('consulta'))
        {
            $consulta = $request->get('consulta');
            $data = DB::connection('DB_Serverr')->table('conceptos')
                ->where('clave_concepto','LIKE','%'.$consulta.'%')
                ->orWhere('concepto','LIKE','%'.$consulta.'%')
                ->get();
    
            $output = '<ul  class="dropdpwn-menu"
                            aria-labelledby="dropdownMenuLink"
                            style="display:block;
                            position:relative;">';
                        foreach($data as $row)
                            {
                                $output .= '<li id="concepto" style="list-style:none"><a class="dropdown-item" href="#">'.$row->clave_concepto.'&nbsp;'.$row->concepto.'</a></li>';
                            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function registrar($datos){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

         $datos->validate([
              'clave_empledo' => 'required',
              'cantidad_ausentismo' => 'required',
              'concepto_clave' => 'required',
              'fecha_ausentismo' => 'required',
              'incapacidad' => 'required',
              'nombre' => 'required',
              'descripcion' => 'required'
        ]);


        $coincidencia = DB::connection('DB_Serverr')->table('ausentismos')
        ->orWhere('incapacidad','=',$datos->incapacidad)
        ->get();

        if($coincidencia->count() == 0){
        DB::connection('DB_Serverr')->insert('insert into ausentismos (
            identificador_periodo,
            clave_empleado,
            cantidad_ausentismo,
            clave_concepto,
            fecha_ausentismo,
            incapacidad,
            descripcion)
            values (?,?,?,?,?,?,?)',[ $datos->identificador_periodo,
                                    $datos->clave_empledo,
                                    $datos->cantidad_ausentismo,
                                    $datos->concepto_clave,
                                    $datos->fecha_ausentismo,
                                    $datos->incapacidad,
                                    $datos->descripcion
                                ]);
        }else{
            return back()->with('msj','Registro duplicado');
        }


    }

    public function actualizar($datos){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
              'clave_empledo' => 'required',
              'cantidad_ausentismo' => 'required',
              'concepto_clave' => 'required',
              'fecha_ausentismo' => 'required',
              'incapacidad' => 'required',
              'nombre' => 'required',
              'descripcion' => 'required'
        ]);

        $aux1 = DB::connection('DB_Serverr')->table('ausentismos')->where('id',$datos->id)->first();
        DB::connection('DB_Serverr')->table('ausentismos')->where('id',$datos->id)->update(['clave_empleado'=>$datos->clave_empledo,
                    'cantidad_ausentismo'=>$datos->cantidad_ausentismo,
                    'clave_concepto'=>$datos->concepto_clave,
                    'fecha_ausentismo'=>$datos->fecha_ausentismo,
                    'incapacidad'=>$datos->incapacidad,
                    'descripcion'=>$datos->descripcion
                    ]);
    }

    public function eliminar($id){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);


        \Config::set('database.connections.DB_Serverr', $clv_empresa);


    $aux1 = DB::connection('DB_Serverr')->table('ausentismos')->where('id',$id)->delete();

    return redirect()->route('ausentismo.index');
    }


   
}
