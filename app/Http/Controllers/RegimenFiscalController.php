<?php

namespace App\Http\Controllers;

use App\RegimenFiscal;
use Illuminate\Http\Request;

class RegimenFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('regimen.regimen');
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
        if (empty($request->all())) {
            return response()->json(["error" => "Sin data"]);
        }

        foreach ($request->only('info') as $value) {
            $data = json_decode($value,true);  
          
            $regimen = new RegimenFiscal;
            $regimen->claveRegimen = $data["clave"];
            $regimen->descripcionRegimen = $data["descripcion"];
            $regimen->save();    
        }
        //return redirect()->route('regimen.index');

        $datoFiscal = RegimenFiscal::first();
        return $datoFiscal;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegimenFiscal  $regimenFiscal
     * @return \Illuminate\Http\Response
     */
    public function show(RegimenFiscal $regimenFiscal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegimenFiscal  $regimenFiscal
     * @return \Illuminate\Http\Response
     */
    public function edit(RegimenFiscal $regimenFiscal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegimenFiscal  $regimenFiscal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegimenFiscal $regimenFiscal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegimenFiscal  $regimenFiscal
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegimenFiscal $regimenFiscal)
    {
        //
    }
}
