<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use DataTables;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
        $identificador_periodo = Session::get('num_periodo');
        
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        switch ($accion) {
            case '':
                $periodo = DB::connection('DB_Serverr')->table('periodos')
                ->select('fecha_inicio','fecha_fin')
                ->where('numero','=',$identificador_periodo)
                ->first();

                return view('tiempo_extra.crudtiempo',compact('periodo'));
            break;
            default:
            break;
        }
    }

  
    public function store(Request $request){
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
            $fecha_periodo = now()->toDateString();
            $te_periodo = Session::get('num_periodo');
             DB::connection('DB_Serverr')->insert('INSERT INTO tiempo_extra (clave_empleado,cantidad_tiempo,fecha_extra,created_at,updated_at,periodo_extra) VALUES (?,?,?,?,?,?)',[$value->empleado,$value->cantidad,$value->fecha,$fecha_periodo,$fecha_periodo,$te_periodo]);
        }
    }
}