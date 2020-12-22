<?php

namespace App\Http\Controllers;

use App\Retenciones;
use Illuminate\Http\Request;

class RetencionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('retenciones.crudretenciones');
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
     * @param  \App\Retenciones  $retenciones
     * @return \Illuminate\Http\Response
     */
    public function show(Retenciones $retenciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Retenciones  $retenciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Retenciones $retenciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Retenciones  $retenciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retenciones $retenciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Retenciones  $retenciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retenciones $retenciones)
    {
        //
    }
}
