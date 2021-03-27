<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AusenciaController extends Controller
{
   
    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $accion= $request->acciones;
        $clv_empresa=$this->conectar($clv);
        

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        

        return view('ausentismo.ausencia');
         

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

    public function store(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach ($request->only('info') as $value) {
            $data = json_decode($value);
        }


        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value) {
            //echo $value->incapacidad;
            $fecha_periodo = now()->toDateString();
            DB::connection('DB_Serverr')->insert('INSERT INTO ausentismos (
            clave_empleado,
            cantidad_ausentismo,
            clave_concepto,
            fecha_ausentismo,
            incapacidad,
            descripcion,created_at,updated_at)
            values (?,?,?,?,?,?,?,?)',[$value->empleado,
                                    $value->ausentismo,
                                    $value->concepto,
                                    $value->fecha,
                                    $value->incapacidad,
                                    $value->descripcion,$fecha_periodo,$fecha_periodo
                                ]);
        }

        //return $request;

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
