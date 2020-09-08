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
    
    public function acciones(Request $request){
        $accion= $request->acciones;
        $clv=$request->clave_banco;
        
        
           switch ($accion) {
               case '':
                   $banco= Banco::first();
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
                   break;

               case 'atras':
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
               
               case 'siguiente':
                   $banc= Banco::where('clave_banco',$clv)->first();
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
               $banco= Banco::first();
               $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               case 'actualizar':
                   $this->actualizar($request);
                   $banco= Banco::first();
                   $bancos=Banco::all();
                   return view('bancos.bancos', compact('banco','bancos'));
               break;
               case 'cancelar':
                   return back();
               break;
               case 'cancelar_banco';
                   return back();
               break; 
               case 'cancelar_actualiza':
                        return back();
                        break;       
               default:
                   # code...
               break;
           }
   
       }

       public function actualizar($datos){ 
        $banc= Banco::where('clave_banco',$datos->clave_banco)->first();
        $banc->nombre_banco= $datos->nombre_banco; 
        $banc->save();
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
            $banco= new Banco;
            $clave= $this->generador();
            $banco->clave_banco= $clave;
            $banco->nombre_banco= $datos->nombre_banco;
            $banco->save();
          }

    public function eliminarbanco($id){
      $banc = Banco::find($id);
      $banc->delete();
      $banco= Banco::first();
      $bancos=Banco::all();
      return view('bancos.bancos', compact('banco','bancos'));
    }
}