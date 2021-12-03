<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Empresa;
use App\Umas;
use App\SalarioMinimo;
use App\Exports\AguinaldoExport;
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

    public function create(Request $request){
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $empleados = DB::connection('DB_Serverr')->table('empleados')
                     ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                     ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                     ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                     ->select('empleados.*','areas.*','departamentos.*','puestos.*')
                     ->get();

        $clave = DB::connection('DB_Serverr')->table('empleados')
                 ->select('clave_empleado','nombre','apellido_paterno','apellido_materno','id_emp')
                 ->where('clave_empleado','=',$request->clvEmp)
                 ->first();

        $at = $this->anios_trabajados($clave->id_emp);
        $sd = $this->sueldo_horas($clave->id_emp);
        
        $datos_prestaciones = DB::connection('DB_Serverr')->table('prestaciones')
                                ->select('aguinaldo')
                                ->where('anio','=',$at)
                                ->first();

        if($request->calculoISR == "art86"){
            $aguinaldoFinal = Collect();
            $ISRRetenerFinal = Collect();
            if($at >= 1){
                $uma = $this->uma();
                $end = new Carbon('last day of December');
                $lastDay = $end->format('Y-m-d');

                $acumladoGrav = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('periodos','prenomina.noPrenomina','=','numero')
                                ->where([
                                    ['prenomina.clave_empleado','=',$clave->clave_empleado],
                                    ['prenomina.clave_concepto','=','01OC'],
                                    ['periodos.fecha_inicio','>=',date('Y-01-01')],
                                    ['periodos.fecha_fin','<=',$lastDay]
                                    ])
                                ->sum('prenomina.monto');

                $acumuladoExce = DB::connection('DB_Serverr')->table('prenomina')
                                 ->join('periodos','prenomina.noPrenomina','=','numero')
                                 ->where([
                                     ['prenomina.clave_empleado','=',$clave->clave_empleado],
                                     ['prenomina.clave_concepto','=','02OC'],
                                     ['periodos.fecha_inicio','>=',date('Y-01-01')],
                                     ['periodos.fecha_fin','<=',$lastDay]
                                     ])
                                 ->sum('prenomina.monto');                
            }else{

            }
            
            $calculo = $sd->sueldo_diario*$datos_prestaciones->aguinaldo;
            $proporcionISR = ($acumuladoExce*100)/$acumladoGrav;
            $aguinaldoExcento = $uma->porcentaje_uma*30;
            $aguinaldoGravado = $calculo-$aguinaldoExcento;
            $ISRRetener = ($aguinaldoGravado*$proporcionISR)/100;
            $aguinaldoF = $calculo - $ISRRetener;

            $aguinaldoFinal->push(["clave_empleado"=>$clave->clave_empleado,"clave_concepto"=>"014P","concepto"=>"AGUINALDO","monto"=>$aguinaldoF]);
            $ISRRetenerFinal->push(["clave_empleado"=>$clave->clave_empleado,"clave_concepto"=>"001T","concepto"=>"ISR","monto"=>$ISRRetener]);
        }else{
            echo "Normal";
        }
        
        return compact('empleados','aguinaldoFinal','ISRRetenerFinal','clave');
    }

    public function store(Request $request){
        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach ($request->only('info') as $value) {
            $data = json_decode($value);
        }

        $periodo = Session::get('num_periodo');
        $fecha_periodo = now();
        
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value) {
            DB::connection('DB_Serverr')->insert('INSERT INTO prenomina_aguinaldo (noPrenomina, clave_empleado, clave_concepto, monto, status_prenomina, created_at, updated_at)
                                                  VALUES(?,?,?,?,?,?,?)',[$periodo, $value->clvEmp, $value->concepto, $value->monto, 1, $fecha_periodo, $fecha_periodo]);
        }

        DB::connection('DB_Serverr')->insert('INSERT INTO prenomina_aguinaldo (noPrenomina, clave_empleado, clave_concepto, monto, status_prenomina, created_at, updated_at)
                                              VALUES(?,?,?,?,?,?,?)',[$periodo, $request->clvEmp, '001S', $request->totalAguinaldo, 1, $fecha_periodo, $fecha_periodo]);
    }

    //Funciones para ayudar al cálculo del aguinaldo
    public function anios_trabajados($idEmp){
        $num_p = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $fecha_inicial = DB::connection('DB_Serverr')->table('periodos')
                         ->select('fecha_inicio')
                         ->where('numero','=',$num_p)
                         ->first();

        $inicial = now()->parse($fecha_inicial->fecha_inicio);

        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
                           ->select('fecha_alta')
                           ->where('id_emp','=',$idEmp)
                           ->first();

        $alta = now()->parse($alta_trabajador->fecha_alta);
        $diferencia = $inicial->DiffInYears($alta);

        return $diferencia;
    }

    public function sueldo_horas($idEmp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos_empleado = DB::connection('DB_Serverr')->table('empleados')
                          ->select('sueldo_diario','horas_diarias')
                          ->where('id_emp','=',$idEmp)
                          ->first();

        return $datos_empleado;
    }

    public function uma(){
        $jt = $this->jornadaTrabajo();
        $uma = Umas::select('porcentaje_uma')
                    ->where([
                        ['periodoinicio_uma','<',$jt->fecha_inicio],
                        ['periodofin_uma','>',$jt->fecha_inicio]
                    ])
                    ->first();

        return $uma;
    }

    public function jornadaTrabajo(){
        $num_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $periodos = DB::connection('DB_Serverr')->table('periodos')
                    ->select('diasPeriodo','fecha_inicio')
                    ->where('numero','=',$num_periodo)
                    ->first();

        return $periodos;
    }

    public function exportExcel(){
        return (new AguinaldoExport)->download('aguinaldos.xlsx');
    }
}
