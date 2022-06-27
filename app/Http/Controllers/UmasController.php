<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Umas;

class UmasController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $accion = $request->acciones;
        switch ($accion) {
            case '':
                $uma = Umas::first();
                $umas = Umas::all();
                return view('umas.crud-umas',compact('uma','umas'));
                break;
            case 'registrar':
                $this->store($request);
                return redirect()->route('umas.index');
                break;
            case 'primero':
                return redirect()->route('umas.index');
                break;
            case 'ultimo':
                $uma = Umas::get()->last();
                $umas = Umas::all();
                
                return view('umas.crud-umas', compact('uma','umas'));
                break;
            case 'atras':
                $identificador = Umas::where('id','=',$request->id)->first();
                $uma = Umas::where('id','<',$identificador->id)->orderBy('id','desc')>first();
                
                if(is_null($uma)){
                    $uma = Umas::get()->last();
                }
                
                $umas = Umas::all();
                return view('umas.crud-umas', compact('uma','umas'));
                break;
            case 'siguiente':
                $identificador = Umas::where('id','=',$request->id)->first();
                $uma = Umas::where('id','>',$identificador->id)->first();

                if(is_null($uma)){
                    $uma = Umas::first();
                }
                $umas = Umas::all();
                return view('umas.crud-umas', compact('uma','umas'));
                break;
            case 'actualizar':
                $this->update($request);
                return redirect()->route('umas.index');
                break;
            case 'cancelar':
                return redirect()->route('umas.index');
                break;
            case 'buscar':
                $criterio = $request->opcion;
                
                if($criterio == 'id'){
                    $uma = Umas::where('id','=',$request->busca)->first();
                
                    if($uma == ""){
                        return back()->with('busqueda','Coincidencia no encontrada');
                    }

                    $umas=Umas::all();
                    return view('umas.crud-umas', compact('uma','umas'));
                }else if($criterio == 'inicial'){
                    $uma = Umas::where('periodoinicio_uma','=',$request->busca)->first();
                    
                    if(is_null($uma)){
                        return back()->with('busqueda','Coincidencia no encontrada');
                    }
                    
                    $umas= Umas::all();
                    return view('umas.crud-umas',compact('uma','umas'));
                }else if($criterio == 'final'){
                    $uma = Umas::where('periodofin_uma','=',$request->busca)->first();
                    
                    if(is_null($uma)){
                        return back()->with('busqueda','Coincidencia no encontrada');
                    }
                    
                    $umas= Umas::all();
                    return view('umas.crud-umas',compact('uma','umas'));
                }
                break;
            default:
                break;
        }
    }

    public function store($datos){  
        $coincidencia = Umas::where([
            ['periodoinicio_uma','=',$datos->periodoinicio_uma],
            ['periodofin_uma','=',$datos->periodofin_uma]
        ])->get();
        
        if($coincidencia->count() == 0){
            $uma = new Umas();
            $uma->periodoinicio_uma = $datos->periodoinicio_uma;
            $uma->periodofin_uma = $datos->periodofin_uma;
            $uma->porcentaje_uma = $datos->porcentaje_uma;
            $uma->save();
        }else{
            return back()->with('msj','Registro duplicado');
        }
    }

    public function show($id){
        $uma = Umas::find($id);
        $umas = Umas::all();
        return view('umas.crud-umas',compact('uma','umas'));
    }

    public function update($datos){
        $uma = Umas::where('id','=',$datos->id)->first();
        $uma->periodoinicio_uma = $datos->periodoinicio_uma;
        $uma->periodofin_uma = $datos->periodofin_uma;
        $uma->porcentaje_uma = $datos->porcentaje_uma;
        $uma->save();
    }

    public function destroy($id){
        $uma = Umas::find($id);
        $uma->delete();
        return redirect()->route('umas.index');
    }
}