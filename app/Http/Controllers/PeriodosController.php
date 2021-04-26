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

        $periodos=DB::connection('DB_Serverr')->table('periodos')->get();
        $cant=DB::connection('DB_Serverr')->table('periodos')->count();
        return view('periodos.periodos',compact('periodos','cant'));
    }

    public function agregarperiodos($datos){


    /*
    if ($datos->fecha_inicio === null || $datos->fecha_fin === null || $datos->fecha_pago === null){
        return redirect()->route('periodos.index');
    }*/

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
            $fecha_periodo = now()->toDateString();
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
    //dd($datos);

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

    public function eliminarperiodo($id){
    $clv= Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);


    \Config::set('database.connections.DB_Serverr', $clv_empresa);


    $aux1 = DB::connection('DB_Serverr')->table('periodos')->where('id',$id)->delete();

    return redirect()->route('periodos.acciones');
    }

}
