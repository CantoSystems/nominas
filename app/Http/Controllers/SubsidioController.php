<?php

namespace App\Http\Controllers;

use App\Subsidio;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class SubsidioController extends Controller{
    public function acciones(Request $request){
        $accion = $request->acciones;
        $clv = $request->id_subsidio;

        switch ($accion) {
            case '':
                $subsidio = Subsidio::first();
                $subsidios = Subsidio::all();

                return view('subsidio.subsidio', compact('subsidio','subsidios'));
                break;
            case 'atras':
                $id = Subsidio::where('id_subsidio',$clv)->first();
                $subsidio = Subsidio::where('id_subsidio','<',$id->id_subsidio)->orderBy('id_subsidio','desc')->first();

                if($subsidio == ""){
                    $subsidio = Subsidio::get()->last();
                }

                $subsidios = Subsidio::all();
                return view('subsidio.subsidio', compact('subsidio','subsidios'));
            break;
            case 'siguiente':
                $sub = Subsidio::where('id_subsidio',$clv)->first();
                $indic = $sub->id_subsidio;
                $subsidio = Subsidio::where('id_subsidio','>',$indic)->first();

                if($subsidio ==""){
                    $subsidio = Subsidio::first();
                }

                $subsidios = Subsidio::all();
                return view('subsidio.subsidio', compact('subsidio','subsidios'));
            break;
            case 'primero':
                $subsidio = Subsidio::first();
                $subsidios = Subsidio::all();
                return view('subsidio.subsidio', compact('subsidio','subsidios'));
            break;
            case 'ultimo':
                $subsidio = Subsidio::get()->last();
                $subsidios = Subsidio::all();
                return view('subsidio.subsidio', compact('subsidio','subsidios'));
            break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('subsidio.acciones');
            break;
            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('subsidio.acciones');
            break;
            case 'cancelar':
                return redirect()->route('subsidio.acciones');
                break;
            case 'buscar':
                $criterio = $request->opcion;
                if($criterio == 'de'){
                    $subsidio = Subsidio::where('hastaIngresos','=',$request->busca)->first();

                    if($subsidio == ""){
                        return back()->with('busqueda','Coincidencia no encontrada');
                    }
                    $subsidios = Subsidio::all();
                    return view('subsidio.subsidio', compact('subsidio','subsidios'));

                }else if ($criterio == 'hasta'){
                    $subsidio = Subsidio::where('ParaIngresos','=',$request->busca)->first();

                    if($subsidio == ""){
                        return back()->with('busqueda','Coincidencia no encontrada');
                    }

                    $subsidios = Subsidio::all();
                    return view('subsidio.subsidio', compact('subsidio','subsidios'));
                }
            break;
            default:
            break;
        }
    }

    public function registrar($datos){
        $datos->validate([
            'hastaIngresos' => 'required',
            'ParaIngresos' => 'required',
            'cantidadSubsidio' => 'required',
            'periodo_subsidio' => 'required'
        ]);

        $coincidencia = Subsidio::where([
            ['ParaIngresos','=',$datos->ParaIngresos],
            ['hastaIngresos','=',$datos->hastaIngresos],
        ])->get();

        if($coincidencia->count() === 0){
            $sub = new Subsidio;
            $sub->hastaIngresos = $datos->hastaIngresos;
            $sub->ParaIngresos = $datos->ParaIngresos;
            $sub->cantidadSubsidio = $datos->cantidadSubsidio;
            $sub->periodo_subsidio = $datos->periodo_subsidio;
            $sub->save();
        }else{
            return back()->with('msj','Registro duplicado');
        }
    }

    public function actualizar($datos){
        $sub = Subsidio::where('id_subsidio',$datos->id_subsidio)->first();
        $sub->hastaIngresos = $datos->hastaIngresos;
        $sub->ParaIngresos = $datos->hastaIngresos;
        $sub->cantidadSubsidio = $datos->cantidadSubsidio;
        $sub->periodo_subsidio = $datos->periodo_subsidio;
        $sub->save();
    }
    
    public function show($id_subsidio){
        $subsidio = Subsidio::where('id_subsidio','=',$id_subsidio)->first();
        $subsidios = Subsidio::all();
        return view('subsidio.subsidio', compact('subsidio','subsidios'));
    }

    public function eliminarsubsidio($id_subsidio){
        $sub = Subsidio::find($id_subsidio);
        $sub->delete();
        return redirect()->route('subsidio.acciones');
    }
}