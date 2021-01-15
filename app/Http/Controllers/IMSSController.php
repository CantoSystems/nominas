<?php

namespace App\Http\Controllers;

use App\IMSS;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class IMSSController extends Controller{
    public function acciones(Request $request){
        $accion= $request->acciones;
        $clv=$request->id_imss;

        switch ($accion) {
            case '':
                $imss = IMSS::first();
                $imsss = IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
                break;
            /*case 'atras':
                $id= IMSS::where("id_imss",$clv)->first();
                $imss= IMSS::where('id_imss','<',$id->id)
                ->orderBy('id_imss','desc')
                ->first();
                if(is_null($imss)){
                    $imss= IMSS::get()->last();
                }
                $imsss=IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;*/
            case 'siguiente':
                $ims = IMSS::where('id_imss',$clv)->first();
                $indic= $ims->id_imss;
                $imss = IMSS::where('id_imss','>',$indic)->first();
                if($imss==""){
                    $imss = IMSS::first();
                }
                $imsss = IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;
            case 'primero':
                $imss = IMSS::first();
                $imsss =IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;
            case 'ultimo':
                $imss= IMSS::get()->last();
                $imsss=IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('imss.acciones');
            break;
            /*case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('imss.acciones');
            break;*/
            case 'cancelar':
                return redirect()->route('imss.acciones');
                break;
            /*case 'buscar':
                $banco = Banco::where('nombre_banco',$request->busca)->first();
                if($banco==""){
                    $banco= Banco::first();
                }
                $bancos= Banco::all();
                return view('bancos.bancos',compact('banco','bancos'));
            break;*/
            default:
                # code...
            break;
        }
    }

    public function registrar($datos){
        /*$datos->validate([
            'clave_banco' => 'required|unique:bancos',
            'nombre_banco' => 'required|unique:bancos',
        ]);*/

        $imss= new IMSS;
        $imss->concepto = $datos->seguroIMSS;
        $imss->prestaciones = $datos->prestacionIMSS;
        $imss->cuotapatron1 = $datos->cuotapatron;
        if($datos->cuotapatron2!=""){
            $imss->cuotapatron2 = $datos->cuotapatron2;
        }
        $imss->cuotatrabajador = $datos->cuotatrabajador;
        $imss->cuotatotal = $datos->cuotatotal;
        $imss->base = $datos->basesalarial;
        $imss->save();
    }

    public function actualizar($datos){
        /*$datos->validate([
              'clave_banco' => 'required',
              'nombre_banco' => 'required',
            ]);*/
        $idimss= IMSS::where('id_imss',$datos->id_imss)->first();
        $idimss->concepto = $datos->seguroIMSS;
        $idimss->prestaciones = $datos->prestacionIMSS;
        $idimss->cuotapatron1 = $datos->cuotapatron;
        if($datos->cuotapatron2!=""){
            $idimss->cuotapatron2 = $datos->cuotapatron2;
        }
        $idimss->cuotatrabajador = $datos->cuotatrabajador;
        $idimss->cuotatotal = $datos->cuotatotal;
        $idimss->base = $datos->basesalarial;
        $idimss->save();
    }

    public function eliminarimss($id_imss){
        $idimss = IMSS::find($id_imss);
        $idimss->delete();
        return redirect()->route('imss.acciones');
    }
}