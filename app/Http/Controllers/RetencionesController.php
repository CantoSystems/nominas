<?php

namespace App\Http\Controllers;

use App\Retenciones;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class RetencionesController extends Controller
{

    public function index(Request $request)
    {
        $accion= $request->acciones;
        $clv=$request->id;
        switch ($accion) {
            case '':
                $isr=Retenciones::all();
                $retencion = Retenciones::first();
                return view('retenciones.crudretenciones', compact('isr','retencion'));
                break;

            case 'registrar':
                $this->store($request);
                return redirect()->route('retenciones.index');
                
                break;

            case 'cancelar':
                 return redirect()->route('retenciones.index');
                 break;

            case 'primero':
                return redirect()->route('retenciones.index');
                break;
            case 'atras':
                $id= Retenciones::where("id",$clv)->first();
                $retencion= Retenciones::where('id','<',$id->id)
                ->orderBy('id','desc')
                ->first();
                if(is_null($retencion)){
                  $retencion= Retenciones::get()->last();
                }
                $isr=Retenciones::all();
                return view('retenciones.crudretenciones', compact('isr','retencion'));
                break;

            case 'siguiente':
                $indic= Retenciones::where('id',$clv)->first();
               
                $retencion= Retenciones::where('id','>',$indic->id)->first();
                if($retencion==""){
                  $retencion= Retenciones::first();
                }
                $isr=Retenciones::all();
                return view('retenciones.crudretenciones', compact('isr','retencion'));
                break;

            case 'ultimo':
                $retencion= Retenciones::get()->last();
                $isr=Retenciones::all();
                return view('retenciones.crudretenciones', compact('isr','retencion'));
                break;

            case 'actualizar':
                $this->update($request);
                return redirect()->route('retenciones.index');
                break;

            case 'buscar':
                $criterio= $request->opcion;
                if($criterio == 'limite_inferior'){
                    $retencion= Retenciones::where('limite_inferior',$request->busca)->first();

                    if($retencion == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }
                     $isr=Retenciones::all();
                    return view('retenciones.crudretenciones', compact('isr','retencion'));

                }else if($criterio == 'limite_superior'){
                    $retencion= Retenciones::where('limite_superior',$request->busca)->first();

                    if($retencion == "")
                        {
                          return back()->with('busqueda','Coincidencia no encontrada');
                        }
                    $isr=Retenciones::all();
                    return view('retenciones.crudretenciones', compact('isr','retencion'));

                }
                break;
            default:
                # code...
                break;
        }
        
    }


    public function store($datos)
    {
        $datos->validate([
              'limite_inferior' => 'required',
              'cuota_fija' => 'required',
              'limite_superior' => 'required',
              'porcentaje_excedente' => 'required',
              'periodo_retencion' => 'required'
        ]);

        $coincidencia = Retenciones::where([
            ['limite_inferior','=',$datos->limite_inferior],
            ['limite_superior','=',$datos->limite_superior],
        ])->get();

        if($coincidencia->count() === 0)
        {
            $retencion = new Retenciones;
            $retencion->limite_inferior = $datos->limite_inferior;
            $retencion->cuota_fija = $datos->cuota_fija;
            $retencion->limite_superior = $datos->limite_superior;
            $retencion->porcentaje_excedente = $datos->porcentaje_excedente;
            $retencion->periodo_retencion = $datos->periodo_retencion;
            $retencion->save();  
        }else{
            return back()->with('msj','Registro duplicado');
        }
        
    }

   
    public function update($datos)
    {
        $datos->validate([
              'limite_inferior' => 'required',
              'cuota_fija' => 'required',
              'limite_superior' => 'required',
              'porcentaje_excedente' => 'required',
              'periodo_retencion' => 'required'
        ]);

        $retencion= Retenciones::where('id',$datos->id)->first();
        $retencion->limite_inferior = $datos->limite_inferior;
        $retencion->cuota_fija = $datos->cuota_fija;
        $retencion->limite_superior = $datos->limite_superior;
        $retencion->porcentaje_excedente = $datos->porcentaje_excedente;
        $retencion->periodo_retencion = $datos->periodo_retencion;
        $retencion->save();
    }

    public function show($id)
    {
        $isr=Retenciones::all();
        $retencion = Retenciones::find($id);
        return view('retenciones.crudretenciones', compact('isr','retencion'));
    }
    
    public function destroy($id)
    {
        $retencion = Retenciones::find($id);
        $retencion->delete();
        return redirect()->route('retenciones.index');
    }
}
