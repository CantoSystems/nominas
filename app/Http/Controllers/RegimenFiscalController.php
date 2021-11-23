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
    public function index(Request $request)
    {
        $accion = $request->acciones;
        $identificador = $request->id;

        switch($accion){
            case '':
                $datosRegimen = RegimenFiscal::all();
                $regimenFiscal = RegimenFiscal::first();
                return view('regimen.regimen',compact('datosRegimen','regimenFiscal'));
                break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('regimen.index');
                break;
            case 'cancelar':
                return redirect()->route('regimen.index');
                break;
            case 'primero':
                return redirect()->route('regimen.index');
                break;
            case 'ultimo':
                $datosRegimen = RegimenFiscal::all();
                $regimenFiscal = RegimenFiscal::get()->last();
                return view('regimen.regimen',compact('datosRegimen','regimenFiscal'));
                break;
            case 'atras':
               
                $datosRegimen = RegimenFiscal::all();
                $regimenFiscal = RegimenFiscal::where('id','<',$identificador)
                    ->orderBy('id','desc')
                    ->first();

                    if(is_null($regimenFiscal)){
                        $regimenFiscal = RegimenFiscal::get()->last();
                    }

                return view('regimen.regimen',compact('datosRegimen','regimenFiscal'));
                break;
            
            case 'siguiente':
                $datosRegimen = RegimenFiscal::all();
                $regimenFiscal = RegimenFiscal::where('id','>',$identificador)
                    ->first();

                    if(is_null($regimenFiscal)){
                        $regimenFiscal = RegimenFiscal::first();
                    }

                return view('regimen.regimen',compact('datosRegimen','regimenFiscal'));
                break;
            
                case 'actualizar':
                    $this->update($request);
                    return redirect()->route('regimen.index');
                    break;

            


        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function registrar($datos){

        $datos->validate([
            'claveRegimen' => 'required|unique:regimen_fiscals',
            'descripcionRegimen' => 'required|unique:regimen_fiscals',
        ]);

        $regimen = new RegimenFiscal;
        $regimen->claveRegimen = $datos->claveRegimen;
        $regimen->descripcionRegimen = $datos->descripcionRegimen;
        $regimen->save(); 
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
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
    }*/

    /**
     * Display the specified resource.
     *
     * @param  \App\RegimenFiscal  $regimenFiscal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datosRegimen = RegimenFiscal::all();
        $regimenFiscal = RegimenFiscal::find($id);
        return view('regimen.regimen',compact('datosRegimen','regimenFiscal'));
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
    public function update($datos)
    {
        $datos->validate([
            'claveRegimen' => 'required',
            'descripcionRegimen' => 'required',
        ]);

        $regimen = RegimenFiscal::where('id',$datos->id)->first();
        $regimen->descripcionRegimen = $datos->descripcionRegimen;
        $regimen->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegimenFiscal  $regimenFiscal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = RegimenFiscal::find($id);
        $reg->delete();
        return redirect()->route('regimen.index');
    }
}
