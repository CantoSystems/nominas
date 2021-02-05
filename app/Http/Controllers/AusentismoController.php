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
         
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
         $accion= $request->acciones;


         switch ($accion) {
             case '':
                $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('id','=',$periodo)
                ->first();

                $empleado=DB::connection('DB_Serverr')->table('empleados')
                        ->get();

                $ausentismo= DB::connection('DB_Serverr')->table('ausentimos')
                ->join('empleados','empleados.clave_empleado','=','ausentimos.clave_empleado')
                ->select('ausentimos.*','empleados.*')
                ->first();
                //dd($ausentismo);

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();

                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo'));
                 break;

                case 'cancelar':
                 return redirect()->route('ausentismo.index');
              break;

              case 'registrar':
                    $this->registrar($request);
                    return redirect()->route('ausentismo.index');

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

        DB::connection('DB_Serverr')->insert('insert into ausentimos (
            identificador_periodo,
            clave_empleado,
            cantidad,
            clave_concepto,
            fecha_ausentismo,
            incapacidad,
            descripcion)
            values (?,?,?,?,?,?,?)',[ $datos->identificador_periodo,
                                    $datos->clave_empledo,
                                    $datos->cantidad,
                                    $datos->concepto_clave,
                                    $datos->fecha_ausentismo,
                                    $datos->incapacidad,
                                    $datos->descripcion
                                ]);

    }
   
}
