<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegimenFiscal;
class FiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accion = $request->acciones;
        $clv    = $request->id;
        switch($accion ){
            case '':
                $regimen = RegimenFiscal::first();
                $regimenes = RegimenFiscal::all();
                return view('fiscal.crudfiscal',compact('regimen','regimenes'));
                break;
            case 'atras':
                $regimen = RegimenFiscal::where('id',$clv)
                            ->orderBy('id','desc')->first();
                    if(is_null($regimen)){
                        $regimen = RegimenFiscal::get()->last();
                    }
                    $regimenes = RegimenFiscal::all();
                    return view('fiscal.crudfiscal',compact('regimen','regimenes'));
                break;
            case 'siguiente':
                $regimen = RegimenFiscal::where('id','>',$clv)->first();
                    if(is_null($regimen)){
                        $regimen = RegimenFiscal::first();
                    }
                    $regimenes = RegimenFiscal::all();
                    return view('fiscal.crudfiscal',compact('regimen','regimenes'));
                break;
            case 'primero':
                $regimen = RegimenFiscal::first();
                $regimenes = RegimenFiscal::all();
                return view('fiscal.crudfiscal',compact('regimen','regimenes'));
                break;
            case 'ultimo':
                $regimen = RegimenFiscal::get()->last();
                $regimenes = RegimenFiscal::all();
                return view('fiscal.crudfiscal',compact('regimen','regimenes'));
                break;
            case 'registrar':
                $this->store($request);
                return redirect()->route('fiscal');
                break;
            case 'actualizar':
                $this->update($request);
                return redirect()->route('fiscal');
                break;
            case 'cancelar':
                return redirect()->route('fiscal');
                break;
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $regimen = RegimenFiscal::find($id);
        $regimenes = RegimenFiscal::all();
        return view('fiscal.crudfiscal',compact('regimen','regimenes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        $data->validate([
            'claveRegimen' => 'required|unique:regimen_fiscals',
            'descripcionRegimen' => 'required',
        ]);

        $rFiscal =  new RegimenFiscal;
        $rFiscal->claveRegimen = $data->claveRegimen;
        $rFiscal->descripcionRegimen = $data->descripcionRegimen;
        $rFiscal->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regimen = RegimenFiscal::find($id);
        $regimenes = RegimenFiscal::all();
        return view('fiscal.crudfiscal',compact('regimen','regimenes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data)
    {
        $data->validate([
            'claveRegimen' => 'required',
            'descripcionRegimen' => 'required',
        ]);

        $rFiscal = RegimenFiscal::where('id',$data->id)->first();
        $rFiscal->claveRegimen = $data->claveRegimen;
        $rFiscal->descripcionRegimen = $data->descripcionRegimen;
        $rFiscal->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eliminarRegimen = RegimenFiscal::find($id)->delete();
        return redirect()->route('fiscal');
    }
}
