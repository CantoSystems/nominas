<?php

namespace App\Http\Controllers;

use App\SalarioMinimo;
use Illuminate\Http\Request;

class SalarioMinimoController extends Controller{
    public function acciones(Request $request){
        $accion= $request->acciones;
        //$clv=$request->id_imss;

        switch ($accion) {
            case '':
                $salMin = SalarioMinimo::first();
                $salMins = SalarioMinimo::all();
                return view('salarios.crudsalarios', compact('salMin','salMins'));
                break;
            /*case 'atras':
                $id= IMSS::where('id_imss',$clv)->first();
                $imss= IMSS::where('id_imss','<',$id->id_imss)->orderBy('id_imss','desc')->first();
                if($imss==""){
                    $imss= IMSS::get()->last();
                }
                $imsss=IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;
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
                    $imss= IMSS::first();
                }
                $imsss= IMSS::all();
                return view('imss.imss', compact('imss','imsss'));
            break;*/
            default:
                # code...
            break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalarioMinimo  $salarioMinimo
     * @return \Illuminate\Http\Response
     */
    public function show(SalarioMinimo $salarioMinimo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalarioMinimo  $salarioMinimo
     * @return \Illuminate\Http\Response
     */
    public function edit(SalarioMinimo $salarioMinimo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalarioMinimo  $salarioMinimo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalarioMinimo $salarioMinimo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalarioMinimo  $salarioMinimo
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalarioMinimo $salarioMinimo)
    {
        //
    }
}
