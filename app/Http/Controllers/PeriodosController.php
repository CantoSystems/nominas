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
    public function index(){
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
        Session::put('num_periodo',$request->periodo);
        return view('layouts.segunda');
    }

    public function generarPeriodo(){
        $actualPeriodo = Session::get('num_periodo');
        $fecha_periodo = now()->toDateString();

        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);
        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $terminoPeriodo = DB::connection('DB_Serverr')->table('periodos')
            ->select('fecha_fin','diasPeriodo','fecha_pago','numero')
            ->where([
                    ['numero','=',$actualPeriodo],
                    ['status_periodo','=',0]
                ])
                ->latest('id')->first();

        //dd($terminoPeriodo);
        
                if(is_null($terminoPeriodo)){
                    return back()->with('status','Verificar si se ha desactivado el periodo anterior');
                }
       
        $encontrarDia = date('d',strtotime($terminoPeriodo->fecha_fin))+1;
        $encontrarMes  = date('m',strtotime($terminoPeriodo->fecha_fin));
        $encontrarAnio = date('Y',strtotime($terminoPeriodo->fecha_fin));

        if($encontrarDia === 32 or $encontrarDia === 29 or  $encontrarDia === 31){
            $encontrarDia = 1;
        }

        if( $terminoPeriodo->diasPeriodo === 15){
            if($encontrarDia <=15){
                $siguienteMes = $encontrarMes+1;
                if($siguienteMes <= 12){
                    $numeroPeriodo = ($siguienteMes*2)-1;
                    $iniciarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-01';
                    $finalizarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-15';
                    $pago = $finalizarPeriodo;
                }else if($siguienteMes == 13){
                    $siguienteMes = 1;
                    $siguienteAnio = $encontrarAnio+1;
                    $numeroPeriodo = ($siguienteMes*2)-1;
                    $iniciarPeriodo = $siguienteAnio.'-'.$siguienteMes.'-01';
                    $finalizarPeriodo = $siguienteAnio.'-'.$siguienteMes.'-15';
                    $pago = $finalizarPeriodo;
                }
            }else if($encontrarDia >= 16 and $encontrarDia<=31){
                $numeroPeriodo = $encontrarMes*2;
                $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-16';
                $mesSiguiente = $encontrarMes+1;
                $finalizarPeriodo =  date('Y-m-d',(mktime(0,0,0,$mesSiguiente,1,$encontrarAnio)-1));
                $pago = $finalizarPeriodo;
            }
        }else if( $terminoPeriodo->diasPeriodo === 30){
                $proximoMes = $encontrarMes + 1;                
                    if($proximoMes <= 12){
                        $numeroPeriodo = Ltrim($proximoMes,"0");
                        $iniciarPeriodo =  $encontrarAnio.'-'.$proximoMes.'-1';
                        $finalizarPeriodo = date('Y-m-d',(mktime(0,0,0,$proximoMes+1,1,$encontrarAnio)-1));
                        $pago = $finalizarPeriodo;
                    }else if($proximoMes == 13){
                      
                        $anioNuevo = $encontrarAnio + 1;
                        $reiniciarMes = $proximoMes = 1;
                        $numeroPeriodo = Ltrim($reiniciarMes,"0");
                        $iniciarPeriodo =  $anioNuevo.'-'.$reiniciarMes.'-1';
                        $finalizarPeriodo = date('Y-m-d',(mktime(0,0,0,$reiniciarMes+1,1,$anioNuevo)-1));
                        $pago = $finalizarPeriodo;
                    }
        }else if($terminoPeriodo->diasPeriodo === 7){
            $difFechas = Carbon::parse($terminoPeriodo->fecha_pago)->diffInDays($terminoPeriodo->fecha_fin);
            $numeroPeriodo = $terminoPeriodo->numero+1;
            $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-'.$encontrarDia;
            $finalizarPeriodo = date("Y-m-d",strtotime($terminoPeriodo->fecha_fin."+ ".$terminoPeriodo->diasPeriodo." days"));
            $pago = date("Y-m-d",strtotime($finalizarPeriodo."+ ".$difFechas." days"));

            $anioInicioPeriodo =  date('Y',strtotime($iniciarPeriodo));
            $anioPagoPeriodo   =  date('Y',strtotime($pago));

            if($anioPagoPeriodo > $anioInicioPeriodo){
                $numeroPeriodo = 1;
            }
        }else if($terminoPeriodo->diasPeriodo === 10){
            $encontrarDia = date('d',strtotime($terminoPeriodo->fecha_fin))+1;

            if($encontrarDia <= 31){

                if($encontrarMes === 4 || $encontrarMes === 6 || $encontrarMes === 9 || $encontrarMes === 11 ){
                    echo "Mes 30 días";
                    $encontrarDia = 1;
                    $siguienteMes =  $encontrarMes+1;
                    $diaPago = date('l',strtotime($terminoPeriodo->fecha_pago));
                    $numeroPeriodo = $terminoPeriodo->numero+1;
                    $iniciarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-'.$encontrarDia;
                    $finalizarPeriodo = date("Y-m-d",strtotime($terminoPeriodo->fecha_fin."+ ".$terminoPeriodo->diasPeriodo." days"));
                    $fechaFormateada = strtotime($finalizarPeriodo);
                    $pago = date('Y-m-d',strtotime('next '.$diaPago,$fechaFormateada));
                    //echo $siguienteMes;
                }else{
                    echo "Mes 31 días";
                    $diaPago = date('l',strtotime($terminoPeriodo->fecha_pago));
                    $numeroPeriodo = $terminoPeriodo->numero+1;
                    $iniciarPeriodo = $encontrarAnio.'-'.$encontrarMes.'-'.$encontrarDia;
                    $finalizarPeriodo = date("Y-m-d",strtotime($terminoPeriodo->fecha_fin."+ ".$terminoPeriodo->diasPeriodo." days"));
                    $fechaFormateada = strtotime($finalizarPeriodo);
                    $pago = date('Y-m-d',strtotime('next '.$diaPago,$fechaFormateada));
                }

                
            }else if ($encontrarDia === 32){
                $encontrarDia = 1;
                $siguienteMes =  $encontrarMes+1;
                $diaPago = date('l',strtotime($terminoPeriodo->fecha_pago));
                $numeroPeriodo = $terminoPeriodo->numero+1;
                $iniciarPeriodo = $encontrarAnio.'-'.$siguienteMes.'-'.$encontrarDia;
                $finalizarPeriodo = date("Y-m-d",strtotime($terminoPeriodo->fecha_fin."+ ".$terminoPeriodo->diasPeriodo." days"));
                $fechaFormateada = strtotime($finalizarPeriodo);
                $pago = date('Y-m-d',strtotime('next '.$diaPago,$fechaFormateada));
            }
           
        }
        
      /* DB::connection('DB_Serverr')->insert('insert into periodos(numero,fecha_inicio,fecha_fin,fecha_pago,diasPeriodo
                                            ,status_periodo,created_at,updated_at)
                                            VALUES(?,?,?,?,?,?,?,?)',[$numeroPeriodo,$iniciarPeriodo
                                            ,$finalizarPeriodo,$pago
                                            ,$terminoPeriodo->diasPeriodo,1
                                            ,$fecha_periodo,$fecha_periodo]);
        return redirect()->route('periodos.index');*/

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

    public function eliminarperiodo($id){
    $clv= Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);
    \Config::set('database.connections.DB_Serverr', $clv_empresa);
    $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('id',$id)->delete();

    return redirect()->route('periodos.acciones');
    }

}
