<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Schema;

class TiempoController extends Controller
{   
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

    public function index(Request $request){
        $clv=Session::get('clave_empresa');
        $accion= $request->acciones;
        $clv_empresa=$this->conectar($clv);

        $extras_periodo= Session::get('num_periodo');
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        switch ($accion) {
            case '':
                $periodot_extras = DB::connection('DB_Serverr')->table('periodos')
                ->where('numero','=',$extras_periodo)
                ->first();

                return view('tiempo_extra.crudtiempo',compact('periodot_extras'));
            break;

            default:
            break;
        }
    }

  
    public function store(Request $request)
    {

        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }


        foreach ($request->only('info') as $value) {
            $data = json_decode($value);
        }

        /*
            Primer opción aunque envia  todos los valores de jalón
        */
        /*foreach ($data as $value) {
            foreach ($value as $value1) {
                echo $value1.PHP_EOL;
            }
        }*/


        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value) {
            //echo ;
            //echo $value->
             DB::connection('DB_Serverr')->insert('INSERT INTO tiempo_extra (periodo_id,clave_empleado,cantidad_tiempo,fecha_extra)VALUES (?,?,?,?)',[$value->periodo,$value->empleado,$value->cantidad,$value->fecha]);
        }
     
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
