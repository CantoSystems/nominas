<?php


namespace App\Http\Controllers;

use App\Banco;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Session;


class BancosController extends Controller
{
    /**
    * Control de los botones siguiente | atras | delante | ultimo
    * Realiza el vaciado de los registros en l tabla así como en
    * el Datatable mediante las consultas
    * Modelo involucrado Bancos
    * Envia el Request a los metodos actualizar | registar
    * Implementa un modal de busqueda
    * Elimina registro modal
    * @version V1
    * @author Gustavo
    * @param $request | Array
    * @return vista   | $bancos | array
    */


    public function acciones(Request $request){
        $accion= $request->acciones;
        //$clv=$request->clave_banco;
        $clv=$request->id;


           switch ($accion) {
               case '':
                   $banco= Banco::first();
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
                   break;

               case 'atras':
                $id= Banco::where("id",$clv)->first();
                $banco= Banco::where('id','<',$id->id)
                ->orderBy('id','desc')
                ->first();
                if(is_null($banco)){
                    $banco= Banco::get()->last();
                  }
                $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;

               case 'siguiente':
                   $banc= Banco::where('id',$clv)->first();
                   $indic= $banc->id;
                   $banco= Banco::where('id','>',$indic)->first();
                   if($banco==""){
                      $banco= Banco::first();
                   }
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               case 'primero':
                   $banco= Banco::first();
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               case 'ultimo':
                   $banco= Banco::get()->last();
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               case 'registrar':
                  $this->registrar($request);
                  return redirect()->route('bancos.acciones');
               break;
               case 'actualizar':
                   $this->actualizar($request);
                   return redirect()->route('bancos.acciones');
               break;

               case 'cancelar':
                  return redirect()->route('bancos.acciones');
                        break;

                case 'buscar':

                      $banco = Banco::where('nombre_banco',$request->busca)->first();
                       if($banco==""){
                      $banco= Banco::first();
                      }
                      $bancos= Banco::all();
                    return view('bancos.bancos',compact('banco','bancos'));
                     break;

               default:
                   # code...
               break;
           }

       }

      /**
      * Recibe los valores del request
      * Comprara la clave del banco la primer coincidencia
      * Actualiza y guarda el registro
      * @version V1
      * @author Gustavo
      * @param $datos | Array del request
      * @return void
      */


       public function actualizar($datos){
        $datos->validate([
              'clave_banco' => 'required',
              'nombre_banco' => 'required',
            ]);
        $banc= Banco::where('id',$datos->id)->first();
        $banc->clave_banco= $datos->clave_banco;
        $banc->nombre_banco= $datos->nombre_banco;
        $banc->save();
     }

      /**
      *Genera un numero random de digitos
      *Para la clave indicadora del banco
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
          * Valida el nombre del banco no veng vacio
          * guarda el resultado del funcion generador
          * @version V1
          * @author Gustavo
          * @param void
          * @return $codigo | int
        */

          public function registrar($datos){
            $datos->validate([
              'clave_banco' => 'required|unique:bancos',
              'nombre_banco' => 'required|unique:bancos',
            ]);

            /**if ($datos->nombre_banco === null) {
              return redirect()->route('bancos.acciones');
            }*/
            $banco= new Banco;
            //$clave= $this->generador();
            $banco->clave_banco= $datos->clave_banco;
            $banco->nombre_banco= $datos->nombre_banco;
            $banco->save();
          }
     /**
    *Elimina el registro de la tabla eliminar banco
    *Elimina mediante el modelo y el ORm por id
    *Con la clave de la empresa
    *@version V1
    *@return Redirecciona un cambio de funcion en el controlador
    *@author Elizabeth
    *@param id | Integer
    */

    public function eliminarbanco($id){
      $banc = Banco::find($id);
      $banc->delete();
      return redirect()->route('bancos.acciones');
    }
}
