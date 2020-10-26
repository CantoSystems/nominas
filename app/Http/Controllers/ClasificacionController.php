<?php

namespace App\Http\Controllers;
use App\Clasificacion;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;

class ClasificacionController extends Controller
{
  

    public function acciones(Request $request){//funcion que permite el movimiento de los botones (flechas) para poder mostrar las clasificaciones registradas
        $accion= $request->acciones;
        $clv=$request->clave;
        
        //switch que permite las acciones atras,siguiente,irse hasta al primer registro o hasta el ultimo
           switch ($accion) {
               case ''://caso vacio, refleja el primer registro o la primer clasficacion
                   $clasifica= Clasificacion::first();
                   $clasificaciones= Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
                   break;

               case 'atras'://caso atras, permite ir al registro anterior en el que se encuentra haciendo la consulta con la variable clv traida con el request "clave"
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
               
               case 'siguiente'://caso siguiente, permite ir al registro siguiente en el que se encuentra haciendo la consulta con la variable clv traida con el request "clave"
                   $clasif= Clasificacion::where('clave',$clv)->first();
                   $indic= $clasif->id;
                   $clasifica= Clasificacion::where('id','>',$indic)->first();
                   if($clasifica==""){
                      $clasifica= Clasificacion::first();  
                   }
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
               break;
               case 'primero'://caso primero, trae el primer registro de todos
                   $clasifica= Clasificacion::first();
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
               break;
               case 'ultimo'://caso ultimo, trae el primer registro de todos
                   $clasifica= Clasificacion::get()->last(); 
                   $clasificaciones=Clasificacion::all();
                   return view('clasificaciones.clasificacion', compact('clasifica','clasificaciones'));
               break;
               case 'registrar':
                  $this->registrar($request);
                  return redirect()->route('clasificacion.acciones');
               break;
               case 'actualizar':
                   $this->actualizar($request);
                   return redirect()->route('clasificacion.acciones');
               break;
               case 'cancelar':
                   return redirect()->route('clasificacion.acciones');
               break;
               case 'cancelar_actualiza';
                   return redirect()->route('clasificacion.acciones');
               break; 
               case 'buscar'://buscador que permite hacerla por cualquiera de sus campos 
                $criterio= $request->opcion;
                if($criterio=='conceptos'){
                  $clasifica = DB::connection('mysql')->table('clasificacions')->where('conceptos',$request->busca)->first(); 
                }
                if($criterio=='clave'){
                  $clasifica = DB::connection('mysql')->table('clasificacions')->where('clave_clasificacion',$request->busca)->first(); 
                }
                if($criterio=='digito'){
                    $clasifica = DB::connection('mysql')->table('clasificacions')->where('digito',$request->busca)->first(); 
                  }
                $clasificaciones = DB::connection('mysql')->table('clasificacions')->get();     
                
              return view('clasificaciones.clasificacion',compact('clasifica','clasificaciones'));
               break;        
               default:
                   # code...
               break;
           }
   
       }

       public function actualizar($datos){//metodo que permite actualizar los una clasificacion por medio de la clave
        $clasif= Clasificacion::where('clave',$datos->clave)->first();
        $clasif->clave_clasificacion= $datos->clave_clasificacion;
        $clasif->digito= $datos->digito; 
        $clasif->conceptos= $datos->conceptos; 
        $clasif->save();
     }

     public function generador(){//funcion que genera la clave 
        $raiz= '0123456789';
        $codigo='';
        for ($i=0; $i < 3; $i++) { 
            $letra= $raiz[mt_rand(0, 4 - 1)];
            $codigo .=$letra;
        }
        return $codigo;
        }


        public function registrar($datos){//metodo que permite registrar una nueva clasificacion instanciando un nuevo objeto Clasificacion
            if ($datos->clave_clasificacion === null || $datos->digito === null || $datos->conceptos === null) {
              return redirect()->route('clasificacion.acciones');
            }
            $clasificacion= new Clasificacion;
            $clave= $this->generador();
            $clasificacion->clave= $clave;
            $clasificacion->clave_clasificacion= $datos->clave_clasificacion;
            $clasificacion->digito= $datos->digito;
            $clasificacion->conceptos= $datos->conceptos;
            $clasificacion->save();
          }

    public function destroy($id)//elimina un registro de clasificacion por su id
    {
        $clasificar= Clasificacion::find($id);
        $clasificar->delete();
        return redirect()->route('clasificacion.acciones');
    }
}
