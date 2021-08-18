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
    
    class ControlPrenominaController extends Controller{
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

        return view('prenomina.controlPrenomina', compact('empleados'));
    }

    public function store(Request $request){
        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach ($request->only('info') as $value) {
            $data = json_decode($value);
        }

        $periodo = Session::get('num_periodo');
        $fecha_periodo = now()->toDateString();
        
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        foreach ($data as $value) {
            DB::connection('DB_Serverr')->insert('INSERT INTO prenomina (clave_empleado,
                                                                         prenomina_periodo,
                                                                         clave_concepto,
                                                                         monto,
                                                                         gravable,
                                                                         excento,
                                                                         status_prenomina,
                                                                         created_at,
                                                                         updated_at
                                                                )values(?,?,?,?,?,?,?,?,?)',[$value->clvEmp
                                                                                            ,$periodo
                                                                                            ,$value->concepto
                                                                                            ,$value->monto
                                                                                            ,$value->gravable
                                                                                            ,$value->excento
                                                                                            ,1
                                                                                            ,$fecha_periodo
                                                                                            ,$fecha_periodo]);
        }
    }

    public function calcularImpuestos(Request $request){
        $percGrav = $request->totalPercepcionesGrav;
        $percNoGrav = $request->totalPercepcionesNoGrav;

        $limites = Retenciones::select('limite_inferior','limite_superior','cuota_fija','porcentaje_excedente')
                   ->where('limite_inferior','<',$percGrav)
                   ->orderBy('id','desc')
                   ->first();

        $diferencia = $percGrav - $limites->limite_inferior;
        $impuestoMarginal = ($diferencia*$limites->porcentaje_excedente)/100;
        $isrCalculado = $impuestoMarginal+$limites->cuota_fija;

        $subsidio = Subsidio::select('ParaIngresos','hastaIngresos','cantidadSubsidio')
                    ->where('ParaIngresos','<',$percGrav)
                    ->orderBy('id_subsidio','desc')
                    ->first();

        $isrDeterminado = $isrCalculado - $subsidio->cantidadSubsidio;
        if($isrDeterminado<0){
            $isr = 0;
        }else{
            $isr = $isrDeterminado;
        }

        return $collection = collect(['002I','ISR',$isr]);
    }

    public function pensionAlimenticia(Request $request){
        $periodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $pension = DB::connection('DB_Serverr')->table('incidencias')
                   ->where([
                       ['clave_empleado','=',$request->clvEmp],
                       ['periodo_incidencia','=',$periodo]
                   ])
                   ->whereIn('clave_concepto',['018D','020D'])
                   ->count();

        if($pension!=0){
            $pension = DB::connection('DB_Serverr')->table('incidencias')
                       ->join('conceptos','conceptos.clave_concepto','=','incidencias.clave_concepto')
                       ->select('incidencias.monto','conceptos.concepto','conceptos.clave_concepto')
                       ->where([
                           ['clave_empleado','=',$request->clvEmp],
                           ['periodo_incidencia','=',$periodo]
                       ])
                       ->whereIn('incidencias.clave_concepto',['018D','020D'])
                       ->first();

            if($pension->clave_concepto == '018D'){
                $descuentoPension = ($pension->monto * $request->totalSueldo)/100;
                $sueldoTotal = $request->totalSueldo - $descuentoPension;
            }else{
                $descuentoPension = $pension->monto;
                $sueldoTotal = $request->totalSueldo - $descuentoPension;
            }

            return $collection = collect([$pension->clave_concepto,$pension->concepto,$sueldoTotal,$descuentoPension]);
        }else{
            $sueldoTotal = $request->totalSueldo;

            return $collection = collect(['','',$sueldoTotal,'']);
        }
    }

    public function calcularIMSS(Request $request){
        $clv = Session::get('clave_empresa');
        $num_periodo = Session::get('num_periodo');

        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $empleados = DB::connection('DB_Serverr')->table('empleados')
                     ->select('id_emp','sueldo_diario','dias')   
                     ->where('clave_empleado','=',$request->clvEmp)
                     ->first();

        $conceptos = DB::connection('DB_Serverr')->table('conceptos')
                     ->select('imss_porcentaje','concepto')
                     ->where([
                         ['seleccionado','=',1],
                         ['imss','=',1],
                         ['imss_porcentaje','!=',0.00]
                     ])
                     ->get();

        $at = $this->anios_trabajados($empleados->id_emp);
        if($at == 0){
            $at = 1;
        }

        $prestaciones = DB::connection('DB_Serverr')->table('prestaciones')
                        ->select('dias')
                        ->where('anio','=',$at)
                        ->first();
        
        $SBC = $this->SBC($prestaciones->dias,$empleados->sueldo_diario,$request->totalImss);
        $uma = $this->uma();

        $ims = IMSS::select('cuotatrabajador','id_imss','base')
                     ->where('cuotatrabajador','!=',0)
                     ->get();

        $totalIMSS = 0;
        foreach($ims as $cuotasIMSS){
            if($cuotasIMSS->id_imss == 3){
                $diferenciaSueldo = $SBC - ($uma->porcentaje_uma*3);
                $sumaIMSS = ($cuotasIMSS->cuotatrabajador*$empleados->dias*$diferenciaSueldo)/100;
                $totalIMSS = $totalIMSS + $sumaIMSS;
            }else{
                $sumaIMSS = ($cuotasIMSS->cuotatrabajador*$empleados->dias*$SBC)/100;
                $totalIMSS = $totalIMSS + $sumaIMSS;
            }
        }

        return $collection = collect(['003T','IMSS TRABAJADOR',$totalIMSS]);
    }

    public function SBC($diasVacaciones,$sueldoDiario,$totalIMSS){
        $primaAguinaldo = 15/365;
        $primaVacaciones = ($diasVacaciones*0.25)/365;
        $FactorIntegracion = $primaAguinaldo + $primaVacaciones + 1;
        $SBC = ($sueldoDiario * $FactorIntegracion) + $totalIMSS; 

        return $SBC;
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
        
        $conceptos = DB::connection('DB_Serverr')->table('conceptos')
                     ->select('clave_concepto','isr','isr_uma','isr_porcentaje')   
                     ->where('seleccionado','=',1)
                     ->get();

        $ControlPrenomina = collect();
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
                    if($resultaFondoAhorro != 0){
                        $Gravado = 0;
                        $Excento = $resultaFondoAhorro;
    
                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"004P","concepto"=>"FONDO DE AHORRO EMPRESA","monto"=>$resultaFondoAhorro,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);  
                    }
                    
                }else if($concep->clave_concepto == "005P"){
                    $resultaPremioPunt = $this->premioPunt($emp->id_emp,$emp->clave_empleado);
                    if($resultaPremioPunt != 0){
                        $Gravado = $resultaPremioPunt;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"005P","concepto"=>"PREMIO DE PUNTUALIDAD","monto"=>$resultaPremioPunt,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);  
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "006P"){
                    $resultaPremioAsis = $this->premioPunt($emp->id_emp,$emp->clave_empleado);
                    if($resultaPremioAsis != 0){
                        $Gravado = $resultaPremioAsis;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"006P","concepto"=>"PREMIO DE ASISTENCIA","monto"=>$resultaPremioAsis,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "007P"){
                    $resultaPrimaVacacional = $this->primaVacacional($emp->id_emp,$emp->clave_empleado);
                    if($resultaPrimaVacacional != 0){
                        $calculosISR = $this->calcularGravado($concep,$resultaPrimaVacacional);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"007P","concepto"=>"PRIMA VACACIONAL","monto"=>$resultaPrimaVacacional,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
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
                    $montoCompensacion = $this->adicionales($emp->clave_empleado,'009P');
                    if($montoCompensacion != 0){
                        $calculosISR = $this->calcularGravado($concep,$montoCompensacion);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"009P","concepto"=>"COMPENSACION","monto"=>$montoCompensacion,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                        $percepcionesImss->push(["concepto"=>"COMPENSACION", "total" => $montoCompensacion]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "010P"){
                    $montoDiferencia = $this->adicionales($emp->clave_empleado,'010P');
                    if($montoDiferencia != 0){
                        $calculosISR = $this->calcularGravado($concep,$montoDiferencia);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"009P","concepto"=>"DIFERENCIA DE SUELDO","monto"=>$montoDiferencia,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                        $percepcionesImss->push(["concepto"=>"DIFERENCIA DE SUELDO", "total" => $montoDiferencia->monto]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "011P"){

                }else if($concep->clave_concepto == "012P"){
                
                }else if($concep->clave_concepto == "013P"){
                    $Vacaciones = $this->pagoVacaciones($emp->id_emp,$emp->clave_empleado);
                    if($Vacaciones != 0){
                        $Gravado = $Vacaciones;
                        $Excento = 0;

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"013P","concepto"=>"VACACIONES","monto"=>$Vacaciones,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                        $percepcionesImss->push(["concepto"=>"VACACIONES", "total" => $Vacaciones ]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "015P"){
                    $montoComisiones = $this->adicionales($emp->clave_empleado,'015P');
                    if($montoComisiones != 0){
                        $calculosISR = $this->calcularGravado($concep,$montoComisiones);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"015P","concepto"=>"COMISIONES","monto"=>$montoComisiones,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                        $percepcionesImss->push(["concepto"=>"COMISIONES", "total" => $montoComisiones->monto]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "016P"){

                }else if($concep->clave_concepto == "017P"){
                    $montoComisiones = $this->adicionales($emp->clave_empleado,'017P');
                    if($montoComisiones != 0){
                        $calculosISR = $this->calcularGravado($concep,$montoComisiones);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"017P","concepto"=>"BONO DE PRODUCTIVIDAD","monto"=>$montoComisiones,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "P"]);
                        $percepcionesImss->push(["concepto"=>"BONO DE PRODUCTIVIDAD", "total" => $montoComisiones->monto]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
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
                    $resultaDeduccionFondo = $this->fondoAhorro($emp->id_emp);
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
                    $montoUniformes = $this->adicionales($emp->clave_empleado,'011D');
                    if($montoUniformes != 0){
                        $calculosISR = $this->calcularGravado($concep,$montoUniformes);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"012D","concepto"=>"UNIFORMES","monto"=>$montoUniformes,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "D"]);
                        $percepcionesImss->push(["concepto"=>"UNIFORMES", "total" => $montoUniformes]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "012D"){
                    $montoPrestamos = $this->adicionales($emp->clave_empleado,'012D');
                    if($montoPrestamos != 0){
                        $calculosISR = $this->calcularGravado($concep,$montoPrestamos);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"012D","concepto"=>"PRESTAMOS","monto"=>$montoPrestamos,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "D"]);
                        $percepcionesImss->push(["concepto"=>"PRESTAMOS", "total" => $montoPrestamos]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "013D"){
                    $montoLentes = $this->adicionales($emp->clave_empleado,'013D');
                    if($montoLentes != 0){
                        $calculosISR = $this->calcularGravado($concep,$montoLentes);
                        $Gravado = $calculosISR['percepcionGravable'];
                        $Excento = $calculosISR['percepcionExcenta'];

                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"013D","concepto"=>"DESCUENTO DE LENTES","monto"=>$montoLentes,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "D"]);
                        $percepcionesImss->push(["concepto"=>"DESCUENTO DE LENTES", "total" => $montoLentes]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }else if($concep->clave_concepto == "014D"){

                }else if($concep->clave_concepto == "015D"){
                    
                }else if($concep->clave_concepto == "016D"){
                    
                }else if($concep->clave_concepto == "017D"){
                    
                }else if($concep->clave_concepto == "018D"){
                    
                }else if($concep->clave_concepto == "019D"){
                    $montoRetardo = $this->adicionales($emp->clave_empleado,'019D');
                    if($montoRetardo != 0){
                        $ControlPrenomina->push(["clave_empleado"=>$emp->clave_empleado,"clave_concepto"=>"013D","concepto"=>"RETARDO","monto"=>$montoRetardo,"gravable"=>$Gravado,"excento"=>$Excento,"tipo"=> "D"]);
                        $percepcionesImss->push(["concepto"=>"DESCUENTO DE LENTES", "total" => $montoRetardo]);
                    }else{
                        $Gravado = 0;
                        $Excento = 0;
                    }
                }
            }
        }

        $clave = DB::connection('DB_Serverr')->table('empleados')
                 ->select('clave_empleado','nombre','apellido_paterno','apellido_materno','id_emp')
                 ->where('id_emp','=',$id_emp)
                 ->first();

        $calculospercepciones = $ControlPrenomina->where('clave_empleado',$clave->clave_empleado);
        $portipopercepciones = $calculospercepciones->where('tipo','P');

        $calculosdeducciones = $ControlPrenomina->where('clave_empleado',$clave->clave_empleado);
        $portipodeducciones = $calculosdeducciones->where('tipo','D');

        $sumaImss = $percepcionesImss->sum('total');
        
        return view('prenomina.controlPrenomina', compact('empleados','portipopercepciones','portipodeducciones','ControlPrenomina','sumaImss','clave'));
    }

    public function exportExcel(){
        return (new PrenominaExport)->download('prenomina.xlsx');
    }

    public function pagoVacaciones($idEmp,$claveEmp){
        $sd = $this->sueldo_horas($idEmp);
        $diasTomadosPeriodo = $this->vacacionesEmpleadoPeriodo($claveEmp); 
        //Dias de vacaciones tomados en el periodo
        $diasVacaciones = $diasTomadosPeriodo->cantidad * $sd->sueldo_diario;
        return $diasVacaciones;
    }

    public function vacacionesEmpleado($idEmp,$claveEmp){
        $at = $this->anios_trabajados($idEmp);
        
        $alta_trabajador = DB::connection('DB_Serverr')->table('empleados')
                           ->select('fecha_alta')
                           ->where('id_emp','=',$idEmp)
                           ->first();

        $fecha_actual = now()->toDateString();
        if($at == 0){
            $fechaInicio = $alta_trabajador->fecha_alta;
        }else{
            $fechaInicio = date('Y-m-d',strtotime($alta_trabajador->fecha_alta."+".$at." years"));
        }

        $periodos = DB::connection('DB_Serverr')->table('periodos')
                    ->select('numero')
                    ->where([
                        ['fecha_inicio','>',$fechaInicio],
                        ['fecha_fin','<',$fecha_actual]
                    ])
                    ->get();
      
        $arrayPeriodos = $periodos->pluck('numero')->toArray();
        $diasVacacionesTom = DB::connection('DB_Serverr')->table('incidencias')
                             ->select(DB::raw('CASE WHEN COUNT(`cantidad`) = " " THEN 0 ELSE SUM(`cantidad`) END as cantidad'))
                             ->where([
                                 ['clave_concepto','=','013P'],
                                 ['clave_empleado','=',$claveEmp]
                             ])
                             ->whereIn('periodo_incidencia', $arrayPeriodos)
                             ->first();
        
        return $diasVacacionesTom;
    }

    public function vacacionesEmpleadoPeriodo($claveEmp){
        $num_periodo = Session::get('num_periodo');
        $diasVacacionesTom = DB::connection('DB_Serverr')->table('incidencias')
                             ->select(DB::raw('CASE WHEN COUNT(`cantidad`) = " " THEN 0 ELSE SUM(`cantidad`) END as cantidad'))
                             ->where([
                                 ['clave_concepto','=','013P'],
                                 ['clave_empleado','=',$claveEmp],
                                 ['periodo_incidencia','=',$num_periodo]
                             ])
                             ->first();
        
        return $diasVacacionesTom;
    }

    /* Funciones variable general */
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
    }

    public function ahorro_riesgo(){
        $clv = Session::get('clave_empresa');
        $datos_empresa = Empresa::select('primaRiesgo','porcentajeAhorro','region')
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

        $datos_prestaciones = DB::connection('DB_Serverr')->table('prestaciones')
                                ->select('aguinaldo','dias','prima_vacacional')
                                ->where('anio','=',$at)
                                ->first();
                                //retornamos la cantidad de dias otorgados acceder
                                // $diasAguinaldo->aguinaldo
        if(is_null($datos_prestaciones)){
            
            $datos_prestaciones=  DB::connection('DB_Serverr')->table('prestaciones')
                                    ->select('aguinaldo','dias','prima_vacacional')
                                    ->where('anio','=',1)
                                    ->first();
        }
        return $datos_prestaciones;
    }

    public function sueldo($idEmp,$claveEmp){
        //Sueldo = SD * (JT-001D-002D)
        $sd = $this->sueldo_horas($idEmp);
        $jt = $this->dias_trabajados($claveEmp);
        $tiempo = $this->vacacionesEmpleado($idEmp,$claveEmp);
         //Cantidad de vacaciones totales en el último año
         
        $diasTotalesVacaciones = $this->aguinaldo_vacaciones_prima($idEmp); 
        //Días totales de vacaciones que puede tomar
        $diasTomadosPeriodo = $this->vacacionesEmpleadoPeriodo($claveEmp); 
        //Dias de vacaciones tomados en el periodo        
        $diasTotalesTrabajados = 0;
        if($diasTotalesVacaciones->dias >= $tiempo->cantidad){
            $diasTotalesTrabajados = ($jt - $diasTomadosPeriodo->cantidad)*$sd->sueldo_diario;
        }else{
            $diasTotalesTrabajados = $sd->sueldo_diario * $jt;
        }

        return $diasTotalesTrabajados;
    }

    public function fondoAhorro($idEmp){
    /* //Formula SI(UMA*1.3>SD, UMA*1.3,SD)*PFA*/
        $sd = $this->sueldo_horas($idEmp);
        //$sd->sueldo_diario;
        return $sd->sueldo_diario;
        $region = $this->ahorro_riesgo();
        //$region->porcentajeAhorro;
        $importeRegion = SalarioMinimo::select('importe')
                            ->where('region',$region->region)
                            ->first();
        $importeCondicion = $importeRegion->importe * 1.3;
        //$importeCondicion;        
        if($importeCondicion<$sd->sueldo_diario){
            $totalFondo = ($importeRegion->importe * 1.3)*$region->porcentajeAhorro;
             return $totalFondo;
        }

        $totalFondo = $sd->sueldo_diario*$region->porcentajeAhorro;
        return $totalFondo;
    }

    public function premioPunt($idEmp,$claveEmp){
        //SD*(DT)*.1
        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);
        $premioPuntualidad = $sd->sueldo_diario*($diasTrabajados)*0.1;
        return $premioPuntualidad;
    }

    public function primaVacacional($idEmp,$claveEmp){
        $sd = $this->sueldo_horas($idEmp);
        $dv = $this->aguinaldo_vacaciones_prima($idEmp);
        $diasTomadosPeriodo = $this->vacacionesEmpleadoPeriodo($claveEmp);
        $primaVacacional = (($sd->sueldo_diario*$diasTomadosPeriodo->cantidad) * $dv->prima_vacacional)/100;
        return $primaVacacional;
    }

    public function primaDominical($idEmp){
        $sd = $this->sueldo_horas($idEmp);
        $primaDominical = $sd->sueldo_diario * 0.25 ;
        return $primaDominical;
    }

    public function ausentismoIncapacidadDeduccion($idEmp,$claveEmp){
        $sd = $this->sueldo_horas($idEmp);
        $diasTrabajados = $this->dias_trabajados($claveEmp);
        $ausentismoIncapacidad = $sd->sueldo_diario * $diasTrabajados;
        return $ausentismoIncapacidad;
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
        
    public function calcularGravado($datosPercepcion,$totalPercepcion){
        $UMAExcentas = $datosPercepcion->isr_uma*89;
        $exceso = $totalPercepcion - $UMAExcentas;
        $percepcionGravable = (($UMAExcentas*$datosPercepcion->isr_porcentaje)/100)+$exceso;
        $percepcionExcenta = ($UMAExcentas*$datosPercepcion->isr_porcentaje)/100;
        
        return compact('percepcionGravable','percepcionExcenta');
    }

    public function adicionales($claveEmp,$claveConcepto){
        $nperiodo = Session::get('num_periodo');
        $clv = Session::get('clave_empresa');
        $clv_empresa = $this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $totalAdicional = DB::connection('DB_Serverr')->table('incidencias')
                          ->select(DB::raw('CASE WHEN COUNT(importe) = " " THEN 0 ELSE SUM(importe) END as monto'))
                          ->where([
                              ['clave_concepto','=',$claveConcepto],
                              ['clave_empleado','=',$claveEmp],
                              ['periodo_incidencia','=',$nperiodo]
                          ])
                          ->first();

        return $totalAdicional->monto;
    }
}