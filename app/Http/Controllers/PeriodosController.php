<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Empresa;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class PeriodosController extends Controller
{
    public function index(Request $request){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $periodos=DB::connection('DB_Serverr')->table('periodos')
                ->where('status_periodo',1)->get();
        $cant=DB::connection('DB_Serverr')->table('periodos')->count();
        return view('periodos.periodos',compact('periodos','cant'));
    }

    public function agregarperiodos($datos){

        //$this->desactivarPeriodo();
        $actualPeriodo = Session::get('num_periodo');
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $datos->validate([
            'diasPeriodo' => 'required',
            'fecha_inicio' => 'required',
            'fecha_pago' => 'required'
        ]);
        $tipoPeriodo = $datos->diasPeriodo;

        $terminoPeriodo = DB::connection('DB_Serverr')->table('periodos')
                    ->select('fecha_fin','diasPeriodo','fecha_pago','numero','fecha_inicio')
                    ->where([
                            ['numero','=',$actualPeriodo],
                            ['status_periodo','=',1]
                    ])
                    ->latest('id')->first();
        if(!(is_null($terminoPeriodo))){
             //Inicio periodo
        $encontrarDia = date('d',strtotime($datos->fecha_inicio));
        $encontrarMes = date('m',strtotime($datos->fecha_inicio));
        $encontrarAnio = date('Y',strtotime($datos->fecha_inicio));
        $siguienteMes = $encontrarMes+1;
        $calculoPeriodo = $tipoPeriodo-1;
        $anionuevo = 1;
        $siguienteAnio = $encontrarAnio+1;


            if($tipoPeriodo == 7 ){
                $numero =  $terminoPeriodo->numero+1;
                $fechaFin = date("Y-m-d",strtotime($datos->fecha_inicio."+ ".$calculoPeriodo." days"));

                //Reiniciamos el número de periodo al cambiar de año
                $anioInicioPeriodo =  date('Y',strtotime($datos->fecha_inicio));
                $anioPagoPeriodo   =  date('Y',strtotime($datos->fecha_pago));

                if($anioPagoPeriodo > $anioInicioPeriodo){
                    $numero = 1;
                }
            }else if($tipoPeriodo == 10){
                $numero =  $terminoPeriodo->numero+1;
                $fechaFin = date("Y-m-d",strtotime($datos->fecha_inicio."+ ".$calculoPeriodo." days"));
                //Reiniciamos el número de periodo al cambiar de año
                $anioInicioPeriodo =  date('Y',strtotime($datos->fecha_inicio));
                $anioPagoPeriodo   =  date('Y',strtotime($datos->fecha_pago));

                if($anioPagoPeriodo > $anioInicioPeriodo){
                    $numero = 1;
                }
            }else if($tipoPeriodo == 15){
                if($encontrarDia <= 15 ){
                    if($siguienteMes <= 12){
                        $numero =  $terminoPeriodo->numero+1;
                        $fechaFin = $encontrarAnio.'-'.$encontrarMes.'-15';
                    }elseif($siguienteMes ==13){
                        $numero =  $terminoPeriodo->numero+1;
                        $fechaFin = $siguienteAnio.'-'.$anionuevo.'-15';
                    }
                }else if($encontrarDia >= 16 ){
                    $numero =  $terminoPeriodo->numero+1;
                    //$numero = $encontrarMes*2;
                    $fechaFin = date('Y-m-d',(mktime(0,0,0,$encontrarMes+1,1,$encontrarAnio)-1));
                }
            }else if($tipoPeriodo == 30){
                
                if($siguienteMes <= 12){
                    $numero =  $terminoPeriodo->numero+1;
                    $fechaFin = date('Y-m-d',(mktime(0,0,0,$encontrarMes+1,1,$encontrarAnio)-1));
                }elseif($siguienteMes ==13){
                    $numero = Ltrim($anionuevo,"0");
                    $fechaFin = date('Y-m-d',(mktime(0,0,0,$anionuevo+1,1,$siguienteAnio)-1)); 
                }
                
            }else{
                return back()->with('msj','Las fechas ingresadas son incorrectas');
            }

            $evitarDesfase = DB::connection('DB_Serverr')->table('periodos')
                        ->orWhere('fecha_inicio',$datos->fecha_inicio)
                        ->orWhere('fecha_fin',$fechaFin)
                        ->orWhere('fecha_pago',$datos->fecha_pago)
                        ->get();
            
            if($evitarDesfase->count() == 0 && (strtotime($datos->fecha_inicio) >= strtotime($terminoPeriodo->fecha_fin) || strtotime($fechaFin) >= strtotime($terminoPeriodo->fecha_fin) || strtotime($datos->fecha_pago)) >= strtotime($terminoPeriodo->fecha_fin) ){
                $this->desactivarPeriodo();
                $fecha_periodo = now();
                DB::connection('DB_Serverr')->insert('insert into periodos (numero,fecha_inicio,
                                            fecha_fin,fecha_pago,diasPeriodo,status_periodo,created_at,updated_at)
                                            values (?,?,?,?,?,?,?,?)',[$numero,$datos->fecha_inicio,
                                            $fechaFin,$datos->fecha_pago,$datos->diasPeriodo,1,$fecha_periodo,$fecha_periodo]);

            }else{
                return back()->with('msj','Las fechas ingresadas son incorrectas');
            }
        }else{
            return back()->with('msj','Las fechas ingresadas son incorrectas'); 
        }        
    }

    public function seleccionarperiodo(Request $request){
        $request->validate([
            'periodo' => 'required'
        ]);
        Session::put('num_periodo',$request->periodo);
        return view('layouts.segunda');
    }

    public function sugerenciaFechaInicio(Request $request){
    
        $actualPeriodo = Session::get('num_periodo');
        $fecha_periodo = now()->toDateString();

        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        /* se consulta a la tabla de periodos el último periodo regisrtrado
            desactivado y por numero de periodo
        */
        
        $terminoPeriodo = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_fin','diasPeriodo','fecha_pago','numero')
            ->where([
                    ['numero','=',$actualPeriodo],
                    ['status_periodo','=',1]
                ])
            ->latest('id')->first();
        
        if(!is_null($terminoPeriodo)){
                $encontrarDia = date('d',strtotime($terminoPeriodo->fecha_fin))+1;
                $encontrarMes  = date('m',strtotime($terminoPeriodo->fecha_fin));
                $encontrarAnio = date('Y',strtotime($terminoPeriodo->fecha_fin));
                $siguienteMes = $encontrarMes+1;
                $siguienteAnio = $encontrarAnio+1;
                $anionuevo = 1;
                $validacionbisiesto = checkdate(2,29,$encontrarAnio);

            // se toman en cuenta la suma del la variable encontrarDia+1, para comenzar en 1 el mes 
            // Y la validación de si es año bisiesto
            if($validacionbisiesto){
                if($encontrarDia === 30){
                    $encontrarDia = 1; 
                }
            }else{
                if($encontrarDia === 32 or $encontrarDia === 29 or  $encontrarDia === 31){
                    $encontrarDia = 1;
                }
            }

            if($terminoPeriodo->diasPeriodo === 7){
                $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-'.$encontrarDia;
            }else if($terminoPeriodo->diasPeriodo === 10){
                if($encontrarDia != 1){
                    $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-'.$encontrarDia;
                }else{
                    $iniciarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-'.$encontrarDia;
                }
            }else if($terminoPeriodo->diasPeriodo === 15){
                if($encontrarDia <= 15){
                    if($siguienteMes <= 12){
                        $iniciarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-01';
                    }elseif($siguienteMes ==13){
                        $iniciarPeriodo = $siguienteAnio.'-'.$anionuevo.'-01';
                    }
                }elseif($encontrarDia >= 16){
                    $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-16';
                }
            }else if($terminoPeriodo->diasPeriodo === 30){
                if($siguienteMes <= 12){
                    $iniciarPeriodo =  $encontrarAnio.'-'.$siguienteMes.'-1';
                }elseif($siguienteMes ==13){
                    $iniciarPeriodo =  $siguienteAnio.'-'.$anionuevo.'-1';
                }
            }
            }
            
                return $iniciarPeriodo;
    }

    public function generarPeriodo(){
        //se obtiene el numero del periodo 
        $actualPeriodo = Session::get('num_periodo');
        //se obtiene la fecha actual para la inserción del nuevo periodo
        $fecha_periodo = now()->toDateString();

        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        /* se consulta a la tabla de periodos el último periodo regisrtrado
            desactivado y por numero de periodo
        */
        
        //dd($actualPeriodo);
        $terminoPeriodo = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_fin','diasPeriodo','fecha_pago','numero')
            ->where([
                    ['numero','=',$actualPeriodo],
                    ['status_periodo','=',0]
                ])
            ->latest('id')->first();

        //return (is_null($terminoPeriodo)) ? "nulo" : "no nulo";
        // evaluamos si se ha desactivado el periodo anterior
        if(!is_null($terminoPeriodo)){

            //variables 
            $encontrarDia = date('d',strtotime($terminoPeriodo->fecha_fin))+1;
            $encontrarMes  = date('m',strtotime($terminoPeriodo->fecha_fin));
            $encontrarAnio = date('Y',strtotime($terminoPeriodo->fecha_fin));
            $siguienteMes = $encontrarMes+1;
            $siguienteAnio = $encontrarAnio+1;
            $difFechas = Carbon::parse($terminoPeriodo->fecha_pago)->diffInDays($terminoPeriodo->fecha_fin);
            $anionuevo = 1;

            $validacionbisiesto = checkdate(2,29,$encontrarAnio);

            // se toman en cuenta la suma del la variable encontrarDia+1, para comenzar en 1 el mes 
            // Y la validación de si es año bisiesto
            if($validacionbisiesto){
                if($encontrarDia === 30){
                    $encontrarDia = 1; 
                }
            }else{
                if($encontrarDia === 32 or $encontrarDia === 29 or  $encontrarDia === 31){
                    $encontrarDia = 1;
                }
            }

            //Se evalua el tipo de periodo para generar los siguientes periodos
            if($terminoPeriodo->diasPeriodo === 7){

                $numeroPeriodo = $terminoPeriodo->numero+1;
                $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-'.$encontrarDia;
                $finalizarPeriodo = date("Y-m-d",strtotime($terminoPeriodo->fecha_fin."+ ".$terminoPeriodo->diasPeriodo." days"));
                $pago = date("Y-m-d",strtotime($finalizarPeriodo."+ ".$difFechas." days"));

                //Reiniciamos el número de periodo al cambiar de año
                $anioInicioPeriodo =  date('Y',strtotime($iniciarPeriodo));
                $anioPagoPeriodo   =  date('Y',strtotime($pago));

                if($anioPagoPeriodo > $anioInicioPeriodo){
                    $numeroPeriodo = 1;
                }

            }elseif($terminoPeriodo->diasPeriodo === 10){
                //Ubicamos el día de la semana en que se realizo el primer día de pago
                $diaPago = date('l',strtotime($terminoPeriodo->fecha_pago));
                
                $numeroPeriodo = $terminoPeriodo->numero+1;

                    if($encontrarDia != 1){
                        $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-'.$encontrarDia;
                    }else{
                        $iniciarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-'.$encontrarDia;
                    }

                    
                $finalizarPeriodo = date("Y-m-d",strtotime($terminoPeriodo->fecha_fin."+ ".$terminoPeriodo->diasPeriodo." days"));
                //formateamos la fecha en número 
                $fechaFormateada = strtotime($finalizarPeriodo);
                //Encontramos el día se la semana próximo para generar la fecha de pago
                $pago = date('Y-m-d',strtotime('next '.$diaPago,$fechaFormateada));

                //Reiniciamos el número de periodo al cambiar de año
                $anioInicioPeriodo =  date('Y',strtotime($iniciarPeriodo));
                $anioPagoPeriodo   =  date('Y',strtotime($pago));

                if($anioPagoPeriodo > $anioInicioPeriodo){
                    $numeroPeriodo = 1;
                }
               

            }elseif($terminoPeriodo->diasPeriodo === 15){

                if($encontrarDia <= 15){
                    //validamos el mes y cambiamos de año 
                    if($siguienteMes <= 12){
                        $numeroPeriodo = ($siguienteMes*2)-1;
                        $numeroPeriodo = ($siguienteMes*2)-1;
                        $iniciarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-01';
                        $finalizarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-15';
                    }elseif($siguienteMes ==13){
                        $numeroPeriodo = ($anionuevo*2)-1;
                        $iniciarPeriodo = $siguienteAnio.'-'.$anionuevo.'-01';
                        $finalizarPeriodo = $siguienteAnio.'-'.$anionuevo.'-15';
                    }
                    $pago = $finalizarPeriodo;
                }elseif($encontrarDia >= 16){

                    $numeroPeriodo = $encontrarMes*2;
                    $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-16';
                    $mesSiguiente = $encontrarMes+1;
                    $finalizarPeriodo =  date('Y-m-d',(mktime(0,0,0,$mesSiguiente,1,$encontrarAnio)-1));
                    $pago = $finalizarPeriodo;
                }
            }elseif($terminoPeriodo->diasPeriodo === 30){
                
                if($siguienteMes <= 12){
                    $numeroPeriodo = Ltrim($siguienteMes,"0");
                    $iniciarPeriodo =  $encontrarAnio.'-'.$siguienteMes.'-1';
                    $finalizarPeriodo = date('Y-m-d',(mktime(0,0,0,$siguienteMes+1,1,$encontrarAnio)-1));
                }elseif($siguienteMes ==13){
                    $numeroPeriodo = Ltrim($anionuevo,"0");
                    $iniciarPeriodo =  $siguienteAnio.'-'.$anionuevo.'-1';
                    $finalizarPeriodo = date('Y-m-d',(mktime(0,0,0,$anionuevo+1,1,$siguienteAnio)-1)); 
                }
                $pago = $finalizarPeriodo;
            }
        } else {
            return back()->with('status','Verificar si se ha desactivado el periodo anterior');
        }

        DB::connection('DB_Serverr')->insert('insert into periodos(numero,fecha_inicio,fecha_fin,fecha_pago,diasPeriodo
                                            ,status_periodo,created_at,updated_at)
                                            VALUES(?,?,?,?,?,?,?,?)',[$numeroPeriodo,$iniciarPeriodo
                                            ,$finalizarPeriodo,$pago
                                            ,$terminoPeriodo->diasPeriodo,1
                                            ,$fecha_periodo,$fecha_periodo]);
        return redirect()->route('periodos.index');
    }
    public function acciones(Request $request){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $accion= $request->acciones;
        $indic=$request->identificador;

        switch ($accion) {
            case '':
                $aux = DB::connection('DB_Serverr')->table('periodos')->first();
                $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));
            break;

            case 'atras':
                $aux = DB::connection('DB_Serverr')->table('periodos')->where('id','<',$indic)->latest('id')->first();
                if(is_null($aux)){
                    $aux = DB::connection('DB_Serverr')->table('periodos')->get()->last();
                }
                $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));
            break;

            case 'siguiente':
                $aux = DB::connection('DB_Serverr')->table('periodos')->where('id','>',$indic)->first();
                if(is_null($aux)){
                    $aux = DB::connection('DB_Serverr')->table('periodos')->first();
                }
                $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));
            break;

            case 'primero':
                $aux = DB::connection('DB_Serverr')->table('periodos')->first();
                $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));
            break;

            case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('periodos')->latest('id')->first();
                $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));
            break;

            case 'registrar':
                $this->agregarperiodos($request);
                return redirect()->route('home');
            break;

            case 'actualizar':
                $this->actualizarperiodos($request);
                return redirect()->route('periodos.acciones');
            break;

            case 'cancelar_periodos':
                return redirect()->route('periodos.acciones');
            break;

            case 'buscar':
                $criterio= $request->opcion;
                if($criterio == 'numero'){
                    $aux = DB::connection('DB_Serverr')->table('periodos')->where('numero',$request->busca)->first();

                        if($aux == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }
                    $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));


                }else if($criterio == 'fecha_inicio'){
                    $aux = DB::connection('DB_Serverr')->table('periodos')->where('fecha_inicio',$request->busca)->first();

                        if($aux == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }

                    $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));

                }else if($criterio == 'fecha_fin'){

                    $aux = DB::connection('DB_Serverr')->table('periodos')->where('fecha_fin',$request->busca)->first();

                        if($aux == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }

                    $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));

                }else if($criterio == 'fecha_pago'){

                    $aux = DB::connection('DB_Serverr')->table('periodos')->where('fecha_pago',$request->busca)->first();

                        if($aux == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }
                        
                    $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));

                }

                break;

            default:

            break;

        }

    }

    public function conectar($clv)
    {

        $configDb = [
        'driver'      => 'mysql',
        'host'        => env('DB_HOST', 'localhost'),
        'port'        => env('DB_PORT', '3306'),
        'database'    => $clv,
        'username'    => env('DB_USERNAME', 'root'),
        'password'    => env('DB_PASSWORD', 'prueba1'),
        'unix_socket' => env('DB_SOCKET', 'Incretec_265'),
        'charset'     => 'utf8',
        'collation'   => 'utf8_unicode_ci',
        'prefix'      => '',
        'strict'      => true,
        'engine'      => null,
        ];

        return $configDb;

    }

    public function actualizarperiodos($datos){

    $clv= Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $datos->validate([
              'fecha_pago' => 'required'
        ]);
    
    $actualizarporid=$datos->identificador;


    $aux1 = DB::connection('DB_Serverr')->table('periodos')
        ->select('fecha_fin')->where([
        ['id',$actualizarporid],
        ['status_periodo',1]])->first();

        if(!(is_null($aux1)) && strtotime($datos->fecha_pago) > strtotime($aux1->fecha_fin)){
            DB::connection('DB_Serverr')->table('periodos')->where('id',$actualizarporid)->update([
                'fecha_pago'=>$datos->fecha_pago,
            ]);
        }else{
            return back()->with('msj','Periodos inactivos no se pueden modificar'); 
        }

    
    }

    public function desactivarPeriodo(){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $statusPeriodo = Session::get('num_periodo');

        DB::connection('DB_Serverr')->table('periodos')->where('numero',$statusPeriodo)->update([  
            'status_periodo'=>0,
        ]);
    }

    public function desactivarPrenomina(){
        $this->desactivarPeriodo();
        return redirect()->route('control.index');
    }

    public function show($id){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux = DB::connection('DB_Serverr')->table('periodos')
        ->where('id',$id)->first();
        $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
        return view('periodos.crudperiodos',compact('aux','periodos'));

    }

    public function rangoPeriodo(Request $request){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $dPeriodo = DB::connection('DB_Serverr')->table('periodos')
                                                ->select('diasPeriodo')
                                                ->latest('id')->first();
                                                 
        return $dPeriodo->diasPeriodo;
    }

    public function calcularFechaFin(Request $request){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

            $diaInicio =  date('d',strtotime($request->inicio));
            $mesInicio =  date('m',strtotime($request->inicio));
            $anioInicio =  date('Y',strtotime($request->inicio));
            $calculoPeriodo = $request->periodoTipo-1;
            $siguienteMes = $mesInicio+1;
            $siguienteAnio = $anioInicio+1;
            $anionuevo = 1;

         if($request->periodoTipo == 7 || $request->periodoTipo == 10){
            
            $fechaFin = date("Y-m-d",strtotime($request->inicio."+ ".$calculoPeriodo." days"));
         }else if($request->periodoTipo == 15){
            if($diaInicio <= 15){
                if($siguienteMes <= 12){
                    $fechaFin = $anioInicio.'-'.$mesInicio.'-'.'15';
                }elseif($siguienteMes == 13){
                    $fechaFin = $siguienteAnio.'-'.$anionuevo.'-15';
                }
            }else{
                $fechaFin = date('Y-m-d',(mktime(0,0,0,$mesInicio+1,1,$anioInicio)-1));
            }
         }else if($request->periodoTipo == 30){
            
            if($siguienteMes <= 12){
                $fechaFin = date('Y-m-d',(mktime(0,0,0,$mesInicio+1,1,$anioInicio)-1));
            }elseif($siguienteMes ==13){
                $fechaFin = date('Y-m-d',(mktime(0,0,0,$anionuevo+1,1,$siguienteAnio)-1)); 
            }
         }
         return $fechaFin;
    }

    public function eliminarperiodo($id){
    $clv= Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $aux1 = DB::connection('DB_Serverr')->table('periodos')
        ->select('fecha_fin')->where([
        ['id',$id],
        ['status_periodo',1]])->first();

        if(!(is_null($aux1))){
            $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('id',$id)->delete();
            $anteriorPeriodo = DB::connection('DB_Serverr')->table('periodos')
                                                ->select('id')->where([
                                                ['status_periodo','=',0]
                                                ])
                                                ->latest('id')->first();
            DB::connection('DB_Serverr')->table('periodos')->where('id',$anteriorPeriodo->id)->update([  
                                                    'status_periodo'=>1,
                                                ]);                             
            return redirect()->route('periodos.acciones');
        }else{
            return back()->with('msj','Periodos inactivos no pueden ser eliminados'); 
        }

    
    
    }

}
