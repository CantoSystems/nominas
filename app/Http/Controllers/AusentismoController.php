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

                $emp=DB::connection('DB_Serverr')->table('empleados')
                ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                ->select('empleados.*','areas.*','departamentos.*','puestos.*')
                ->get()->first();

                $personal = DB::connection('DB_Serverr')->table('empleados')
                ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                ->select('empleados.*','areas.*','departamentos.*','puestos.*')
                ->get();

                $this->getciudadano($request);
           
                return view('ausentismo.crudausentismo', compact('periodo','ptrabajo','emp','personal'));
                 break;

                case 'cancelar':
                 return redirect()->route('ausentismo.index');
              break;
             
             default:
                 # code...
                 break;
         }
        

        $ptrabajo = DB::connection('DB_Serverr')->table('periodos')
        ->where('id','=',$periodo)
        ->first();
        return view('ausentismo.crudausentismo', compact('periodo','ptrabajo'));
        
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

    public function getciudadano($datos)
    {
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        if($datos->get('query')){
            $query = $datos->get('query');
            $data =  DB::connection('DB_Serverr')->table('empleados')
                        ->where('clave_empledo','LIKE',"%{$query}%")
                        ->get();
            $outout = '<ul class="dropdown-menu" style="display:block;position:relative">';
            foreach ($data as $row) {
                $outout .= '
                <li> <a href="#">'.$row->name.'</a></li>';
            }
            $outout .= '</ul>';
            echo $outout;

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
