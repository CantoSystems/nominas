<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conecta\Conexionmultiple;
use DB;
use App\Empresa;
use App\Umas;
use App\SalarioMinimo;
use Session;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse;

class CalculoPrenominaController extends Controller{
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

        switch($accion){
            case '':
               $empleados = DB::connection('DB_Serverr')->table('empleados')
                ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                ->select('empleados.*','departamentos.*','areas.*','puestos.*')
                ->get();

                $prenominaPercepciones = null;

                return view('prenomina.prenomina', compact('empleados','prenominaPercepciones'));
                break;
            case 'calcular':
                $this->create();
                return redirect()->route('prenomina.index');
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

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value) {
            echo $value->monto.'|'.$value->idPre.'|'.$value->concepto;
            DB::connection('DB_Serverr')->table('prenomina')
            ->where([
                ['id_prenomina','=',$value->idPre],
                ['clave_concepto','=',$value->concepto]
            ])
            ->update(['monto' => $value->monto,
                        'status_prenomina' => 1]);
        }
    }

    public function show($id_emp){
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $clave = DB::connection('DB_Serverr')->table('empleados')
                ->select('clave_empleado','nombre','apellido_paterno','apellido_materno')
                ->where('id_emp','=',$id_emp)
                ->first();

        $empleados = DB::connection('DB_Serverr')->table('empleados')
                ->join('departamentos','departamentos.clave_departamento','=','empleados.clave_departamento')
                ->join('puestos','puestos.clave_puesto','=','empleados.clave_puesto')
                ->join('areas','areas.clave_area', '=','departamentos.clave_area')
                ->select('empleados.*','departamentos.*','areas.*','puestos.*')
                ->get();
        
        $status_prenomina =  DB::connection('DB_Serverr')->table('prenomina')
                                ->select('status_prenomina')
                                ->where('prenomina.clave_empleado','=',$clave->clave_empleado)
                                ->groupBy('status_prenomina')
                                ->first();


        $prenominaPercepciones = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                                ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                                ->select('prenomina.id_prenomina', 'empleados.clave_empleado','prenomina.clave_concepto','conceptos.concepto','prenomina.monto')
                                ->where([
                                    ['prenomina_periodo','=',$num_periodo],
                                    ['prenomina.clave_empleado','=',$clave->clave_empleado],
                                    ['conceptos.naturaleza','=','P']
                                ])
                                ->get();
        
        $prenominaDeducciones = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                                ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                                ->select('prenomina.id_prenomina', 'empleados.clave_empleado','prenomina.clave_concepto','conceptos.concepto','prenomina.monto')
                                ->where([
                                    ['prenomina_periodo','=',$num_periodo],
                                    ['prenomina.clave_empleado','=',$clave->clave_empleado],
                                    ['conceptos.naturaleza','=','D']
                                ])
                                ->get();
        
        $prenominaTrabajador = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                                ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                                ->select('prenomina.id_prenomina', 'empleados.clave_empleado','prenomina.clave_concepto','conceptos.concepto','prenomina.monto')
                                ->where([
                                    ['prenomina_periodo','=',$num_periodo],
                                    ['prenomina.clave_empleado','=',$clave->clave_empleado],
                                    ['conceptos.naturaleza','=','T']
                                ])
                                ->get();
        
        $prenominaPatron = DB::connection('DB_Serverr')->table('prenomina')
                                ->join('empleados','empleados.clave_empleado','=','prenomina.clave_empleado')
                                ->join('conceptos','conceptos.clave_concepto','=','prenomina.clave_concepto')
                                ->select('prenomina.id_prenomina', 'empleados.clave_empleado','prenomina.clave_concepto','conceptos.concepto','prenomina.monto')
                                ->where([
                                    ['prenomina_periodo','=',$num_periodo],
                                    ['prenomina.clave_empleado','=',$clave->clave_empleado],
                                    ['conceptos.naturaleza','=','I']
                                ])
                                ->get();
        
        return view('prenomina.prenomina', compact('empleados','prenominaPercepciones','clave','prenominaDeducciones','prenominaTrabajador','prenominaPatron','status_prenomina'));
    }

    public function create(){
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
        
        $conceptos = DB::connection('DB_Serverr')->table('conceptos')
        ->select('clave_concepto')   
        ->where('seleccionado','=',1)
        ->get();

        //$resultaHoraExtraDoble = $this->criterio_horas(3,'OOMJ');
        foreach($empleados as $emp){
            foreach($conceptos as $concep){
                if($concep->clave_concepto == "001P"){
                    $resultaSueldo = $this->sueldo($emp->id_emp,$emp->clave_empleado);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'001P',$resultaSueldo,0]);
                }else if($concep->clave_concepto == "002P"){
                    $resultaHoraExtraDoble = $this->criterio_horas($emp->id_emp,$emp->clave_empleado);

                    //echo $resultaHoraExtraDoble["horasDoblesGenerales"];
                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'002P',$resultaHoraExtraDoble["horasDoblesGenerales"],0]);
                    
                }else if($concep->clave_concepto == "003P"){
                    $resultaHoraExtraTriple = $this->criterio_horas($emp->id_emp,$emp->clave_empleado);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'003P',$resultaHoraExtraTriple["horasTriplesGenerales"],0]);
                }else if($concep->clave_concepto == "004P"){
                    $resultaFondoAhorro = $this->fondoAhorro($emp->id_emp);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'004P',$resultaFondoAhorro,0]);
                }else if($concep->clave_concepto == "005P"){
                    $resultaPremioPunt = $this->premioPunt($emp->id_emp,$emp->clave_empleado);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'005P',$resultaPremioPunt,0]);
                }else if($concep->clave_concepto == "006P"){
                    $resultaPremioAsis = $this->premioPunt($emp->id_emp,$emp->clave_empleado);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'006P',$resultaPremioAsis,0]);
                }else if($concep->clave_concepto == "007P"){
                    $resultaPrimaVacacional = $this->primaVacacional($emp->id_emp);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'007P',$resultaPrimaVacacional,0]);
                }else if($concep->clave_concepto == "008P"){
                    $resultaPrimaDominical = $this->primaDominical($emp->id_emp);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'008P',$resultaPrimaDominical,0]);
                }else if($concep->clave_concepto == "009P"){
    
                }else if($concep->clave_concepto == "010P"){
    
                }else if($concep->clave_concepto == "011P"){
    
                }else if($concep->clave_concepto == "012P"){
                
                }else if($concep->clave_concepto == "013P"){
                    $Vacaciones = $this->sueldo_horas($emp->id_emp);
                    $resultaVacaciones = $Vacaciones->sueldo_diario;

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'013P',$resultaVacaciones,0]);
                }else if($concep->clave_concepto == "014P"){
                    $aguinaldos = $this->aguinaldo($emp->id_emp);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'014P',$aguinaldos,0]);
                }else if($concep->clave_concepto == "015P"){
    
                }else if($concep->clave_concepto == "016P"){
    
                }else if($concep->clave_concepto == "017P"){
    
                }else if($concep->clave_concepto == "018P"){
    
                }else if($concep->clave_concepto == "019P"){
    
                }else if($concep->clave_concepto == "020P"){
    
                }else if($concep->clave_concepto == "021P"){
    
                }else if($concep->clave_concepto == "022P"){
    
                }else if($concep->clave_concepto == "023P"){
                    
                }else if($concep->clave_concepto == "001D"){
                    $resultaAusentismoDed = $this->ausentismoIncapacidadDeduccion($emp->id_emp,$emp->clave_empleado);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'001D',$resultaAusentismoDed,0]);
                }else if($concep->clave_concepto == "002D"){
                    $resultaIncapacidadDed = $this->ausentismoIncapacidadDeduccion($emp->id_emp,$emp->clave_empleado);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'002D',$resultaIncapacidadDed,0]);
                }else if($concep->clave_concepto == "003D"){
                     $resultaFondoAhorroTrabajador = $this->fondoAhorro($emp->id_emp);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'003D',$resultaFondoAhorroTrabajador,0]);
                }else if($concep->clave_concepto == "004D"){
                    $resultaDeduccionFondo = $this->deduccionAhorro($emp->id_emp);

                    DB::connection('DB_Serverr')->insert('insert into prenomina (clave_empleado,prenomina_periodo,clave_concepto,monto,status_prenomina)
                                                                         values (?,?,?,?,?)'
                                                                                ,[$emp->clave_empleado,$num_periodo,'004D',$resultaDeduccionFondo,0]);
                }else if($concep->clave_concepto == "005D"){
                    
                }else if($concep->clave_concepto == "006D"){
                    
                }else if($concep->clave_concepto == "007D"){
    
                }else if($concep->clave_concepto == "008D"){
                    
                }else if($concep->clave_concepto == "009D"){
                    
                }else if($concep->clave_concepto == "010D"){
                    
                }else if($concep->clave_concepto == "011D"){
                    
                }else if($concep->clave_concepto == "012D"){
                    
                }else if($concep->clave_concepto == "013D"){
                    
                }else if($concep->clave_concepto == "014D"){

                }else if($concep->clave_concepto == "015D"){
                    
                }else if($concep->clave_concepto == "016D"){
                    
                }else if($concep->clave_concepto == "017D"){
                    
                }
            }
        }
        
        return redirect()->route('prenomina.index');
    }

    /**
     * Funciones variable general
     */
    public function sueldo_horas($idEmp){
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos_empleado = DB::connection('DB_Serverr')->table('empleados')
        ->select('sueldo_diario','horas_diarias')
        ->where('id_emp','=',$idEmp)
        ->first();

        //Se retorna el sueldo en $ del empleado y las horas trabajadas
        return $datos_empleado;
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

        // se retorna los días del periodo
        return $periodos;
    }

    public function anios_trabajados($idEmp){
        //Fecha Inicial del Periodo de Nómina - Fecha de Alta del Trabajador
        $num_p = Session::get('num_periodo');

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $fecha_inicial = DB::connection('DB_Serverr')->table('periodos')
        ->select('fecha_inicio')
        ->where('numero','=',$num_p)
        ->first();

        //Accedemos a la fecha $fecha_inicial->fecha_inicio
        //Parseando la fecha
        $inicial = now()->parse($fecha_inicial->fecha_inicio);
    
        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
        ->select('fecha_alta')
        ->where('id_emp','=',$idEmp)
        ->first();

        //Accedemos a la fecha alta del trabajador $alta_trabajador->fecha_alta
        //Parseando la fecha
        $alta = now()->parse($alta_trabajador->fecha_alta);

        $diferencia = $inicial->DiffInYears($alta); 
        return $diferencia;
    }

    public function ausentismo($claveEmp){
        $num_periodo = Session::get('num_periodo');

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $acumulado_ausen = DB::connection('DB_Serverr')->table('ausentismos')
        ->select(DB::raw('CASE WHEN COUNT(`cantidad_ausentismo`) = "" THEN 0 ELSE SUM(`cantidad_ausentismo`) END as conteoDias'))
        ->where([
            ['clave_empleado','=',$claveEmp],
            ['ausentismo_periodo','=',$num_periodo]
        ])
        ->whereIn('clave_concepto',['001D','002D'])
        ->first();

        return $acumulado_ausen;
    }

    public function dias_trabajados($claveEmp){
        $jt = $this->jornadaTrabajo();
        $ausentismo = $this->ausentismo($claveEmp);
        
        $diasTrabajados = $jt->diasPeriodo - $ausentismo->conteoDias;
        return $diasTrabajados;
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

       /* $uma = Umas::select('porcentaje_uma')
        ->orderBy('created_at','desc')
        ->first();

        return $uma;*/
    }

    public function cantidad_dias($idEmp){
        //Fecha Inicial del Periodo de Nómina - Fecha de Alta del Trabajador
        $num_p = Session::get('num_periodo');
    
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
    
        $fecha_inicial = DB::connection('DB_Serverr')->table('periodos')
        ->select('fecha_inicio')
        ->where('numero','=',$num_p)
        ->first();
    
        //Accedemos a la fecha $fecha_inicial->fecha_inicio
        //Parseando la fecha
        $inicial = now()->parse($fecha_inicial->fecha_inicio);
    
        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
        ->select('fecha_alta')
        ->where('id_emp','=',$idEmp)
        ->first();
    
        //Accedemos a la fecha alta del trabajador $alta_trabajador->fecha_alta
        //Parseando la fecha
        $alta = now()->parse($alta_trabajador->fecha_alta);
    
        $diferencia = $inicial->diffInDays($alta); 
        return $diferencia;
    }

    public function ahorro_riesgo(){
        $clv = Session::get('clave_empresa');

        $datos_empresa = Empresa::select('primaRiesgo','porcentajeAhorro')
        ->where('clave','=',$clv)
        ->first();

        return $datos_empresa;
    }

    public function aguinaldo_vacaciones_prima($idEmp){
        //Años trabajados se accede directamento con $at
        $at = $this->anios_trabajados($idEmp);

        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
            $datos_prestaciones= DB::connection('DB_Serverr')->table('prestaciones')
                                    ->select('aguinaldo','dias','prima_vacacional')
                                    ->where('anio','=',$at)
                                    ->first();
                                    //retornamos la cantidad de dias otorgados acceder
                                    // $diasAguinaldo->aguinaldo
            return  $datos_prestaciones;
    }

  /*  public function diasTrabajadosAguinaldo($idEmp,$claveEmp){
        
        $diasAguinaldo = $this->aguinaldo_vacaciones_prima($idEmp);
        //Cambiar la evaluacion si se requiere para premio de puntualidad
        if(is_null($diasAguinaldo)){
            $diasTotales = $diasTrabajados-0;
            return $diasTotales;
        }

        $diasTotales = $diasTrabajados-$diasAguinaldo->aguinaldo;

        return $diasTotales;
    }*/


     /**
     * Funciones conceptos
     */

    public function sueldo($idEmp,$claveEmp){
        //Sueldo = SD * (JT-001D-002D)
        $sd = $this->sueldo_horas($idEmp);

        $jt = $this->dias_trabajados($claveEmp);
        
        $sueldoFinal = $sd->sueldo_diario * $jt;
        return $sueldoFinal;
    }

   public function fondoAhorro($idEmp){
       /* //Formula SI(UMA*1.3>SD, UMA*1.3,SD)*PFA
        $uma = $this->uma();
        //$uma->porcentaje_uma
        $sd = $this->sueldo_horas($idEmp);
        //$sd->sueldo_diario
        $rt = $this->ahorro_riesgo();
        //rt->porcentajeAhorro

        $umaCond = $uma->porcentaje_uma*1.3;

        if($umaCond<$sd->sueldo_diario){
            $fondo = $umaCond * $rt->porcentajeAhorro;
            return round($fondo,2);
        }
        $umaFin = $sd->sueldo_diario*$rt->porcentajeAhorro;
        return round($umaCond,2);*/
       
        $uma = $this->uma();
        $sd = $this->sueldo_horas($idEmp);
        $rt = $this->ahorro_riesgo();
        $porcentaje_ahorro = $rt->porcentajeAhorro/100;
        $umaCond = $uma->porcentaje_uma*1.3;
        
        if($umaCond<$sd->sueldo_diario){
            $umaCond = $sd->sueldo_diario;
        }

        $umaFin = $umaCond*$porcentaje_ahorro;
        return $umaFin;
    }

    public function premioPunt($idEmp,$claveEmp){
        //SD*(DT)*.1
        
        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);
        $premioPuntualidad = $sd->sueldo_diario*($diasTrabajados)*0.1;

        return $premioPuntualidad;
    }

    public function primaVacacional($idEmp){
        $sd = $this->sueldo_horas($idEmp);
        $dv = $this->aguinaldo_vacaciones_prima($idEmp);
        if(is_null($dv)){
            return $primaVacacional = 0;
        }

        $primaVacacional = $sd->sueldo_diario * $dv->prima_vacacional/100;

        return $primaVacacional;
    }

    public function primaDominical($idEmp){
        $sd = $this->sueldo_horas($idEmp);

        $primaDominical = $sd->sueldo_diario * 0.25 ;

        return $primaDominical;
    }

    public function aguinaldo($idEmp){
        $sd = $this->sueldo_horas($idEmp);
        $diasAguinaldo = $this->aguinaldo_vacaciones_prima($idEmp);

        if(is_null($diasAguinaldo)){
            //Retorna la cantidad de días 
            $dias =$this->cantidad_dias($idEmp);
            $total_aguinaldo = ($sd->sueldo_diario * 15)/365;
            $aguinaldo_proporcional = $total_aguinaldo * $dias;
            return round($aguinaldo_proporcional,2);

            //$resultad = collect(['aguinaldo'=> $dias]);
            //$sd->sueldo_diario * $resultad['aguinaldo'];
        }

        $aguinaldo = $sd->sueldo_diario * $diasAguinaldo->aguinaldo;

        return $aguinaldo;
    }

    public function ausentismoIncapacidadDeduccion($idEmp,$claveEmp){
        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);


        $ausentismoIncapacidad = $sd->sueldo_diario * $diasTrabajados;

        return $ausentismoIncapacidad;
    }

    public function deduccionAhorro($idEmp){
        $fondoAhorroEmpresa = $this->fondoAhorro($idEmp);

        return 1;
    } 

    public function criterio_horas($idEmp,$claveEmp){
        $identificador_periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $manipulacion_fechas = DB::connection('DB_Serverr')->table('periodos')
        ->select('fecha_inicio','fecha_fin','diasPeriodo')
        ->where('numero','=',$identificador_periodo)
        ->first();

        $conteohoras = DB::connection('DB_Serverr')->table('tiempo_extra')
        ->select(DB::raw('CASE WHEN COUNT(`cantidad_tiempo`) = "" THEN 0 ELSE SUM(`cantidad_tiempo`) END as cantidad_tiempo'))
        ->where('periodo_extra','=',$identificador_periodo)
        ->where('clave_empleado','=',$claveEmp)
        ->first();

        if($conteohoras->cantidad_tiempo!=0){
            $horasExtras = DB::connection('DB_Serverr')->table('tiempo_extra')
            ->select('fecha_extra',DB::raw('SUM(cantidad_tiempo) as cantidad_tiempo'))
            ->where('periodo_extra','=',$identificador_periodo)
            ->where('clave_empleado','=',$claveEmp)
            ->whereBetween('fecha_extra',array($manipulacion_fechas->fecha_inicio,$manipulacion_fechas->fecha_fin))
            ->groupBy('fecha_extra')
            ->get();

            $inicio_semana1 = $manipulacion_fechas->fecha_inicio;
            $horasTriples = 0;
            $horasTriplesGenerales = 0;
            $horasDobles = 0;
            $horasDoblesGenerales = 0;
            $k = 0; // dias semana

            if($manipulacion_fechas->diasPeriodo<8){
                foreach($horasExtras as $horas){
                    if($horas->fecha_extra < date('Y-m-d',strtotime($inicio_semana1."+ 7 days"))){
                        if($k<3){
                            if($horas->cantidad_tiempo>3){
                                $horasTriples = $horas->cantidad_tiempo-3;
                                $horasDobles = 3;
                            }else{
                                $horasDobles = $horas->cantidad_tiempo;
                                $horasTriples = 0;
                            }
                            $k++;
                        }else{
                            $horasDobles = 0;
                            $horasTriples = $horas->cantidad_tiempo;
                        }
                        $horasDoblesGenerales = $horasDoblesGenerales + $horasDobles;
                        $horasTriplesGenerales = $horasTriplesGenerales + $horasTriples;
                        //echo $horasDobles.'|'.$horasTriples.'|'.$horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                    }
                }
                
                //echo $horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                $sd = $this->sueldo_horas($idEmp);
                $precioHoraExtra = $sd->sueldo_diario/$sd->horas_diarias;
                $horasDoblesGenerales = $horasDoblesGenerales*($precioHoraExtra*2);
                $horasTriplesGenerales = $horasTriplesGenerales*($precioHoraExtra*3);
                //echo $horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                return compact('horasDoblesGenerales','horasTriplesGenerales');
            }else{
                foreach($horasExtras as $horas){
                    if($horas->fecha_extra < date('Y-m-d',strtotime($inicio_semana1."+ 7 days"))){
                        if($k<3){
                            if($horas->cantidad_tiempo>3){
                                $horasTriples = $horas->cantidad_tiempo-3;
                                $horasDobles = 3;
                            }else{
                                $horasDobles = $horas->cantidad_tiempo;
                                $horasTriples = 0;
                            }
                            $k++;
                        }else{
                            $horasDobles = 0;
                            $horasTriples = $horas->cantidad_tiempo;
                        }
                        $horasDoblesGenerales = $horasDoblesGenerales + $horasDobles;
                        $horasTriplesGenerales = $horasTriplesGenerales + $horasTriples;
                        //echo $horasDobles.'|'.$horasTriples.'|'.$horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                    }else{
                        $k = 1;
                        $horasDobles = 0;
                        $horasTriples = 0;

                        if($horas->cantidad_tiempo>3){
                            $horasTriples = $horas->cantidad_tiempo-3;
                            $horasDobles = 3;
                        }else{
                            $horasDobles = $horas->cantidad_tiempo;
                            $horasTriples = 0;
                        }
                        $horasDoblesGenerales = $horasDoblesGenerales + $horasDobles;
                        $horasTriplesGenerales = $horasTriplesGenerales + $horasTriples;

                        if(date('Y-m-d',strtotime($inicio_semana1."+ 7 days")) < $manipulacion_fechas->fecha_fin){
                            $inicio_semana1 = date('Y-m-d',strtotime($inicio_semana1."+ 7 days"));
                        }
                        //echo $horasDobles.'|'.$horasTriples.'|'.$horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                    }
                }
                //echo $horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                $sd = $this->sueldo_horas($idEmp);
                $precioHoraExtra = $sd->sueldo_diario/$sd->horas_diarias;
                $horasDoblesGenerales = $horasDoblesGenerales*($precioHoraExtra*2);
                $horasTriplesGenerales = $horasTriplesGenerales*($precioHoraExtra*3);
                //echo "1.".$horasDoblesGenerales.'|'.$horasTriplesGenerales.'<br>';
                return compact('horasDoblesGenerales','horasTriplesGenerales');
            }
        }else{
            $horasDoblesGenerales = 0;
            $horasTriplesGenerales = 0;
            
            return compact('horasDoblesGenerales','horasTriplesGenerales');
        }
    }    
}