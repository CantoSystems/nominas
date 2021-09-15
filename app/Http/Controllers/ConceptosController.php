<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class ConceptosController extends Controller{
    public function index(Request $request){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $accion= $request->acciones;
        $indic=$request->identificador;

        switch ($accion) {
            case '':
                $aux = DB::connection('DB_Serverr')->table('conceptos')->first();
                $conceptosAll =  DB::connection('DB_Serverr')->table('conceptos')->get();
                return view('conceptos.conceptos',compact('aux','conceptosAll'));
            break;
            case 'atras':
                $id=DB::connection('DB_Serverr')->table('conceptos')->
                where('clave_concepto',$request->clave_concepto)->first();
                $aux=DB::connection('DB_Serverr')->table('conceptos')->where('id','<',$id->id)
                ->orderBy('id','desc')
                ->first();
                if(is_null($aux)){
                    $aux=DB::connection('DB_Serverr')->table('conceptos')->get()->last();
                }
                $conceptosAll =  DB::connection('DB_Serverr')->table('conceptos')->get();
                return view('conceptos.conceptos',compact('aux','conceptosAll'));
            break;
            case 'siguiente':
                $id=DB::connection('DB_Serverr')->table('conceptos')->
                where('clave_concepto',$request->clave_concepto)->first();
                $aux=DB::connection('DB_Serverr')->table('conceptos')->where('id','>',$id->id)
                ->orderBy('id','asc')
                ->first();
                if(is_null($aux)){
                    $aux=DB::connection('DB_Serverr')->table('conceptos')->first();
                }
                $conceptosAll =  DB::connection('DB_Serverr')->table('conceptos')->get();
                return view('conceptos.conceptos',compact('aux','conceptosAll'));
            break;
            case 'primero':
                $aux = DB::connection('DB_Serverr')->table('conceptos')->first();
                $conceptosAll =  DB::connection('DB_Serverr')->table('conceptos')->get();
                return view('conceptos.conceptos',compact('aux','conceptosAll'));
            break;
            case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('conceptos')->get()->last();
                $conceptosAll =  DB::connection('DB_Serverr')->table('conceptos')->get();
                return view('conceptos.conceptos',compact('aux','conceptosAll'));
            break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('conceptos.index');
            break;
            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('conceptos.index');
            break;
            case 'cancelar':
                return redirect()->route('conceptos.index');
            break;
            default:
            break;
        }
    }

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

    public function registrar($datos){
        $clv=Session::get('clave_empresa');
        $clave_concepto= $datos->clave_concepto.$datos->naturaleza;
        
        if($datos->isr=="on"){
            $isr=1;
        }else{
            $isr=0;
        }

        if($datos->imss=="on"){
            $imss=1;
        }else{
            $imss=0;
        }

        if($datos->infonavit=="on"){
            $infonavit=1;
        }else{
            $infonavit=0;
        }

        if($datos->estatal=="on"){
            $estatal=1;
        }else{
            $estatal=0;
        }

        if($datos->isr_uma == ""){
            $isr_uma = 0.00;
        }else{
            $isr_uma = $datos->isr_uma;
        }

        if($datos->isr_porcentaje == ""){
            $isr_porcentaje = 0.00;
        }else{
            $isr_porcentaje = $datos->isr_porcentaje;
        }

        if($datos->imss_uma == ""){
            $imss_uma = 0.00;
        }else{
            $imss_uma = $datos->imss_uma;
        }

        if($datos->imss_porcentaje == ""){
            $imss_porcentaje = 0.00;
        }else{
            $imss_porcentaje = $datos->imss_porcentaje;
        }


        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $datos->validate([
              'clave_concepto' => 'required',
              'concepto' => 'required',
              'naturaleza' => 'required',
              'manejo' => 'required',
        ]);

        $coincidencia = DB::connection('DB_Serverr')->table('conceptos')
        ->where('clave_concepto','=',$datos->clave_concepto)
        ->orWhere('concepto','=',$datos->concepto)
        ->get();

        if($coincidencia->count() == 0){
            $fecha_periodo = now()->toDateString();
            DB::connection('DB_Serverr')->insert('insert into conceptos (clave_concepto
                                                                        ,concepto
                                                                        ,formula
                                                                        ,naturaleza
                                                                        ,manejo
                                                                        ,cantidad
                                                                        ,importe
                                                                        ,monto
                                                                        ,isr
                                                                        ,imss
                                                                        ,infonavit,
                                                                        estatal,
                                                                        isr_uma,
                                                                        isr_porcentaje,
                                                                        imss_uma,
                                                                        imss_porcentaje,
                                                                        seleccionado,
                                                                        created_at,
                                                                        updated_at)
                                                                    values (?
                                                                        ,?
                                                                        ,?
                                                                        ,?
                                                                        ,?
                                                                        ,?
                                                                        ,?
                                                                        ,?
                                                                        ,?
                                                                        ,?
                                                                        ,?
                                                                        ,?,?,?,?,?,?,?,?)',[$clave_concepto,$datos->concepto,$datos->formula,$datos->naturaleza
            ,$datos->manejo,$datos->cantidad,$datos->importe,$datos->monto,$isr,$imss,$infonavit,$estatal,
            $isr_uma,
            $isr_porcentaje,
            $imss_uma,
            $imss_porcentaje,0,
            $fecha_periodo,$fecha_periodo]);
        }else{
            return back()->with('msj','Registro duplicado');
        }
    }

    public function actualizar($datos){
        $clv=Session::get('clave_empresa');
        //$clave_concepto= $datos->clave_concepto.$datos->naturaleza;

        if($datos->isr=="on"){
            $isr=1;
        }else{
            $isr=0;
        }

        if($datos->imss=="on"){
            $imss=1;
        }else{
            $imss=0;
        }

        if($datos->infonavit=="on"){
            $infonavit=1;
        }else{
            $infonavit=0;
        }

        if($datos->estatal=="on"){
            $estatal=1;
        }else{
            $estatal=0;
        }

         if($datos->isr_uma == ""){
            $isr_uma = 0.00;
        }else{
            $isr_uma = $datos->isr_uma;
        }

        if($datos->isr_porcentaje == ""){
            $isr_porcentaje = 0.00;
        }else{
            $isr_porcentaje = $datos->isr_porcentaje;
        }

        if($datos->imss_uma == ""){
            $imss_uma = 0.00;
        }else{
            $imss_uma = $datos->imss_uma;
        }

        if($datos->imss_porcentaje == ""){
            $imss_porcentaje = 0.00;
        }else{
            $imss_porcentaje = $datos->imss_porcentaje;
        }

        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('id',$datos->id)->first();
        $datos->validate([
              'clave_concepto' => 'required',
              'concepto' => 'required',
              'naturaleza' => 'required',
              'manejo' => 'required',
        ]);

          $fecha_periodo = now()->toDateString();
        if($aux1!==""){
            DB::connection('DB_Serverr')->table('conceptos')->where('id',$datos->id)
            ->update(['concepto'=>$datos->concepto
                     ,'formula'=>$datos->formula
                     ,'naturaleza'=>$datos->naturaleza
                     ,'manejo'=>$datos->manejo
                     ,'cantidad'=>$datos->cantidad
                     ,'importe'=>$datos->importe
                     ,'monto'=>$datos->monto
                     ,'isr'=>$isr
                     ,'imss'=>$imss
                     ,'infonavit'=>$infonavit
                     ,'estatal'=>$estatal,
                     'isr_uma'=>$isr_uma,
                     'isr_porcentaje'=>$isr_porcentaje,
                     'imss_uma'=>$imss_uma,
                     'imss_porcentaje'=>$imss_porcentaje,
                     'updated_at'=>$fecha_periodo
                    ]);
        }
    }

    public function show($id){
        $clv=Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux = DB::connection('DB_Serverr')->table('conceptos')
                ->where('id','=',$id)
                ->first();
        $conceptosAll =  DB::connection('DB_Serverr')->table('conceptos')->get();
        return view('conceptos.conceptos',compact('aux','conceptosAll'));
    }

    public function eliminaconcepto($id){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('id',$id)->delete();
        return redirect()->route('conceptos.index');
    }
}