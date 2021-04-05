<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
use Session;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use App\CalculosTiempoExtra\OperacionesSalarioCalculado;

class SeleccionTiempoExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $this->OperacionFragmentaSemanas();

        
        
       
       

                            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $fechaInicial = now()->firstOfMonth();
        $fechaFinal = now()->lastOfMonth();


    $semanaUno = now()->firstOfMonth()->addWeek();

    echo $semanaUno;

    echo "<br>";

    $semanaDos = now()->firstOfMonth()->addWeeks(2);

    echo $semanaDos;

    echo "<br>";

   if ($fechaInicial->diffInDays($fechaFinal) >= 28) {
    echo "El periodo es mensual";
   }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $fechaInicial = now()->createMidnightDate(2021, 03, 1);
        $fechaOriginal = now()->createMidnightDate(2021, 03, 1);
        $fechaFinal = now()->createMidnightDate(2021, 03, 31);

        $diferenciaDias = $fechaInicial->diffInDays($fechaFinal);

        echo $diferenciaDias."<br />";

        $semanaUno = $fechaInicial->addWeek();

        echo "La semana inicia en $fechaOriginal y termina".$semanaUno."<br>";
        $nuevaFecha = $semanaUno->addDay(1);
        echo $nuevaFecha;

        $semanaDos = $semanaUno->addWeek();

    echo $semanaDos;
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
