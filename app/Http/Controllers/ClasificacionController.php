<?php

namespace App\Http\Controllers;
use App\Clasificacion;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class ClasificacionController extends Controller
{
  

    public function acciones(Request $request){
        $accion= $request->acciones;
        $clv=$request->clave;
        
        
           switch ($accion) {
               case '':
                   $clasifica= Clasificacion::first();
                   $clasificaciones= Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
                   break;

               case 'atras':
                  $id= Clasificacion::where("clave",$clv)->first();
                  $clasifica= Clasificacion::where('id','<',$id->id)
                  ->orderBy('id','desc')
                  ->first();
                    if(is_null($clasifica)){
                    $clasifica= Clasificacion::get()->last();
                    }
                    $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
               break;
               
               case 'siguiente':
                   $clasif= Clasificacion::where('clave',$clv)->first();
                   $indic= $clasif->id;
                   $clasifica= Clasificacion::where('id','>',$indic)->first();
                   if($clasifica==""){
                      $clasifica= Clasificacion::first();  
                   }
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
               break;
               case 'primero':
                   $clasifica= Clasificacion::first();
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
               break;
               case 'ultimo':
                   $clasifica= Clasificacion::get()->last(); 
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
               break;
               case 'registrar':
               $this->registrar($request);
               $clasifica= Clasificacion::first();
               $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
               break;
               case 'actualizar':
                   $this->actualizar($request);
                   $clasifica= Clasificacion::first();
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
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

       public function actualizar($datos){ 
        $clasif= Clasificacion::where('clave',$datos->clave)->first();
        $clasif->clave_clasificacion= $datos->clave_clasificacion;
        $clasif->digito= $datos->digito; 
        $clasif->conceptos= $datos->conceptos; 
        $clasif->save();
     }

     public function generador(){
        $raiz= '0123456789';
        $codigo='';
        for ($i=0; $i < 3; $i++) { 
            $letra= $raiz[mt_rand(0, 4 - 1)];
            $codigo .=$letra;
        }
        return $codigo;
        }


        public function registrar($datos){
            $clasificacion= new Clasificacion;
            $clave= $this->generador();
            $clasificacion->clave= $clave;
            $clasificacion->clave_clasificacion= $datos->clave_clasificacion;
            $clasificacion->digito= $datos->digito;
            $clasificacion->conceptos= $datos->conceptos;
            $clasificacion->save();
          }

    public function destroy($id)
    {
        $clasificar= Clasificacion::find($id);
        $clasificar->delete();
        $clasifica= Clasificacion::first();
        $clasificaciones= Clasificacion::all();
        return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));

    }
}
