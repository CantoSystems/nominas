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
    $clv= Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $tipoPeriodo = Empresa::select('tipoPeriodo')
    ->where('clave',$clv)
    ->first();


    $datos->validate([
              'numero' => 'required',
              'fecha_inicio' => 'required',
              'fecha_fin' => 'required',
              'fecha_pago' => 'required'
        ]);

    $coincidencia = DB::connection('DB_Serverr')->table('periodos')
        ->where('numero','=',$datos->numero)
        ->get();
    //$cant=DB::connection('DB_Serverr')->table('periodos')->count();

        if($coincidencia->count() == 0){
            $fecha_periodo = now();
            DB::connection('DB_Serverr')->insert('insert into periodos (numero,fecha_inicio,
            fecha_fin,fecha_pago,diasPeriodo,created_at,updated_at)
            values (?,?,?,?,?,?,?)',[$datos->numero,$datos->fecha_inicio,
            $datos->fecha_fin,$datos->fecha_pago,$tipoPeriodo->tipoPeriodo,$fecha_periodo,$fecha_periodo]);
        }else{
            return back()->with('msj','Registro duplicado');
        }
    }

    public function seleccionarperiodo(Request $request){
        $request->validate([
            'periodo' => 'required'
        ]);
        Session::put('num_periodo',$request->periodo);
        return view('layouts.segunda');
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
                if($aux==""){
                    $aux = DB::connection('DB_Serverr')->table('periodos')->get()->last();
                }
                $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
                return view('periodos.crudperiodos',compact('aux','periodos'));
            break;

            case 'siguiente':
                $aux = DB::connection('DB_Serverr')->table('periodos')->where('id','>',$indic)->first();
                if($aux==""){
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
                return redirect()->route('periodos.acciones');
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

    public function actualizarperiodos($datos){

    $clv= Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $datos->validate([
              'numero' => 'required',
              'fecha_inicio' => 'required',
              'fecha_fin' => 'required',
              'fecha_pago' => 'required'
        ]);
    
    $actualizarporid=$datos->identificador;


    $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('id',$actualizarporid)->first();

    DB::connection('DB_Serverr')->table('periodos')->where('id',$actualizarporid)->update([  
            'numero'=>$datos->numero,
            'fecha_inicio'=>$datos->fecha_inicio,
            'fecha_fin'=>$datos->fecha_fin,
            'fecha_pago'=>$datos->fecha_pago,
        ]);
    }

    public function desactivarPeriodo(){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $statusPeriodo = Session::get('num_periodo');
        

        DB::connection('DB_Serverr')->table('periodos')->where('numero',$statusPeriodo)->update([  
            'status_periodo'=>0,
        ]);

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

    public function eliminarperiodo($id){
    $clv= Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);
    $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('id',$id)->delete();
    return redirect()->route('periodos.acciones');
    }

}
