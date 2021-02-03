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
                //dd($conceptos);
                
                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','empleado','conceptos','ausentismo'));
                 break;

                case 'cancelar':
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
    public function seleccionarempleado($clave_emp){

        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        $periodo= Session::get('num_periodo');

        \Config::set('database.connections.DB_Serverr', $clv_empresa);


        $ausentismo = DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$clave_emp)->get()->first();
        $conceptos=DB::connection('DB_Serverr')->table('conceptos')->get();
        $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
                ->where('id','=',$periodo)
                ->first();

        return view('ausentismo.crudausentismo',compact('ausentismo','conceptos','ptrabajo','periodo'));
    }
     public function seleccionarconcept2($clave_con,$clave_emp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $emplea = DB::connection('DB_Serverr')->table('conceptos')->where('clave_concepto',$clave_con)->get()->first();
        $emp = DB::connection('DB_Serverr')->table('empleados')->where('clave_empleado',$clave_emp)->get()->first();
        $conceptos = DB::connection('DB_Serverr')->table('conceptos')->get();
        $personal = DB::connection('DB_Serverr')->table('empleados')->get();
        return view('ausentismo.crudausentismo',compact('emplea','conceptos','emp','personal'));
    }

     

    public function store(Request $request)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

      public function destroy($id)
    {
        //
    }
}
