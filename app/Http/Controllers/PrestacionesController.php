<?php

namespace App\Http\Controllers;

use App\Prestaciones;
use Illuminate\Http\Request;

class PrestacionesController extends Controller
{
     /**
    * Control de los botones siguiente | atras | delante | ultimo
    * Realiza el vaciado de los registros en l tabla así como en
    * el Datatable mediante las consultas
    * Modelo involucrado Prestaciones
    * Envia el Request a los metodos actualizar | registar
    * Implementa un modal de busqueda
    * Elimina registro modal
    * @version V1
    * @author Gustavo | Elizabeth
    * @param $request | Array
    * @return vistas  | $prestciones  | array
    */
    public function index(Request $request)
    {
        $accion= $request->acciones;
        $clv= $request->anio;
        switch ($accion) {
            case '':
                $aux = Prestaciones::first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            case 'atras':
                $aux1= Prestaciones::where('anio',$clv)->get()->last();
                $indic= $aux1->id;
                $aux= Prestaciones::where('id','<',$indic)->latest('id')->first();
                 if($aux==""){
                    $aux= Prestaciones::get()->last();
                 }
                 $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));

                break;

            case 'siguiente':
                $aux1= Prestaciones::where('anio',$clv)->get()->last();
                $indic= $aux1->id;
                $aux= Prestaciones::where('id','>',$indic)->first();
                 if($aux==""){
                    $aux= Prestaciones::get()->first();
                 }
                 $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));

                break;

            case 'primero':
                $aux = Prestaciones::first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            case 'ultimo':
                $aux = Prestaciones::latest('id')->first();
                $prestaciones = Prestaciones::all();
                return view('prestaciones.prestaciones',compact('aux','prestaciones'));
                break;
            case 'registrar':
                $this->store($request);
                return redirect()->route('prestaciones.index');
                break;

            case 'actualizar':
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

        /**
          *
          * Recibe el $request del metodo index
          * Modelo involucrado Prestaciones
          * Valida los request para que no lleguen vacios
          * @version V1
          * @author Elizabeth
          * @param void
          * @return void
        */

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
    /**
      * Recibe los valores del request
      * Comprara el aniola primer coincidencia
      * Actualiza y guarda el registro
      * @version V1
      * @author Eizabeth
      * @param $datos | Array del request
      * @return void
      */
    public function update($datos)
    {
        $prestaciones= Prestaciones::where('anio',$datos->anio)->first();
        $prestaciones->dias= $datos->dias;
        $prestaciones->prima_vacacional= $datos->prima_vacacional;
        $prestaciones->aguinaldo= $datos->aguinaldo;
        $prestaciones->save();
    }

    /**
    *Elimina el registro de la tabla Prestaciones
    *@version V1
    *@return Redirecciona un cambio de funcion en el controlador
    *@author Elizabeth
    *@param id | Integer
    */


    public function destroy($id)
    {
        $prestacion = Prestaciones::find($id);
        $prestacion->delete();
        return redirect()->route('prestaciones.index');
    }
}
