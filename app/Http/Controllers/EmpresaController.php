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
    public function index()
    {
    //$accion, $clave
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
        case 'registrar':
        $this->registrar($request);
        $empresa= Empresa::first();
        return view('empresas.crudempresas', compact('empresa'));
        break;
        case 'actualizar':
            $this->actualizar($request);
            $empresa= Empresa::first();
            return view('empresas.crudempresas', compact('empresa'));
        break;
        default:
            # code...
            break;
    }
    }

     public function actualizar($datos){ 
        $emp= Empresa::where('clave',$datos->clave)->first();
        $emp->nombre= $datos->nombre;
        $emp->rfc= $datos->rfc;
        $emp->segurosocial= $datos->segurosocial;
        $emp->registro_estatal= $datos->registro_estatal;
        $emp->calle=$datos->calle;
        $emp->num_interno=$datos->num_interno;
        $emp->num_externo=$datos->num_externo;
        $emp->colonia=$datos->colonia;
        $emp->municipio=$datos->municipio;
        $emp->ciudad=$datos->ciudad;
        $emp->pais=$datos->pais;
        $emp->representante_legal=$datos->representante_legal;
        $emp->rfc_representante= $datos->rfc_representante;
        $emp->telefono= $datos->telefono;
        $emp->email= $datos->email;
        $emp ->save();
     }
     public function registrar($datos){
     $empresa= new Empresa;
     $empresa->clave= $datos->clave;
     $empresa->nombre= $datos->nombre;
     $empresa->rfc= $datos->rfc;
     $empresa->segurosocial= $datos->segurosocial;
     $empresa->registro_estatal= $datos->registro_estatal;
     $empresa->calle=$datos->calle;
     $empresa->num_interno=$datos->num_interno;
     $empresa->num_externo=$datos->num_externo;
     $empresa->colonia=$datos->colonia;
     $empresa->municipio=$datos->municipio;
     $empresa->ciudad=$datos->ciudad;
     $empresa->pais=$datos->pais;
     $empresa->representante_legal=$datos->representante_legal;
     $empresa->rfc_representante= $datos->rfc_representante;
     $empresa->telefono= $datos->telefono;
     $empresa->email= $datos->email;
     $empresa->save();
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
