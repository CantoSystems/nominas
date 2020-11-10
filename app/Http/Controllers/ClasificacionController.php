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
    * Control de los botones siguiente | atras | delante | ultimo
    * Realiza el vaciado de los registros en l tabla así como en 
    * el Datatable mediante las consultas 
    * Modelo involucrado Clasificaciones
    * Envia el Request a los metodos actualizar | registar
    * Implementa un modal de busqueda
    * Elimina registro modal
    * @version V1
    * @author Gustavo | Elizabeth
    * @param $request | Array 
    * @return vista   | $clasificaciones | array 
    */

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
               case 'buscar':
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

        /**
      * Recibe los valores del request
      * Comprara la clave  la primer coincidencia 
      * Actualiza y guarda el registro
      * @version V1
      * @author Gustavo
      * @param $datos | Array del request
      * @return void 
      */

       public function actualizar($datos){
        $clasif= Clasificacion::where('clave',$datos->clave)->first();
        $clasif->clave_clasificacion= $datos->clave_clasificacion;
        $clasif->digito= $datos->digito; 
        $clasif->conceptos= $datos->conceptos; 
        $clasif->save();
     }
        /**
      *Genera un numero random de digitos 
      *Para la clave indicadora del clasificaciones
      * @version V1
      * @author Gustavo
      * @param void
      * @return $codigo | int 
      */

     public function generador(){
        $raiz= '0123456789';
        $codigo='';
        for ($i=0; $i < 3; $i++) { 
            $letra= $raiz[mt_rand(0, 4 - 1)];
            $codigo .=$letra;
        }
        return $codigo;
        }

        /**
          *
          * Recibe el $request del metodo accciones
          * Modelo involucrado Banco
          * Valida el clave_clasificacion |digito  | conceptosno veng vacio
          * guarda el resultado del funcion generador 
          * @version V1
          * @author Gustavo
          * @param void
          * @return void 
        */
        public function registrar($datos){
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
       }
     /**
    *Elimina el registro de la tabla eliminar clasificacion
    *Elimina mediante el modelo y el ORm por id
    *Con la clave de la empresa
    *@version V1
    *@return Redirecciona un cambio de funcion en el controlador
    *@author Elizabeth
    *@param id | Integer
    */

    public function destroy($id)
        $clasificar= Clasificacion::find($id);
        $clasificar->delete();
        return redirect()->route('clasificacion.acciones');
    }
}
