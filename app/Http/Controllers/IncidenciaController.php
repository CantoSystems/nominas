<?php

    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use DB;
    use Session;
    use Carbon\Carbon;

    class IncidenciaController extends Controller{
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
            $accion = $request->acciones;
            $clv_empresa = $this->conectar($clv);

            \Config::set('database.connections.DB_Serverr', $clv_empresa);
            switch ($accion) {
                case '':
                    $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                    ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                    ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                    ->select('incidencias.*','empleados.*','conceptos.concepto')
                    ->first();

                    $incidencias2 = DB::connection('DB_Serverr')->table('incidencias')
                    ->join('empleados','empleados.clave_empleado','=','incidencias.clave_empleado')
                    ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                    ->select('incidencias.*','empleados.*','conceptos.concepto')
                    ->get();

                    $emp = DB::connection('DB_Serverr')->table('empleados')->get();

                    $conceptos = DB::connection('DB_Serverr')->table('conceptos')->get();

                    return view('incidencias.incidencias',compact('incidencias2','incidencias','emp','conceptos'));
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

            $clv = Session::get('clave_empresa');
            $clv_empresa = $this->conectar($clv);
            \Config::set('database.connections.DB_Serverr', $clv_empresa);

            foreach ($data as $value) {
                $fecha_periodo = now()->toDateString();
                $inciden_periodo = Session::get('num_periodo');
                DB::connection('DB_Serverr')->insert('INSERT INTO incidencias (clave_concepto
                                                                            ,clave_empleado
                                                                            ,cantidad
                                                                            ,importe
                                                                            ,monto,periodo_incidencia,created_at,updated_at)
                                                                    VALUES (?,?,?,?,?,?,?,?)'
                                                                                ,[$value->concepto
                                                                                ,$value->empleado
                                                                                ,$value->cantidad
                                                                                ,$value->importe
                                                                                ,$value->monto,
                                                                                $inciden_periodo,
                                                                                $fecha_periodo,
                                                                                $fecha_periodo]);
            }
        }

        public function check(Request $request){
            $clv = Session::get('clave_empresa');
            $clv_empresa = $this->conectar($clv);
            \Config::set('database.connections.DB_Serverr', $clv_empresa);

            $Prestamos = DB::connection('DB_Serverr')->table('prestamos')
                         ->where([
                                ['claveConcepto','=',$request->concepto],
                                ['claveEmpleado','=',$request->claveEmpleado],
                                ['statusPrestamo','=','0']
                         ])
                         ->count();

            if($Prestamos > 0){
                $incidencias = DB::connection('DB_Serverr')->table('incidencias')
                               ->select(DB::raw('CASE WHEN COUNT(*) = " " THEN 0 ELSE SUM(`monto`) END as monto'))
                               ->where([
                                   ['clave_concepto','=',$request->concepto],
                                   ['clave_empleado','=',$request->claveEmpleado]
                               ])
                               ->first();

                $totalPrestamo = DB::connection('DB_Serverr')->table('prestamos')
                                 ->select('prestamos.monto','prestamos.importe','conceptos.concepto')
                                 ->join('conceptos','conceptos.clave_concepto','=','prestamos.claveConcepto')
                                 ->where([
                                    ['prestamos.claveConcepto','=',$request->concepto],
                                    ['prestamos.claveEmpleado','=',$request->claveEmpleado],
                                    ['prestamos.statusPrestamo','=','0']
                                 ])
                                 ->orderBy('prestamos.created_at', 'asc')
                                 ->first();

                $restante = $totalPrestamo->monto - $incidencias->monto;
                $collection = collect([$restante,$totalPrestamo->importe,$totalPrestamo->concepto]);
            }else{
                $collection = collect(['0','0',$request->nomConcepto]);
            }

            return $collection;
        }
    }