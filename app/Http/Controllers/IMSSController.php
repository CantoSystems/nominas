<?php

namespace App\Http\Controllers;

use App\IMSS;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class IMSSController extends Controller{
    public function acciones(Request $request){
        $accion = $request->acciones;
        $clv = $request->id_imss;

        switch ($accion) {
            case '':
                $imss = IMSS::first();
                $imsss = IMSS::all();

                return view('imss.imss', compact('imss','imsss'));
                break;
            case 'atras':
                $id = IMSS::where('id_imss',$clv)->first();
                $imss = IMSS::where('id_imss','<',$id->id_imss)->orderBy('id_imss','desc')->first();

                if($imss==""){
                    $imss = IMSS::get()->last();
                }

                $imsss = IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;
            case 'siguiente':
                $ims = IMSS::where('id_imss',$clv)->first();
                $indic = $ims->id_imss;
                $imss = IMSS::where('id_imss','>',$indic)->first();

                if($imss==""){
                    $imss = IMSS::first();
                }

                $imsss = IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;
            case 'primero':
                $imss = IMSS::first();
                $imsss = IMSS::all();

                return view('imss.imss', compact('imss','imsss'));
            break;
            case 'ultimo':
                $imss = IMSS::get()->last();
                $imsss = IMSS::all();

                return view('imss.imss', compact('imss','imsss'));
            break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('imss.acciones');
            break;
            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('imss.acciones');
            break;
            case 'cancelar':
                return redirect()->route('imss.acciones');
                break;
            case 'buscar':
                $imss = IMSS::where('concepto',$request->busca)->first();
                if($imss==""){
                    $imss = IMSS::first();
                }
                $imsss = IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;
            default:
            break;
        }
    }

    public function registrar($datos){
        $totalcuotas =  $datos->cuotapatron + $datos->cuotatrabajador;
        $imss = new IMSS;
        $imss->concepto = $datos->seguroIMSS;
        $imss->prestaciones = $datos->prestacionIMSS;
        $imss->cuotapatron = $datos->cuotapatron;
        $imss->cuotatrabajador = $datos->cuotatrabajador;
        $imss->claveImss = $datos->claveImss;
        $imss->cuotatotal = $totalcuotas;
        $imss->base = $datos->basesalarial;
        $imss->save();
    }

    public function actualizar($datos){
        $totalcuotas =  $datos->cuotapatron + $datos->cuotatrabajador;
        $imss = IMSS::where('id_imss',$datos->id_imss)->first();
        $imss->concepto = $datos->seguroIMSS;
        $imss->prestaciones = $datos->prestacionIMSS;
        $imss->cuotapatron = $datos->cuotapatron;     
        $imss->cuotatrabajador = $datos->cuotatrabajador;
        $imss->cuotatotal = $totalcuotas;
        $imss->base = $datos->basesalarial;
        $imss->save();
    }
    public function show($id_imss){
        $imss = IMSS::where('id_imss','=',$id_imss)->first();
        $imsss = IMSS::all();
        return view('imss.imss', compact('imss','imsss'));
    }

    public function eliminarimss($id_imss){
        $idimss = IMSS::find($id_imss);
        $idimss->delete();
        return redirect()->route('imss.acciones');
    }
}