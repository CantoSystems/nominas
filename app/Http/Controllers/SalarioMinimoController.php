<?php

namespace App\Http\Controllers;

use App\SalarioMinimo;
use Illuminate\Http\Request;

class SalarioMinimoController extends Controller{
    public function acciones(Request $request){
        $accion= $request->acciones;
        $indicador=$request->idsalMinimo;

        switch ($accion) {
            case '':
                $salMinimo = SalarioMinimo::first();
                $SalarioMin = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMinimo','SalarioMin'));
                break;
            case 'atras':
                $salMinimo = SalarioMinimo::where('idSalarioMinimo','<',$indicador)
                ->orderBy('idSalarioMinimo','desc')->first();

                if(is_null($salMinimo)){
                    $salMinimo = SalarioMinimo::get()->last();
                }
                $SalarioMin = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMinimo','SalarioMin'));
            break;
            case 'siguiente':
                $salMinimo = SalarioMinimo::where('idSalarioMinimo','>',$indicador)->first();
                if(is_null($salMinimo)){
                    $salMinimo = SalarioMinimo::first();
                }
                $SalarioMin = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMinimo','SalarioMin'));
            break;      
            case 'primero':
                $salMinimo = SalarioMinimo::first();
                $SalarioMin = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMinimo','SalarioMin'));
            break;
            case 'ultimo':
                $salMinimo = SalarioMinimo::get()->last();
                $SalarioMin = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMinimo','SalarioMin'));
            break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('salariomin.acciones');
            break;
            case 'actualizar':
                $this->update($request);
                return redirect()->route('salariomin.acciones');
            break;
            case 'cancelar':
                return redirect()->route('salariomin.acciones');
            break;
            default:
                # code...
            break;
        }
    }

    public function registrar($datos){
        $SalMin = new SalarioMinimo;
        $SalMin->fechaInicio = $datos->fechaInicioSal;
        $SalMin->fechafin = $datos->fechaTerminoSal;
        $SalMin->region = $datos->regionSalario;
        $SalMin->importe = $datos->importeSal;
        $SalMin->save();
    }

    public function update($datos){
        $SalMin = SalarioMinimo::where('idSalarioMinimo',$datos->idSalMin)->first();
        $SalMin->fechaInicio = $datos->fechaInicioSal;
        $SalMin->fechafin = $datos->fechaTerminoSal;
        $SalMin->region = $datos->regionSalario;
        $SalMin->importe = $datos->importeSal;
        $SalMin->save();
    }

    public function show($idSalMin){
        $salMinimo  = SalarioMinimo::where('idSalarioMinimo',$idSalMin)->first();
        $SalarioMin = SalarioMinimo::all();
        return view('salarios.crudsalarios', compact('salMinimo','SalarioMin'));
    }

    public function destroy($idSalMin){
        $aux1 = SalarioMinimo::where('idSalarioMinimo',$idSalMin)->delete();
        return redirect()->route('salariomin.acciones');
    }
}