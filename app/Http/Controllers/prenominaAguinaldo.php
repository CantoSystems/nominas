<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Empresa;
use App\Umas;
use App\Subsidio;
use App\Retenciones;
use App\SalarioMinimo;
use App\IMSS;
use App\Exports\PrenominaExport;
use Session;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse; 
use Maatwebsites\Excel\Facades\Excel;

class prenominaAguinaldo extends Controller{
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

    public function index(Request $request){
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        
        $accion = $request->acciones;
        $empleados = DB::connection('DB_Serverr')->table('empleados')
                    ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                    ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                    ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                    ->select('empleados.*','departamentos.*','areas.*','puestos.*')
                    ->get();

        return view('aguinaldosNomina.controlAguinaldos', compact('empleados'));
    }
}
