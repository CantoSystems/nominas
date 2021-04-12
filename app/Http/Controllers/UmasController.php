<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Umas;

class UmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accion= $request->acciones;
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
                $uma= Umas::get()->last();
                //return $uma;
                $umas= Umas::all();
                return view('umas.crud-umas', compact('uma','umas'));
                break;
            case 'atras':
                $identificador = Umas::where('id','=',$request->id)->first();
                $uma = Umas::where('id','<',$identificador->id)
                ->orderBy('id','desc')
                ->first();
                if(is_null($uma)){
                    $uma = Umas::get()->last();
                }
                $umas = Umas::all();
                return view('umas.crud-umas', compact('uma','umas'));
                break;

            case 'siguiente':
                $identificador = Umas::where('id','=',$request->id)->first();
                $uma = Umas::where('id','>',$identificador->id)
                ->first();

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
            case 'buscar':
               $criterio = $request->opcion;
               if($criterio == 'id'){
                  $uma = Umas::where('id','=',$request->busca)->first();
                  if($uma == ""){
                    return back()->with('busqueda','Coincidencia no encontrada');
                  }
                $umas=Umas::all();
                return view('umas.crud-umas', compact('uma','umas'));
               }
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($datos)
    {   
        //dd($datos);

        $uma = new Umas();
        $uma->porcentaje_uma = $datos->porcentaje_uma;
        $uma->save();
    }

    public function update($datos)
    {
        $uma = Umas::where('id','=',$datos->id)->first();
        $uma->porcentaje_uma = $datos->porcentaje_uma;
        $uma->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Umas  $umas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uma = Umas::find($id);
        $uma->delete();
        return redirect()->route('umas.index');
    }

}