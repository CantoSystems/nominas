<?php

namespace App\Http\Controllers;

use DB;
use App\BaseVejez;
use Illuminate\Http\Request;

class BaseVejezController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function acciones(Request $request)
    {
        $accion = $request->acciones;
        $clv = $request->id;

        switch($accion){
            case '':
                $basevejez = BaseVejez::all();
                $vejez = BaseVejez::first();        
                return view('basevejez.basevejez', compact('basevejez','vejez'));
                break;
            case 'atras':
                $basevejez = BaseVejez::all();
                $vejez = BaseVejez::where('id','<',$clv)
                                ->orderBy('id','desc')
                                ->first();
                    if(is_null($vejez))
                    {
                        $vejez = BaseVejez::get()->last();
                    }
                    return view('basevejez.basevejez', compact('basevejez','vejez'));
                break;
            case 'siguiente':
                $basevejez = BaseVejez::all();
                $vejez = BaseVejez::where('id','>',$clv)
                            ->orderBy('id','desc')
                            ->first();
                    if(is_null($vejez))
                    {
                        $vejez = BaseVejez::first();
                    }
                    return view('basevejez.basevejez', compact('basevejez','vejez'));
                break;
            case 'primero':
                return redirect()->route('vejez.acciones');
                break;
            case 'ultimo';
                $basevejez = BaseVejez::all();
                $vejez = BaseVejez::get()->last(); 
                return view('basevejez.basevejez', compact('basevejez','vejez'));
                break;
            case 'registrar':
                $this->registrar($request);
                return redirect()->route('vejez.acciones');
                break;
            case 'actualizar':
                $this->actualizar($request);
                return redirect()->route('vejez.acciones');
                break;
            case 'cancelar':
                return redirect()->route('vejez.acciones');
                break;

        }
    }

    public function registrar($datos){
        $datos->validate([
            'de_salariocotizacion_vejez' => 'required',
            'hasta_salariocotizacion_vejez' => 'required',
            'cuotapatronal_vejez' => 'required',
        ]);

        $vejeznuevo =  new BaseVejez;
        $vejeznuevo->de_salariocotizacion_vejez = $datos->de_salariocotizacion_vejez;
        $vejeznuevo->hasta_salariocotizacion_vejez = $datos->hasta_salariocotizacion_vejez;
        $vejeznuevo->cuotapatronal_vejez = $datos->cuotapatronal_vejez;
        $vejeznuevo->save();

    }

    public function actualizar($datos)
    {
        $datos->validate([
            'de_salariocotizacion_vejez' => 'required',
            'hasta_salariocotizacion_vejez' => 'required',
            'cuotapatronal_vejez' => 'required',
        ]);
        $vejezactualizar = BaseVejez::find($datos->id);
        $vejezactualizar->de_salariocotizacion_vejez = $datos->de_salariocotizacion_vejez;
        $vejezactualizar->hasta_salariocotizacion_vejez = $datos->hasta_salariocotizacion_vejez;
        $vejezactualizar->cuotapatronal_vejez = $datos->cuotapatronal_vejez;
        $vejezactualizar->save();
    }
    public function show($id)
    {
        $vejez = BaseVejez::find($id);
        $basevejez = BaseVejez::all();
        return view('basevejez.basevejez', compact('basevejez','vejez'));
    }

    public function eliminarbasevejez($id)
    {
        $vejezeliminar = BaseVejez::find($id);
        $vejezeliminar->delete();
        return redirect()->route('vejez.acciones');
    }

}
