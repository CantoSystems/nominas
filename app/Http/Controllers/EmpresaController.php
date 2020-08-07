<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($accion, $clave)
    {
   
    }
    public function acciones(Request $request){
     $accion= $request->acciones;
     $clv=$request->clave;
    switch ($accion) {
        case '':
            $empresa= Empresa::first();
            return view('empresas.crudempresas', compact('empresa'));
            break;
        case 'atras':
             $emp= Empresa::where('clave',$clv)->first();
             $indic= $emp->id;
             $empresa= Empresa::where('id','<',$indic)->first();
             if($empresa==""){
                $empresa= Empresa::get()->last();  
             }
             return view('empresas.crudempresas', compact('empresa'));
        break;
        case 'siguiente':
            $emp= Empresa::where('clave',$clv)->first();
            $indic= $emp->id;
            $empresa= Empresa::where('id','>',$indic)->first();
            if($empresa==""){
               $empresa= Empresa::first();  
            }
            return view('empresas.crudempresas', compact('empresa'));
        break;
        case 'primero':
            $empresa= Empresa::first();
            return view('empresas.crudempresas', compact('empresa'));
        break;
        case 'ultimo':
            $empresa= Empresa::get()->last(); 
            return view('empresas.crudempresas', compact('empresa')); 
        break;
        
        default:
            # code...
            break;
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
