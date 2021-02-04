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

                $ausentismo= DB::connection('DB_Serverr')->table('ausentimos')->first();

                $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();
                //dd($ptrabajo);



                
                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo'));
                 break;

                case 'cancelar':
                 return redirect()->route('ausentismo.index');
              break;

              case 'registrar':
                 

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
                                $output .= '<li class="empleado" style="list-style:none"><a class="dropdown-item" href="#">'.$row->clave_empleado.'&nbsp;'.$row->nombre.'</a></li>';
                            }
            $output .= '</ul>';
            echo $output;
        }
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
                                $output .= '<li class="concepto" style="list-style:none"><a class="dropdown-item" href="#">'.$row->clave_concepto.'&nbsp;'.$row->concepto.'</a></li>';
                            }
            $output .= '</ul>';
            echo $output;
        }
    }
   
}
