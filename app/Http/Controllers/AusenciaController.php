<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Schema;

class AusenciaController extends Controller
{
   
    public function index(Request $request)
    {
        $clv=Session::get('clave_empresa');
        $accion= $request->acciones;
        $clv_empresa=$this->conectar($clv);
        $periodoausencia= Session::get('num_periodo');

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $ausenciap = DB::connection('DB_Serverr')->table('periodos')
                ->where('numero','=',$periodoausencia)
                ->first();

        //dd($ausenciap);

        return view('ausentismo.ausencia', compact('ausenciap'));
         

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
            DB::connection('DB_Serverr')->insert('INSERT INTO ausentismos (
            identificador_periodo,
            clave_empleado,
            cantidad_ausentismo,
            clave_concepto,
            fecha_ausentismo,
            incapacidad,
            descripcion)
            values (?,?,?,?,?,?,?)',[ $value->identificador,
                                    $value->empleado,
                                    $value->ausentismo,
                                    $value->concepto,
                                    $value->fecha,
                                    $value->incapacidad,
                                    $value->descripcion
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
