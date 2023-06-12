<?php

namespace App\Http\Controllers;

use App\Infonavit;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class InfonavitController extends Controller{
    public function acciones(Request $request){
        $accion = $request->acciones;
        $clv = $request->idInfonavit;

        switch ($accion) {
            case '':
                $infonavit = DB::table('umiinfonavit')->first();
                $infonavitGral = DB::table('umiinfonavit')->get();

                return view('infonavit.infonavit', compact('infonavit','infonavitGral'));
                break;
            case 'atras':
                $id = DB::table('umiinfonavit')->where('id','=',$clv)->first();
                $infonavit = DB::table('umiinfonavit')->where('id','<',$id->id)->orderBy('id','desc')->first();

                if($infonavit==""){
                    $infonavit = DB::table('umiinfonavit')->get()->last();
                }

                $infonavitGral = DB::table('umiinfonavit')->get();
                return view('infonavit.infonavit', compact('infonavit','infonavitGral'));
                break;
            case 'siguiente':
                $id = DB::table('umiinfonavit')->where('id','=',$clv)->first();
                $indic = $id->id;
                $infonavit = DB::table('umiinfonavit')->where('id','>',$id->id)->first();

                if($infonavit==""){
                    $infonavit = DB::table('umiinfonavit')->get()->first();
                }

                $infonavitGral = DB::table('umiinfonavit')->get();
                return view('infonavit.infonavit', compact('infonavit','infonavitGral'));
                break;
            case 'primero':
                $infonavit = DB::table('umiinfonavit')->first();
                $infonavitGral = DB::table('umiinfonavit')->get();

                return view('infonavit.infonavit', compact('infonavit','infonavitGral'));
                break;
            case 'ultimo':
                $infonavit = DB::table('umiinfonavit')->get()->last();
                $infonavitGral = DB::table('umiinfonavit')->get();

                return view('infonavit.infonavit', compact('infonavit','infonavitGral'));
                break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('infonavit.acciones');
                break;
            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('infonavit.acciones');
                break;
            case 'cancelar':
                return redirect()->route('infonavit.acciones');
                break;
            case 'buscar':
                $infonavit = DB::table('umiinfonavit')->where('anio',$request->busca)->first();

                if($infonavit==""){
                    $infonavit = DB::table('umiinfonavit')->first();
                }

                $infonavitGral = DB::table('umiinfonavit')->get();
                return view('infonavit.infonavit', compact('infonavit','infonavitGral'));
                break;
            default:
            break;
        }
    }

    public function registrar($datos){
        $datos->validate([
            'anioInfonavit' => 'required',
            'vsmInfonavit' => 'required',
            'varUma' => 'required',
            'valorInfonavit' => 'required',
            'varUnidadMixta' => 'required'
        ]);

        DB::table('umiinfonavit')->insert([
            'anio' => $datos->anioInfonavit,
            'vsm' => $datos->vsmInfonavit,
            'varUma' => $datos->varUma,
            'valorInfonavit' => $datos->valorInfonavit,
            'varUnidadMixta' => $datos->varUnidadMixta
        ]);
    }

    public function actualizar($datos){
        $datos->validate([
            'anioInfonavit' => 'required',
            'vsmInfonavit' => 'required',
            'varUma' => 'required',
            'valorInfonavit' => 'required',
            'varUnidadMixta' => 'required'
        ]);

        $infonavitUpdt = DB::table('umiinfonavit')
                            ->where('id','=',$datos->idInfonavit)
                            ->update([
                                'anio' => $datos->anioInfonavit,
                                'vsm' => $datos->vsmInfonavit,
                                'varUma' => $datos->varUma,
                                'valorInfonavit' => $datos->valorInfonavit,
                                'varUnidadMixta' => $datos->varUnidadMixta
                            ]);
    }

    public function delete($id){
        DB::table('umiinfonavit')->where('id','=',$id)->delete();
        return redirect()->route('infonavit.acciones');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Infonavit  $infonavit
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $infonavit = DB::table('umiinfonavit')->where('id','=',$id)->first();
        $infonavitGral = DB::table('umiinfonavit')->get();
        return view('infonavit.infonavit', compact('infonavit','infonavitGral'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Infonavit  $infonavit
     * @return \Illuminate\Http\Response
     */
    public function edit(Infonavit $infonavit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Infonavit  $infonavit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Infonavit $infonavit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Infonavit  $infonavit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Infonavit $infonavit)
    {
        //
    }
}