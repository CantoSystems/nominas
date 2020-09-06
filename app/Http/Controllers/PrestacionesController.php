<?php

namespace App\Http\Controllers;

use App\Prestaciones;
use Illuminate\Http\Request;

class PrestacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accion= $request->acciones;
        $clv= $request->anio;
        switch ($accion) {

            case '':
                $aux = Prestaciones::first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            case 'atras':
                $aux1= Prestaciones::where('anio',$clv)->get()->last();
                $indic= $aux1->id;
                $aux= Prestaciones::where('id','<',$indic)->latest('id')->first();
                 if($aux==""){
                    $aux= Prestaciones::get()->last();  
                 }
                 $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                
                break;

            case 'siguiente':
                $aux1= Prestaciones::where('anio',$clv)->get()->last();
                $indic= $aux1->id;
                $aux= Prestaciones::where('id','>',$indic)->first();
                 if($aux==""){
                    $aux= Prestaciones::get()->first();  
                 }
                 $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                
                break;

            case 'primero':
                $aux = Prestaciones::first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            case 'ultimo':
                $aux = Prestaciones::latest('id')->first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            
            default:
                # code...
                break;
        }
        return view('prestaciones.prestaciones');
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
     * @param  \App\Prestaciones  $prestaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Prestaciones $prestaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestaciones  $prestaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestaciones $prestaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestaciones  $prestaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestaciones $prestaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestaciones  $prestaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestaciones $prestaciones)
    {
        //
    }
}
