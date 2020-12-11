<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

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
                return view('conceptos.conceptos',compact('aux'));
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
                return view('conceptos.conceptos', compact('aux'));
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
                return view('conceptos.conceptos', compact('aux'));
            break;
            case 'primero':
                $aux = DB::connection('DB_Serverr')->table('conceptos')->first();
                return view('conceptos.conceptos',compact('aux'));
            break;
            case 'ultimo':
                $aux = DB::connection('DB_Serverr')->table('conceptos')->get()->last();
                return view('conceptos.conceptos',compact('aux'));
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
            case 'buscar':
                $aux = DB::connection('DB_Serverr')->table('conceptos')->where('concepto',$request->busca)->first();
                $aux1 = DB::connection('DB_Serverr')->table('conceptos')->get();
                return view('conceptos.conceptos',compact('aux','aux1'));
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

        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        DB::connection('DB_Serverr')->insert('insert into conceptos (clave_concepto
                                                                    ,concepto
                                                                    ,formula
                                                                    ,naturaleza
                                                                    ,manejo
                                                                    ,cantidad
                                                                    ,importe
                                                                    ,monto
                                                                    ,ispt
                                                                    ,imss
                                                                    ,infonavit
                                                                    ,estatal)
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
                                                                       ,?)',[$clave_concepto,$datos->concepto,$datos->formula,$datos->naturaleza
        ,$datos->manejo,$datos->cantidad,$datos->importe,$datos->monto,$isr,$imss,$infonavit,$estatal]);
    }

    public function actualizar($datos){
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

        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);
        $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('id',$datos->id)->first();
        if($aux1!==""){
            DB::connection('DB_Serverr')->table('conceptos')->where('id',$datos->id)
            ->update(['clave_concepto'=>$clave_concepto
                     ,'concepto'=>$datos->concepto
                     ,'formula'=>$datos->formula
                     ,'naturaleza'=>$datos->naturaleza
                     ,'manejo'=>$datos->manejo
                     ,'cantidad'=>$datos->cantidad
                     ,'importe'=>$datos->importe
                     ,'monto'=>$datos->monto
                     ,'ispt'=>$isr
                     ,'imss'=>$imss
                     ,'infonavit'=>$infonavit
                     ,'estatal'=>$estatal]);
        }
    }

    public function eliminaconcepto($id){
        $clv= Session::get('clave_empresa');
        $clv_empresa=$this->conectar($clv);

        \Config::set('database.connections.DB_Serverr', $clv_empresa);

        $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('id',$id)->delete();
        return redirect()->route('conceptos.index');
    }
}