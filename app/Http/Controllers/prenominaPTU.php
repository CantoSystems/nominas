<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Exports\AguinaldoExport;
use Session;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse; 
use Maatwebsites\Excel\Facades\Excel;

class prenominaPTU extends Controller{
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

        return view('ptuNomina.controlPTU', compact('empleados'));
    }

    public function create(Request $request){
        //dd($request);
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $time = strtotime('-1 year', time());
        $fechaInicio = date('Y-01-01', $time);
        $fechaFin = date('Y-12-31', $time);

        $empleados = DB::connection('DB_Serverr')->table('empleados')
                     ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                     ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                     ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                     ->select('empleados.*','areas.*','departamentos.*','puestos.*')
                     ->get();

        $totalDias = 0;
        foreach($empleados as $emp){
            $sumAusencias = DB::connection('DB_Serverr')->table('ausentismos')
                            ->select(DB::raw('CASE WHEN COUNT(cantidad_ausentismo) = " " THEN 0 ELSE SUM(cantidad_ausentismo) END as sumaAusencias'))
                            ->where([
                                ['clave_concepto','=','001D'],
                                ['clave_empleado','=',$emp->clave_empleado]
                            ])
                            ->whereBetween('fecha_ausentismo', [$fechaInicio,$fechaFin])
                            ->first();

            $totalDias = $totalDias + (365-$sumAusencias->sumaAusencias);
        }

        $sumAusenciasEmp = DB::connection('DB_Serverr')->table('ausentismos')
                            ->select(DB::raw('CASE WHEN COUNT(cantidad_ausentismo) = " " THEN 0 ELSE 365 - SUM(cantidad_ausentismo) END as sumaAusenciasEmp'))
                            ->where([
                                ['clave_concepto','=','001D'],
                                ['clave_empleado','=',$request->clvEmp]
                            ])
                            ->whereBetween('fecha_ausentismo', [$fechaInicio,$fechaFin])
                            ->first();

        $ingTotalEmp = DB::connection('DB_Serverr')->table('prenomina')
                       ->join('periodos','prenomina.noPrenomina','=','numero')
                       ->where([
                           ['prenomina.clave_empleado','=',$request->clvEmp],
                           ['prenomina.clave_concepto','=','001S'],
                           ['periodos.fecha_inicio','>=',$fechaInicio],
                           ['periodos.fecha_fin','<=',$fechaFin]
                           ])
                       ->sum('prenomina.monto');

        $factorDias = $sumAusenciasEmp->sumaAusenciasEmp/$totalDias;

        if($ingTotalEmp > $request->ingresosEmp){
            $IngNorm = $request->ingresosEmp*1.1;
        }else{
            $IngNorm = $ingTotalEmp;
        }
        
        //return compact('empleados','aguinaldo','aguinaldoFinal','ISRRetenerFinal','clave');
    }
}
