<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ConceptosController extends Controller
{
 public function index(Request $request){
    $clv=Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);


    \Config::set('database.connections.DB_Serverr', $clv_empresa);


    $accion= $request->acciones;
    $indic=$request->identificador;

    switch ($accion) {
        case '':
            $aux = DB::connection('DB_Serverr')->table('conceptos')->first();
            return view('conceptos.conceptos',compact('aux'));
        break;

        case 'atras':
            $id=DB::connection('DB_Serverr')->table('conceptos')->
            where('clave_concepto',$request->clave_concepto)->first();
               $aux=DB::connection('DB_Serverr')->table('conceptos')->where('id','<',$id->id)
            ->orderBy('id','desc')
            ->first();
            if(is_null($aux)){
                $aux=DB::connection('DB_Serverr')->table('conceptos')->get()->last();
            }
            return view('conceptos.conceptos', compact('aux'));
        break;

        case 'siguiente':
            $id=DB::connection('DB_Serverr')->table('conceptos')->
            where('clave_concepto',$request->clave_concepto)->first();
               $aux=DB::connection('DB_Serverr')->table('conceptos')->where('id','>',$id->id)
            ->orderBy('id','asc')
            ->first();
            if(is_null($aux)){
                $aux=DB::connection('DB_Serverr')->table('conceptos')->first();
            }
            return view('conceptos.conceptos', compact('aux'));
        break;

        case 'primero':
            $aux = DB::connection('DB_Serverr')->table('conceptos')->first();
            return view('conceptos.conceptos',compact('aux'));
        break;

        case 'ultimo':
            $aux = DB::connection('DB_Serverr')->table('conceptos')->get()->last();
            return view('conceptos.conceptos',compact('aux'));
        break;

        case 'registrar':
            $this->registrar($request);
            return redirect()->route('conceptos.index');
        break;

        case 'actualizar':
            $this->actualizar($request);
            return redirect()->route('conceptos.index');
        break;

        case 'cancelar':
            return redirect()->route('conceptos.index');
        break;

        case 'buscar':

            $aux = DB::connection('DB_Serverr')->table('conceptos')->where('concepto',$request->busca)->first();
            $aux1 = DB::connection('DB_Serverr')->table('conceptos')->get();
          return view('conceptos.conceptos',compact('aux','aux1'));
          break;

        default:

        break;

    }

 }

 public function conectar($clv)
  {

    $configDb = [
        'driver'      => 'mysql',
        'host'        => env('DB_HOST', 'localhost'),
        'port'        => env('DB_PORT', '3306'),
        'database'    => $clv,
        'username'    => env('DB_USERNAME', 'root'),
        'password'    => env('DB_PASSWORD', ''),
        'unix_socket' => env('DB_SOCKET', ''),
        'charset'     => 'utf8',
        'collation'   => 'utf8_unicode_ci',
        'prefix'      => '',
        'strict'      => true,
        'engine'      => null,
    ];

    return $configDb;

  }

 public function registrar($datos){
    $clv=Session::get('clave_empresa');
    $clave_concepto= $datos->clave_concepto.$datos->naturaleza;
    if(is_null($datos->ispt)){
     $ispt=1;
    }
    else{
        $ispt=$datos->ispt;
    }
    if(is_null($datos->imss)){
        $imss=1;
    }
    else{
        $imss=$datos->imss;
    }
    if(is_null($datos->infonavit)){
        $infonavit=1;
    }
    else{
        $infonavit=$datos->infonavit;
    }
    if(is_null($datos->estatal)){
        $estatal=1;
    }
    else{
        $estatal=$datos->estatal;
    }

    $clv_empresa=$this->conectar($clv);


    \Config::set('database.connections.DB_Serverr', $clv_empresa);
    DB::connection('DB_Serverr')->insert('insert into conceptos (clave_concepto,concepto,formula,naturaleza,manejo
    ,cantidad,importe,monto,ispt,imss,infonavit,estatal)
    values (?,?,?,?,?,?,?,?,?,?,?,?)',[$clave_concepto,$datos->concepto,$datos->formula,$datos->naturaleza
    ,$datos->manejo,$datos->cantidad,$datos->importe,$datos->monto,$ispt,$imss,$infonavit,$estatal]);
}
public function generador($naturaleza){

	/*$raiz= '0123456789';
	$codigo='';
	for ($i=0; $i < 3; $i++) {
		$letra= $raiz[mt_rand(0, 4 - 1)];
		$codigo .=$letra;
    }
    $codigo=$codigo.$naturaleza;
	return $codigo;*/
    }

public function actualizar($datos){
    $clv=Session::get('clave_empresa');
    $clave_concepto= $datos->clave_concepto.$datos->naturaleza;
    //$this->generador($datos->naturaleza);
    if(is_null($datos->ispt)){
     $ispt=1;
    }
    else{
        $ispt=$datos->ispt;
    }
    if(is_null($datos->imss)){
        $imss=1;
    }
    else{
        $imss=$datos->imss;
    }
    if(is_null($datos->infonavit)){
        $infonavit=1;
    }
    else{
        $infonavit=$datos->infonavit;
    }
    if(is_null($datos->estatal)){
        $estatal=1;
    }
    else{
        $estatal=$datos->estatal;
    }

    $clv_empresa=$this->conectar($clv);


    \Config::set('database.connections.DB_Serverr', $clv_empresa);
    $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('clave_concepto',$datos->clave_concepto)->first();
     if($aux1!=="")
     {
         DB::connection('DB_Serverr')->table('conceptos')->where('clave_concepto',$datos->clave_concepto)
         ->update(['concepto'=>$datos->concepto,'formula'=>$datos->naturaleza,'manejo'=>$datos->manejo,
         'cantidad'=>$datos->cantidad,'importe'=>$datos->importe,'monto'=>$datos->monto, 'ispt'=>$ispt,
         'imss'=>$imss,'infonavit'=>$infonavit,'estatal'=>$estatal]);
     }
    }

    public function eliminaconcepto($id){
    $clv= Session::get('clave_empresa');
    $clv_empresa=$this->conectar($clv);


    \Config::set('database.connections.DB_Serverr', $clv_empresa);

    $aux1 = DB::connection('DB_Serverr')->table('conceptos')->where('id',$id)->delete();
    return redirect()->route('conceptos.index');

    }

}
