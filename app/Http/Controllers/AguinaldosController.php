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
    
    class AguinaldosController extends Controller{
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

        public function create($id_emp){
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

            $ControlPrenomina = collect();
            foreach($empleados as $emp){
                $aguinaldo = $this->aguinaldo($emp->id_emp);

                if($aguinaldo!=0){
                    $Gravado = $aguinaldo;
                    $Excento = 0;
                }else{
                    $Gravado = 0;
                    $Excento = 0;
                }

                $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"014P","concepto"=>"AGUINALDO","monto"=>$aguinaldo,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
            }
            
            /*$ControlPrenomina = collect();
            $percepcionesImss = Collect();
            foreach($empleados as $emp){
                foreach($conceptos as $concep){
                    if($concep->clave_concepto == "001P"){
                        $resultaSueldo = $this->sueldo($emp->id_emp,$emp->clave_empleado);
                        if($resultaSueldo!=0){
                            $Gravado = $resultaSueldo;
                            $Excento = 0;
                        }else{
                            $Gravado = 0;
                            $Excento = 0;
                        }

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"001P","concepto"=>"SUELDO","monto"=>$resultaSueldo,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);                           
                    }else if($concep->clave_concepto == "002P"){
                        $resultaHoraExtraDoble = $this->criterio_horas($emp->id_emp,$emp->clave_empleado);
                        if($resultaHoraExtraDoble != 0){
                            $calculosISR = $this->calcularGravado($concep,$resultaHoraExtraDoble['horasDoblesGenerales']);
                            $Gravado = $calculosISR['percepcionGravable'];
                            $Excento = $calculosISR['percepcionExcenta'];
                        }else{
                            $Gravado = 0;
                            $Excento = 0;
                        }

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"002P","concepto"=>"HORAS EXTRAS DOBLES","monto"=>$resultaHoraExtraDoble["horasDoblesGenerales"],"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=>"P"]);  
                    }else if($concep->clave_concepto == "003P"){
                        $resultaHoraExtraTriple = $this->criterio_horas($emp->id_emp,$emp->clave_empleado);
                        if($resultaHoraExtraTriple != 0){
                            $Gravado = $resultaHoraExtraTriple['horasTriplesGenerales'];
                            $Excento = 0;
                        }else{
                            $Gravado = 0;
                            $Excento = 0;
                        }
                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"003P","concepto"=>"HORAS EXTRAS TRIPLES","monto"=>$resultaHoraExtraTriple["horasTriplesGenerales"],"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                        $percepcionesImss->push(["concepto"=>"HORAS EXTRAS TRIPLES", "total" => $resultaHoraExtraTriple["horasTriplesGenerales"] ]);
                    }else if($concep->clave_concepto == "004P"){
                        $resultaFondoAhorro = $this->fondoAhorro($emp->id_emp);
                        $Gravado = 0;
                        $Excento = $resultaFondoAhorro;

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"004P","concepto"=>"FONDO DE AHORRO EMPRESA","monto"=>$resultaFondoAhorro,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);  
                    }else if($concep->clave_concepto == "005P"){
                        $resultaPremioPunt = $this->premioPunt($emp->id_emp,$emp->clave_empleado);
                        if($resultaPremioPunt != 0){
                            $Gravado = $resultaPremioPunt;
                            $Excento = 0;
                        }else{
                            $Gravado = 0;
                            $Excento = 0;
                        }

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"005P","concepto"=>"PREMIO DE PUNTUALIDAD","monto"=>$resultaPremioPunt,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);  
                    }else if($concep->clave_concepto == "006P"){
                        $resultaPremioAsis = $this->premioPunt($emp->id_emp,$emp->clave_empleado);
                        if($resultaPremioAsis != 0){
                            $Gravado = $resultaPremioAsis;
                            $Excento = 0;
                        }else{
                            $Gravado = 0;
                            $Excento = 0;
                        }

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"006P","concepto"=>"PREMIO DE ASISTENCIA","monto"=>$resultaPremioAsis,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                    }else if($concep->clave_concepto == "007P"){
                        $resultaPrimaVacacional = $this->primaVacacional($emp->id_emp,$emp->clave_empleado);
                        if($resultaPrimaVacacional != 0){
                            $calculosISR = $this->calcularGravado($concep,$resultaPrimaVacacional);
                            $Gravado = $calculosISR['percepcionGravable'];
                            $Excento = $calculosISR['percepcionExcenta'];
                        }else{
                            $Gravado = 0;
                            $Excento = 0;
                        }

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"007P","concepto"=>"PRIMA VACACIONAL","monto"=>$resultaPrimaVacacional,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                    }else if($concep->clave_concepto == "008P"){
                        $resultaPrimaDominical = $this->primaDominical($emp->id_emp);
                        if($resultaPrimaDominical != 0){
                            $calculosISR = $this->calcularGravado($concep,$resultaPrimaDominical);
                            $Gravado = $calculosISR['percepcionGravable'];
                            $Excento = $calculosISR['percepcionExcenta'];
                        }else{
                            $Gravado = 0;
                            $Excento = 0;
                        }

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"008P","concepto"=>"PRIMA DOMINICAL","monto"=>$resultaPrimaDominical,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                        $percepcionesImss->push(["concepto"=>"PRIMA DOMINICAL", "total" => $resultaPrimaDominical ]);
                    }else if($concep->clave_concepto == "009P"){
                        $montoCompensacion = DB::connection('DB_Serverr')->table('conceptos')
                            ->select('monto')
                            ->where('clave_concepto','009P')
                            ->first();

                    $percepcionesImss->push(["concepto"=>"COMPENSACION", "total" => $montoCompensacion->monto]);
                    }else if($concep->clave_concepto == "010P"){
                        $montoDiferencia = DB::connection('DB_Serverr')->table('conceptos')
                            ->select('monto')
                            ->where('clave_concepto','010P')
                            ->first();

                    $percepcionesImss->push(["concepto"=>"DIFERENCIA DE SUELDO", "total" => $montoDiferencia->monto]);
                    }else if($concep->clave_concepto == "011P"){

                    }else if($concep->clave_concepto == "012P"){
                    
                    }else if($concep->clave_concepto == "013P"){
                        $Vacaciones = $this->pagoVacaciones($emp->id_emp,$emp->clave_empleado);
                        if($Vacaciones != 0){
                            $Gravado = $Vacaciones;
                            $Excento = 0;
                        }else{
                            $Gravado = 0;
                            $Excento = 0;
                        }

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"013P","concepto"=>"VACACIONES","monto"=>$Vacaciones,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                        $percepcionesImss->push(["concepto"=>"VACACIONES", "total" => $Vacaciones ]);
                    }else if($concep->clave_concepto == "015P"){
                        $montoComisiones = DB::connection('DB_Serverr')->table('conceptos')
                        ->select('monto')
                        ->where('clave_concepto','015P')
                        ->first();

                        $percepcionesImss->push(["concepto"=>"COMISIONES", "total" => $montoComisiones->monto]);
                    }else if($concep->clave_concepto == "016P"){

                    }else if($concep->clave_concepto == "017P"){
                        $montoBono = DB::connection('DB_Serverr')->table('conceptos')
                        ->select('monto')
                        ->where('clave_concepto','017P')
                        ->first();

                        $percepcionesImss->push(["concepto"=>"BONO DE PRODUCTIVIDAD", "total" => $montoBono->monto]);
                    }else if($concep->clave_concepto == "018P"){

                    }else if($concep->clave_concepto == "019P"){
                        $montoRetroactivo = DB::connection('DB_Serverr')->table('conceptos')
                        ->select('monto')
                        ->where('clave_concepto','019P')
                        ->first();

                        $percepcionesImss->push(["concepto"=>"SUELDO RETROACTIVO", "total" => $montoRetroactivo->monto]);
                    }else if($concep->clave_concepto == "020P"){

                    }else if($concep->clave_concepto == "021P"){

                    }else if($concep->clave_concepto == "022P"){

                    }else if($concep->clave_concepto == "023P"){
                        
                    }else if($concep->clave_concepto == "024P"){
                        $resultaSueldo = $this->sueldo($emp->id_emp,$emp->clave_empleado);
                        $montoDescanso = $resultaSueldo * 2;
                        $percepcionesImss->push(["concepto"=>"TRABAJO EN DIAS DE DESCANSO", "total" => $montoDescanso]);
                        
                    }else if($concep->clave_concepto == "001D"){
                        $resultaAusentismoDed = $this->ausentismoIncapacidadDeduccion($emp->id_emp,$emp->clave_empleado);
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"001D","concepto"=>"AUSENTISMO","monto"=>$resultaAusentismoDed,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "D"]);
                    }else if($concep->clave_concepto == "002D"){
                        $resultaIncapacidadDed = $this->ausentismoIncapacidadDeduccion($emp->id_emp,$emp->clave_empleado);
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"002D","concepto"=>"INCAPACIDAD","monto"=>$resultaIncapacidadDed,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "D"]);
                    }else if($concep->clave_concepto == "003D"){
                        $resultaFondoAhorroTrabajador = $this->fondoAhorro($emp->id_emp);
                        $Gravado = 0;
                        $Excento = 0;
                        
                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"003D","concepto"=>"FONDO DE AHORRO TRABAJADOR","monto"=>$resultaFondoAhorroTrabajador,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "D"]);
                    }else if($concep->clave_concepto == "004D"){
                        $resultaDeduccionFondo = $this->deduccionAhorro($emp->id_emp);
                        $Gravado = 0;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"004D","concepto"=>"DEDUCCION FONDO DE AHORRO EMPRESA","monto"=>$resultaDeduccionFondo,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "D"]);
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
            }*/

            $clave = DB::connection('DB_Serverr')->table('empleados')
                    ->select('clave_empleado','nombre','apellido_paterno','apellido_materno','id_emp')
                    ->where('id_emp','=',$id_emp)
                    ->first();
                
            $calculospercepciones = $ControlPrenomina->where('clave_empleado',$clave->clave_empleado);
            $portipopercepciones = $calculospercepciones->where('tipo','P');

            $calculosdeducciones = $ControlPrenomina->where('clave_empleado',$clave->clave_empleado);
            $portipodeducciones = $calculosdeducciones->where('tipo','D');

            //$sumaImss = $percepcionesImss->sum('total');
            
            return view('aguinaldosNomina.controlAguinaldos', compact('empleados','calculosdeducciones','portipopercepciones','ControlPrenomina'));
        }

        public function anios_trabajados($idEmp){
            $num_p = Session::get('num_periodo');
            $clv = Session::get('clave_empresa');
            $clv_empresa = $this->conectar($clv);
            \Config::set('database.connections.DB_Serverr', $clv_empresa);

            $fecha_inicial = DB::connection('DB_Serverr')->table('periodos')
                            ->select('fecha_inicio')
                            ->where('numero','=',$num_p)
                            ->first();

            $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
                            ->select('fecha_alta')
                            ->where('id_emp','=',$idEmp)
                            ->first();

            $inicial = now()->parse($fecha_inicial->fecha_inicio);
            $alta = now()->parse($alta_trabajador->fecha_alta);
            $diferencia = $inicial->DiffInYears($alta);

            return $diferencia;
        }

        public function aguinaldo_vacaciones_prima($idEmp){
            $at = $this->anios_trabajados($idEmp);

            $clv = Session::get('clave_empresa');
            $clv_empresa = $this->conectar($clv);
            \Config::set('database.connections.DB_Serverr', $clv_empresa);

            $datos_prestaciones = DB::connection('DB_Serverr')->table('prestaciones')
                                    ->select('aguinaldo','dias','prima_vacacional')
                                    ->where('anio','=',$at)
                                    ->first();

            return $datos_prestaciones;
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

        public function aguinaldo($idEmp){
            $diasAguinaldo = $this->aguinaldo_vacaciones_prima($idEmp);
            $sueldoDiario = $this->sueldo_horas($idEmp);
            $aguinaldo = $sueldoDiario->sueldo_diario * $diasAguinaldo->aguinaldo;

            return $aguinaldo;
        }
    }