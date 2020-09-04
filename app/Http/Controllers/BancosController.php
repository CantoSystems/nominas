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
    
    public function accionesban(Request $request){
        $accion= $request->acciones;
        $clv=$request->clave_banco;
        
        
           switch ($accion) {
               case '':
                   $banco= Banco::first();
                   return view('bancos.bancos', compact('banco'));
                   break;

               case 'atras':
                $id= Banco::where("clave_banco",$clv)->first();
               $banco= Banco::where('id','<',$id->id)
            ->orderBy('id','desc')
            ->first();
            if(is_null($banco)){
                $banco= Banco::get()->last();
            }
            return view('bancos.bancos', compact('banco'));
               break;
               
               case 'siguiente':
                   $banc= Banco::where('clave_banco',$clv)->first();
                   $indic= $banc->id;
                   $banco= Banco::where('id','>',$indic)->first();
                   if($banco==""){
                      $banco= Banco::first();  
                   }
                   return view('bancos.bancos', compact('banco'));
               break;
               case 'primero':
                   $banco= Banco::first();
                   return view('bancos.bancos', compact('banco'));
               break;
               case 'ultimo':
                   $banco= Banco::get()->last(); 
                   return view('bancos.bancos', compact('banco')); 
               break;
               case 'registrar':
               $this->registrar($request);
               $banco= Banco::first();
               return view('bancos.bancos', compact('banco'));
               break;
               case 'actualizar':
                   $this->actualizar($request);
                   $banco= Banco::first();
                   return view('bancos.bancos', compact('banco'));
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
        $banc= Banco::where('clave_banco',$datos->clave_banco)->first();
        $banc->nombre_banco= $datos->nombre_banco;
        $banc->clave_banco= $datos->clave_banco;
        
        $banc ->save();
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

        public function seleccionarbanco(Request $request){
             $clv= $request->banco;
            $banco= Banco::where('clave_banco',$clv)->first();

            //Session::put('clave_banco',$banco->clave_banco);
            //Session::put('nombre_banco',$banco->nombre_banco);
            return view('bancos.bancos'); 
           } 

          public function registrar($datos){
            $banco= new Banco;
            $banco->clave_banco= $datos->clave_banco;
            $banco->nombre_banco= $datos->nombre_banco;
            $banco->save();
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