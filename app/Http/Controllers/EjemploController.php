<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class EjemploController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pruba');
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

         $year =  date ('Y',strtotime($request->fecha));
         $validacion = checkdate(2,29,$year);

        if($validacion){
            return "Bisiesto";
        }else{
            return "No es bisiesto";
        }
        
       /* $diaInicio="Monday";
        $diaFin="Sunday";
    
        $strFecha = strtotime($request->fecha);
       
        $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
        $fechaFin = date('Y-m-d',strtotime('next '.$diaFin,$strFecha));

        echo $request->fecha;
        echo "<br>";
        echo $fechaInicio;
        echo "<br>";
        echo $fechaFin;*/
    
    
        /*if(date("l",$strFecha)==$diaInicio){
            $fechaInicio= date("Y-m-d",$strFecha);
        }
        if(date("l",$strFecha)==$diaFin){
            $fechaFin= date("Y-m-d",$strFecha);
        }
        return Array("fechaInicio"=>$fechaInicio,"fechaFin"=>$fechaFin);*/
        
        
        
        
        /*$fechaInicio = date('Y-m-d',strtotime($request->fecha));
        $diaInicio = date('d',strtotime($request->fecha));
        $mesInicio = date('m',strtotime($request->fecha));
        $anioInicio = date('Y',strtotime($request->fecha));

        $numero = 1;
        $fechaInicio = date('Y-m-d',strtotime($request->fecha));
        $ped = $request->dias-1;
        $fechaFin = date("Y-m-d",strtotime($request->fecha."+ ".$ped." days"));

        echo $fechaInicio;
        echo "<br>";
        echo $fechaFin;
        echo "<br>";
        echo $mesInicio;
        echo "<br>";
        echo $anioInicio;
        echo "<br>";*/


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
