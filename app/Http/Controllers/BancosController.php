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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index(){ 

     }
    
    public function acciones(Request $request){//funcion que permite el movimiento de los botones (flechas) para poder mostrar los bancos registrados
        $accion= $request->acciones;
        $clv=$request->clave_banco;
        
        //switch que permite las acciones atras,siguiente,irse hasta al primer registro o hasta el ultimo
           switch ($accion) { 
               case ''://caso vacio, refleja el primer registro o el primer banco
                   $banco= Banco::first();
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
                   break;

               case 'atras'://caso atras, permite ir al registro anterior en el que se encuentra haciendo la consulta con la variable clv traida con el request "clave_banco"
                $id= Banco::where("clave_banco",$clv)->first();
                $banco= Banco::where('id','<',$id->id)
                ->orderBy('id','desc')
                ->first();
                if(is_null($banco)){
                    $banco= Banco::get()->last();
                  }
                $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               
               case 'siguiente': //caso siguiente, permite ir al registro siguiente en el que se encuentra haciendo la consulta con la variable clv traida con el request "clave_banco"
                   $banc= Banco::where('clave_banco',$clv)->first();
                   $indic= $banc->id;
                   $banco= Banco::where('id','>',$indic)->first();
                   if($banco==""){
                      $banco= Banco::first();  
                   }
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               case 'primero': //caso primero, trae el primer registro de todos
                   $banco= Banco::first();
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               case 'ultimo'://caso ultimo, trae el ultimo registro que se hizo en la tabla bancos
                   $banco= Banco::get()->last(); 
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               case 'registrar'://caso registrar, permite hacer un registro de un banco con su nombre y por default se le asigna una clave
                  $this->registrar($request);
                  return redirect()->route('bancos.acciones');
               break;
               case 'actualizar'://caso actualizar, permite editar el nombre del banco o registro en el que se este
                   $this->actualizar($request);
                   return redirect()->route('bancos.acciones');
               break;
               case 'cancelar':
                   return back();
               break;
               case 'cancelar_banco';
                   return back();
               break; 
               case 'cancelar_actualiza':
                  return redirect()->route('bancos.acciones');
                        break; 

                case 'buscar'://buscador que trae al input el banco que se requiera
                      
                      $banco = Banco::where('nombre_banco',$request->busca)->first();
                      $bancos= Banco::all();
                    return view('bancos.bancos',compact('banco','bancos'));
                     break; 

               default:
                   # code...
               break;
           }
   
       }

       public function actualizar($datos){ //funciona para poder actualizar compara la clave con la trae la variable datos
        $banc= Banco::where('clave_banco',$datos->clave_banco)->first();
        $banc->nombre_banco= $datos->nombre_banco; 
        $banc->save();
     }

    public function generador(){//genera la clave del banco, toma como base los numero del 0 a 9, con 3 digitos
        $raiz= '0123456789';
        $codigo='';
        for ($i=0; $i < 3; $i++) { 
            $letra= $raiz[mt_rand(0, 4 - 1)];
            $codigo .=$letra;
        }
        return $codigo;
        }


          public function registrar($datos){//funciona para poder registrar un nuevo banco 
            if ($datos->nombre_banco === null) {
              return redirect()->route('bancos.acciones');
            }
            $banco= new Banco; //instancia un nuevo objeto del modelo banco
            $clave= $this->generador();
            $banco->clave_banco= $clave;
            $banco->nombre_banco= $datos->nombre_banco;
            $banco->save();
          }

    public function eliminarbanco($id){//borra un banco buscandolo por su id
      $banc = Banco::find($id);
      $banc->delete();
      return redirect()->route('bancos.acciones');
    }
}