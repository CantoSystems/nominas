<?php

namespace App\Http\Controllers;
use App\Clasificacion;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class ClasificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function acciones(Request $request){
        $accion= $request->acciones;
        $clv=$request->clave;
        
        
           switch ($accion) {
               case '':
                   $clasificacion= Clasificacion::first();
                   $clasificaciones=clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasificacion','clasificaciones'));
                   break;

               case 'atras':
                $id= Clasificacion::where("clave",$clv)->first();
               $clasificacion= Clasificacion::where('id','<',$id->id)
            ->orderBy('id','desc')
            ->first();
            if(is_null($clasificacion)){
                $clasificacion= Clasificacion::get()->last();
            }
            $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasificacion','clasificaciones'));
               break;
               
               case 'siguiente':
                   $clasif= Clasificacion::where('clave',$clv)->first();
                   $indic= $clasif->id;
                   $clasificacion= Clasificacion::where('id','>',$indic)->first();
                   if($clasificacion==""){
                      $clasificacion= Clasificacion::first();  
                   }
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasificacion','clasificaciones'));
               break;
               case 'primero':
                   $clasificacion= Clasificacion::first();
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasificacion','clasificaciones'));
               break;
               case 'ultimo':
                   $clasificacion= Clasificacion::get()->last(); 
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasificacion','clasificaciones'));
               break;
               case 'registrar':
               $this->registrar($request);
               $clasificacion= Clasificacion::first();
               $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasificacion','clasificaciones'));
               break;
               case 'actualizar':
                   $this->actualizar($request);
                   $clasificacion= Clasificacion::first();
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasificacion','clasificaciones'));
               break;
               case 'cancelar':
                   return back();
               break;
               case 'cancelar_actualiza';
                   return back();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
