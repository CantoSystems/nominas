<?php

namespace App\Http\Controllers;

use App\SalarioMinimo;
use Illuminate\Http\Request;

class SalarioMinimoController extends Controller{
    public function acciones(Request $request){
        $accion= $request->acciones;
        $clv=$request->idSalMin;

        switch ($accion) {
            case '':
                $salMin = SalarioMinimo::first();
                $salMins = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMin','salMins'));
                break;
            case 'atras':
                $SalMin2 = SalarioMinimo::where('idSalarioMinimo',$clv)->first();
                $salMin = SalarioMinimo::where('idSalarioMinimo','<',$SalMin2->idSalarioMinimo)
                ->orderBy('idSalarioMinimo','desc')->first();

                if($salMin==""){
                    $salMin = SalarioMinimo::get()->last();
                }
                $SalMins = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMin','SalMins'));
            break;
            case 'siguiente':
                $SalMin2 = SalarioMinimo::where('idSalarioMinimo',$clv)->first();
                $indic = $SalMin2->idSalarioMinimo;

                $salMin = SalarioMinimo::where('idSalarioMinimo','>',$indic)->first();
                if($salMin==""){
                    $salMin = SalarioMinimo::first();
                }
                $SalMins = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMin','SalMins'));
            break;
            case 'primero':
                $salMin = SalarioMinimo::first();
                $SalMins = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMin','SalMins'));
            break;
            case 'ultimo':
                $salMin = SalarioMinimo::get()->last();
                $SalMins = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMin','SalMins'));
            break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('salariomin.acciones');
            break;
            case 'actualizar':
                $this->actualizar($request);
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

    public function actualizar($datos){
        $SalMin = SalarioMinimo::where('idSalarioMinimo',$datos->idSalMin)->first();
        $SalMin->fechaInicio = $datos->fechaInicioSal;
        $SalMin->fechafin = $datos->fechaTerminoSal;
        $SalMin->region = $datos->regionSalario;
        $SalMin->importe = $datos->importeSal;
        $SalMin->save();
    }

    public function show($idSalMin){
        $salMin = SalarioMinimo::where('idSalarioMinimo',$idSalMin)->first();
        $SalMins = SalarioMinimo::all();

        return view('salarios.crudsalarios', compact('salMin','SalMins'));
    }

    public function destroy($idSalMin){
        $aux1 = SalarioMinimo::where('idSalarioMinimo',$idSalMin)->delete();
        return redirect()->route('salariomin.acciones');
    }
}