<?php

namespace App\Http\Controllers;

use App\Prestaciones;
use Illuminate\Http\Request;

class PrestacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)//funcion que permite el movimiento de los botones (flechas) para poder mostrar los pretaciones registrados
    {
        $accion= $request->acciones;
        $clv= $request->anio;
        switch ($accion) {//switch que permite las acciones atras,siguiente,irse hasta al primer registro o hasta el ultimo

            case ''://trae el primer registro
                $aux = Prestaciones::first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            case 'atras'://trae el registro anterior
                $aux1= Prestaciones::where('anio',$clv)->get()->last();
                $indic= $aux1->id;
                $aux= Prestaciones::where('id','<',$indic)->latest('id')->first();
                 if($aux==""){
                    $aux= Prestaciones::get()->last();  
                 }
                 $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                
                break;

            case 'siguiente'://trae el siguiente registro.
                $aux1= Prestaciones::where('anio',$clv)->get()->last();
                $indic= $aux1->id;
                $aux= Prestaciones::where('id','>',$indic)->first();
                 if($aux==""){
                    $aux= Prestaciones::get()->first();  
                 }
                 $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                
                break;

            case 'primero'://trae el primer registro
                $aux = Prestaciones::first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            case 'ultimo'://trae el ultimo registro
                $aux = Prestaciones::latest('id')->first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            case 'registrar'://para el boton registrar, usa el metodo store
                $this->store($request);
                return redirect()->route('prestaciones.index');
                break;

            case 'actualizar'://permite actualizar el registro usando el metdo update
                $this->update($request);
                return redirect()->route('prestaciones.index');
                break;
            case 'cancelar_prestaciones':
                return redirect()->route('prestaciones.index');
                break;
            default:
                # code...
                break;
        }
        return view('prestaciones.prestaciones');
    }

   
    public function store($datos)
    {
        if ($datos->anio === null || $datos->dias === null || $datos->prima_vacacional === null || $datos->aguinaldo === null) {
           return redirect()->route('prestaciones.index');
        }
        $prestaciones= new Prestaciones();
        $prestaciones->anio= $datos->anio;
        $prestaciones->dias= $datos->dias;
        $prestaciones->prima_vacacional= $datos->prima_vacacional;
        $prestaciones->aguinaldo= $datos->aguinaldo;
        $prestaciones->save();

    }

    public function update($datos)
    {
        $prestaciones= Prestaciones::where('anio',$datos->anio)->first();
        $prestaciones->dias= $datos->dias;
        $prestaciones->prima_vacacional= $datos->prima_vacacional; 
        $prestaciones->aguinaldo= $datos->aguinaldo;

        $prestaciones->save();
    }

   
    public function destroy($id)
    {
        $prestacion = Prestaciones::find($id);
        $prestacion->delete();
        return redirect()->route('prestaciones.index');
    }
}
